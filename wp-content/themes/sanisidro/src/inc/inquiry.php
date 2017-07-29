<?php
require_once 'vendor/Mailchimp.php';
// require_once 'vendor/Mandrill.php';

$api_key            = 'bd397178d444851afaab1bc85144fc9d-us14';
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

// function sendConfirmationEmail($email, $first){

//   $api_key = 'Fz5mFI24lGtbeEpl32fwAg';

//   $mandrill = new Mandrill($api_key);

//   $message = array(
//       'subject' => 'Thank You For Your Inquiry',
//       'from_email' => '',
//       'to' => array( array( 'email' => $email, 'name' => $first ) ),
//             'global_merge_vars' => array(
//                     array(
//                         'name' => 'first_name',
//                         'content' => $first
//                         )
//                     ));

//   $template_name = 'inquiry-confirmation';

//   $template_content = array();

//   $response = $mandrill->messages->sendTemplate($template_name, $template_content, $message);

// }

// function sendAdministratorEmail($email, $id, $vars){

//   $api_key    = '';
//   $mandrill   = new Mandrill($api_key);

//   $html = '<p><strong>New user:</strong> <a href="https://us11.admin.mailchimp.com/lists/members/view?id=' . $id . '&use_segment=Y">' . $email . '</a></p>';
//   $html = $html.'<p>';
//   $html = $html.'<strong>First Name:</strong> '.$vars['FIRST_NAME'].'<br>';
//   $html = $html.'<strong>Last Name:</strong> '.$vars['LAST_NAME'].'<br>';
//   $html = $html.'<strong>Email:</strong> '.$vars['EMAIL'].'<br>';
//   $html = $html.'<strong>Phone:</strong> '.$vars['PHONE'].'<br>';
//   $html = $html.'<strong>Property:</strong> '.$vars['PROPERTY'].'<br>';
//   $html = $html.'<strong>Message:</strong> '.$vars['MESSAGE'].'<br>';
//   $html = $html.'</p>';

//   $message          = array(
//               'subject' => 'Inquiry Notification',
//               'from_email' => '',
//               'to' => array(array('email' => '')),
//             'global_merge_vars' => array(
//                     array(
//                         'name' => 'main',
//                         'content' => $html
//                     )
//                 ));

//   $template_name    = 'inquiry-notification';
//   $template_content = array();
//   $response         = $mandrill->messages->sendTemplate($template_name, $template_content, $message);

// }

// exit;
