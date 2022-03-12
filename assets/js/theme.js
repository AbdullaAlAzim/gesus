/* -----------------------------------------------------------------------------

File:           JS Core
Version:        1.0
Last change:    00/00/00 
-------------------------------------------------------------------------------- */
(function($) {

    "use strict";

    var gesus = {
        init: function() {
            this.Basic.init();  
        },

        Basic: {
            init: function() {

                this.navbarFixed();
                this.MobileMenu();
                this.bgImg();
                this.Numbernice();
                this. NiceSelect();
                this. preloader();
                this. scrollToTop();
                this. plyrAudioPlayer();
                this. barfillerProgress();
          

            },

            // Navbar Fixed  
            navbarFixed: function (){
                if ( $('.gesus-header-section, .gesus-header-section-two').length ){ 
                    $(window).on('scroll', function() {
                        var scroll = $(window).scrollTop();   
                        if (scroll >= 50) {
                            $(".gesus-header-section, .gesus-header-section-two").addClass("navbar_fixed");
                        } else {
                            $(".gesus-header-section, .gesus-header-section-two").removeClass("navbar_fixed");
                        }
                    });
                };
            },

                // mobile menu 
            MobileMenu: function (){
                $('.gesus-nav-open').click (function(){
                    $(".nav-close, .gesus-overlay").click(function(){
                        $("body").removeClass("nav_activee");
                    });
                    $('body').toggleClass("nav_activee");
                });
                if($('.gesus-mobile-menu li.dropdown ul').length){
                    $('.gesus-mobile-menu li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
                    $('.gesus-mobile-menu li.dropdown .dropdown-btn').on('click', function() {
                        $(this).prev('ul').slideToggle(500);
                    });
                };
                $("form.maan-input-field.form-billing input").addClass('woocommerce-Input');
            },
            // data background 
            bgImg: function() {
                $("[data-background]").each(function() {
                    $(this).css("background-image", "url(" + $(this).attr("data-background") + ")");
                });
            },
             
            // Nice Number   
            Numbernice: function (){
                if ($('.number-count').length){
                    $('input[type="number"]').niceNumber();
                };
            },   
            // Nice Select
            NiceSelect: function(){
                $('select').niceSelect();
            },

            // Preloader JS
            preloader: function(){
            if( $('.preloader').length ){
                    $(window).on('load', function() {
                        $('.preloader').fadeOut();
                        $('.preloader').delay(50).fadeOut('slow');  
                    })   
                };
            },

             // Scroll to top
             scrollToTop: function() {
                if ($('.scroll-top').length) {  
                    $(window).on('scroll', function () {
                        if ($(this).scrollTop() > 200) {
                            $('.scroll-top').fadeIn();
                        } else {
                            $('.scroll-top').fadeOut();
                        }
                    }); 
                    //Click event to scroll to top
                    $('.scroll-top').on('click', function () {
                        $('html, body').animate({
                            scrollTop: 0
                        }, 200);
                        return false;
                    });
                };
            },


             plyrAudioPlayer: function(){
                var controls =
                [
                'rewind', // Rewind by the seek time (default 10 seconds)
                'play', // Play/pause playback
                'fast-forward', // Fast forward by the seek time (default 10 seconds)
                'progress', // The progress bar and scrubber for playback and buffering
                'current-time', // The current time of playback
                'duration', // The full duration of the media
                'mute', // Toggle mute
                'volume', // Volume control
                ];
                
                const players = Plyr.setup('.js-player', { controls });
                
                // Expose player so it can be used from the console
                window.player = player;
            },

             barfillerProgress: function(){
                $('.course-box, .home2-donation-list').each(function (){
                    var bars = $(this).find('.barfiller');
                    var barid = bars.attr('data-donate-id');
                    var progress = bars.attr('id');
                    $('#'+progress).barfiller({barColor: "#BF0930"});
                });
                if ($('body').hasClass('.give-success')){
                    $('body').append("<button id='gesus-print-btn' class='btn gesus-btn'>Print Receipt</button>");
                    $('#gesus-print-btn').on('click', function (){
                        $(this).closest('#give_donation_receipt').print();
                    });
                }
            },

        }
    }; 
    jQuery(document).ready(function (){
        gesus.init();     
  
    });
       
})(jQuery);
