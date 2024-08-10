<?php 
/*
	Template Name: Summer Relays - Results (Leaderboard)
*/

$seniorMensTeams = $wpdb->get_results( $wpdb->prepare( "SELECT * from {$wpdb->prefix}ghac_c_teams WHERE Category = 'Senior Mens' AND TeamTime <> '00:00:00' ORDER BY TeamStatus DESC, TeamTime ASC LIMIT 3;" ) );
$seniorLadiesTeams = $wpdb->get_results( $wpdb->prepare( "SELECT * from {$wpdb->prefix}ghac_c_teams WHERE Category = 'Senior Ladies' AND TeamTime <> '00:00:00' ORDER BY TeamStatus DESC, TeamTime ASC LIMIT 3;" ) );
$veteranMensTeams = $wpdb->get_results( $wpdb->prepare( "SELECT * from {$wpdb->prefix}ghac_c_teams WHERE Category = 'Veteran Mens' AND TeamTime <> '00:00:00' ORDER BY TeamStatus DESC, TeamTime ASC LIMIT 3;" ) );
$veteranLadiesTeams = $wpdb->get_results( $wpdb->prepare( "SELECT * from {$wpdb->prefix}ghac_c_teams WHERE Category = 'Veteran Ladies' AND TeamTime <> '00:00:00' ORDER BY TeamStatus DESC, TeamTime ASC LIMIT 3;" ) );
$seniorLadies = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerACategory = 'Senior Ladies' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBCategory = 'Senior Ladies' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCCategory = 'Senior Ladies' " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$seniorMens = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerACategory = 'Senior Mens' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBCategory = 'Senior Mens' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCCategory = 'Senior Mens' " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$veteranLadies = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerACategory = 'Veteran Ladies' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBCategory = 'Veteran Ladies' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCCategory = 'Veteran Ladies' " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$veteranMens = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerACategory = 'Veteran Mens' " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBCategory = 'Veteran Mens' " .
     "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCCategory = 'Veteran Mens' " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$o50Ladies = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAAge = 'Over 50' AND (RunnerACategory = 'Senior Ladies' OR RunnerACategory = 'Veteran Ladies') " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBAge = 'Over 50' AND (RunnerBCategory = 'Senior Ladies' OR RunnerBCategory = 'Veteran Ladies') " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCAge = 'Over 50' AND (RunnerCCategory = 'Senior Ladies' OR RunnerCCategory = 'Veteran Ladies') " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$o50Mens = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAAge = 'Over 50' AND (RunnerACategory = 'Senior Mens' OR RunnerACategory = 'Veteran Mens') " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBAge = 'Over 50' AND (RunnerBCategory = 'Senior Mens' OR RunnerBCategory = 'Veteran Mens') " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCAge = 'Over 50' AND (RunnerCCategory = 'Senior Mens' OR RunnerCCategory = 'Veteran Mens') " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$o60Ladies = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAAge = 'Over 60' AND (RunnerACategory = 'Senior Ladies' OR RunnerACategory = 'Veteran Ladies') " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBAge = 'Over 60' AND (RunnerBCategory = 'Senior Ladies' OR RunnerBCategory = 'Veteran Ladies') " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCAge = 'Over 60' AND (RunnerCCategory = 'Senior Ladies' OR RunnerCCategory = 'Veteran Ladies') " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
$o60Mens = $wpdb->get_results( $wpdb->prepare( 
    "(SELECT CONCAT(TeamNumber, 'A') AS RunnerNumber, TeamID, RunnerA AS RunnerName, ClubName, RunnerACategory AS Category, RunnerAAge AS AgeCategory, RunnerALegTime AS LegTime " . 
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerALegTime <> '00:00:00' AND RunnerAAge = 'Over 60' AND (RunnerACategory = 'Senior Mens' OR RunnerACategory = 'Veteran Mens') " .
        "UNION " .
    "SELECT CONCAT(TeamNumber, 'B') AS RunnerNumber, TeamID, RunnerB AS RunnerName, ClubName, RunnerBCategory AS Category, RunnerBAge AS AgeCategory, RunnerBLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerBLegTime <> '00:00:00' AND RunnerBAge = 'Over 60' AND (RunnerBCategory = 'Senior Mens' OR RunnerBCategory = 'Veteran Mens') " .
    "UNION " .
    "SELECT CONCAT(TeamNumber, 'C') AS RunnerNumber, TeamID, RunnerC AS RunnerName, ClubName, RunnerCCategory AS Category, RunnerCAge AS AgeCategory, RunnerCLegTime AS LegTime " .
    "FROM {$wpdb->prefix}ghac_c_teams WHERE RunnerCLegTime <> '00:00:00' AND RunnerCAge = 'Over 60' AND (RunnerCCategory = 'Senior Mens' OR RunnerCCategory = 'Veteran Mens') " . 
    "ORDER BY LegTime ASC) LIMIT 3;" ) );
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
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-relay-teams-individuals' ); ?>" class="btn btn-primary">Individuals</a>&nbsp;&nbsp;
                    <a href="<?php echo get_page_permalink_by_pageslug( 'summer-relays/results-junior-races' ); ?>" class="btn btn-primary">Junior Races</a>&nbsp;&nbsp;
                    <a href="#" class="btn btn-secondary">Leaderboards</a>
				</p>
                <h2>Senior Ladies (Teams)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($seniorLadiesTeams as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
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
                                    <td><?php echo ( $row->TeamTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">Senior Mens (Teams)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($seniorMensTeams as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
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
                                    <td><?php echo ( $row->TeamTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">Veteran Ladies (Teams)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($veteranLadiesTeams as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
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
                                    <td><?php echo ( $row->TeamTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">Veteran Mens (Teams)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Team Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gun Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($veteranMensTeams as $row) : ?>
                                <tr>
                                    <td><?php echo $overall_pos; ?></td>
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
                                    <td><?php echo ( $row->TeamTime ); ?></td>
                                </tr>
                            <?php 
                                    // Increment the overall position
                                    $overall_pos = $overall_pos + 1;
                                endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <h2 class="pt-5">Senior Ladies (Individuals)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($seniorLadies as $row) : ?>
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
                <h2 class="pt-5">Senior Mens (Individuals)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($seniorMens as $row) : ?>
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
                <h2 class="pt-5">Veteran Ladies (Individuals)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($veteranLadies as $row) : ?>
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
                <h2 class="pt-5">Veteran Mens (Individuals)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($veteranMens as $row) : ?>
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
                <h2 class="pt-5">Over 50 Ladies (Individuals)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($o50Ladies as $row) : ?>
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
                <h2 class="pt-5">Over 50 Mens (Individuals)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($o50Mens as $row) : ?>
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
                <h2 class="pt-5">Over 60 Ladies (Individuals)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($o60Ladies as $row) : ?>
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
                <h2 class="pt-5">Over 60 Mens (Individuals)</h2>
                <?php $overall_pos = 1; ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Pos</th>
                                <th scope="col">#</th>
      						    <th scope="col">Name</th>
      						    <th scope="col">Club</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($o60Mens as $row) : ?>
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
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>