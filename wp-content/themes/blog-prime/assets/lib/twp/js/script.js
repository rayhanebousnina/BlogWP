(function (e) {
    "use strict";
    var n = window.TWP_JS || {};
    n.stickyMenu = function () {
        if (e(window).scrollTop() > 350) {
            e("body").addClass("nav-affix");
        } else {
            e("body").removeClass("nav-affix");
        }
    };
    n.mobileMenu = {
        init: function () {
            this.menuMobile();
            this.toggleIcon();
            this.menuDesktoparrow();
            this.menuMobilearrow();
        },
        menuMobile: function () {
            e('.offcanvas-toggle, .offcanvas-close').click(function () {
                e('body').toggleClass('offcanvas-menu-open');
                e('body').toggleClass('body-scroll-locked');

                if( e('body').hasClass('offcanvas-menu-open') ){
                    e('html').attr('style','overflow-y: scroll; position: fixed; width: 100%; left: 0px; top: 0px;');
                }else{
                    e('html').removeAttr('style');
                }
                
                setTimeout(function () {
                    e('.offcanvas-close').focus();
                }, 300);
            });
            e('body').append('<div class="offcanvas-overlay"></div>');

            e( 'input, a, button' ).on( 'focus', function() {
                if ( e( 'body' ).hasClass( 'offcanvas-menu-open' ) ) {

                    if ( e( this ).hasClass( 'skip-link-offcanvas-menu-first' ) ) {
                        e('.skip-link-offcanvas-menu-last').focus();
                    }
                    
                    if ( ! e( this ).parents( '#offcanvas-menu' ).length ) {
                         e('.offcanvas-close').focus();
                    }
                }
            } );

        },
        toggleIcon: function () {
            e('#offcanvas-menu .offcanvas-navigation').on('click', 'li .twp-submenu-toggle', function (event) {
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
        menuDesktoparrow: function () {
            if (e('#masthead .main-navigation div.menu > ul').length) {
                e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('.link-icon-wrapper').append('<a class="twp-submenu-toggle" href="javascript:void(0)"><i class="ion-md-arrow-dropdown"></a>');
            }
        },
        menuMobilearrow: function () {
            if (e('#offcanvas-menu .offcanvas-navigation div.menu > ul').length) {
                e('#offcanvas-menu .offcanvas-navigation div.menu > ul .sub-menu').parent('li').find('.link-icon-wrapper').append('<a class="twp-submenu-toggle" href="javascript:void(0)"><i class="ion-md-arrow-dropdown"></a>');
            }
        }
    };
    n.TwpReveal = function () {
        e('.icon-search').on('click', function (event) {
            e('body').toggleClass('reveal-search');
            e('body').addClass('body-scroll-locked');
            e('html').attr('style','overflow-y: scroll; position: fixed; width: 100%; left: 0px; top: 0px;');
            setTimeout(function () {
                e('.close-popup').focus();
            }, 300);
            
        });
        e('.close-popup').on('click', function (event) {
            e('body').removeClass('reveal-search');
            e('body').removeClass('body-scroll-locked');
            e('html').removeAttr('style');
            setTimeout(function () {
                e('.icon-search').focus();
            }, 300);
        });

        e(document).keyup(function(j) {

            if( e('body').hasClass('sidr-nav-open') ){

                if (j.key === "Escape") { // escape key maps to keycode `27`

                    e.sidr('close', 'sidr-nav');
                    e('#hamburger-one').removeClass('active');
                    e('html').removeAttr('style');
                    setTimeout(function () {
                        e('#hamburger-one').focus();
                    }, 300);

                }

            }else if( e('body').hasClass('offcanvas-menu-open') ){

                if (j.key === "Escape") { // escape key maps to keycode `27`

                    e('body').toggleClass('offcanvas-menu-open');
                    e('body').toggleClass('body-scroll-locked');
                    e('html').removeAttr('style');
                    setTimeout(function () {
                        e('.offcanvas-close').focus();
                    }, 300);

                }

            }else{
                if (j.key === "Escape") { // escape key maps to keycode `27`\

                    e('body').removeClass('reveal-search');
                    e('body').removeClass('body-scroll-locked');
                    e('html').removeAttr('style');
                    setTimeout(function () {
                        e('.icon-search').focus();
                    }, 300);

                }
            }

        });

        e( 'input, a, button' ).on( 'focus', function() {
            if ( e( 'body' ).hasClass( 'reveal-search' ) ) {

                if ( e( this ).hasClass( 'skip-link-search' ) ) {
                    e('.popup-search-form .search-submit').focus();
                }

                if ( ! e( this ).parents( '.popup-search' ).length ) {
                    e('.close-popup').focus();
                }
            }
        } );
    };
    n.TwpOffcanvasNav = function () {
        if (e("body").hasClass("rtl")) {
            e('#widgets-nav').sidr({
                name: 'sidr-nav',
                side: 'right'
            });
        } else {
            e('#widgets-nav').sidr({
                name: 'sidr-nav',
                side: 'left'
            });
        }
        e('#hamburger-one').click(function () {
            e(this).toggleClass('active');
            
            if(  e(this).hasClass('active') ){
                e('html').attr('style','overflow-y: scroll; position: fixed; width: 100%; left: 0px; top: 0px;');
            }else{
                e('html').attr('style','');
            }
            
            setTimeout(function () {
               e('.sidr-offcanvas-close').focus();
            }, 300);

        });

        e('.sidr-offcanvas-close').click(function () {

            e.sidr('close', 'sidr-nav');

            e('#hamburger-one').removeClass('active');

            e('html').removeAttr('style');

            setTimeout(function () {
                e('#hamburger-one').focus();
            }, 300);

        });

        e( 'input, a, button' ).on( 'focus', function() {
            if ( e( 'body' ).hasClass( 'sidr-nav-open' ) ) {

                if ( e( this ).hasClass( 'skip-link-offcanvas-first' ) ) {
                    e('.skip-link-offcanvas-last').focus();
                }

                if ( ! e( this ).parents( '#sidr-nav' ).length ) {
                     e('.sidr-offcanvas-close').focus();
                }
            }
        } );
        
    };
    n.TwpBackground = function () {
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
    };
    n.TwpSlider = function () {
        e(".main-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<i class="slide-icon slide-next ion-ios-arrow-round-forward"></i>',
            prevArrow: '<i class="slide-icon slide-prev ion-ios-arrow-round-back"></i>',
        });
        e("ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid, .gallery-columns-1").each(function () {
            e(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-next ion-ios-arrow-round-forward"></i>',
                prevArrow: '<i class="slide-icon slide-prev ion-ios-arrow-round-back"></i>',
                dots: false
            });
        });
    };
    n.MagnificPopup = function () {
        e('.widget .gallery, .entry-content .gallery, .wp-block-gallery').each(function () {
            e(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                    titleSrc: function (item) {
                        return item.el.attr('title');
                    }
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });
        });
    };
    n.show_hide_scroll_top = function () {
        if (e(window).scrollTop() > e(window).height() / 2) {
            e(".scroll-up").fadeIn(300);
        } else {
            e(".scroll-up").fadeOut(300);
        }
    };
    n.scroll_up = function () {
        e('.scroll-up').click(function () {
            e("html, body").animate({
                scrollTop: 0
            }, 700);
            return false;
        });
    };
    n.twp_preloader = function () {
        e(window).load(function () {
            e("body").addClass("page-loaded");
        });
    };
    n.twp_sticksidebar = function () {
        e('.widget-area').theiaStickySidebar({
            additionalMarginTop: 30
        });
    };
    n.tab_posts = function () {
        e('.twp-nav-tabs .tab').on('click', function (event) {
            var tabid = e(this).attr('id');
            e('.twp-nav-tabs .tab').removeClass('active');
            e(this).addClass('active');
            e('.tab-content .tab-pane').removeClass('active');
            e('#content-' + tabid).addClass('active');
        });
    };
    n.aos_animation = function () {
        var i = 0;
        var delay = 300;
        e('body.no-sidebar .article-wraper article').each(function () {
            if (i == 1) {
                delay = 500;
            } else if (i == 2) {
                delay = 700;
            } else {
                delay = 300;
            }
            e(this).attr('data-aos-delay', delay);
            if (i >= 2) {
                i = 0;
            } else {
                i++;
            }
        });
        e('body.right-sidebar .article-wraper article, body.left-sidebar .article-wraper article').each(function () {
            if (i % 2 == 0) {
                delay = 300;
            } else {
                delay = 500;
            }
            e(this).attr('data-aos-delay', delay);
            i++;
        });
        i = 0;
        delay = 300;
        e('.recommended-post-wraper .recommended-load').each(function () {
            if (i == 1) {
                delay = 500;
            } else if (i == 2) {
                delay = 700;
            } else {
                delay = 300;
            }
            e(this).attr('data-aos-delay', delay);
            if (i >= 2) {
                i = 0;
            } else {
                i++;
            }
        });
        AOS.init();
    };
    n.toogle_minicart = function () {
        e(".minicart-title-handle").on("click", function () {
            e(".minicart-content").slideToggle();
        });
    };
    e(document).ready(function () {
        n.mobileMenu.init();
        n.TwpReveal();
        n.TwpOffcanvasNav();
        n.TwpBackground();
        n.TwpSlider();
        n.scroll_up();
        n.twp_preloader();
        n.MagnificPopup();
        n.twp_sticksidebar();
        n.tab_posts();
        n.aos_animation();
        n.toogle_minicart();
    });
    e(window).scroll(function () {
        n.stickyMenu();
        n.show_hide_scroll_top();
    });
})(jQuery);