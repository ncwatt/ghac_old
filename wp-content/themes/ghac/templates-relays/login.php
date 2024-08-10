<?php 
/*
	Template Name: Summer Relays - Login
*/
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $step = $_POST['formStep'];
    $emailAddress = $_POST['emailAddress'];

    if ( isset( $_POST['formStep'] ) && ( $step == 2 ) ) {
        $clientCode = $_POST['clientCode'];
        $serverCode = $_POST['emailCode'];

        // Get the email address entry
        $email = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_c_emails WHERE EmailAddress = %s", $emailAddress ) );

        if ( isset( $email ) ) {
            if ( ( $email->CodeUsed == false ) && ( $clientCode == $email->ClientCode ) && ( $serverCode == $email->ServerCode ) && ( time() < strtotime( $email->CodeExpiry ) ) ) {
                // Set the session variable
                $_SESSION['relays_user_email'] = $emailAddress;
                // Update the table to show that the code has now been used
                $wpdb->update( 
                    "{$wpdb->prefix}ghac_c_emails", 
                    array(
                        'CodeUsed' => true
                    ),
                    array(
                        'EmailAddress' => $emailAddress
                    )
                );

                // redirect the teams page
                wp_redirect( get_page_permalink_by_pageslug( 'summer-relays/teams-manager' ) );
            } else {
                $step = 3;
            }
        } else {
            $step = 3;
        }
    }

    if ( isset( $_POST['formStep'] ) && ( $step == 1 ) ) {
        // Validate email address
		$emailErr = false;
        if  ( ! filter_var( $emailAddress, FILTER_VALIDATE_EMAIL ) ) { 
            $emailErr = true;
			$errors[] = 'The email address entered is not valid';
        } else {
            // Generate two random six digit numbers
            $clientCode = rand(100000,999999);
            $serverCode = rand(100000,999999);
            // Update the values
			$wpdb->update( 
				"{$wpdb->prefix}ghac_c_emails", 
				array(
                    'ClientCode' => $clientCode,
                    'ServerCode' => $serverCode,
                    'CodeExpiry' => date('Y-m-d H:i:s', time() + 5 * 60),
                    'CodeUsed' => false
                ),
                array(
                    'EmailAddress' => $emailAddress
                )
            );

            // Check if the email address exists
            $email = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}ghac_c_emails WHERE EmailAddress = %s", $emailAddress ) );

            if ( isset ( $email ) ) {
                // Let's send the person an email to tell them.
			    $emailSubject = 'Gosforth Harriers Summer Relays - Authentication Code';
                $emailBody = 'Hi ' . $email->FirstName;
                $emailBody = $emailBody . '<br /><br />An authentication code was requested for your email address ' . $emailAddress . ' to access the team manager for the Gosforth Summer Relays.';
                $emailBody = $emailBody . '<br /><br />Please enter the following code to authenticate your access:';
			    $emailBody = $emailBody . '<br /><br />' . $serverCode . '';
			    $emailBody = $emailBody . '<br /><br />If you experience any issues, all you need to do is reply to this email and our webmaster will answer your query.';
            	$emailBody = $emailBody . '<br /><br />Gosforth Harriers & AC';
			    $headers[] = 'Content-Type: text/html; charset=UTF-8';
                $headers[] = 'Reply-To: Gosforth Harriers <webmaster@gosforth-harriers.org>';

                if (wp_mail($emailAddress, $emailSubject, $emailBody, $headers) == false) {
                    $sendErr = true;
                    $postSuccess = false;
                }
            }

            // Go to step 2
            $step = 2;
        }
    }
}
?>
<?php get_header(); ?>
<div class="content-1">
	<div class="container">
		<div class="row">
            <div class="col">
                <h1><?php the_title(); ?></h1>
                <form id="loginForm" name="loginForm" method="post" action="" novalidate class="mb-4 mb-lg-0">
                    <?php if ( ! isset( $step ) || $step == 1 ) : ?>
                        <input type="hidden" name="formStep" value="1" />
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">
									    Login
								    </div>
								    <div class="card-body">
                                        <?php if ( ( ( isset( $emailErr ) ) && ( $emailErr == true ) ) ) : ?>
                                            <div class="alert alert-danger" role="alert">
                                               <p>The email address you have entered is invalid.</p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="alert alert-info" role="alert">
						                    <p>Please enter your email address below and click submit.</p>
                                            <p>A unique one time code will be sent to your address which you will enter at the next step.</p>
					                    </div>
                                        <div class="mb-3">
										    <label for="emailAddress" class="form-label">Email Address</label>
                        				    <input type="email" id="emailAddress" name="emailAddress" aria-describedby="emailAddressHelp" maxlength="254" class="form-control <?php if ( isset( $emailErr ) ) { echo( $emailErr == true ) ? 'is-invalid' : 'is-valid'; } ?>" value="<?php echo isset( $emailAddress ) ? $emailAddress : ''; ?>">
                        				    <div id="emailAddressHelp" class="form-text">Enter your email address.</div>
                    				    </div>
                                        <div class="row">
							                <div class="col">
								                <button type="submit" class="btn btn-primary">Submit</button>
							                </div>
						                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ( isset( $step ) && $step == 2 ) : ?>
                        <input type="hidden" name="formStep" value="2" />
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        Login
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-info" role="alert">
						                    <p>If your email address is registered to a team, you will have been sent a unique one use code.</p>
                                            <p>Please check your email. The code will expire in 5 minutes.</p>
					                    </div>
                                        <div class="mb-3">
                                            <label for="emailCode" class="form-label">Enter Code</label>
                                            <input type="text" id="emailCode" name="emailCode" aria-describedby="emailCodeHelp" maxlength="6" class="form-control">
                                            <input type="hidden" id="emailAddress" name="emailAddress" value="<?php echo isset( $emailAddress ) ? $emailAddress : ''; ?>">
                                            <input type="hidden" id="clientCode" name="clientCode" value="<?php echo isset( $clientCode ) ? $clientCode : ''; ?>">
                                            <div id="emailCodeHelp" class="form-text">Please enter the code that has been sent to your email address.</div>
                                        </div>
                                        <div class="row">
							                <div class="col">
								                <button type="submit" class="btn btn-primary">Submit</button>
							                </div>
						                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
                <?php if ( isset( $step ) && $step == 3 ) : ?>
                        <input type="hidden" name="formStep" value="2" />
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        Error
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-danger" role="alert">
						                    <p>There has been a problem authenticating your account. Click the restart button below to try again.</p>
                                            <p>If the problem consists please contact an administrator.</p>
					                    </div>
                                        <?php //echo $email->CodeExpiry . ' : ' . strtotime($email->CodeExpiry) . ' : ' . time(); ?>
                                        <div class="row">
							                <div class="col">
                                                <a href="<?php get_page_permalink_by_pageslug( 'summer-relays/summer-relays-login' ); ?>" class="btn btn-primary">Restart</a>
							                </div>
						                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>