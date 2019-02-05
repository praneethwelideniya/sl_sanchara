/* 
 * ===========================================================
 * MAIN SCRIPT- OSCAR THEMES
 * ===========================================================
 * This script manage all the js functions and the 3r party plugins.
 * 
*/
$(document).ready(function(){
    "use strict";
  /*
    ============================================================
         Page Loader Javascript
    ============================================================
  */
  $(window).load(function(){
    $("body").imagesLoaded(function(){
      $(".loader-cont").fadeOut();
      $("#loader-overflow").delay(200).fadeOut(700);
    });
  });
  /*
  ==============================================================
    Fixed Header Script
  ==============================================================
  */
  if ( $('.sticky-header').length ){
      $('.sticky-header').affix({
        offset: { top: 1, }
      });
  }
  $(".section-heading").closest("section").addClass( "adj" );
  /*
    ============================================================
       Search Bar Javascript
    ============================================================
  */
  if($('.search-bar-outer').length){
    $('.search-bar-outer').parent('.sub-banner,.main-banner').addClass('mb-85');
  }
  $('.cd-search-trigger').on('click', function(){
    $('#cd-search').slideToggle('is-visible');
    $('.cd-search-trigger').toggleClass('is-visible');
  });
  /*
  ============================================================
       Counter Javascript
  ============================================================
  */
  if ($('.count-number').length) {
    $('.count-number').counterUp({
        delay: 10,
        time: 1000
    });
  }
  if($('input[type="submit"]').length){
    $('input[type="submit"]').addClass('submit-btn th-bg');
  }
  /*
   * ANIMATIONS
   * -------------------------------------------------------------
   * Manage all the animations on page scroll, on click, on hover
   * Manage the timeline animations
  */
  function cssInit(delay, speed) {
    delay += 'ms';
    speed += 'ms';
    return {
      'transition-duration': speed,
      'animation-duration': speed,
      'transition-timing-function': 'ease',
      'transition-delay': delay
    };
  }
  // -------------------- Remove Placeholder When Focus Or Click
  $("input,textarea").each( function(){
    $(this).data('holder',$(this).attr('placeholder'));
    $(this).on('focusin', function() {
        $(this).attr('placeholder','');
    });
    $(this).on('focusout', function() {
        $(this).attr('placeholder',$(this).data('holder'));
    });     
  });
  /*************************** Default Scripts Start ********************************/
  /*
  ============================================================
    JS NOT FOR MOBILE (PARALLAX, OPACITY SCROLL)
  ============================================================
  */
  if( mobileDetect == false ) {
    /*
    ============================================================
      PARALLAX
     ===========================================================
    */
    if ( $('.sub-banner,.parallax-section').length ){
      $.stellar({
        responsive: false,
        verticalOffset: 60,
        parallaxElements: true,
        parallaxBackgrounds: true,
        hideDistantElements: false,
        horizontalScrolling: false,
        scrollProperty: 'scroll'
      }); 
    }; 
  
  }//END JS NOT FOR MOBILE
  /*
  ============================================================== 
    DL Responsive Menu
  ============================================================== 
  */
  if(typeof($.fn.dlmenu) == 'function'){
    $('#responsive-navigation').each(function(){
      $(this).find('.dl-submenu').each(function(){
      if( $(this).siblings('a').attr('href') && $(this).siblings('a').attr('href') != '#' ){
        var parent_nav = $('<li class="menu-item parent-menu"></li>');
        parent_nav.append($(this).siblings('a').clone());
        
        $(this).prepend(parent_nav);
      }
      });
      $(this).dlmenu();
    });
  }
  /*================ Slick Sliders Javascript ================*/
    /*
    =======================================================================
        Slick Slider Caption Animation Script
    =======================================================================
    */
    if ( $('.slick-slider').length ){
      $('.slick-slider').on('init', function(e, slick) {
        var $firstAnimatingElements = $('.slick-slide:first-child').find('[data-animation]');
        doAnimations($firstAnimatingElements);
      });
      $('.slick-slider').on('beforeChange', function(e, slick, currentSlide, nextSlide) {
        var $animatingElements = $('.slick-slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
        doAnimations($animatingElements);
      });
      function doAnimations(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function() {
          var $this = $(this);
          var $animationDelay = $this.data('delay');
          var $animationType = 'animated ' + $this.data('animation');
          $this.css({
              'animation-delay': $animationDelay,
              '-webkit-animation-delay': $animationDelay
          });
          $this.addClass($animationType).one(animationEndEvents, function() {
              $this.removeClass($animationType);
          });
        });
      }
    }
    /*
    ============================================================
      Destination Slider Javascript
    ============================================================
    */
    if ($('.list-slider').length) {
      $('.list-slider').slick({
          slidesToShow: 3,
          easing: "linear",
          speed: 1000,
          responsive: [{
              breakpoint: 1200,
              settings: {
                  slidesToShow: 2
              }
          }, {
              breakpoint: 992,
              settings: {
                  slidesToShow: 2
              }
          }, {
              breakpoint: 768,
              settings: {
                  slidesToShow: 1
              }
          }, {
              breakpoint: 481,
              settings: {
                  slidesToShow: 1
              }
          }]
      });
    }
    /*
    ============================================================
      Gallery Slider Javascript
    ============================================================
    */
    if ($('.gallery-slider').length) {
      $('.gallery-slider').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          responsive: [{
              breakpoint: 1200,
              settings: {
                  slidesToShow: 2
              }
          },{
              breakpoint: 992,
              settings: {
                  slidesToShow: 2
              }
          }, {
              breakpoint: 768,
              settings: {
                  slidesToShow: 1
              }
          }, {
              breakpoint: 481,
              settings: {
                  slidesToShow: 1
              }
          }]
      });
    }
    /*
    ============================================================
      Slider Javascript
    ============================================================
    */
    if($('.bg-slider').length){
      $('.bg-slider').slick({
        autoplay: true,
          autoplaySpeed: 7000,
          dots: false,
          infinite: true,
          speed: 500,
          fade: true,
          cssEase: 'linear',
          lazyLoad: 'ondemand',
          lazyLoadBuffer: 0,
      });
    }
    /*
    ============================================================
       Special Room Slider Javascript
    ============================================================
    */
    if ($('.testimonial').length) {
      $('.testimonial').slick({
        arrows: false,
        dots: false,
        fade:true,
      });
    }
    /*
    ============================================================
       News & Updates Slider Javascript
    ============================================================
    */
    if ($('.news-slider').length) {
      $('.news-slider').slick({
          arrows: true,
          dots: false,
          fade:false,
          speed: 1500,
      });
    }
    /*
    ============================================================
       Destination Slider Javascript
    ============================================================
    */
    if ($('.destination-slider').length) {
        $('.destination-slider').slick({
            arrows: true,
            dots: false,
            fade:true,
        });
    }
    /*
      ============================================================
         Main Banner Javascript
      ============================================================
    */
    if($('.slider').length){
      $('.slider').slick({
        dots: false,
        fade: true,
        speed: 900,
        arrows: true,
        infinite: true,
        draggable: true,
        touchThreshold: 100
      });
    }
    /*
      ============================================================
         Team Slider Javascript
      ============================================================
    */
    if($('.team_slider').length){
      $('.team_slider').slick({
        dots: false,
        fade: true,
        speed: 900,
        arrows: true,
        infinite: true,
        draggable: true,
        touchThreshold: 100
      });
    }
    /*
    ============================================================
      BRAND Slider Javascript
    ============================================================
    */
    if ($('.brand-slider').length) {
      $('.brand-slider').slick({
        slidesToShow: 6,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 5
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 481,
            settings: {
                slidesToShow: 1
            }
        }]
      });
    }
  /*
  =======================================================================
    Map Script
  =======================================================================
  */
  if ( $('.map-canvas').length ){
    initMap();
  };
  /*
  =======================================================================
    Map Custom Style Script Script
  =======================================================================
  */
  function initMap(){
    var gmMapDiv = $(".map-canvas");
    (function($){

      var gmCenterAddress = gmMapDiv.attr("data-address");
      var gmMarkerAddress = gmMapDiv.attr("data-address");
      var gmstreetViewControl = gmMapDiv.attr("data-view");
      
      gmMapDiv.gmap3({
        action: "init",
        marker: {
            address: gmMarkerAddress,
            options: {
                icon: "../images/loc-marker.png" /* Location marker */
            }
        },
        map: {
            options: {
                zoom: 17,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                },
                mapTypeControl: true, /* hide/show (false/true) mapTypeControl*/
                scaleControl: false, /*hide/show (false/true) scaleControl */
                scrollwheel: false, /*hide/show (false/true) scrollwheel*/
                streetViewControl: gmstreetViewControl, /*hide/show (false/true) streetViewControl*/
                draggable: true,
                styles:[ 
                  {
                      "featureType": "administrative.country",
                      "elementType": "geometry",
                      "stylers": [
                          {
                              "visibility": "simplified"
                          },
                          {
                              "hue": "#ff0000"
                          }
                      ]
                  }
                ] /*CHANGE STYLE (colors and etc.) */
            }
        }
      });

    })(jQuery);
  }
  /*
  =======================================================================
    NEWSLETTER
  =======================================================================
  */
  $(function() {
    'use strict';
    var $form = $('#mc-embedded-subscribe-form');
    $('#mc-embedded-subscribe').on('click', function(event) {
      if (event) event.preventDefault();
      register($form);
    });
  });
  function register($form) {
    $.ajax({
      type: $form.attr('method'),
      url: $form.attr('action'),
      data: $form.serialize(),
      cache: false,
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      error: function(err) {
          $('#notification_container').html('<div id="nl-alert-container"  class="alert alert-info alert-dismissible fade in bounceIn" role="alert" ><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Could not connect to server. Please try again later.</div>');
      },
      success: function(data) {

          if (data.result != "success") {
              var message = data.msg;
              $('#notification_container').html('<div id="nl-alert-container"  class="alert alert-info alert-dismissible fade in bounceIn" role="alert" ><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' + message + '</div>');
          } else {
              var message = data.msg;
              $('#notification_container').html('<div id="nl-alert-container"  class="alert alert-info alert-dismissible fade in bounceIn" role="alert" ><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' + message + '</div>');
          }
      }
    });
  }
});
