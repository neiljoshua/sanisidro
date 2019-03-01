<?php
require_once 'vendor/Mailchimp.php';
require_once 'config.php';


$api_key            = Config::MC_KEY;
$list_id            = 'bb33031de5';
$double_optin       = false;
$send_welcome       = false;
$update_existing    = true;
$replace_interests  = true;
$email_type         = 'html';

$name        = $_POST['message_name'];
$email        = $_POST['message_email'];
$message      = $_POST['message_text'];

$merge_vars   = array('NAME'=>$name,
                      'EMAIL' => $email,
                      'MESSAGE' => $message
                      );

$Mailchimp       = new Mailchimp( $api_key );
$Mailchimp_Lists = new Mailchimp_Lists( $Mailchimp );

try {

  $subscriber = $Mailchimp_Lists->subscribe( $list_id, array( 'email' => $email ), $merge_vars, $email_type, $double_optin, $update_existing, $replace_interests, $send_welcome );

  if ( ! empty( $subscriber['leid'] ) ) {

    // sendConfirmationEmail($email, $first);
    // sendAdministratorEmail($email, $subscriber['leid'], $merge_vars);
    generate_response("success", $message_sent);
      // echo json_encode( array('status' => 'success','message'=> 'The submission is complete.') );

  } else {

      // echo json_encode( array('status' => 'error','message'=> 'An unknow error has occurred. Please try again.') );

  }

} catch (Exception $e) {


    echo json_encode( array('status' => 'error','message'=> 'An unknow error has occurred. Please try again.') );

}
