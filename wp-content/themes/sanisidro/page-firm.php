<?php
/**
*Template Name: Firm Page
**/

add_action('firm_page_content', 'do_firm_page_content');

add_filter('body_class', 'add_firm_page_body_class');

function add_firm_page_body_class($classes) {

  $classes[] = 'firm';

  return $classes;

}

add_theme_support('sanisidro-structural-wraps', array( 'header' , 'footer' , 'nav',) );

get_header();
?>

<main>

<?php

  $lead = get_field('firm_lead_image');
  if ($lead){
    $description = get_field('firm_lead_description');

?>
  <section>
    <div class="page-hero">
      <img class ="lazy page-hero__image"  data-original="<?php echo $lead; ?>"" alt="Hero Image">
    </div>
    <div class="firm-description"> <?php echo $description; ?> </div>
  </section>

<?php

   }

?>
<?php

  $members = get_field('member');
  if ($members) {


?>
  <section>
<?php
    foreach($members as $member)
  {

?>
  <div class="member">
    <div class="member-image">
      <img class="member-image__image lazy" data-original="<?php echo $member['member_image']; ?>" wifth="300" height="300" alt="<?php echo $member['member_name']; ?>">
    </div>
    <div class="member-copy">
      <h2 class="member-copy__name"> <?php echo $member['member_name']; ?>  </h2>
      <h3 class="member-copy__title"> <?php echo $member['member_title']; ?>  </h3>
      <p class="member-copy__copy"> <?php echo $member['member_profile']; ?> </p>
    </div>
  </div>

<?php
    }
?>
  </section>
<?php

  }

?>

</main>

<?php

get_footer();
