/*
 Theme Name: Ulina
 Theme URI: https://uiuxom.com/ulina/html/
 Author: uiuxom
 Author URI: https://themeforest.net/user/uiuxom
 Description: Ulina - Fashion Ecommerce Responsive HTML Template
 Version: 1.0
 License:
 License URI: 
*/

/*==================================
    [Table of contents]
===================================
    01. Variables
    02. Nice Selects
    03. Owl Carousels and Slick
    04. Masonry Grid
    05. Count Down
    06. Image Popup
    07. Back To Top
    08. Pointer Image
    09. Revolution Slider
    10. Sidebar Toggle
    11. Price Slider
    12. Payment Method Toggle
    13. Cirle Progress
    14. Skill Bar
    15. Counter
    16. Sticky Header
    17. Popup Search
    18. Preloader
    19. Contact Form Submission
    20. Google Maps
    21. Social Toggle Menu
    22. Mobile Menu
*/

(function () {
    'use strict';
    /*------------------------------------------------------
    /  01. Variables
    /------------------------------------------------------*/
    let $anSelect = $('.anSelect select'),
        $sortNavSelect = $('.sortNav select'),
        $singleVariationSelect = $('.singleVariation select'),
        $productCarousel = $('.productCarousel'),
        $contactCarousel = $('.contactCarousel'),
        $ulinaCountDown = $('.ulinaCountDown'),
        $masonryGrid = $('#masonryGrid'),
        $masonryGrid2 = $('#masonryGrid2'),
        $categoryCarousel = $('.categoryCarousel'),
        $testimonialCarousel = $('.testimonialCarousel'),
        $testimonialCarousel2 = $('.testimonialCarousel2'),
        $instagramSlider = $('.instagramSlider'),
        $clientLogoSlider = $('.clientLogoSlider'),
        $categoryCarousel2 = $('.categoryCarousel2'),
        $sliderRange = $('#sliderRange'),
        $pointerImage = $('.pointerImage'),
        $shippingFormElementsSelect = $('.shippingFormElements select'),
        $checkoutForm = $('.checkoutForm select'),
        $teamCarousel = $('.teamCarousel');

    /*------------------------------------------------------
    /  02. Nice Selects
    /------------------------------------------------------*/
    if ($anSelect.length > 0) {
        $anSelect.niceSelect();
    };
    if ($sortNavSelect.length > 0) {
        $sortNavSelect.niceSelect();
    };
    if ($singleVariationSelect.length > 0) {
        $singleVariationSelect.niceSelect();
    };
    if ($shippingFormElementsSelect.length > 0) {
        $shippingFormElementsSelect.niceSelect();
    };
    if ($checkoutForm.length > 0) {
        $checkoutForm.niceSelect();
    };

    /*------------------------------------------------------
    /  03. Owl Carousels and Slick
    /------------------------------------------------------*/

    // Owl Carousel For teamCarousel
    if ($teamCarousel.length > 0) {
        $teamCarousel.owlCarousel({
            rewind: true,
            autoplay: 2000,
            margin: 24,
            loop: false,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 4,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    };

    // Owl Carousel For productCarousel
    if ($productCarousel.length > 0) {
        $productCarousel.owlCarousel({
            rewind: true,
            autoplay: 2000,
            margin: 24,
            loop: false,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 4,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    };

    // Owl Carousel For contactCarousel
    if ($contactCarousel.length > 0) {
        $contactCarousel.owlCarousel({
            rewind: true,
            autoplay: 2000,
            margin: 24,
            loop: false,
            nav: true,
            center: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 3,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        });
    };

    // Owl Carousel For categoryCarousel
    if ($categoryCarousel.length > 0) {
        $categoryCarousel.owlCarousel({
            rewind: true,
            autoplay: 2000,
            margin: 24,
            loop: false,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 4,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });
    };

    // Owl Carousel For categoryCarousel2
    if ($categoryCarousel2.length > 0) {
        $categoryCarousel2.owlCarousel({
            rewind: true,
            autoplay: 2000,
            margin: 24,
            loop: false,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: false,
            items: 5,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    };

    // Owl Carousel For testimonialCarousel2
    if ($testimonialCarousel2.length > 0) {
        $testimonialCarousel2.owlCarousel({
            rewind: true,
            autoplay: 2000,
            margin: 24,
            loop: false,
            nav: true,
            navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
            dots: true,
            items: 3,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                576: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        });
    };

    // Owl Carousel For testimonialCarousel
    if ($testimonialCarousel.length > 0) {
        let $testimonialCarousel_obj = $testimonialCarousel.owlCarousel({
            rewind: true,
            autoplay: 2000,
            margin: 24,
            loop: false,
            nav: true,
            navText: [],
            dots: true,
            items: 2,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 1
                },
                1200: {
                    items: 2
                }
            }
        });
        $('.tnext').on('click', function () {
            $testimonialCarousel_obj.trigger('next.owl.carousel');
        });
        $('.tprev').on('click', function () {
            $testimonialCarousel_obj.trigger('prev.owl.carousel');
        });
    }

    // Owl Carousel For instagramSlider
    if ($instagramSlider.length > 0) {
        $instagramSlider.owlCarousel({
            rewind: true,
            autoplay: 2000,
            margin: 0,
            loop: false,
            nav: false,
            dots: false,
            items: 5,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    };

    // Owl Carousel For clientLogoSlider
    if ($clientLogoSlider.length > 0) {
        $clientLogoSlider.owlCarousel({
            autoplay: false,
            margin: 0,
            loop: true,
            nav: false,
            dots: false,
            items: 5,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    };

    /*--------------------------------------------------------
    / 04. Masonry Grid
    /---------------------------------------------------------*/
    if ($masonryGrid.length > 0) {
        let Shuffle = window.Shuffle;
        let element = document.querySelector('#masonryGrid');
        let sizer = element.querySelector('.shafSizer');

        new Shuffle(element, {
            itemSelector: '.shafItem',
            sizer: sizer
        });
    }
    if ($masonryGrid2.length > 0) {
        let Shuffle = window.Shuffle;
        let element = document.querySelector('#masonryGrid2');
        let sizer = element.querySelector('.shafSizer');

        new Shuffle(element, {
            itemSelector: '.shafItem',
            sizer: sizer
        });
    }

    /*--------------------------------------------------------
    / 05. Count Down
    /----------------------------------------------------------*/
    if ($ulinaCountDown.length > 0) {
        let d = $ulinaCountDown.attr('data-day');
        let m = $ulinaCountDown.attr('data-month');
        let y = $ulinaCountDown.attr('data-year');
        $ulinaCountDown.countdown({
            until: new Date(y, m - 1, d),
            format: 'DHMS',
            labels: ['Yrs', 'Mths', 'Weks', 'Days', 'Hrs', 'Mins', 'Secs']
        });
    }

    /*--------------------------------------------------------
     /   07. Back To Top
     /--------------------------------------------------------*/
    let back = $("#backtotop"),
        body = $("body, html");
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > $(window).height()) {
            back.css({ bottom: '25px', opacity: '1', visibility: 'visible' });
        } else {
            back.css({ bottom: '-25px', opacity: '0', visibility: 'hidden' });
        }
    });
    body.on("click", "#backtotop", function (e) {
        e.preventDefault();
        body.animate({ scrollTop: 0 });
        return false;
    });

    /*--------------------------------------------------------
     /   08. Pointer Image
     /--------------------------------------------------------*/
    $pointerImage.each(function () {
        let $pointerWrap = $(this);
        $('.cpAchor', $pointerWrap).on('click', function (e) {
            e.preventDefault();
            let $cpAchor = $(this);
            if ($cpAchor.parent('.clickPoint').hasClass('active')) {
                $('.clickPoint', $pointerWrap).removeClass('active');
            } else {
                $('.clickPoint', $pointerWrap).removeClass('active');
                $cpAchor.parent('.clickPoint').addClass('active');
            }
        });
    });

    /*--------------------------------------------------------
    /   09. Revolution Slider
    /--------------------------------------------------------*/
    if ($('.sliderSection01').length > 0) {
        jQuery('#rev_slider_1').show().revolution({
            delay: 2000,
            responsiveLevels: [1400, 1399, 991, 767],
            gridwidth: [1320, 1140, 720],
            jsFileLocation: "js/",
            sliderLayout: "fullwidth",
            gridheight: [750, 650, 576, 480],
            minHeight: '200',
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                onHoverStop: "off",
                arrows: {
                    style: "custom",
                    enable: true,
                    hide_onmobile: false,
                    hide_onleave: false,
                    hide_under: 1300,
                    tmp: '',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 60,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 60,
                        v_offset: 0
                    }
                },
                bullets: {
                    enable: true,
                    style: 'custom',
                    tmp: '<span></span>',
                    direction: 'horizontal',
                    rtl: false,

                    container: 'layergrid',
                    h_align: 'left',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 60,
                    space: 20,

                    hide_onleave: false,
                    hide_onmobile: true,
                    hide_under: 1000,
                    hide_over: 9999,
                    hide_delay: 200,
                    hide_delay_mobile: 1200
                }
            },
            parallax: {
                type: 'mouse+scroll',
                origo: 'slidercenter',
                speed: 900,
                levels: [5, 10, 15, 20, 25, 30, 35, 40,
                    45, 46, 47, 48, 49, 50, 51, 55],
                disable_onmobile: 'on'
            }
        });
    }
    if ($('.sliderSection02').length > 0) {
        jQuery('#rev_slider_2').show().revolution({
            delay: 2000,
            responsiveLevels: [1400, 1399, 991, 767],
            gridwidth: [1320, 1140, 720],
            jsFileLocation: "js/",
            sliderLayout: "fullwidth",
            gridheight: [750, 650, 576, 320],
            minHeight: '150',
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                onHoverStop: "off",
                arrows: {
                    style: "custom",
                    enable: true,
                    hide_onmobile: true,
                    hide_under: 767,
                    hide_onleave: false,
                    tmp: '',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 60,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 60,
                        v_offset: 0
                    }
                },
                bullets: {
                    enable: true,
                    style: 'custom',
                    tmp: '<span></span>',
                    direction: 'horizontal',
                    rtl: false,

                    container: 'layergrid',
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 60,
                    space: 20,

                    hide_onleave: false,
                    hide_onmobile: false,
                    hide_under: 320,
                    hide_over: 9999,
                    hide_delay: 200,
                    hide_delay_mobile: 1200
                }
            },
            parallax: {
                type: 'mouse+scroll',
                origo: 'slidercenter',
                speed: 900,
                levels: [5, 10, 15, 20, 25, 30, 35, 40,
                    45, 46, 47, 48, 49, 50, 51, 55],
                disable_onmobile: 'on'
            }
        });
    }

    /*--------------------------------------------------------
    /   10. Sidebar Toggle
    /--------------------------------------------------------*/
    $('.shopSidebar ul li.menu-item-has-children > a').on('click', function (e) {
        e.preventDefault();
        $(this).siblings('ul').slideToggle();
        $(this).parent('li.menu-item-has-children').toggleClass('active');
    });

    /*--------------------------------------------------------
    / 11. Price Slider
    /----------------------------------------------------------*/
    if ($sliderRange.length > 0) {
        $sliderRange.slider({
            range: true,
            min: 0,
            max: 10000,
            values: [0, 2000],
            slide: function (event, ui) {
                $("#amount").html("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        $("#amount").html("$" + $sliderRange.slider("values", 0) + " - $" + $sliderRange.slider("values", 1));
    }

    /*--------------------------------------------------------
    / 12. Payment Method Toggle
    /----------------------------------------------------------*/
    $('.wc_payment_methods li > label').on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.wc_payment_methods li').removeClass('active');
            $('.wc_payment_methods li .paymentDesc').slideUp();
            $(this).parent('li').addClass('active');
            $(this).siblings('.paymentDesc').slideDown();
        }
    });

    /*------------------------------------------------------
    /  13. Cirle Progress
    /------------------------------------------------------*/
    if ($(".circleProgress").length > 0) {
        let ast1 = true;
        $('.circleProgress').appear();
        $('.circleProgress').on('appear', function () {
            if (ast1 == true) {
                $(".circleProgress").each(function () {
                    let pint = $(this).attr('data-skills');
                    let decs = pint * 100;
                    let efill = $(this).attr('data-emptyfill');
                    let fill = $(this).attr('data-fills');

                    $(this).circleProgress({
                        value: pint,
                        startAngle: -Math.PI / 2 * 1,
                        fill: { color: fill },
                        lineCap: 'square',
                        thickness: 6,
                        animation: { duration: 1800 },
                        size: 96,
                        emptyFill: efill
                    }).on('circle-animation-progress', function (event, progress) {
                        $(this).find('h3').html(parseInt(decs * progress) + '%');
                    });
                });
                ast1 = false;
            }
        });
    }

    /*--------------------------------------------------------
    / 14. Skill Bar
    /----------------------------------------------------------*/
    if ($(".singleSkill").length > 0) {
        $('.singleSkill').appear();
        $('.singleSkill').on('appear', loadSkills);
    }
    let coun = true;
    function loadSkills() {
        $(".singleSkill").each(function () {
            let datacount = $(this).attr("data-skill");
            $(".skill", this).animate({ 'width': datacount + '%' }, 2000);
            if (coun) {
                $(this).find('span').each(function () {
                    let $this = $(this);
                    $({ Counter: 0 }).animate({ Counter: datacount }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function () {
                            $this.text(Math.ceil(this.Counter) + '%');
                        }
                    });
                });
            }
        });
        coun = false;
    }
    /*--------------------------------------------------------
    / 15. Counter
    /---------------------------------------------------------*/
    $('.timer').appear();
    $(document.body).on('appear', '.timer', function (e, $affected) {
        $affected.each(function () {
            let $this = $(this);
            if (!$this.hasClass('appeared')) {
                jQuery({ Counter: 0 }).animate({ Counter: $this.attr('data-count') }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function () {
                        let num = Math.ceil(this.Counter).toString();
                        $this.html(num);
                    }
                });
                $this.addClass('appeared');
            }
        });
    });

    /*--------------------------------------------------------
    /  16. Sticky Header
    /---------------------------------------------------------*/
    $(window).on('scroll', function () {
        let header_height = $(".isSticky").height();
        if ($(window).scrollTop() > 100) {
            if ($(".isSticky").hasClass('h01Mode2')) {
                $('.blanks').css('height', header_height);
                $(".triggerFixed").addClass("fixed-top");
                $(".triggerFixed").css("top", header_height);
            }
            $(".isSticky").addClass('fixedHeader animated slideInDown');
            $(".triggerFixed").addClass('fixedHeader animated slideInDown');
        } else {
            if ($(".isSticky").hasClass('h01Mode2')) {
                $('.blanks').css('height', '0');
                $(".triggerFixed").removeClass("fixed-top");
                $(".triggerFixed").css("top", '0');
            }
            $(".isSticky").removeClass('fixedHeader animated slideInDown');
            $(".triggerFixed").removeClass('fixedHeader animated slideInDown');
        }
    });

    /*--------------------------------------------------------
    / 17. Popup Search
    /----------------------------------------------------------*/
    $('.anSearch > a').on('click', function (e) {
        e.preventDefault();
        $('.popup_search_sec').toggleClass('active');
    });
    $('.popup_search_overlay, #search_Closer').on('click', function () {
        $('.popup_search_sec').removeClass('active');
    });

    /*--------------------------------------------------------
    /  18. Preloader
    /---------------------------------------------------------*/
    $(window).on('load', function () {
        let preload = $('#preloader');
        if (preload.length > 0) {
            preload.delay(500).fadeOut('slow');
        }
    });

    /*--------------------------------------------------------
    /  21. Social Toggle Menu
    /---------------------------------------------------------*/
    $('.anSocial a.tog').on('click', function () {
        $(this).parent('.anSocial').toggleClass('active');
    });

    /*--------------------------------------------------------
    /  22. Mobile Menu
    /---------------------------------------------------------*/
    $('.mainMenu ul li.menu-item-has-children > a').on('click', function (e) {
        e.preventDefault();
        if ($(window).width() < 1366) {
            $(this).siblings('ul, .megaMenu').slideToggle();
        }
    });
    $('.menuToggler').on('click', function (e) {
        e.preventDefault();
        $('.mainMenu').slideToggle();
        $(this).toggleClass('active');
    });

})(jQuery)