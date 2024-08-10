<?php 
/*
	Template Name: Summer Relays - Add Time
*/
// Check that the user is logged in - if not redirect to login page
if ( ! is_user_logged_in() ) { wp_redirect( wp_login_url() . '?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] ) ); }
// Determine if the user is an administrator or not
$user = wp_get_current_user();
if ( ! is_user_in_role( 'administrator' ) ) { wp_redirect( get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ) ); }

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
	if ( isset( $_POST['addTimeForm'] ) ) {
		// Get the values from the form
		$runnerNumber = $_POST['runnerNumber'];
		$legMins = $_POST['legMins'];
		$legSecs = $_POST['legSecs'];
	}

	// Set postSuccess to true - this will get set to false during validation if a value fails
	$postSuccess = true;
	$errors = array();

	// Validate the runner number
	$runnerNumberErr = false;
	if ( strlen( $runnerNumber ) > 1 ) {
		// Check the last character is either A, B or C
		$runnerLeg = strtoupper( substr( $runnerNumber, strlen( $runnerNumber ) - 1, 1 ) );
		if ( ( $runnerLeg == 'A' ) || ( $runnerLeg == 'B' ) || ( $runnerLeg == 'C' ) ) {
			$teamNum = substr( $runnerNumber, 0, strlen( $runnerNumber ) - 1 );
			if ( is_numeric( $teamNum ) ) {
				$teamNum = $teamNum + 0; // Converts the value to a number
				// Get the team
				$team = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_c_teams WHERE TeamNumber = %d", $teamNum ) );
				if ( isset( $team ) ) {
					$teamID = $team->TeamID;
					$teamName = $team->TeamName;
					$runnerATime = $team->RunnerATime;
					$runnerALegTime = $team->RunnerALegTime;
					$runnerBTime = $team->RunnerBTime;
					$runnerBLegTime = $team->RunnerBLegTime;
					$runnerCTime = $team->RunnerCTime;
					$runnerCLegTime = $team->RunnerCLegTime;
					$teamTime = $team->TeamTime;

				} else {
					$runnerNumberErr = true;
					$errors[] = 'The runner number you have entered is not valid.';
					$postSuccess = false;
				}
			} else {
				$runnerNumberErr = true;
				$errors[] = 'The runner number you have entered is not valid.';
				$postSuccess = false;
			}
		} else {
			$runnerNumberErr = true;
			$errors[] = 'The runner number you have entered is not valid.';
			$postSuccess = false;
		}
	} else {
		$runnerNumberErr = true;
		$errors[] = 'The runner number you have entered is not valid.';
		$postSuccess = false;
	}

	// Validate the minutes
	$legMinsErr = false;
	if ( ( strlen( $legMins ) > 0 ) && ( is_numeric( $legMins ) ) && ( ( $legMins + 0) < 60 ) ) {
		$legMins = $legMins + 0;
	} else {
		$legMinsErr = true;
		$errors[] = 'The leg minutes value is not valid.';
		$postSuccess = false;
	}

	// Validate the seconds
	$legSecsErr = false;
	if ( ( strlen( $legSecs ) > 0 ) && ( is_numeric( $legSecs ) ) && ( ( $legSecs + 0) < 60 ) ) {
		$legSecs = $legSecs + 0;
	} else {
		$legSecsErr = true;
		$errors[] = 'The leg seconds value is not valid.';
		$postSuccess = false;
	}

	// Turn the minutes and seconds into a time
	if ( ( $legMinsErr == false ) && (  $legSecsErr == false ) ) {
		$gunTime = '00:' . $legMins . ':' . $legSecs;
	} 

	// Check the order that the numbers are being entered. A must be first, then B and so on.
	$runnerOrderErr = false;
	if ( ( $runnerLeg == 'B' ) && ( $runnerATime == '00:00:00' ) ) { 
		$runnerOrderErr = true;
		$errors[] = 'Runner A\'s time must be entered before runner B\'s.';
		$postSuccess = false;
	}
	if ( ( $runnerLeg == 'C' ) && ( $runnerBTime == '00:00:00' ) ) { 
		$runnerOrderErr = true;
		$errors[] = 'Runner B\'s time must be entered before runner C\'s.';
		$postSuccess = false;
	}

	// Check that runner's leg time is greater than the previous leg
	$runnerTimeErr = false;
	if ( ( $runnerLeg == 'B' ) && ( strtotime( $gunTime ) <= strtotime( $runnerATime ) ) ) {
		$runnerTimeErr = true;
		$errors[] = 'Runner B\'s time must be greater than runner A\'s.';
		$postSuccess = false;
	}
	if ( ( $runnerLeg == 'C' ) && ( strtotime( $gunTime ) <= strtotime( $runnerBTime ) ) ) {
		$runnerTimeErr = true;
		$errors[] = 'Runner C\'s time must be greater than runner B\'s.';
		$postSuccess = false;
	}
	
	if ( $postSuccess == true ) {
		$teamTime = gmdate( "H:i:s", strtotime( $gunTime ) );

		if ( $runnerLeg == 'A' ) {
			$runnerATime = gmdate( "H:i:s", strtotime( $gunTime ) );
			$runnerALegTime = gmdate( "H:i:s", strtotime( $gunTime ) );
			$legTime = $runnerALegTime;
		}

		if ( $runnerLeg == 'B' ) {
			$runnerBTime = gmdate( "H:i:s", strtotime( $gunTime ) );
			$runnerBLegTime = gmdate( "H:i:s", strtotime( $gunTime ) - strtotime( $runnerATime ) );
			$legTime = $runnerBLegTime;
		}

		if ( $runnerLeg == 'C' ) {
			$runnerCTime = gmdate( "H:i:s", strtotime( $gunTime ) );
			$runnerCLegTime = gmdate( "H:i:s", strtotime( $gunTime ) - strtotime( $runnerBTime ) );
			$legTime = $runnerCLegTime;
		}

		// Set the status
		if ( $runnerATime != '00:00:00' ) { $status = 6; }
		if ( $runnerBTime != '00:00:00' ) { $status = 7; }
		if ( $runnerCTime != '00:00:00' ) { $status = 8; }

		// Update the values
		$wpdb->update( 
			"{$wpdb->prefix}ghac_c_teams", 
			array(
				'RunnerATime' => $runnerATime,
				'RunnerALegTime' => $runnerALegTime,
				'RunnerBTime' => $runnerBTime,
				'RunnerBLegTime' => $runnerBLegTime,
				'RunnerCTime' => $runnerCTime,
				'RunnerCLegTime' => $runnerCLegTime,
				'TeamTime' => $teamTime,
				'TeamStatus' => $status
			),
			array(
				'TeamID' => $teamID
			)
		);

		// Reset the values
		$runnerNumber = '';
		$legMins = '';
		$legSecs = '';
	}
}
?>
<?php get_header(); ?>
<div class="content-1">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1><?php the_title(); ?></h1>
				<p>
					<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ) ?>" class="btn btn-primary">Back to Team Manager</a>
				</p>
			</div>
		</div>
		<div class="row">
            <div class="col-md-6">
				<form id="addTimeForm" name="addTimeForm" method="post" action="" novalidate class="mb-4 mb-lg-0">
					<input type="hidden" name="addTimeForm" value="1" />
                	<div class="card mb-3">
                    	<div class="card-header">
					    	Record Gun Time
						</div>
				    	<div class="card-body">
							<?php if ( ( ( isset( $postSuccess ) ) && ( $postSuccess == false ) ) || ( ( isset( $contactSuccess ) ) && ( $contactSuccess == false ) ) ) : ?>
                    			<div class="alert alert-danger" role="alert">
                        			<p>There are errors on the form. Please correct the following and re-submit:</p>
									<ul>
										<?php foreach ( $errors as $error ) { ?>
											<li><?php echo $error; ?></li>
										<?php } ?>
									</ul>
                    			</div>
                			<?php endif; ?>
                            <div class="mb-3">
						        <label for="runnerNumber" class="form-label">Runner Number</label>
                        	    <input type="text" id="runnerNumber" name="runnerNumber" aria-describedby="runnerNumberHelp" maxlength="10" class="form-control <?php if ( isset( $runnerNumberErr ) ) { echo( $runnerNumberErr == true ) ? 'is-invalid' : 'is-valid'; } ?>" value="<?php echo ( isset( $runnerNumber ) ) ? $runnerNumber : ''; ?>">
                        	    <div id="runnerNumberHelp" class="form-text">Enter the runner's bid number.</div>
                    	    </div>
							<div class="row mb-3">
								<div class="col">
									<label for="legMins" class="form-label">Minutes</label>
									<input type="number" id="legMins" name="legMins" aria-describedby="legMinsHelp" class="form-control <?php if ( isset( $legMinsErr ) ) { echo( $legMinsErr == true ) ? 'is-invalid' : 'is-valid'; } ?>" value="<?php echo isset( $legMins ) ? $legMins : ''; ?>">
									<div id="legMinsHelp" class="form-text">Enter the minutes portion of the runner's time.</div>
								</div>
								<div class="col">
									<label for="legSecs" class="form-label">Seconds</label>
									<input type="number" id="legSecs" name="legSecs" aria-describedby="legSecsHelp" class="form-control <?php if ( isset( $legSecsErr ) ) { echo( $legSecsErr == true ) ? 'is-invalid' : 'is-valid'; } ?>" value="<?php echo isset( $legSecs ) ? $legSecs : ''; ?>">
									<div id="legSecsHelp" class="form-text">Enter the seconds portion of the runner's time.</div>
								</div>
							</div>
                        	<div class="row">
								<div class="col">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
                    	</div>
                	</div>
				</form>
				<script>
    				window.onload = function() {
						var txtField;
						<?php if ( isset( $runnerNumberErr ) && ( $runnerNumberErr == true ) ) : ?>
							txtField = document.getElementById("runnerNumber");
						<?php elseif ( isset( $legMinsErr ) && ( $legMinsErr == true) ) : ?>
							txtField = document.getElementById("legMins");
						<?php elseif ( isset( $legSecsErr ) && ( $legSecsErr == true) ) : ?>
							txtField = document.getElementById("legSecs");
						<?php else : ?>
							txtField = document.getElementById("runnerNumber");
        				<?php endif; ?>
						txtField.focus();
						txtField.setSelectionRange(0, txtField.value.length);
    				};
				</script>
            </div>
			<div class="col-md-6">
				<?php if ( isset( $postSuccess ) && ( $postSuccess == true ) ) : ?>
					<div class="alert alert-info" role="alert">
						<h2>Runner Time Updated</h2>
						<p>You have successfully updated runner <?php echo $runnerLeg; ?>'s time within the team <i><?php echo $teamName; ?></i>.</p>
						<table>
							<tr>
								<th>Team Number:</th>
								<td><?php echo $teamNum; ?></td>
							</tr>
							<tr>
								<th>Runner Leg:</th>
								<td><?php echo $runnerLeg; ?></td>
							</tr>
							<tr>
								<th>Gun Time:</th>
								<td><?php echo gmdate( "H:i:s", strtotime( $gunTime ) ); ?></td>
							</tr>
							<tr>
								<th>Leg Time:</th>
								<td><?php echo $legTime; ?></td>
							</tr>
						</table>
					</div>
				<?php endif; ?>
				<?php if ( isset( $postSuccess ) && ( $postSuccess == false ) ) : ?>
					<div class="alert alert-warning" role="alert">
						<h2>Team Statistics</h2>
						<table>
							<tr>
								<th>Team Name</th>
								<td><?php echo $teamName; ?></td>
							</tr>
							<tr>
								<th>Team Number:</th>
								<td><?php echo $teamNum; ?></td>
							</tr>
							<tr>
								<th>Runner A:</th>
								<td><?php echo $runnerATime; ?></td>
							</tr>
							<tr>
								<th>Runner B:</th>
								<td><?php echo $runnerBTime; ?></td>
							</tr>
							<tr>
								<th>Runner C:</th>
								<td><?php echo $runnerCTime; ?></td>
							</tr>
						</table>
					</div>
				<?php endif; ?>
			</div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
