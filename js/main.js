/**
 * Template Name: Presento - v1.1.1
 * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
!(function ($) {
  "use strict";
  // home page winner parallx
  //$("#winner").paroller({ factor: 0.5, factorXs: 0.2, type: 'background', direction: 'vertical' });
  //$("[data-paroller-factor]").paroller();
  //$("#winnerData").paroller();
  // Smooth scroll for the navigation menu and links with .scrollto classes
  var scrolltoOffset = $("#header").outerHeight() - 1;
  $(document).on(
    "click",
    ".nav-menu a, .mobile-nav a, .scrollto",
    function (e) {
      if (
        location.pathname.replace(/^\//, "") ==
          this.pathname.replace(/^\//, "") &&
        location.hostname == this.hostname
      ) {
        var target = $(this.hash);
        if (target.length) {
          e.preventDefault();

          var scrollto = target.offset().top - scrolltoOffset;

          if ($(this).attr("href") == "#header") {
            scrollto = 0;
          }

          $("html, body").animate(
            {
              scrollTop: scrollto,
            },
            1500,
            "easeInOutExpo"
          );

          if ($(this).parents(".nav-menu, .mobile-nav").length) {
            $(".nav-menu .active, .mobile-nav .active").removeClass("active");
            $(this).closest("li").addClass("active");
          }

          if ($("body").hasClass("mobile-nav-active")) {
            $("body").removeClass("mobile-nav-active");
            $(".mobile-nav-toggle i").toggleClass(
              "icofont-navigation-menu icofont-close"
            );
            $(".mobile-nav-overly").fadeOut();
          }
          return false;
        }
      }
    }
  );

  // Activate smooth scroll on page load with hash links in the url
  $(document).ready(function () {
    if (window.location.hash) {
      var initial_nav = window.location.hash;
      if ($(initial_nav).length) {
        var scrollto = $(initial_nav).offset().top - scrolltoOffset;
        $("html, body").animate(
          {
            scrollTop: scrollto,
          },
          1500,
          "easeInOutExpo"
        );
      }
    }
  });

  // Navigation active state on scroll
  var nav_sections = $("section");
  var main_nav = $(".nav-menu, .mobile-nav");

  $(window).on("scroll", function () {
    var cur_pos = $(this).scrollTop() + 200;

    nav_sections.each(function () {
      var top = $(this).offset().top,
        bottom = top + $(this).outerHeight();

      // if (cur_pos >= top && cur_pos <= bottom) {
      //   if (cur_pos <= bottom) {
      //     main_nav.find('li').removeClass('active');
      //   }
      //   main_nav.find('a[href="#' + $(this).attr('id') + '"]').parent('li').addClass('active');
      // }
      // if (cur_pos < 300) {
      //   $(".nav-menu ul:first li:first, .mobile-menu ul:first li:first").addClass('active');
      // }
    });
  });

  // Mobile Navigation
  if ($(".nav-menu").length) {
    var $mobile_nav = $(".nav-menu").clone().prop({
      class: "mobile-nav d-lg-none",
    });
    $("body").append($mobile_nav);
    $("body").prepend(
      '<button type="button" class="mobile-nav-toggle d-lg-none"><img src="images/mobile-nav.png"></button>'
    );
    $("body").append('<div class="mobile-nav-overly"></div>');

    $(document).on("click", ".mobile-nav-toggle", function (e) {
      $("body").toggleClass("mobile-nav-active");
      $(".mobile-nav-toggle i").toggleClass(
        "icofont-navigation-menu icofont-close"
      );
      $(".mobile-nav-overly").toggle();
    });

    $(document).on("click", ".mobile-nav .drop-down > a", function (e) {
      e.preventDefault();
      $(this).next().slideToggle(300);
      $(this).parent().toggleClass("active");
    });

    $(document).click(function (e) {
      var container = $(".mobile-nav, .mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($("body").hasClass("mobile-nav-active")) {
          $("body").removeClass("mobile-nav-active");
          $(".mobile-nav-toggle i").toggleClass(
            "icofont-navigation-menu icofont-close"
          );
          $(".mobile-nav-overly").fadeOut();
        }
      }
    });
  } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
    $(".mobile-nav, .mobile-nav-toggle").hide();
  }

  // Toggle .header-scrolled class to #header when page is scrolled
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $("#header").addClass("header-scrolled");
    } else {
      $("#header").removeClass("header-scrolled");
    }
  });

  if ($(window).scrollTop() > 100) {
    $("#header").addClass("header-scrolled");
  }

  // Portfolio details carousel
  $(".portfolio-details-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1,
  });
  var $otherBlogs = $(".otherBlogs").owlCarousel({
    autoplay: false,
    dots: false,
    loop: true,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },

      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });
  $(".btn-prev-blog").click(function () {
    $otherBlogs.trigger("prev.owl.carousel");
  });

  $(".btn-next-blog").click(function () {
    $otherBlogs.trigger("next.owl.carousel");
  });

  var $champion = $(".champion-videos");
  $champion.owlCarousel({
    autoplay: false,
    autoWidth: true,
    dots: false,
    loop: true,
    nav: false,
  });

  $(".btn-prev-champion").click(function () {
    $champion.trigger("prev.owl.carousel");
  });

  $(".btn-next-champion").click(function () {
    $champion.trigger("next.owl.carousel");
  });

  var $usefulResources = $(".useful-resources");
  $usefulResources.owlCarousel({
    autoplay: false,
    autoWidth: true,
    dots: false,
    loop: true,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },

      600: {
        items: 2,
      },
      1000: {
        items: 4,
      },
    },
  });

  $(".btn-prev-useful").click(function () {
    $usefulResources.trigger("prev.owl.carousel");
  });

  $(".btn-next-useful").click(function () {
    $usefulResources.trigger("next.owl.carousel");
  });

  /////cahmp  videos
  var $championVideos = $(".champion-videos");
  $championVideos.owlCarousel({
    autoplay: false,
    autoWidth: true,
    dots: false,
    loop: true,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },

      600: {
        items: 2,
      },
      1000: {
        items: 4,
      },
    },
  });

  $(".btn-prev-champ").click(function () {
    $championVideos.trigger("prev.owl.carousel");
  });

  $(".btn-next-champ").click(function () {
    $championVideos.trigger("next.owl.carousel");
  });

  ///Sample prototype videos
  var $prototype = $(".prototype-videos");
  $prototype.owlCarousel({
    autoplay: false,
    autoWidth: true,
    dots: false,
    loop: true,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },

      600: {
        items: 2,
      },
      1000: {
        items: 4,
      },
    },
  });

  $(".btn-prev-prototype").click(function () {
    $prototype.trigger("prev.owl.carousel");
  });

  $(".btn-next-prototype").click(function () {
    $prototype.trigger("next.owl.carousel");
  });

  //math work videos
  var $mathworkVideos = $(".mathworks-videos");
  $mathworkVideos.owlCarousel({
    autoplay: false,
    autoWidth: true,
    dots: false,
    loop: true,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },

      600: {
        items: 2,
      },
      1000: {
        items: 4,
      },
    },
  });

  $(".btn-prev-mathworks").click(function () {
    $mathworkVideos.trigger("prev.owl.carousel");
  });

  $(".btn-next-mathworks").click(function () {
    $mathworkVideos.trigger("next.owl.carousel");
  });

  ///mathwork videos

  $(".doubts-owl").owlCarousel({
    loop: true,
    mouseDrag: true,
    touchDrag: true,
    pullDrag: true,
    rewind: true,
    nav: true,
  });

  var curDown = false,
    curYPos = 0,
    curXPos = 0;

  $(".vertical-scroll").mousemove(function (m) {
    $(m.currentTarget).css("color", "red");
    if (curDown) {
      console.log("donw");
      console.log("translate3d(0px," + curXPos + ", 0px)" + curXPos);
      //$(m.currentTarget).css({"transform":"translate3d(0px,-"+curXPos+"px, 0px)"});
      //window.scrollBy(curXPos - m.pageX, curYPos - m.pageY)
    }
  });

  $(".vertical-scroll").mousedown(function (m) {
    curYPos = $(this).offset().top;
    curXPos = $(this).offset().left;
    curDown = true;
  });

  $(".vertical-scroll").mouseup(function () {
    curDown = false;
  });

  // for history scrolling
  $(window).scroll(function () {
    if ($("#historyStart").length > 0) {
      var tops = $("#historyStart").offset().top;
      var winsc = $(this).scrollTop();
      var lineH = winsc - tops + 600;
      $(".leftline").css("height", lineH);

      $(".year-history").each(function (index) {
        var el = $(this);
        var topsel = el.offset().top;
        console.log("tops" + winsc);
        var mm = winsc + 607;
        if (mm > topsel) {
          el.addClass("active");
        } else {
          el.removeClass("active");
        }
      });
    }
  });
  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });

  $(".back-to-top").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      1500,
      "easeInOutExpo"
    );
    return false;
  });

  // Clients carousel (uses the Owl Carousel library)
  $(".clients-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 2,
      },
      768: {
        items: 4,
      },
      900: {
        items: 6,
      },
    },
  });

  // jQuery counterUp
  $('[data-toggle="counter-up"]').counterUp({
    delay: 10,
    time: 1000,
  });

  // Testimonials carousel (uses the Owl Carousel library)
  $(".testimonials-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 1,
      },
      900: {
        items: 2,
      },
      1400: {
        items: 3,
      },
    },
  });
  $(".sub-myaccount").css("display", "none");
  $(".myprofile").click(function () {
    $(".sub-myaccount").toggle();
  });

  // Porfolio isotope and filter
  $(window).on("load", function () {
    var portfolioIsotope = $(".portfolio-container").isotope({
      itemSelector: ".portfolio-item",
      layoutMode: "fitRows",
    });

    $("#portfolio-flters li").on("click", function () {
      $("#portfolio-flters li").removeClass("filter-active");
      $(this).addClass("filter-active");

      portfolioIsotope.isotope({
        filter: $(this).data("filter"),
      });
      aos_init();
    });

    // Initiate venobox (lightbox feature used in portofilo)
    /*$(document).ready(function() {
      $('.venobox').venobox();
    });*/
  });

  // Init AOS
  function aos_init() {
    AOS.init({
      duration: 1000,
      once: true,
    });
  }
  $(window).on("load", function () {
    aos_init();
  });
})(jQuery);
