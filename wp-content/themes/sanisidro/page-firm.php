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
   			<img class ="hero-page-image"  src="<?php echo $lead; ?>">
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
		<div class="member-container">
			<div class="image">
				<!-- <img src="<?php //echo $member['member_image']; ?>" /> -->
				<img class="lazy" data-original="<?php echo $member['member_image']; ?>" wifth="300" height="300">
			</div>
			<div class="text"> 
				<h2> <?php echo $member['member_name']; ?>	</h2>
				<h3> <?php echo $member['member_title']; ?>	</h3>
				<p> <?php echo $member['member_profile']; ?> </p>
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