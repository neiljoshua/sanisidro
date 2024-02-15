import '../sass/styles.scss';
import Dropkick from 'dropkickjs';
import 'dropkickjs/dist/dropkick.css';
import Swiper from 'swiper/js/swiper.js';
import 'swiper/css/swiper.css';

document.addEventListener('DOMContentLoaded', function() {
  var bodySite = document.querySelector('body');

  //Interseptor observer
  var lazyImages = [].slice.call(document.querySelectorAll('img.lazy'));

  if ("IntersectionObserver" in window) {
    let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          let lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
          lazyImage.srcset = lazyImage.dataset.srcset;
          lazyImage.classList.remove("lazy");
          lazyImageObserver.unobserve(lazyImage);
        }
      });
    });

    lazyImages.forEach(function(lazyImage) {
      lazyImageObserver.observe(lazyImage);
    });

  } else {
    // Possibly fall back to a more compatible method here
  }

  //End of interseptor observer

  function loadingGalleryImage() {
    var lazyImages = document.querySelectorAll('img.lazy');

    lazyImages.forEach( function(entry) {
      let lazyImage = entry;

      lazyImage.src = lazyImage.dataset.src;
      lazyImage.srcset = lazyImage.dataset.srcset;
      lazyImage.classList.remove('lazy');
    });

  }

  var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    direction: 'vertical',
    autoplay: true,
    loop: true,
    effect: 'fade'

  });

  function menuToggle() {
    e.preventDefault();
    var burger = document.querySelector('.site-header__hamburger--rot'),
        body = document.body,
        siteMenu = document.querySelector('.site-header__menu');

    burger.toggle('is-active');
    body.toggle('fixed');
    siteMenu.toggle('active');

  }

  function homeMenuScrolling() {
    var body = document.querySelector('body');

    if ( body.classList.contains('home') ) {

       var hero = document.querySelector('.home__hero'),
           menuItems = document.querySelectorAll('.menu-item'),
           heroHeight = hero.offsetHeight,
           scrollPosition = window.pageYOffset;

      if ( scrollPosition >= heroHeight ) {
        document.querySelector('.site-header').classList.add('visible');
        document.querySelector('.site-header__icon').classList.add('visible');
        document.querySelector('.current-menu-item').classList.add('visible');
        menuItems.forEach( function(entry) {
          entry.classList.add('visible');
        });
      } else {
        document.querySelector('.site-header').classList.remove('visible');
        document.querySelector('.site-header__icon').classList.remove('visible');
        document.querySelector('.current-menu-item').classList.remove('visible');
        menuItems.forEach( function(entry) {
          entry.classList.remove('visible');
        });
      }

    }
  }

  function checkWidth() {

    if ( window.outerWidth < 1024 ) {
      if( body.classList.contains('fixed') ) {
        body.classList.toggle('fixed');
        document.querySelector('.site-header__hamburger').classList.remove('is-active');
        document.querySelector('.site-header').classList.remove('active');
        document.querySelector('.site-header__menu').classList.remove('active');
      }
    }

  }

  window.addEventListener('scroll',homeMenuScrolling);
  window.addEventListener('resize', checkWidth);
  document.querySelector('.site-header__hamburger--rot').addEventListener('click', menuToggle);
  checkWidth();

  if( bodySite.classList.contains('projects') ) { // Projects page functions

    var stateSelect = new Dropkick("#state-select"),
        citySelect = new Dropkick("#city-select"),
        cities = document.querySelector('#city-select'),
        states = document.querySelector('#state-select'),
        projectsForm = document.querySelector('#project-form'),
        selectedType,
        selectValue,
        sortedCities = [],
        optionValues =[],
        defaultOption= document.querySelector('#city-select').firstElementChild;

    function userSearchGallery(data) {
      var userImages = new DocumentFragment(),
          gallery = document.querySelector('.gallery'),
          emptyGallery = document.querySelector('.not-found'),
          locationName = document.querySelector('.project-form__input').value;

      locationName = locationName.toLowerCase();;
      userImages = data.querySelectorAll("[data-state='" + locationName + "']");
      userImages = data.querySelectorAll("[data-city='" + locationName + "']");

      emptyGallery.classList.remove('visible');
      if( userImages.length == 0 ) {

        gallery.classList.add('invisible');
        emptyGallery.classList.add('visible');

      } else {

        while (gallery.firstChild) {
          gallery.removeChild(gallery.firstChild);
        }

        userImages.forEach( function(image) {
          gallery.appendChild(image);
        });
        gallery.classList.remove('invisible');
        loadingGalleryImage();

      }

    }

    function userSearch(e) {

      e.preventDefault();
      e.stopPropagation();
      var userRequest = new XMLHttpRequest(),
          href = window.location.origin + '/project-archive/';

      userRequest.open('GET', href);
      userRequest.responseType = 'document';
      userRequest.send();

      userRequest.onreadystatechange = function() {
        if (userRequest.readyState === 4) {
          userSearchGallery(userRequest.response);
        }
      }

    }

    function filterGalleryImages() {
      var images = new DocumentFragment(),
          emptyGallery = document.querySelector('.not-found'),
          gallery = document.querySelector('.gallery');

      images = event.target.response.querySelectorAll("[data-" +selectedType + "=" + selectValue + "]");

      emptyGallery.classList.remove('visible');
      if( images.length == 0 ) {

        gallery.classList.add('invisible');
        emptyGallery.classList.add('visible');

      } else {

        while (gallery.firstChild) {
          gallery.removeChild(gallery.firstChild);
        }

        images.forEach( function(image) {
          gallery.appendChild(image);
        });
        gallery.classList.remove('invisible');
        loadingGalleryImage();
      }

    }

    function filterGallery() {

      var request = new XMLHttpRequest(),
          href = window.location.origin + '/project-archive/';

      request.open('GET', href);
      request.responseType = 'document';
      request.send();
      request.addEventListener('load', filterGalleryImages);

    }

    function populateCities(optionList) {
      var cities = document.querySelector('#city-select');

      cities.length = 0;
      optionList.forEach( function(option, index) {
        if( index == 0 ) {
          cities.appendChild(defaultOption);
          cities.appendChild(option);
        }
        cities.appendChild(option);
      });

      defaultOption.setAttribute('selected', 'selected')

    }

    function removeDuplicatedOptions(select) {
       var L = select.options.length - 1;

       for(var i = L; i >= 0; i--) {
        if( !optionValues.includes(select.options[i].value) ) {
          optionValues.push(select.options[i].value);
          sortedCities.push(select.options[i]);
        }
      }

    }

    function updateCitySelect($state) {

      var filteredCities = [],
          $select = document.querySelectorAll('#city-select'),
          cityList = document.querySelector('#city-select');

      // Find all the outer matched elements
      cityList.disabled = false;

      for(var i=0; i<$select.length; i++) {
        var options = $select[i].querySelectorAll("[data-state='" + $state + "']");

        // document.querySelectorAll() returns an "array-like" collection of elements
        // convert this "array-like" collection to an array
        options = Array.prototype.slice.call(options);

        filteredCities = filteredCities.concat(options);
      }

      populateCities(filteredCities);

      var cityList = new Dropkick(cityList);

      cityList.refresh();

    }

    function galleryFilter() {

      selectedType = this.getAttribute('data-select');
      selectValue = this.value;

      if ( selectValue != 'default'){

        switch (selectedType) {
          case 'state':
            populateCities(sortedCities);
            updateCitySelect(selectValue);
            filterGallery();
            break
          case 'city':
            filterGallery();
            break
        }

      }

    }

    removeDuplicatedOptions(cities);
    states.addEventListener('change', galleryFilter);
    cities.addEventListener('change', galleryFilter);
    projectsForm.addEventListener('submit', userSearch);
  }

})
