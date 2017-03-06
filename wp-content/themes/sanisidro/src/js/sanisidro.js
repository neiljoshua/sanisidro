(function ($, root, undefined) {

$(document).ready(function(){

	var $window = $(window);
  var $header = $('.site-header');
  var $nav = $('.site-nav');
  var $mobile =$('.c-hamburger');
  var $body =$('body');

  function checkWidth(){
    if ($window.width() < 1024) {
    	if($body.hasClass('fixed')){
    		$body.toggleClass('fixed');
	      $mobile.removeClass('is-active');
    		$header.removeClass('active');
	      $nav.removeClass('active');
    	}
    	$('.site-nav').addClass('white-background');
    }
  };

  checkWidth();

  $(window).resize(checkWidth);	

	var scrollStart = 0;
	var startChange = $('#startchange');
	var offset = 0;

	$('.c-hamburger--rot').on('click', function(e){
      e.preventDefault();
        $(this).toggleClass('is-active');
        $('body').toggleClass('fixed');
        $('.site-header').toggleClass('active');
        $('site-branding').toggleClass('white-background');
        $('.site-nav').toggleClass('active');
        if( $('.site-nav').hasClass('white-background')){
        	$('.site-nav').removeClass('white-background');
      	}
    });

	function addWhiteBackGroundMenu() {
		$('site-header').addClass('white-background');
		$('.site-branding').addClass('white-background');
		$('.site-nav').addClass('white-background');
		$('a.c-hamburger').addClass('white-background');
	}

	function removeWhiteBackGroundMenu() {
		$('site-header').removeClass('white-background');
		$('.site-branding').removeClass('white-background');
		$('.site-nav').removeClass('white-background');
		$('a.c-hamburger').removeClass('white-background');
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
		
	if ( $('body').hasClass('home') ) {
		changeMenuColor();
		} else {
			addWhiteBackGroundMenu();
	}
	
	});


})(jQuery, this);