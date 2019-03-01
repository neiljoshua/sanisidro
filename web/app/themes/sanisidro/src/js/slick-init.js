(function ($, root, undefined) {

  $(document).ready(function(){
    $('.home-slider').slick({
      autoplay: true,
      dots: true,
        infinite: true,
        speed: 150,
        fade: true,
        cssEase: 'linear'
     });
  });

})(jQuery, this);
