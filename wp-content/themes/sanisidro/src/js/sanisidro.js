(function ($, root, undefined) {

	$(document).ready(function(){

	var scrollStart = 0;
	var startChange = $('#startchange');
	var offset = 0;

		if (startChange){
		
			$(document).scroll( function(){
				scrollStart = $(this).scrollTop();
				offset = startChange.offset().top - 55 ;
				if( scrollStart >= offset ){
					console.log('passed bellow hero');
					$('header').addClass('white-background');
					$('.site-branding').addClass('white-background');
					$('a.c-hamburger').addClass('white-background');

				} else {
					console.log('We are on the hero section');
					$('header').removeClass('white-background');
					$('.site-branding').removeClass('white-background');
					$('a.c-hamburger').removeClass('white-background');
				}

			})

		}

	});

})(jQuery, this);