(function ($, root, undefined) {

$(document).ready(function(){

  var $container = $('.projects-gallery');
  var $featureProjects = $('.projects').find('.project-gallery').html();
  console.log($featureProjects);
  var $window = $(window);
  var $header = $('.site-header');
  var $nav = $('.site-header__menu');
  var $mobile = $('.site-header__hamburger');
  var $body =$('body');
  var scrollStart = 0;
	var startChange = $('#startchange');
	var offset = 0;


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


	var updateCitySelect = function($state) {

		var activeCities = $('.city-select').find("[data-state='" + $state + "']");
		$('.cities-item').removeClass('cities-item--active').addClass('cities-item--inactive');
		activeCities.removeClass('cities-item--inactive').addClass('cities-item--active');

	}


	var getCityResults = function() {

		var selectedCity = $('.city-select').find(":selected").val();
		if(selectedCity !== 'Select City') {
			projectQuery(selectedCity);
		}
		else {
			var $state = $('.state-select').val();
			projectQuery($state);
		}

	}


	var getStateResults = function () {

		var selectedState = $('.state-select').find(":selected").val(); //check selected state variable value
		var $selectedCity = $('.city-select');
    if (selectedState !== 'Select State') {
      $selectedCity.prop('disabled', false );
      projectQuery(selectedState);
      updateCitySelect(selectedState);
      $selectedCity.change(getCityResults);
    }
    else if (selectedState == 'Select State') {
    	$selectedCity.prop('selectedIndex',0); // Reset .city-select to "City Select"
      $selectedCity.prop('disabled', 'disabled'); // Disable .city-select
      var htmlfeatureProjects = $('.project-gallery').html($featureProjects);
      htmlfeatureProjects.find("img.lazy").lazyload();
    }

	};


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
			$('.state-select').prop('selectedIndex',0);// Reset state-select to default.
			$('.city-select').prop('selectedIndex',0); // Reset city-selct to default.
      $('.city-select').prop('disabled', 'disabled');// disable city-select.
			var valEntered = $('.proj-search-input').val().toLowerCase();
			projectQuery(valEntered);

		});

	}

	var loadingProjectFilter = function() {

		if ($('body').hasClass('page-template-page-projects')) {
			$('.state-select').change(getStateResults);
			$(userQuery);
		}

	}

	$(loadingProjectFilter);


	}); //End of Document ready.


})(jQuery, this);
