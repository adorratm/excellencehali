/** *************Init JS*********************
	
    TABLE OF CONTENTS
	---------------------------
	1.Ready function
	2.Load function
	3.Full height function
	4.pinkman function
	5.Chat App function
	6.Resize function
 ** ***************************************/

"use strict";
/*****Ready function start*****/
$(document).ready(function() {
    pinkman();
    emailApp();
    chatApp();
    calendarApp();
    fmApp();
    /*Disabled*/
    $(document).on("click", "a.disabled,a:disabled", function(e) {
        return false;
    });
    $.fn.countTo = function(options) {
        options = options || {};

        return $(this).each(function() {
            // set options for current element
            var settings = $.extend({}, $.fn.countTo.defaults, {
                from: $(this).data('from'),
                to: $(this).data('to'),
                speed: $(this).data('speed'),
                refreshInterval: $(this).data('refresh-interval'),
                decimals: $(this).data('decimals')
            }, options);

            // how many times to update the value, and how much to increment the value on each update
            var loops = Math.ceil(settings.speed / settings.refreshInterval),
                increment = (settings.to - settings.from) / loops;

            // references & variables that will change with each update
            var self = this,
                $self = $(this),
                loopCount = 0,
                value = settings.from,
                data = $self.data('countTo') || {};

            $self.data('countTo', data);

            // if an existing interval can be found, clear it first
            if (data.interval) {
                clearInterval(data.interval);
            }
            data.interval = setInterval(updateTimer, settings.refreshInterval);

            // initialize the element with the starting value
            render(value);

            function updateTimer() {
                value += increment;
                loopCount++;

                render(value);

                if (typeof(settings.onUpdate) == 'function') {
                    settings.onUpdate.call(self, value);
                }

                if (loopCount >= loops) {
                    // remove the interval
                    $self.removeData('countTo');
                    clearInterval(data.interval);
                    value = settings.to;

                    if (typeof(settings.onComplete) == 'function') {
                        settings.onComplete.call(self, value);
                    }
                }
            }

            function render(value) {
                var formattedValue = settings.formatter.call(self, value, settings);
                $self.html(formattedValue);
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0, // the number the element should start at
        to: 0, // the number the element should end at
        speed: 1000, // how long it should take to count between the target numbers
        refreshInterval: 100, // how often the element should be updated
        decimals: 0, // the number of decimal places to show
        formatter: formatter, // handler for formatting the value before rendering
        onUpdate: null, // callback method for every time the element is updated
        onComplete: null // callback method for when the element finishes updating
    };

    // custom formatting example
    $('.count-number').data('countToOptions', {
        formatter: function(value, options) {
            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
    });

    // start all the timers
    $('.timer').each(count);
});

function count(options) {
    var $this = $(this);
    options = $.extend({}, options || {}, $this.data('countToOptions') || {});
    $this.countTo(options);
}

function formatter(value, settings) {
    return value.toFixed(settings.decimals);
}
/*****Ready function end*****/

/*****Load function start*****/
$(window).on("load", function() {
    $(".preloader-it").delay(500).fadeOut("slow");
});
/*****Load function* end*****/

/*Variables*/
var height, width,
    $wrapper = $(".hk-wrapper"),
    $nav = $(".hk-nav"),
    $vertnaltNav = $(".hk-wrapper.hk-vertical-nav,.hk-wrapper.hk-alt-nav"),
    $horizontalNav = $(".hk-wrapper.hk-horizontal-nav"),
    $navbar = $(".hk-navbar");

/***** pinkman function start *****/
var pinkman = function() {


    /*Counter Animation*/
    var counterAnim = $('.counter-anim');
    if (counterAnim.length > 0) {
        counterAnim.counterUp({
            delay: 10,
            time: 1000
        });
    }

    /*Tooltip*/
    if ($('[data-toggle="tooltip"]').length > 0)
        $('[data-toggle="tooltip"]').tooltip();

    /*Popover*/
    if ($('[data-toggle="popover"]').length > 0)
        $('[data-toggle="popover"]').popover()

    /*Navbar Collapse Animation*/
    var navbarNavCollapse = $('.hk-nav .navbar-nav  li');
    var navbarNavAnchor = '.hk-nav .navbar-nav  li a';
    $(document).on("click", navbarNavAnchor, function(e) {
        if ($(this).attr('aria-expanded') === "false")
            $(this).blur();
        $(this).parent().siblings().find('.collapse').collapse('hide');
        $(this).parent().find('.collapse').collapse('hide');
    });

    /*Card Remove*/
    $(document).on('click', '.card-close', function(e) {
        var effect = $(this).data('effect');
        $(this).closest('.card')[effect]();
        return false;
    });

    /*Accordion js*/
    $(document).on('show.bs.collapse', '.accordion .collapse', function(e) {
        $(this).siblings('.card-header').addClass('activestate');
    });

    $(document).on('hide.bs.collapse', '.accordion .collapse', function(e) {
        $(this).siblings('.card-header').removeClass('activestate');
    });

    /*Navbar Toggle*/
    $(document).on('click', '#navbar_toggle_btn', function(e) {
        $wrapper.toggleClass('hk-nav-toggle');
        $(window).trigger("resize");
        return false;
    });
    $(document).on('click', '#hk_nav_backdrop,#hk_nav_close', function(e) {
        $wrapper.removeClass('hk-nav-toggle');
        return false;
    });

    /*Settings panel Toggle*/
    $(document).on('click', '#settings_toggle_btn', function(e) {
        $wrapper.toggleClass('hk-settings-toggle');
        return false;
    });
    $(document).on('click', '#settings_panel_close', function(e) {
        $wrapper.removeClass('hk-settings-toggle');
        return false;
    });
    $(document).on('click', '#nav_light_select', function(e) {
        $nav.removeClass('hk-nav-dark').addClass('hk-nav-light');
        return false;
    });
    $(document).on('click', '#nav_dark_select', function(e) {
        $nav.removeClass('hk-nav-light').addClass('hk-nav-dark');
        return false;
    });
    $(document).on('click', '#nav_light_select,#nav_dark_select', function(e) {
        $('.hk-nav-select').find('.btn').removeClass('btn-outline-primary').addClass('btn-outline-light');
        $(this).removeClass('btn-outline-light').addClass('btn-outline-primary').blur();
        return false;
    });
    $(document).on('click', '#navtop_light_select,#navtop_dark_select', function(e) {
        $('.hk-navbar-select').find('.btn').removeClass('btn-outline-primary').addClass('btn-outline-light');
        $(this).removeClass('btn-outline-light').addClass('btn-outline-primary').blur();
        return false;
    });
    $(document).on('click', '#navtop_light_select', function(e) {
        $navbar.removeClass('navbar-dark').addClass('navbar-light').find('img.brand-img').attr('src', 'vendor/img/logo-light.png');
        return false;
    });
    $(document).on('click', '#navtop_dark_select', function(e) {
        $navbar.removeClass('navbar-light').addClass('navbar-dark').find('img.brand-img').attr('src', 'vendor/img/logo-dark.png');
        return false;
    });
    if ($('.scroll-nav-switch').length > 0) {
        $('.scroll-nav-switch').toggles({
            drag: true, // allow dragging the toggle between positions
            click: true, // allow clicking on the toggle
            text: {
                on: '', // text for the ON position
                off: '' // and off
            },
            on: false, // is the toggle ON on init
            animate: 250, // animation time (ms)
            easing: 'swing', // animation transition easing function
            checkbox: null, // the checkbox to toggle (for use in forms)
            clicker: null, // element that can be clicked on to toggle. removes binding from the toggle itself (use nesting)

            type: 'compact' // if this is set to 'select' then the select style toggle will be used
        });
        $('.scroll-nav-switch.toggle').on('toggle', function(e, active) {
            if (active) {
                $wrapper.addClass('scrollable-nav');
            } else {
                $wrapper.removeClass('scrollable-nav');
            }
        });
    }
    var navBarChk = ($('.hk-navbar').hasClass('navbar-dark')),
        navChk = ($('.hk-nav').hasClass('hk-nav-dark'))
    $(document).on('click', '#reset_settings', function(e) {
        if (navBarChk)
            $('#navtop_dark_select').click();
        else
            $('#navtop_light_select').click();
        if (navChk)
            $('#nav_dark_select').click();
        else
            $('#nav_light_select').click();
        $('.scroll-nav-switch').click();
        if ($('.scroll-nav-switch').find('.toggle-on').hasClass('active'))
            $('.scroll-nav-switch').click();
        return false;
    });

    /*Search form Collapse*/
    $(document).on('click', '#navbar_search_btn', function(e) {
        $('html,body').animate({ scrollTop: 0 }, 'slow');
        $(".navbar-search input").focus();
        $wrapper.addClass('navbar-search-toggle');
        $(window).trigger("resize");
    });
    $(document).on('click', '#navbar_search_close', function(e) {
        $wrapper.removeClass('navbar-search-toggle');
        $(window).trigger("resize");
        return false;
    });

    /*Slimscroll*/
    $('.nicescroll-bar').slimscroll({ height: '100%', color: '#d6d9da', disableFadeOut: true, borderRadius: 0, size: '6px', enableKeyNavigation: true, opacity: .8 });
    $('.notifications-nicescroll-bar').slimscroll({ height: '330px', size: '6px', color: '#d6d9da', disableFadeOut: true, borderRadius: 0, enableKeyNavigation: true, opacity: .8 });


    /*Slimscroll Key Control*/
    $(".slimScrollDiv").hover(function() {
        $(this).find('[class*="nicescroll-bar"]').focus();
    }, function() {
        $(this).find('[class*="nicescroll-bar"]').blur();
    });

    /*Refresh Init Js*/
    var refreshMe = '.refresh';
    $(document).on("click", refreshMe, function(e) {
        var panelToRefresh = $(this).closest('.card').find('.refresh-container');
        var dataToRefresh = $(this).closest('.card').find('.panel-wrapper');
        var loadingAnim = panelToRefresh.find('.la-anim-1');
        panelToRefresh.show();
        setTimeout(function() {
            loadingAnim.addClass('la-animate');
        }, 100);

        function started() {} //function before timeout
        setTimeout(function() {
            function completed() {} //function after timeout
            panelToRefresh.fadeOut(800);
            setTimeout(function() {
                loadingAnim.removeClass('la-animate');
            }, 800);
        }, 1500);
        return false;
    });

    /*Fullscreen Init Js*/
    $(document).on("click", ".full-screen", function(e) {
        $(this).parents('.card').toggleClass('fullscreen');
        $(window).trigger("resize");
        return false;
    });

};
/***** pinkman function end *****/

/***** Full height function start *****/
var setHeightWidth = function() {
    height = window.innerHeight;
    width = window.innerWidth;
    $('.full-height').css('height', (height));
    $('.hk-pg-wrapper').css('min-height', (height));

    /*****App Height for differnt brekpoints with Vertical & Alt menu*****/

    /*ChatApp Height for differnt brekpoints with Vertical & Alt menu*/
    if ($vertnaltNav.hasClass('navbar-search-toggle'))
        $vertnaltNav.find('.chatapp-users-list,.chat-body').css('height', (height - 240));
    else
        $vertnaltNav.find('.chatapp-users-list,.chat-body').css('height', (height - 190));

    /*EmailApp Height for differnt brekpoints with Vertical & Alt menu*/
    if ($vertnaltNav.hasClass('navbar-search-toggle')) {
        $vertnaltNav.find('.emailapp-emails-list').css('height', (height - 240));
        $vertnaltNav.find('.email-body').css('height', (height - 179));
        $vertnaltNav.find('.emailapp-sidebar').css('height', (height - 107));
    } else {
        $vertnaltNav.find('.emailapp-emails-list').css('height', (height - 190));
        $vertnaltNav.find('.email-body').css('height', (height - 129));
        $vertnaltNav.find('.emailapp-sidebar').css('height', (height - 57));
    }
    /*FilemanagerApp Height for differnt brekpoints with Vertical & Alt menu*/
    if ($vertnaltNav.hasClass('navbar-search-toggle')) {
        $vertnaltNav.find('.fm-body').css('height', (height - 179));
        $vertnaltNav.find('.fmapp-sidebar').css('height', (height - 107));
    } else {
        $vertnaltNav.find('.fm-body').css('height', (height - 129));
        $vertnaltNav.find('.fmapp-sidebar').css('height', (height - 57));
    }
    /*CalendarApp Height for differnt brekpoints with Vertical & Alt menu*/
    if ($vertnaltNav.hasClass('navbar-search-toggle'))
        $vertnaltNav.find('.calendarapp-sidebar,.calendar-wrap').css('height', (height - 107));
    else
        $vertnaltNav.find('.calendarapp-sidebar,.calendar-wrap').css('height', (height - 57));

    /*GmapApp Height for differnt brekpoints with Vertical & Alt menu*/
    if ($vertnaltNav.hasClass('navbar-search-toggle'))
        $vertnaltNav.find('.gmap').css('height', (height - 107));
    else
        $vertnaltNav.find('.gmap').css('height', (height - 57));


    /*****App Height for differnt brekpoints with Horizontal menu*****/

    /*ChatApp Height for differnt brekpoints with Horizontal menu*/
    if (width > 1024) {
        if ($horizontalNav.hasClass('hk-nav-toggle') && !($horizontalNav.hasClass('navbar-search-toggle')))
            $horizontalNav.find('.chatapp-users-list,.chat-body').css('height', (height - 190));
        else if (!($horizontalNav.hasClass('hk-nav-toggle')) && $horizontalNav.hasClass('navbar-search-toggle'))
            $horizontalNav.find('.chatapp-users-list,.chat-body').css('height', (height - 290));
        else
            $horizontalNav.find('.chatapp-users-list,.chat-body').css('height', (height - 240));
    } else {
        if ($horizontalNav.hasClass('navbar-search-toggle'))
            $horizontalNav.find('.chatapp-users-list,.chat-body').css('height', (height - 240));
        else
            $horizontalNav.find('.chatapp-users-list,.chat-body').css('height', (height - 190));
    }

    /*EmailApp Height for differnt brekpoints with Horizontal menu*/
    if (width > 1024) {
        if ($horizontalNav.hasClass('hk-nav-toggle') && !($horizontalNav.hasClass('navbar-search-toggle'))) {
            $horizontalNav.find('.emailapp-emails-list').css('height', (height - 190));
            $horizontalNav.find('.email-body').css('height', (height - 129));
            $horizontalNav.find('.emailapp-sidebar').css('height', (height - 57));
        } else if (!($horizontalNav.hasClass('hk-nav-toggle')) && $horizontalNav.hasClass('navbar-search-toggle')) {
            $horizontalNav.find('.emailapp-emails-list').css('height', (height - 290));
            $horizontalNav.find('.email-body').css('height', (height - 229));
            $horizontalNav.find('.emailapp-sidebar').css('height', (height - 157));
        } else {
            $horizontalNav.find('.emailapp-emails-list').css('height', (height - 240));
            $horizontalNav.find('.email-body').css('height', (height - 179));
            $horizontalNav.find('.emailapp-sidebar').css('height', (height - 107));
        }
    } else {
        if ($horizontalNav.hasClass('navbar-search-toggle')) {
            $horizontalNav.find('.emailapp-emails-list').css('height', (height - 240));
            $horizontalNav.find('.email-body').css('height', (height - 179));
            $horizontalNav.find('.emailapp-sidebar').css('height', (height - 107));
        } else {
            $horizontalNav.find('.emailapp-emails-list').css('height', (height - 190));
            $horizontalNav.find('.email-body').css('height', (height - 129));
            $horizontalNav.find('.emailapp-sidebar').css('height', (height - 57));
        }
    }

    /*FilemanagerApp Height for differnt brekpoints with Horizontal menu*/
    if (width > 1024) {
        if ($horizontalNav.hasClass('hk-nav-toggle') && !($horizontalNav.hasClass('navbar-search-toggle'))) {
            $horizontalNav.find('.fm-body').css('height', (height - 129));
            $horizontalNav.find('.fmapp-sidebar').css('height', (height - 57));
        } else if (!($horizontalNav.hasClass('hk-nav-toggle')) && $horizontalNav.hasClass('navbar-search-toggle')) {
            $horizontalNav.find('.fm-body').css('height', (height - 229));
            $horizontalNav.find('.fmapp-sidebar').css('height', (height - 157));
        } else {
            $horizontalNav.find('.fm-body').css('height', (height - 179));
            $horizontalNav.find('.fmapp-sidebar').css('height', (height - 107));
        }
    } else {
        if ($horizontalNav.hasClass('navbar-search-toggle')) {
            $horizontalNav.find('.fm-body').css('height', (height - 179));
            $horizontalNav.find('.fmapp-sidebar').css('height', (height - 107));
        } else {
            $horizontalNav.find('.fm-body').css('height', (height - 129));
            $horizontalNav.find('.fmapp-sidebar').css('height', (height - 57));
        }
    }

    /*CalendarApp Height for differnt brekpoints with Horizontal menu*/
    if (width > 1024) {
        if ($horizontalNav.hasClass('hk-nav-toggle') && !($horizontalNav.hasClass('navbar-search-toggle')))
            $horizontalNav.find('.calendarapp-sidebar,.calendar-wrap').css('height', (height - 57));
        else if (!($horizontalNav.hasClass('hk-nav-toggle')) && $horizontalNav.hasClass('navbar-search-toggle'))
            $horizontalNav.find('.calendarapp-sidebar,.calendar-wrap').css('height', (height - 157));
        else
            $horizontalNav.find('.calendarapp-sidebar,.calendar-wrap').css('height', (height - 107));
    } else {
        if ($horizontalNav.hasClass('navbar-search-toggle'))
            $horizontalNav.find('.calendarapp-sidebar,.calendar-wrap').css('height', (height - 107));
        else
            $horizontalNav.find('.calendarapp-sidebar,.calendar-wrap').css('height', (height - 57));
    }

    /*GmapApp Height for differnt brekpoints with Horizontal menu*/
    if (width > 1024) {
        if ($horizontalNav.hasClass('hk-nav-toggle') && !($horizontalNav.hasClass('navbar-search-toggle')))
            $horizontalNav.find('.gmap').css('height', (height - 57));
        else if (!($horizontalNav.hasClass('hk-nav-toggle')) && $horizontalNav.hasClass('navbar-search-toggle'))
            $horizontalNav.find('.gmap').css('height', (height - 157));
        else
            $horizontalNav.find('.gmap').css('height', (height - 107));

    } else {
        if ($horizontalNav.hasClass('navbar-search-toggle'))
            $horizontalNav.find('.gmap').css('height', (height - 107));
        else
            $horizontalNav.find('.gmap').css('height', (height - 57));
    }
};
/***** Full height function end *****/

/***** Chat App function start *****/
var chatAppTarget = $('.chatapp-wrap');
var chatApp = function() {
    if (width > 1024)
        chatAppTarget.removeClass('chatapp-slide');
    $(document).on("click", ".chatapp-wrap .chatapp-users-list a.media", function(e) {
        if (width <= 1024) {
            chatAppTarget.addClass('chatapp-slide');
        }
        return false;
    });
    $(document).on("click", "#back_user_list", function(e) {
        if (width <= 1024) {
            chatAppTarget.removeClass('chatapp-slide');
        }
        return false;
    });
    $(document).on("keypress", "#input_msg_send_chatapp", function(e) {
        if ((e.which == 13) && (!$(this).val().length == 0)) {
            $('<li class="media sent"><div class="media-body"><div class="msg-box"><div><p>' + $(this).val() + '</p><span class="chat-time">8:00 pm</span><div class="arrow-triangle-wrap"><div class="arrow-triangle left"></div></div></div></div></div></li>').insertAfter(".chatapp-right  ul li.media:last-child");
            $(this).val('');
        } else if (e.which == 13) {
            alert('Please type asomthing!');
        }
        return;
    });
};
/***** Chat App function end *****/

/***** Email App function start *****/
var emailAppTarget = $('.emailapp-wrap');
var emailApp = function() {
    if (width > 1024)
        emailAppTarget.removeClass('emailapp-slide');
    $(document).on("click", ".emailapp-wrap .emailapp-emails-list a.media", function(e) {
        if (width <= 1024) {
            emailAppTarget.addClass('emailapp-slide');
        }
        return;
    });
    $(document).on("click", "#back_email_list", function(e) {
        if (width <= 1024) {
            emailAppTarget.removeClass('emailapp-slide');
        }
        return false;
    });
    $(document).on("click", "#emailapp_sidebar_move", function(e) {
        emailAppTarget.toggleClass('emailapp-sidebar-toggle');
        return false;
    });
    $(document).on("click", "#close_emailapp_sidebar", function(e) {
        if (width <= 1400) {
            emailAppTarget.removeClass('emailapp-sidebar-toggle');
        }
        return false;
    });
};
/***** Email App function end *****/

/***** Email App function start *****/
var fmAppTarget = $('.fmapp-wrap');
var fmApp = function() {
    $(document).on('click', '#fm_view_switcher', function(e) {
        $(this).closest('.fmapp-main').toggleClass('fmapp-view-switch');
        return false;
    });
    $(document).on("click", "#fmapp_sidebar_move", function(e) {
        fmAppTarget.toggleClass('fmapp-sidebar-toggle');
        return false;
    });
    $(document).on("click", "#close_fmapp_sidebar", function(e) {
        if (width <= 1400) {
            fmAppTarget.removeClass('fmapp-sidebar-toggle');
        }
        return false;
    });
};
/***** Email App function end *****/


/***** Calendar App function start *****/
var calendarAppTarget = $('.calendarapp-wrap');
var calendarApp = function() {
    $(document).on("click", "#calendarapp_sidebar_move", function(e) {
        calendarAppTarget.toggleClass('calendarapp-sidebar-toggle');
        return false;
    });
    $(document).on("click", "#close_calendarapp_sidebar", function(e) {
        if (width <= 1024) {
            calendarAppTarget.removeClass('calendarapp-sidebar-toggle');
        }
        return false;
    });
};
/***** Calendar App function end *****/

/***** Resize function start *****/
$(window).on("resize", function() {
    setHeightWidth();
});
$(window).trigger("resize");
/***** Resize function end *****/