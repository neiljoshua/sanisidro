(function($) {
  'use strict';
    $(window).on('load', function () {
      if ($('.loader').length > 0) {
        $('.loader').fadeOut(500, function(){
          $('.loader').remove();
          $('.container').addClass('loaded');
        });
      }
    });
})(jQuery);
(function ($, root, undefined) {

  $(document).ready(function() {

    var bodySite = $('body'),
        headerSite = $('.site-header'),
        currentTag = $('.current-menu-item'),
        headerSiteMenu = $('.site-header__menu'),
        mobileNav = $('.site-header__hamburger'),
        featureProjects = $('.projects').find('.project-gallery').html(),
        defaultCities = $('#city-select').html();

    $('.lazy').lazyload({
      effect: 'fadeIn',
      effectTime: 100,
      threshold: 200,
      cssEase: 'linear',
      pauseOnHover: false
    });

    $(window).resize(checkWidth);

    $('.site-header__hamburger--rot').on('click', function(e){
      e.preventDefault();
      $(this).toggleClass('is-active');
      $('body').toggleClass('fixed');
      $('.site-header__menu').toggleClass('active');
    });

    $('select').dropkick({
      mobile : true
    });

    $(window).scroll(function() {

      var docViewTop = $(this).scrollTop(),
          docViewBottom =docViewTop + $(this).height(),
          heroTop = $('.hero').offset().top,
          heroBott = heroTop + $('.hero').height(),
          windowWidth = $(this).innerWidth();

      if ( bodySite.hasClass('home') ){

        if( (docViewBottom >= heroTop - 60) && (heroBott-60 >= docViewTop) ) {
          headerSite.removeClass('white-menu');
          currentTag.removeClass('white-menu');
        } else {
          headerSite.addClass('white-menu');
          currentTag.addClass('white-menu');
        }

      }

    });

    function checkWidth() {

      if ( $(window).width() < 1024 ) {
        if(bodySite.hasClass('fixed')) {
          bodySite.toggleClass('fixed');
          mobileNav.removeClass('is-active');
          headerSite.removeClass('active');
          headerSiteMenu.removeClass('active');
        }
      }
    };

    var resetCitySelect = function() {

      var $select = $('#city-select');
      $select.removeData('dropkick');
      $('#city-select').html(defaultCities);
      $select.attr('disabled','true');
      $select.dropkick('refresh');

    }

    var resetProjects = function() {

      var htmlfeatureProjects = $('.project-gallery').html(featureProjects);
      htmlfeatureProjects.find("img.lazy").lazyload();

    }

    var updateCitySelect = function($state) {

      var $select = $('#city-select'),
          selectActiveCities = $('#city-select').find("[data-state='" + $state + "'], [data-state=default]");

      $select.removeData('dropkick');
      $select.html(selectActiveCities);
      $select.removeAttr('disabled');
      $select.dropkick('refresh');
      $select.dropkick('reset','clear');

    }

    var getStateProjects = function ($location) {

      if ($location !== 'default') {
        updateCitySelect($location);
        projectQuery($location);
      }
      else if ($location == 'default') {
        resetCitySelect();
        resetProjects();
      }

    };

    var getCityProjects = function ($location) {

      if ($location !== 'default') {
        projectQuery($location);
      }
      else if ($location == 'default') {
        var activeState = new Dropkick('#state-select'),
            location = activeState.value;

        updateCitySelect(location);
        projectQuery(location);
      }

    };

    var getLocations = function() {

      var selectType = $(this).data('select'),
          location = new Dropkick('#'+selectType+'-select'),
          location = location.value;

      $('.proj-search-input').val('');
      switch (selectType) {
        case 'state':
          $('#city-select').html(defaultCities);
          getStateProjects(location);
          break
        case 'city':
          getCityProjects(location);
          break
      }
    }

    var projectQuery = function($project) {

      var href = window.location.origin + '/project-archive/',
          projectName = $project;

      $.ajax({
         url:href,
         type:'GET',
         success: function(data){
          var resultContents = $(data).find('.project-gallery');
          var filteredProjects = $(resultContents).find("[data-state='" + $project + "'], [data-city='" + $project + "']");
          if ( filteredProjects.length == 0 ) {
            $('.project-gallery').load( window.location.origin + '/project-notfound/');
          } else {
            htmlfilteredProjects = $('.project-gallery').html(filteredProjects);
            htmlfilteredProjects.find("img.lazy").lazyload();
          }
         }
      });

    }

    var userQuery = function() {

      $('#proj-search').on('submit', function(e) {
        e.preventDefault();
        var valEntered = $('.proj-search-input').val().toLowerCase();
        projectQuery(valEntered);
      });

    }

    var loadingProjectFilter = function() {

      $('.project-filter select').change(getLocations);
      userQuery();
      $('.proj-search-input').on('focus',function(){
        $('#state-select').dropkick('reset','clear');
        resetCitySelect();
      })

    }

    loadingProjectFilter();

  });

})(jQuery, this);
