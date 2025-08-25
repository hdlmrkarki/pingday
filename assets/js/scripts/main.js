(function ($) {
  "use strict";

  var pingday = {
    init: function () {
      this.mainMenuBlock();
      this.mainMenuBlock1();
      this.submenuOpener();
      this.stickyHeader();
      this.scrollBar();
      this.twoColsSlider();
      this.linkBoxSlider();
      this.maximizeFAQ();
      this.bgColorAttr();
      this.customAccordion();
      this.pillsOpener();
      this.blogSlider();
      this.statusBox();
      this.numberCounter();
      this.maequee();
    },

    mainMenuBlock: function () {
      jQuery("header").on("click", ".navbar-toggle-btn", function (e) {
        e.preventDefault();
        if (!jQuery(this).hasClass("nav-open")) {
          jQuery("#navbar").removeClass("active");
          jQuery("html").removeClass("menu-active");
          jQuery(this).removeClass("nav-close").addClass("nav-open");
        } else {
          jQuery("#navbar").addClass("active");
          jQuery("html").addClass("menu-active");
          jQuery(this).removeClass("nav-open").addClass("nav-close");
        }
      });
    },

    mainMenuBlock1: function () {
      jQuery("header").on(
        "click",
        ".navbar-toggle-btn.nav-close",
        function (e) {
          jQuery("html").removeClass("submenu-active");
          jQuery(".nav-item").removeClass("opened");
          jQuery(".submenu-opener").removeClass("closed");
          jQuery(".dropdown-menu").css("display", "none");
        }
      );
    },

    submenuOpener: function () {
      jQuery("header.main-header .navbar-nav .submenu-opener").on(
        "click",
        function (e) {
          // e.preventDefault();
          jQuery("html").toggleClass("submenu-active");

          if (!jQuery(this).hasClass("closed")) {
            jQuery(this).addClass("closed");
            jQuery(this).parent(".nav-item").addClass("opened");
            jQuery(this).next(".dropdown-menu").slideToggle();
          } else {
            jQuery(this).removeClass("closed");
            jQuery(this).parent(".nav-item").removeClass("opened");
            jQuery(this).next(".dropdown-menu").slideToggle();
          }
        }
      );
    },

    stickyHeader: function () {
      jQuery(function () {
        function toggleStickyHeader() {
          var sticky = jQuery("header"),
            scroll = jQuery(window).scrollTop();

          if (scroll >= 1) {
            sticky.addClass("sticky-header");
          } else {
            sticky.removeClass("sticky-header");
          }
        }

        jQuery(window).on("scroll", toggleStickyHeader);
        toggleStickyHeader(); // Trigger once on page load
      });
    },

    scrollBar: function () {
      $(document).ready(function () {
        let lastScrollTop = 0;
        let currentTranslateX = {};

        $('.scrollImage').each(function (index) {
          currentTranslateX[index] = 0; // Initialize translateX for each image
        });

        function isInViewport(element) {
          let elementTop = $(element).offset().top;
          let elementBottom = elementTop + $(element).outerHeight();

          let viewportTop = $(window).scrollTop();
          let viewportBottom = viewportTop + $(window).height();

          return elementBottom > viewportTop && elementTop < viewportBottom;
        }

        $(window).on('scroll', function () {
          let st = $(this).scrollTop();
          let direction = (st > lastScrollTop) ? -3 : 3;

          $('.scrollImage').each(function (index) {
            if (isInViewport(this)) {
              currentTranslateX[index] += direction;
              $(this).css('transform', 'translateX(' + currentTranslateX[index] + 'px)');
            }
          });

          lastScrollTop = st <= 0 ? 0 : st;
        });
      });
    },

    twoColsSlider: function () {

      $(document).ready(function () {
        // On page load: Add 'active' class to the first slide on both sliders
        $('.main-slider .single-slide').first().addClass('active');
        $('.thumbnail-slider .single-slide').first().addClass('active');

        // On thumbnail click: Change active slide
        $('.thumbnail-slider .single-slide').on('click', function () {
          var index = $(this).index();

          // Update main-slider active class
          $('.main-slider .single-slide').removeClass('active')
            .eq(index).addClass('active');

          // Update thumbnail-slider active class
          $('.thumbnail-slider .single-slide').removeClass('active');
          $(this).addClass('active');
        });
      });

      mobileOnlySlider(".two-cols-slider .main-slider", true, false, 991);

      function mobileOnlySlider($slidername, $dots, $arrows, $breakpoint) {
        var slider = $($slidername);
        var settings = {
          mobileFirst: true,
          dots: $dots,
          arrows: $arrows,
          autoplay: false,
          infinite: true,
          slidesToShow: 1,

          responsive: [
            {
              breakpoint: $breakpoint,
              settings: "unslick",
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 2,
              }
            }
          ],
        };

        slider.slick(settings);

        $(window).on("resize", function () {
          if ($(window).width() > $breakpoint) {
            return;
          }
          if (!slider.hasClass("slick-initialized")) {
            return slider.slick(settings);
          }
        });
      } // Mobile Only Slider

    },

    linkBoxSlider: function () {

      mobileOnlySlider2(".link-box-slider", true, false, 991);

      function mobileOnlySlider2($slidername, $dots, $arrows, $breakpoint) {
        var slider = $($slidername);
        var settings = {
          mobileFirst: true,
          dots: $dots,
          arrows: $arrows,
          autoplay: false,
          infinite: true,
          slidesToShow: 1,

          responsive: [
            {
              breakpoint: $breakpoint,
              settings: "unslick",
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 2,
              }
            }
          ],
        };

        slider.slick(settings);

        $(window).on("resize", function () {
          if ($(window).width() > $breakpoint) {
            return;
          }
          if (!slider.hasClass("slick-initialized")) {
            return slider.slick(settings);
          }
        });
      } // Mobile Only Slider

    },

    maximizeFAQ: function () {
      jQuery(document).on('click', '.fixed-faq-block .top-block', function (e) {
        jQuery('.fixed-faq-block').toggleClass("maximized");
      });
    },

    bgColorAttr: function () {
      document.querySelectorAll('[hover-bg], [hover-color]').forEach(el => {
        const hoverBg = el.getAttribute('hover-bg');
        const hoverColor = el.getAttribute('hover-color');

        const originalBg = el.style.backgroundColor;
        const originalColor = el.style.color;

        el.addEventListener('mouseenter', () => {
          if (hoverBg) el.style.backgroundColor = hoverBg;
          if (hoverColor) el.style.color = hoverColor;
        });

        el.addEventListener('mouseleave', () => {
          if (hoverBg) el.style.backgroundColor = originalBg;
          if (hoverColor) el.style.color = originalColor;
        });
      });
    },


    customAccordion: function () {
      $('.Accordions').each(function () {
        var $accordion = $(this);

        // Activate first item only if NOT alt2
        if (!$accordion.hasClass('alt2')) {
          $accordion.find('.Accordion_item:first .title_tab')
            .addClass('active')
            .next()
            .stop()
            .slideDown(300);
        }

        // Click handler for only this accordion
        $accordion.find('.title_tab').on('click', function (e) {
          e.preventDefault();
          var $this = $(this);

          if ($this.hasClass('active')) {
            $this.removeClass('active')
              .next().stop().slideUp(500);
          } else {
            $this.addClass('active')
              .next().stop().slideDown(500);

            $this.parent().siblings().children('.title_tab').removeClass('active');
            $this.parent().siblings().children('.inner_content').slideUp(500);
          }
        });
      });

    },

    pillsOpener: function () {
      jQuery('.pills-opener').on('click', function () {

        jQuery('.pills-tab-wrapper').toggleClass('open-navpills');

      });

      jQuery('.pills-tab-wrapper a.nav-link').on('click', function () {

        jQuery('.pills-tab-wrapper').removeClass('open-navpills');
      });
    },

    blogSlider: function () {
      $('.blog-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        responsive: [

          {
            breakpoint: 992,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              arrows: false,
              dots: true,
              infinite: true,

            }
          },
        ]
      });

      jQuery(".blog-slider-block .left-arrow").click(function () {
        jQuery(".blog-slider .slick-prev ").trigger("click");
        return false;
      });

      jQuery(".blog-slider-block .right-arrow").click(function () {
        jQuery(".blog-slider .slick-next").trigger("click");
        return false;
      });

    },




    statusBox: function () {
      $('.status-box .heading').on('click', function () {
        var $statusBox = $(this).closest('.status-box');
        var $icon = $(this).find('.fa');

        $statusBox.toggleClass('closed');
        $statusBox.find('.custom-control-wrapper').stop().slideToggle(300);

        // Toggle icon between minus and plus
        $icon.toggleClass('fa-minus fa-plus');
      });

      // window.addEventListener("scroll", function () {
      //   document.querySelectorAll(".section-has-bg-img").forEach(section => {
      //     const bg = section.querySelector(".bg-img");
      //     const leftBubble = section.querySelector(".left-bubble");
      //     const rightBubble = section.querySelector(".right-bubble");

      //     const rect = section.getBoundingClientRect();

      //     if (rect.top < window.innerHeight && rect.bottom > 0) {
      //       let scrollProgress = rect.top / window.innerHeight;

      //       // Background parallax
      //       if (bg) {
      //         bg.style.transform = `translate(-50%, ${scrollProgress * 350}px)`;
      //       }

      //       // Left bubble parallax
      //       if (leftBubble) {
      //         leftBubble.style.transform = `translateY(${scrollProgress * -50}px)`;
      //       }

      //       // Right bubble parallax
      //       if (rightBubble) {
      //         rightBubble.style.transform = `translateY(${scrollProgress * 50}px)`;
      //       }
      //     }
      //   });
      // });



    },

    numberCounter: function () {
      var a = 0;
      $(window).scroll(function () {

        var oTop = $('#counter').length && $('#counter').offset().top - window.innerHeight;
        if (a == 0 && $(window).scrollTop() > oTop) {
          $('.counter-value').each(function () {
            var $this = $(this),
              countTo = $this.attr('data-count');
            $({
              countNum: $this.text()
            }).animate({
              countNum: countTo
            },

              {

                duration: 3000,
                easing: 'swing',
                step: function () {
                  $this.text(Math.floor(this.countNum));
                },
                complete: function () {
                  $this.text(this.countNum);
                  //alert('finished');
                }

              });
          });
          a = 1;
        }

      });
    },

    maequee: function () {
      const swiperWrapper = document.querySelector('.marquee-swiper .swiper-wrapper');

      // Duplicate slides so we have enough width
      function fillSlides() {
        const containerWidth = document.querySelector('.marquee-swiper').offsetWidth;
        let totalWidth = swiperWrapper.scrollWidth;

        const originals = Array.from(swiperWrapper.children).map(slide => slide.cloneNode(true));

        let guard = 0;
        while (totalWidth < containerWidth * 3 && guard < 50) {
          originals.forEach(clone => swiperWrapper.appendChild(clone.cloneNode(true)));
          totalWidth = swiperWrapper.scrollWidth;
          guard++;
        }
      }
      fillSlides();

      const swiper = new Swiper('.marquee-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 0,
        loop: false, // we handle "infinite" manually
        allowTouchMove: false,
        speed: 0, // instant repositioning (we’ll use translate directly)
      });

      // Constant scroll logic
      let translate = 0;
      const step = 2; // speed in px per frame (~30px/sec if 60fps)

      function animate() {
        translate -= step;
        const maxTranslate = -(
          swiperWrapper.scrollWidth / 2
        ); // half because we duplicated slides

        if (translate <= maxTranslate) {
          translate = 0; // reset to start seamlessly
        }
        swiperWrapper.style.transform = `translate3d(${translate}px,0,0)`;
        requestAnimationFrame(animate);
      }
      requestAnimationFrame(animate);
    },

  };

  pingday.init();
})(jQuery);
