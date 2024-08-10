<?php 
/*
	Template Name: Summer Relays - Results (Individuals)
*/

$results = $wpdb->get_results( $wpdb->prepare( 
    "SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' " . 
    "ORDER BY LegTime ASC;" ) );
$overall_pos = 1;
$filter_pos = 1;
?>
<?php get_header(); ?>
<div class="content-1">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1><?php the_title(); ?></h1>
                <div class="alert alert-info">
                    <p>Click one of the buttons below to access alternative results views.</p>
                    <p>Please note that this page updates as results are entered. Results are provisional until officially confirmed.</p>
                </div>
                <p>
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-relay-teams-condensed' ); ?>" class="btn btn-primary">Teams (Condensed View)</a>&nbsp;&nbsp;
					<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-relay-teams-full' ); ?>" class="btn btn-primary">Teams (Full View)</a>&nbsp;&nbsp;
                    <a href="#" class="btn btn-secondary">Individuals</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-junior-races' ); ?>" class="btn btn-primary">Junior Races</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-relay-teams-leaderboards' ); ?>" class="btn btn-primary">Leaderboards</a>
				</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
      						    <th scope="col">Sex</th>
                                <th scope="col">Cat.</th>
							    <th scope="col">Age</th>
                                <th scope="col">Leg Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($results as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
                                    <td>
                                        <?php if ( is_user_in_role( 'administrator' ) ) : ?>
                                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->RunnerNumber; ?></a>
                                        <?php else: ?>
                                            <?php echo $row->RunnerNumber; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ( is_user_in_role( 'administrator' ) ) : ?>
                                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->RunnerName; ?></a>
                                        <?php else: ?>
                                            <?php echo $row->RunnerName; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td>
                                        <?php 
                                            switch ( $row->Category ) {
                                                case 'Senior Ladies':
                                                    echo 'F';
                                                    break;
                                                case 'Senior Mens':
                                                    echo 'M';
                                                    break;
                                                case 'Veteran Ladies':
                                                    echo 'F';
                                                    break;
                                                case 'Veteran Mens':
                                                    echo 'M';
                                                    break;
                                                default:
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            switch ( $row->Category ) {
                                                case 'Senior Ladies':
                                                    echo 'SL';
                                                    break;
                                                case 'Senior Mens':
                                                    echo 'SM';
                                                    break;
                                                case 'Veteran Ladies':
                                                    echo 'VL';
                                                    break;
                                                case 'Veteran Mens':
                                                    echo 'VM';
                                                    break;
                                                default:
                                            }
                                        ?>
                                    </td>
                                    <td>
										<?php 
											switch ( $row->AgeCategory ) {
												case 'Under 50':
													echo '';
													break;
												case 'Over 50':
													echo 'O50';
													break;
												case "Over 60":
													echo 'O60';
													break;
												default:
													echo '';
											}
										?>
                                    </td>
                                    <td><?php echo ( $row->LegTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>