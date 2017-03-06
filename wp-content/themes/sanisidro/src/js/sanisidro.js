(function ($, root, undefined) {

	$(document).ready(function(){

	var scrollStart = 0;
	var startChange = $('#startchange');
	var offset = 0;

	$('.c-hamburger--rot').on('click', function(e){
      e.preventDefault();
        $(this).toggleClass('is-active');
        $('body').toggleClass('fixed');
        $('site-branding').toggleClass('white-background');
        $('.site-header').toggleClass('active');
        $('.site-nav').toggleClass('active');
    });

	function addWhiteBackGroundMenu() {
		$('.site-branding').addClass('white-background');
		$('a.c-hamburger').addClass('white-background');
	}

	function removeWhiteBackGroundMenu() {
		$('.site-branding').removeClass('white-background');
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