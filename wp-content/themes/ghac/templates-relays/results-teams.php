<?php 
/*
	Template Name: Summer Relays - Results (Teams)
*/

$teams = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_c_teams WHERE TeamStatus > 1 ORDER BY TeamStatus DESC, TeamTime ASC" ) );
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
                    <p>Click on the team names to display more details. Or click one of the buttons below to access alternative results views.</p>
                    <p>Please note that this page updates as results are entered. Results are provisional until officially confirmed.</p>
                </div>
                <p>
                    <a href="#" class="btn btn-secondary">Teams (Condensed View)</a>&nbsp;&nbsp;
					<a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-relay-teams-full' ); ?>" class="btn btn-primary">Teams (Full View)</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-relay-teams-individuals' ); ?>" class="btn btn-primary">Individuals</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-junior-races' ); ?>" class="btn btn-primary">Junior Races</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-relay-teams-leaderboards' ); ?>" class="btn btn-primary">Leaderboards</a>
				</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club Name</th>
      						    <th scope="col">Category</th>
                                <th scope="col">Status</th>
							    <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($teams as $row) : ?>
                                <tr class="<?php echo ( $overall_pos % 2 == 0 ) ? 'table-secondary' : '' ?>">
                                    <td><?php echo ( $row->TeamStatus > 5 ) ? $overall_pos : ''; ?></td>
                                    <td><a href="#teamRunners<?php echo $row->TeamID ?>" data-bs-toggle="collapse" aria-expanded="false" aria-controls="teamRunners<?php echo $row->TeamID ?>"><?php echo $row->TeamNumber; ?></a></td>
                                    <td><a href="#teamRunners<?php echo $row->TeamID ?>" data-bs-toggle="collapse" aria-expanded="false" aria-controls="teamRunners<?php echo $row->TeamID ?>"><?php echo $row->TeamName; ?></a></td>
                                    <td><?php echo $row->ClubName; ?></td>
                                    <td><?php echo $row->Category; ?></td>
                                    <td>
                                        <?php 
                                            switch ( $row->TeamStatus ) {
                                                case 1:
                                                    echo 'Registration';
                                                    break;
                                                case 2:
                                                    echo 'Pre-Race';
                                                    break;
                                                case 3:
                                                    echo 'Did Not Start';
                                                    break;
                                                case 4:
                                                    echo 'Did Not Finish';
                                                    break;
                                                case 5:
                                                    echo 'Invalid';
                                                    break;
                                                case 6:
                                                    echo 'Leg 1';
                                                    break;
                                                case 7:
                                                    echo 'Leg 2';
                                                    break;
                                                case 8:
                                                    echo 'Finished';
                                                    break;
                                                default:
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo ( $row->TeamStatus > 5 ) ? $row->TeamTime : ''; ?></td>
                                </tr>
                                <tr class='table-info'>
                                    <td id="teamRunners<?php echo $row->TeamID ?>" colspan="7" class="collapse">
                                        <table class="table table-info">
                                            <thead>
                                                <tr>
                                                    <th>Leg</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Age Band</th>
                                                    <th>Leg Time</th>
                                                    <th>Gun Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>A</td>
                                                    <td><?php echo $row->RunnerA; ?></td>
                                                    <td><?php echo $row->RunnerACategory; ?></td>
                                                    <td><?php echo $row->RunnerAAge; ?></td>
                                                    <td><?php echo $row->RunnerALegTime; ?></td>
                                                    <td><?php echo $row->RunnerATime; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>B</td>
                                                    <td><?php echo $row->RunnerB; ?></td>
                                                    <td><?php echo $row->RunnerBCategory; ?></td>
                                                    <td><?php echo $row->RunnerBAge; ?></td>
                                                    <td><?php echo $row->RunnerBLegTime; ?></td>
                                                    <td><?php echo $row->RunnerBTime; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>C</td>
                                                    <td><?php echo $row->RunnerC; ?></td>
                                                    <td><?php echo $row->RunnerCCategory; ?></td>
                                                    <td><?php echo $row->RunnerCAge; ?></td>
                                                    <td><?php echo $row->RunnerCLegTime; ?></td>
                                                    <td><?php echo $row->RunnerCTime; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div>
                                            <?php if ( is_user_in_role( 'administrator' ) ) : ?>
					                            <p>
						                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>" class="btn btn-primary">Edit Team</a>
					                            </p>
				                            <?php endif; ?>
                                        </div>
                                    </td>
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