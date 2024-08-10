<?php 
/*
	Template Name: Summer Relays - Results (Teams) - Full
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
                    <p>Click one of the buttons below to access alternative results views.</p>
                    <p>Please note that this page updates as results are entered. Results are provisional until officially confirmed.</p>
                </div>
                <p>
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-relay-teams-condensed' ); ?>" class="btn btn-primary">Teams (Condensed View)</a>&nbsp;&nbsp;
					<a href="#" class="btn btn-secondary">Teams (Full View)</a>&nbsp;&nbsp;
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
      						    <th scope="col">Cat.</th>
                                <th scope="col">Status</th>
                                <th scope="col">Runner A</th>
                                <th scope="col">Time</th>
                                <th scope="col">Runner B</th>
                                <th scope="col">Time</th>
                                <th scope="col">Runner C</th>
                                <th scope="col">Time</th>
							    <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($teams as $row) : ?>
                                <tr class="<?php echo ( $overall_pos % 2 == 0 ) ? 'table-secondary' : '' ?>">
                                    <td><?php echo ( $row->TeamStatus > 5 ) ? $overall_pos : ''; ?></td>
                                    <td>
                                        <?php if ( is_user_in_role( 'administrator' ) ) : ?>
                                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->TeamNumber; ?></a>
                                        <?php else: ?>
                                            <?php echo $row->TeamNumber; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ( is_user_in_role( 'administrator' ) ) : ?>
                                            <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/edit-team' ) . '?teamid=' . $row->TeamID; ?>"><?php echo $row->TeamName; ?></a>
                                        <?php else: ?>
                                            <?php echo $row->TeamName; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row->ClubName; ?></td>
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
                                            switch ( $row->TeamStatus ) {
                                                case 1:
                                                    echo 'Reg';
                                                    break;
                                                case 2:
                                                    echo 'Pre';
                                                    break;
                                                case 3:
                                                    echo 'DNS';
                                                    break;
                                                case 4:
                                                    echo 'DNF';
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
                                    <td>
                                        <?php echo ( $row->RunnerA ); ?>
                                        <sup>
											<?php 
												switch ( $row->RunnerACategory ) {
													case "Senior Ladies":
														echo " (SF)";
														break;
													case "Senior Mens":
														echo " (SM)";
														break;
													case "Veteran Ladies":
														echo " (VF)";
														break;
													case "Veteran Mens":
														echo " (VM)";
														break;
													default:
														"";
												}	
											?>
										</sup>
										<sup>
											<?php 
												switch ( $row->RunnerAAge ) {
													case "Under 50":
														echo "";
														break;
													case "Over 50":
														echo " (50)";
														break;
													case "Over 60":
														echo " (60)";
														break;
													default:
														echo "";
												}
											?>
										</sup>
                                    </td>
                                    <td><?php echo ( $row->RunnerALegTime ); ?></td>
                                    <td>
                                        <?php echo ( $row->RunnerB ); ?>
                                        <sup>
											<?php 
												switch ( $row->RunnerBCategory ) {
													case "Senior Ladies":
														echo " (SF)";
														break;
													case "Senior Mens":
														echo " (SM)";
														break;
													case "Veteran Ladies":
														echo " (VF)";
														break;
													case "Veteran Mens":
														echo " (VM)";
														break;
													default:
														echo "";
												}
											?>
										</sup>
										<sup>
											<?php 
												switch ( $row->RunnerBAge ) {
													case "Under 50":
														echo "";
														break;
													case "Over 50":
														echo " (50)";
														break;
													case "Over 60":
														echo " (60)";
														break;
													default:
														echo "";
												}
											?>
										</sup>
                                    </td>
                                    <td><?php echo ( $row->RunnerBLegTime ); ?></td>
                                    <td>
                                        <?php echo ( $row->RunnerC ); ?>
                                        <sup>
											<?php 
												switch ( $row->RunnerCCategory ) {
													case "Senior Ladies":
														echo " (SF)";
														break;
													case "Senior Mens":
														echo " (SM)";
														break;
													case "Veteran Ladies":
														echo " (VF)";
														break;
													case "Veteran Mens":
														echo " (VM)";
														break;
													default:
														echo "";
												}
											?>
										</sup>
										<sup>
											<?php 
												switch ( $row->RunnerCAge ) {
													case "Under 50":
														echo "";
														break;
													case "Over 50":
														echo " (50)";
														break;
													case "Over 60":
														echo " (60)";
														break;
													default:
														echo "";
												}
											?>
										</sup>
                                    </td>
                                    <td><?php echo ( $row->RunnerCLegTime ); ?></td>
                                    <td><?php echo ( $row->TeamStatus > 5 ) ? $row->TeamTime : ''; ?></td>
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