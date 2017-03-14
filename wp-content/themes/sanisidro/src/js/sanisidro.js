(function ($, root, undefined) {

$(document).ready(function(){

  var $container = $('.home-gallery');	
  var $window = $(window);
  var $header = $('.site-header');
  var $nav = $('.site-nav');
  var $mobile =$('.c-hamburger');
  var $body =$('body');


  if ($body.hasClass('.projects')) {
	  $('.home-gallery').on('load', function() {
		  // add new images
		  console.log('loading images');
		  var items = getItems();
		  $container.prepend( $(items) );
		  // use ImagesLoaded
		  $container.imagesLoaded()
		    .progress( onProgress )
		    .always( onAlways );
		  // reset progress counter
		  imageCount = $container.find('img').length;
		  resetProgress();
		  updateProgress( 0 );
		});
	}

  // return doc fragment with
	function getItems() {
	  var items = '';
	  for ( var i = 0; i < 7; i++ ) {
	    items += getImageItem();
	  }
	  return items;
	}

	// return an <li> with a <img> in it
	function getImageItem() {
	  var item = '<li class="is-loading">';
	  var size = Math.random() * 3 + 1;
	  var width = Math.random() * 110 + 100;
	  width = Math.round( width * size );
	  var height = Math.round( 140 * size );
	  var rando = Math.ceil( Math.random() * 1000 );
	}


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