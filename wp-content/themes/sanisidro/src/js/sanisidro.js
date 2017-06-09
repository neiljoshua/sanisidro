(function ($, root, undefined) {

$(document).ready(function(){

  var $container = $('.home-gallery');	
  var $window = $(window);
  var $header = $('.site-header');
  var $nav = $('.site-header__menu');
  var $mobile = $('.site-header__hamburger');
  var $body =$('body');
  

 //  $(function() {
 //    $("img.lazy").lazyload({
 //        event : "iamges"
 //    });
 //  });

 //  $(window).bind("load", function() {
	// var timeout = setTimeout(function() { $("img.lazy").trigger("images") }, 500);
 //  });

  $('img.lazy').lazyload({
	threshold: 150,
	effect: 'fadeIn'
  });

 //Toggle mobilemenu if viewport width chages.
  function checkWidth(){
    if ($window.width() < 1024) {
    	if($body.hasClass('fixed')){
    		$body.toggleClass('fixed');
	     	$mobile.removeClass('is-active');
    		$header.removeClass('active');
	        $nav.removeClass('active');
    	}
    	ifHome();
    }
  };

  // checkWidth();

  $(window).resize(checkWidth);	

	var scrollStart = 0;
	var startChange = $('#startchange');
	var offset = 0;

	$('.site-header__hamburger--rot').on('click', function(e){
      e.preventDefault();
        $(this).toggleClass('is-active');
        $('body').toggleClass('fixed');
        $('.site-header__menu').toggleClass('active');
    });

	function addWhiteBackGroundMenu() {
		$('.site-header').addClass('active');
		$('.site-header__logo').addClass('active');
		$('.current-menu-item a').addClass('dark-menu');
		$('.site-header__menu a').addClass('dark-menu');
		$('.site-header__hamburger').addClass('dark-hamburger');
	}

	function removeWhiteBackGroundMenu() {
		$('.site-header').removeClass('active');
		$('.site-header__logo').removeClass('active');
		$('.current-menu-item a').removeClass('dark-menu');
		$('.site-header__menu a').removeClass('dark-menu');
		$('.site-header__hamburger').removeClass('dark-hamburger');
	}

	function changeMenuColor() {

		if (startChange){
		
			$(document).scroll( function(){
				scrollStart = $(this).scrollTop();
				offset = startChange.offset().top - 55 ;
				if( scrollStart >= offset ){
					addWhiteBackGroundMenu();

				} else {
					removeWhiteBackGroundMenu();
					
				}

			})

		}
	}	
		
	function ifHome(){
		if ( $('body').hasClass('home') ) {
		changeMenuColor();
		} else {
			addWhiteBackGroundMenu();
		}
	}	

	ifHome();
	
	}); //End of Document ready.


})(jQuery, this);