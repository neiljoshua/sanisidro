<?php
 
  /**
  *Template Name: Contact Page
  **/
  
  add_action('contact_page_content', 'do_contact_page_content');

  add_filter('body_class', 'add_contact_page_body_class');

  function add_contact_page_body_class($classes) {
    
    $classes[] = 'contact';

    return $classes;

  }

  add_theme_support('sanisidro-structural-wraps', array( 'header' , 'footer' , 'nav',) );
  //response generation function

  $response = "";

  //function to generate response
  function generate_response($type, $message){
    
    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";
    
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    //response messages
    $not_human       = "Human verification incorrect.";
    $missing_content = "Please supply all information.";
    $email_invalid   = "Email Address Invalid.";
    $message_unsent  = "Message was not sent. Try Again.";
    $message_sent    = "Thanks! Your message has been sent.";

    //user posted variables
    $name = $_POST['message_name'];
    $email = $_POST['message_email'];
    $message = $_POST['message_text'];
    $human = $_POST['message_human'];

    //php mailer variables
    $to = get_option('admin_email');
    $subject = "Someone sent a message from ".get_bloginfo('name');
    $headers = 'From: '. $email . "\r\n" .
      'Reply-To: ' . $email . "\r\n";
    
    if(!$human == 0){
      if($human != 2) generate_response("error", $not_human); //not human!
      else {
        
        //validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
          generate_response("error", $email_invalid);
        else //email is valid
        {
          //validate presence of name and message
          if(empty($name) || empty($message)){
            generate_response("error", $missing_content);
          }
          else //ready to go!
          {
            $sent = mail($to, $subject, $message, $headers);
            if($sent) generate_response("success", $message_sent); //message sent!
            else generate_response("error", $message_unsent); //message wasn't sent
          }
        }
      }
    } 
    else if ($_POST['submitted']) generate_response("error", $missing_content);

  }
?>

<?php get_header(); ?>

  <main>

    <?php while ( have_posts() ) : the_post(); ?>

      <section>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <div class="contact-map"></div>
      </section>

      <section class="entry-content">
      
        <div id="respond">
          <?php echo $response; ?>

          <form action="<?php the_permalink(); ?>" method="POST">
            <p><label for="name">Name: <span>*</span> <br><input type="text" name="message_name" placeholder="John Smith"></label></p>

            <p><label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" placeholder="youremail@server.com"> </label></p>

            <p><label for="message_text">Message: <span>*</span> <br><textarea type="text" name="message_text"></textarea></label></p>

            <p <label for="message_human">Human Verification: <span>*</span> <br><input class='human' type="text"  name="message_human"> + 3 = 5</label></p>
            <input type="hidden" name="submitted" value="1">
            <p><input type="submit"></p>
          </form>
        </div>

      </section><!-- .entry-content -->

    <?php endwhile; // end of the loop. ?>
      
  </main><!-- #primary -->

<?php get_footer(); ?>