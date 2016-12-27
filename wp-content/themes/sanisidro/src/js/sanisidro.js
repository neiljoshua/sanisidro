(function ($, root, undefined) {

	$(document).ready(function(){

	var scrollStart = 0;
	var startChange = $('#startchange');
	var offset = startChange.offset().top - 60 ;

		if (startChange){
		
			$(document).scroll( function(){
				scrollStart = $(this).scrollTop();

				if( scrollStart >= offset ){
					console.log('passed bellow hero');
					$('header').addClass('white-background');
					$('a.c-hamburger').addClass('white-background');

				} else {
					console.log('We are on the hero section');
					$('header').removeClass('white-background');
					$('a.c-hamburger').removeClass('white-background');
				}

			})

		}

	});

})(jQuery, this);