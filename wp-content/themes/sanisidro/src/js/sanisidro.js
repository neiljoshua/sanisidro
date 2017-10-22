(function ($, root, undefined) {

$(document).ready(function(){

  var $container = $('.projects-gallery');
  var $featureProjects = $('.projects').find('.project-gallery').html();
  var $window = $(window);
  var $header = $('.site-header');
  var $nav = $('.site-header__menu');
  var $mobile = $('.site-header__hamburger');
  var $body =$('body');
  var scrollStart = 0;
	var startChange = $('#startchange');
	var offset = 0;
	var currentState = '';
	var defaultCities = $('#city-select').html();

	$('img.lazy').lazyload({
		threshold: 100,
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


	ifHome();

  // checkWidth();

  $(window).resize(checkWidth);


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

	// Using DropKick


  $('.default').dropkick({
  	mobile : true
  });

  var resetCitySelect = function() {

  	var $select = $('#city-select');
		$select.removeData('dropkick');
		$('#city-select').html(defaultCities);
		$select.dropkick('refresh');

  }

	var updateCitySelect = function($state) {

		if ($state !== 'default'){
			var $select = $('#city-select');
			var selectActiveCities = $('#city-select').find("[data-state='" + $state + "']");
			$select.removeData('dropkick');
			$select.html(selectActiveCities);
			$select.dropkick('refresh');
			$select.dropkick('reset','clear')
		}

	}

	var resetProjects = function() {
		var htmlfeatureProjects = $('.project-gallery').html($featureProjects);
    console.log(htmlfeatureProjects);
    htmlfeatureProjects.find("img.lazy").lazyload();
	}


	var getProjects = function ($location) {

    if ($location !== 'default') {
      projectQuery($location);
    }
    else if ($location == 'default') {
      $(resetProjects);
    }

	};


	var getLocations = function() {

		 var selectType = $(this).data('select');
		 var location = new Dropkick('#'+selectType+'-select')
		 var location = location.value;

	   switch (selectType) {
	     case 'state':
	     	 $('#city-select').html(defaultCities);
	     	 if (location != 'default'){
		     	 updateCitySelect(location);
		     	 getProjects(location);
		     	 break
	     	 }
	     	 $(resetCitySelect);
	     	 $(resetProjects);
	     	 break
	     case 'city':
	     	 getProjects(location);
	       break
	   }
	}


	var projectQuery = function($project) {

		var href = 'http://san-isidro.local/project-archive/';
			$.ajax({  // Use ajax to pull in archive projects.
			   url:href,
			   type:'GET',
			   success: function(data){
			   	// Save ajax results/contents to variable $resultContents
			    var resultContents = $(data).find('.project-gallery');
					var filteredProjects = $(resultContents).find("[data-state='" + $project + "'], [data-city='" + $project + "']");
					htmlfilteredProjects = $('.project-gallery').html(filteredProjects);
					htmlfilteredProjects.find("img.lazy").lazyload();
			   }
			});

	}

	var userQuery = function() {

		$('#proj-search').on('submit', function(e){ // On form submit, get input value
			e.preventDefault();
			var valEntered = $('.proj-search-input').val().toLowerCase();
			projectQuery(valEntered);
		});

	}

	var loadingProjectFilter = function() {

		if ($('body').hasClass('page-template-page-projects')) {
			$('.project-filter select').change(getLocations);
			$(userQuery);
		}

	}

	$(loadingProjectFilter);


	}); //End of Document ready.


})(jQuery, this);
