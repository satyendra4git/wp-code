
  jQuery(window).scroll(function() {
    10
      <=
      jQuery(window).scrollTop() ? jQuery("header").addClass("darkHeader") : jQuery("header").removeClass("darkHeader")
  });

  jQuery('#play-video').on('click', function(e) {
    e.preventDefault();
    jQuery('#video-overlay').addClass('open');
    jQuery("#video-overlay").append('<iframe width="560" height="315" src="https://www.youtube.com/embed/ngElkyQ6Rhs" frameborder="0" allowfullscreen></iframe>');
  });

  jQuery('.video-overlay, .video-overlay-close').on('click', function(e) {
    e.preventDefault();
    close_video();
  });

  jQuery(document).keyup(function(e) {
    if (e.keyCode === 27) {
      close_video();
    }
  });

  function close_video() {
    jQuery('.video-overlay.open').removeClass('open').find('iframe').remove();
  };

  jQuery(function() {

    function slideMenu() {

      var activeState = jQuery('#menu-container .menu-list').hasClass('active');

      jQuery('#menu-container .menu-list').animate({

        left: activeState ? '0%' : '-100%'

      }, 400);

    }

    jQuery('#menu-wrapper').click(function(event) {

      event.stopPropagation();

      jQuery('#hamburger-menu').toggleClass('open');

      jQuery('#menu-container .menu-list').toggleClass('active');

      slideMenu();

      jQuery('body').toggleClass('overflow-hidden');

    });

    jQuery(".menu-list").find('.accordion-toggle').click(function() {

      jQuery(this).toggleClass("active-tab").find("span").toggleClass("icon-minus icon-plus");

      jQuery(this).next().toggleClass("open").slideToggle("fast");

      jQuery(".menu-list .accordion-content").not(jQuery(this).next()).slideUp("fast").removeClass("open");

      jQuery(".menu-list .accordion-toggle").not(jQuery(this)).removeClass("active-tab").find("span").removeClass("icon-minus").addClass("icon-plus")

    });
  }); // jQuery load

  jQuery(document).ready(function() {

        jQuery(window).scroll(function() {

          if (jQuery(this).scrollTop() > 100) {

            jQuery('#scroll').fadeIn();

          } else {

            jQuery('#scroll').fadeOut();

          }

        });

        jQuery(window).scroll(function() {

          var pos = jQuery(window).scrollTop();

          if (pos > 400) {

            jQuery('.fix-menu').addClass('darkHeader');
          } else {
            jQuery('.fix-menu').removeClass('darkHeader');
          }
        });
        
        });