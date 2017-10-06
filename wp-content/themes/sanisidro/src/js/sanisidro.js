(function ($, root, undefined) {

$(document).ready(function(){

  var $container = $('.home-gallery');
  var $featureProjects = $('.projects').find('.home-gallery');
  console.log($featureProjects);
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

	var showProjectBycity = function($City) {

		var activeProjectsbyCity = $('.projects-gallery').find("[data-city='" + $City + "']");
		console.log(activeProjectsbyCity);
    $('.gallery-image').removeClass('gallery-image__show-sate gallery-image__show-city').addClass('gallery-image__hide-state gallery-image__hide-city');
    activeProjectsbyCity .removeClass('gallery-image__hide-state gallery-image__hide-city').addClass('gallery-image__show-sate gallery-image__show-city');

	}


	var filterProjectByCity = function() {

		var selectedCity = $('.cities').find(":selected").val();
		if(selectedCity!=='Select City') {
			showProjectBycity(selectedCity);
		}
		else {
			var $state = $('.states').val();
			filterByState($state);
		}

	}

	var updateCityByState = function($state) {

		var activeCities = $('.cities').find("[data-state='" + $state + "']");
		$('.cities-item').removeClass('cities-item--active').addClass('cities-item--inactive');
		activeCities.removeClass('cities-item--inactive').addClass('cities-item--active');

	}


	var filterByState = function($state) {

		$('.cities').prop('selectedIndex',0);
		var href = 'http://san-isidro.local/project-archive/';
		var resultContents;
		$.ajax({ // Use ajax to pull in archive projects.
			url:href,
			type:'GET',
			success: function(data){
				// Save ajax results/contents to variableo $resultContents
			var resultContents = $(data).find('.home-gallery');
			var filteredState = $(resultContents).find("[data-state='" + $state + "']");
			htmlfilteredState = $('.projects-gallery').html(filteredState);
			htmlfilteredState.find("img.lazy").lazyload();
	   }
	 });

  }


	var getCitiesByState = function () {

		var selectedState = $('.states').find(":selected").val(); //check selected state variable value


    if (selectedState!=='Select State') {
      $('.cities').prop('disabled', false );
      filterByState(selectedState);
      updateCityByState(selectedState);
      $('.cities').change(filterProjectByCity);
    }
    else if (selectedState=='Select State') {
    	$('.cities').prop('selectedIndex',0);
      $('.cities').prop('disabled', 'disabled');
      var htmlfeatureProjects = $('.projects-gallery').html($featureProjects);
      htmlfeatureProjects.find("img.lazy").lazyload();
    }

	};

	var loadingProjectFilter = function() {


		if ($('body').hasClass('page-template-page-projects')) {
			$('.cities').prop('disabled', 'disabled');
			// $(getCitiesByState);
			$('.states').change(getCitiesByState);
		}

	}

	$(loadingProjectFilter);


	// var loadingProjects = function() {

	// 	if ($('body').hasClass('page-template-page-projects')) {
	// 		var href = 'http://san-isidro.local/project-archive/';
	// 		$.ajax({ // Use ajax to pull in archive projects.
	// 		   url:href,
	// 		   type:'GET',
	// 		   success: function(data){
	// 		   	// Save ajax results/contents to variableo $resultContents
	// 		    var resultContents = $(data).find('.home-gallery').html();
	// 		    resultContents.find("img.lazy").lazyload();
	// 				// console.log(resultContents);
	// 		   }
	// 		});
	// 	}

	// }


	// loadingProjects();


	var userQuery = function() {

		$('#proj-search').on('submit', function(e){ // On form submit, get input value
			e.preventDefault();
			$('.states').prop('selectedIndex',0);
			$('.cities').prop('selectedIndex',0);
      $('.cities').prop('disabled', 'disabled');
			var valEntered = $('.proj-search-input').val().toLowerCase();// Save input value to $query
			var href = 'http://san-isidro.local/project-archive/';
			var resultContents;
			// console.log(valEntered);
			$.ajax({  // Use ajax to pull in archive projects.
			   url:href,
			   type:'GET',
			   success: function(data){
			   	// Save ajax results/contents to variable $resultContents
			    var resultContents = $(data).find('.home-gallery');
					var filteredProjects = $(resultContents).find("[data-state='" + valEntered + "'], [data-city='" + valEntered + "']");
					htmlfilteredProjects = $('.projects-gallery').html(filteredProjects);
					htmlfilteredProjects.find("img.lazy").lazyload();
			   }
			});
		});


		// Use .find for data attributes (city, state, project title)
		// var projectCity = $resultContents.find("[data-city'" + $query + "']");
		// var projectState = $resultContents.find("[data-state'" + $query + "']");
		// Query data attributes separately or together. If you query them all together make sure you
		// account for "nil" values. For example, if user searches "Barranco".
		// You will check all data attributes for Barranco. Therefore, data-state="barranco" will be nil.
		// Display projects with matched data attributes

	}

	$(userQuery);

	}); //End of Document ready.


})(jQuery, this);
