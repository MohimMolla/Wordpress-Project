(function (e) {
    "use strict";
    var n = window.AFTHRAMPES_JS || {};
    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("#masthead").addClass("nav-affix") : e("#masthead").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                this.toggleMenu(), this.menuMobile(), this.menuArrow()

            },
            toggleMenu: function () {
                e('#masthead').on('click', '.toggle-menu', function (event) {
                    var ethis = e('.main-navigation .menu .menu-mobile');
                    if (ethis.css('display') == 'block') {
                        ethis.slideUp('300');
                    } else {
                        ethis.slideDown('300');
                    }
                    e('.ham').toggleClass('exit');
                    e('body.aft-sticky-header').toggleClass('aft-sticky-header-revealed');
                });
                e('#masthead .main-navigation ').on('click', '.menu-mobile a button', function (event) {
                    event.preventDefault();
                    var ethis = e(this),
                        eparent = ethis.closest('li'),
                        esub_menu = eparent.find('> .sub-menu');
                    if (esub_menu.css('display') == 'none') {
                        esub_menu.slideDown('300');
                        ethis.addClass('active');
                    } else {
                        esub_menu.slideUp('300');
                        ethis.removeClass('active');
                    }
                    return false;
                });
            },
            menuMobile: function () {
                if (e('.main-navigation .menu > ul').length) {
                    var ethis = e('.main-navigation .menu > ul'),
                        eparent = ethis.closest('.main-navigation'),
                        pointbreak = eparent.data('epointbreak'),
                        window_width = window.innerWidth;
                    if (typeof pointbreak == 'undefined') {
                        pointbreak = 991;
                    }
                    if (pointbreak >= window_width) {
                        ethis.addClass('menu-mobile').removeClass('menu-desktop');
                        e('.main-navigation .toggle-menu').css('display', 'block');
                        e('.main-navigation-container-items-wrapper').addClass('aft-mobile-navigation');
                    } else {
                        ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                        e('.main-navigation .toggle-menu').css('display', '');
                        e('.main-navigation-container-items-wrapper').removeClass('aft-mobile-navigation');
                    }
                }

                if (e('.aft-mobile-navigation').length) {
                    var navElement = document.querySelector(".aft-mobile-navigation");
                    if(navElement){

                        n.trapFocus(navElement);
                    }
                }
            },
            menuArrow: function () {
                if (e('#masthead .main-navigation div.menu > ul').length) {
                    e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<button class="fa fa-angle-down">');
                }
            }
        },

        n.trapFocus = function(element) {

            var focusableEls = element.querySelectorAll('a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled])'),
                firstFocusableEl = focusableEls[0],
                lastFocusableEl = focusableEls[focusableEls.length - 1],
                KEYCODE_TAB = 9;

            element.addEventListener('keydown', function(e) {
                var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

                if (!isTabPressed) {
                    return;
                }

                if ( e.shiftKey ) /* shift + tab */ {
                    if (document.activeElement === firstFocusableEl) {
                        e.preventDefault();
                        lastFocusableEl.focus();
                    }

                } else /* tab */ {
                    if (document.activeElement === lastFocusableEl) {
                        e.preventDefault();
                        firstFocusableEl.focus();
                    }

                }

            });


        },


        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.setInstaHeight = function () {
            e('.insta-slider-block').each(function () {
                var img_width = e(this).find('.insta-item .af-insta-height').eq(0).innerWidth();

                e(this).find('.insta-item .af-insta-height').css('height', img_width);
            });
        },


        /* Slick Slider */
        n.SlickCarousel = function () {



            e(".full-slider-mode").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-icon-1 slide-next icon-right fas fa-angle-right"></span>',
                prevArrow: '<span class="slide-icon slide-icon-1 slide-prev icon-left fas fa-angle-left"></span>',
                appendArrows: e('.af-main-navcontrols'),
                rtl: rtl_slick()

            });

            function rtl_slick(){
                if (e('body').hasClass("rtl")) {
                    return true;
                } else {
                    return false;
                }}


            e(".posts-slider").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next icon-right fas fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev icon-left fas fa-angle-left"></i>',
                rtl: rtl_slick()
            });

            e("#aft-trending-story-five .trending-posts-carousel").not('.slick-initialized').slick({
                autoplay: true,
                vertical: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                verticalSwiping: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1  slide-next fas fa-angle-down"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev fas fa-angle-up"></i>',
                appendArrows: e('.af-trending-navcontrols'),
                responsive: [
                    {
                        breakpoint: 1834,
                        settings: {
                            slidesToShow: 5
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 5
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3
                        }
                    },

                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 3
                        }
                    }
                ]
            });

            e(".trending-posts-carousel").not('.slick-initialized').slick({
                autoplay: true,
                vertical: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                verticalSwiping: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1  slide-next fas fa-angle-down"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev fas fa-angle-up"></i>',
                appendArrows: e('.af-trending-navcontrols'),
                responsive: [
                    {
                        breakpoint: 1834,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3
                        }
                    },

                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 3
                        }
                    }
                ]
            });



            e(".trending-posts-vertical-carousel").not('.slick-initialized').slick({
                autoplay: true,
                vertical: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                verticalSwiping: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1  slide-next fas fa-angle-down"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev fas fa-angle-up"></i>'
            });

            e("#primary .posts-carousel").slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 10000,
                infinite: true,
                rtl: rtl_slick(),
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next icon-right fas fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev icon-left fas fa-angle-left"></i>',
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },

                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            e("#secondary .posts-carousel").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 10000,
                infinite: true,
                rtl: rtl_slick(),
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next icon-right fas fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev icon-left fas fa-angle-left"></i>',

            });

            e(".gallery-columns-1").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 10000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-icon-1 slide-next fa fa-arrow-right"></i>',
                prevArrow: '<i class="slide-icon slide-icon-1 slide-prev fa fa-arrow-left"></i>',
                dots: true
            });



        },

        n.Preloader = function () {
            e(window).on('load', function () {
                e('#loader-wrapper').fadeOut();
                e('#af-preloader').delay(500).fadeOut('slow');

            });
        },

        n.Search = function () {
            e(window).on('load', function () {
                e(".af-search-click").on('click', function(){
                    e("#af-search-wrap").toggleClass("af-search-toggle");
                });
            });


        },

        n.searchReveal = function () {



            e(window).on('load', function () {
            jQuery('.search-icon').on('click', function (event) {
                event.preventDefault();
                jQuery('.search-overlay').toggleClass('reveal-search');                
            });

            });

            

        },

        // SHOW/HIDE SCROLL UP //
        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },



        n.em_sticky = function () {
            jQuery('.home #secondary.aft-sticky-sidebar').theiaStickySidebar({
                additionalMarginTop: 30
            });
        },


        n.jQueryMarqueeRight = function () {
            e('.marquee.flash-slide-right').marquee({
                //duration in milliseconds of the marquee
                speed: 80000,
                //gap in pixels between the tickers
                gap: 0,
                //time in milliseconds before the marquee will start animating
                delayBeforeStart: 0,
                //'left' or 'right'
                //direction: 'right',
                //true or false - should the marquee be duplicated to show an effect of continues flow
                duplicated: true,
                pauseOnHover: true,
                startVisible: true
            });
        },

        n.jQueryMarquee = function () {
            e('.marquee.flash-slide-left').marquee({
                //duration in milliseconds of the marquee
                speed: 80000,
                //gap in pixels between the tickers
                gap: 0,
                //time in milliseconds before the marquee will start animating
                delayBeforeStart: 0,
                //'left' or 'right'
                //direction: 'left',
                //true or false - should the marquee be duplicated to show an effect of continues flow
                duplicated: true,
                pauseOnHover: true,
                startVisible: true
            });
        },


        e(function () {
            n.mobileMenu.init(), n.DataBackground(), n.setInstaHeight(), n.jQueryMarquee(),n.jQueryMarqueeRight(), n.SlickCarousel(), n.scroll_up();
        }), e(window).on('scroll', function () {
        n.stickyMenu(), n.show_hide_scroll_top();
    }), e(window).on('resize', function () {
        n.mobileMenu.menuMobile();
    }), e(window).on('load', function () {
        e('#loader-wrapper').fadeOut();
        e('#af-preloader').delay(500).fadeOut('slow');

        e(".af-search-click").on('click', function(){
            e("#af-search-wrap").toggleClass("af-search-toggle");
        });

        e('.search-icon').on('click', function (event) {
            event.preventDefault();
            e('.search-overlay').toggleClass('reveal-search');

            if (e('.reveal-search').length) {
                var searchElement = document.querySelector(".reveal-search");
                if(searchElement){
                    n.trapFocus(searchElement);
                }
            }
        });

    })
})(jQuery);