(function($) {
  'use strict';
    $(window).on('load', function () {
      if ($('.loader').length > 0) {
        $('.loader').fadeOut('slow');
        $('.container').addClass('loaded');
      }
    });
})(jQuery);

(function ($, root, undefined) {

  $(document).ready(function() {

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
          currentTag = $('.current-menu-item'),
          windowWidth = $(this).innerWidth();

      if ( $('body').hasClass('home') ){
        if( (docViewBottom >= heroTop - 60) && (heroBott-60 >= docViewTop) ) {
          $('.site-header').removeClass('white-menu');
          currentTag.removeClass('white-menu');
        } else {
          $('.site-header').addClass('white-menu');
          currentTag.addClass('white-menu');
        }
      }

    });

    function checkWidth() {

      if ( $(window).width() < 1024 ) {
        if( $('body').hasClass('fixed') ) {
          $('body').toggleClass('fixed');
          $('.site-header__hamburger').removeClass('is-active');
          $('.site-header').removeClass('active');
          $('.site-header__menu').removeClass('active');
        }
      }

    }

    function resetCitySelect() {

      var $select = $('#city-select');
      $select.removeData('dropkick');
      $('#city-select').html(filteredCities);
      $select.attr('disabled','true');
      $select.dropkick('refresh');

    }

    function resetProjects() {

      var htmlfeatureProjects = $('.project-gallery').html(featureProjects);
      htmlfeatureProjects.find("img.lazy").lazyload();

    }

    function updateCitySelect($state) {

      var $select = $('#city-select'),
          selectActiveCities = $('#city-select').find("[data-state='" + $state + "'], [data-state=default]");

      $select.removeData('dropkick');
      $select.html(selectActiveCities);
      $select.removeAttr('disabled');
      $select.dropkick('refresh');
      $select.dropkick('reset','clear');

    }

    function showProjectsByState($location) {

      if ($location !== 'default') {
        updateCitySelect($location);
        loadProjects($location);
      }
      else if ($location == 'default') {
        resetCitySelect();
        resetProjects();
      }

    }

    function showProjectsByCity($location) {

      if ($location !== 'default') {
        loadProjects($location);
      }
      else if ($location == 'default') {
        var activeState = new Dropkick('#state-select'),
            location = activeState.value;

        updateCitySelect(location);
        loadProjects(location);
      }

    }

    function filterLocations() {

      var selectType = $(this).data('select'),
          location = new Dropkick('#'+selectType+'-select'),
          location = location.value;

      $('.project-form__input').val('');
      switch (selectType) {
        case 'state':
          $('#city-select').html(filteredCities);
          showProjectsByState(location);
          break
        case 'city':
          showProjectsByCity(location);
          break
      }
    }

    function loadProjects($project) {

      var href = window.location.origin + '/project-archive/',
          projectName = $project;

      $.ajax({
        url:href,
        type:'GET',
        success: function(data) {
          var resultContents   = $(data).find('.project-gallery'),
              filteredProjects = $(resultContents).find("[data-state='" + $project + "'], [data-city='" + $project + "']");

          $('.not-found').removeClass('visible');
          if( filteredProjects.length == 0) {
            $('.project-gallery').addClass('invisible');
            $('.not-found').addClass('visible');
          } else {
            $('.project-gallery').removeClass('invisible');
            htmlfilteredProjects = $('.project-gallery').html(filteredProjects);
            htmlfilteredProjects.find("img.lazy").lazyload();
          }
        }
      });

    }

    function userSearch() {

      $('#project-form').on('submit', function(e) {
        e.preventDefault();
        var valEntered = $('.project-form__input').val().toLowerCase();
        loadProjects(valEntered);
      });

    }

    function filteringProjects() {

      var featureProjects = $('.projects').find('.project-gallery').html(),
        optionValues =[];;

      $('#city-select option').each(function(){
         if($.inArray(this.value, optionValues) >-1){
            $(this).remove()
         } else{
            optionValues.push(this.value);
         }
      });

      filteredCities = $('#city-select').html();
      $('.select-container select').change(filterLocations);
      userSearch();
      $('.project-form__input').on('focus',function(){
        $('#state-select').dropkick('reset','clear');
        resetCitySelect();
      })

    }

    filteringProjects();

  });

})(jQuery, this);
