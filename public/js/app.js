window.addEventListener('DOMContentLoaded', function () {
    let anchorlinks = document.querySelectorAll('#fixingBar a[href^="#"]')

	for (let item of anchorlinks) { // relitere 
		item.addEventListener('click', (e) => {
			e.preventDefault();
			let hashval = item.getAttribute('href')
			let target = (document.querySelector(hashval).getBoundingClientRect().top + window.pageYOffset) - ($(".triggerFixed").height());
			if (window.screen.width > 1139) {
				target -= $(".isSticky").height() 
			}
			if (!$(".triggerFixed").hasClass("fixed-top")) {
				target -= $(".isSticky").height() + $(".topbarSection").height() + 20;
			}
			$("html, body").animate({ scrollTop: target }, 'slow');
			history.pushState(null, null, hashval)
		})
	}

	$(window).scroll(function () {
		var windscroll = $(window).scrollTop();
		if (windscroll >= 100) {
			$('#fixingBar a').each(function (i) {
				if ($($(this).attr("href")).position().top <= windscroll - 100) {
					$('#fixingBar a.active').removeClass('active');
					$('#fixingBar a').eq(i).addClass('active');
				}
			});

		} else {
			$('#fixingBar a.active').removeClass('active');
			$('#fixingBar a:first').addClass('active');
		}

	}).scroll();

	$(window).on("load", function () {
		let lastAnchor = window.location.href.split("/").pop();
		if ($('#'+lastAnchor).length) {
			let target = (document.querySelector('#'+lastAnchor).getBoundingClientRect().top + window.pageYOffset) - ($(".triggerFixed").height());
			if (window.screen.width > 1139) {
				target -= $(".isSticky").height()
			}
			if (!$(".triggerFixed").hasClass("fixed-top")) {
				target -= $(".isSticky").height() + $(".topbarSection").height();
			}
			history.pushState(null, null, lastAnchor)
			$('html, body').animate({
				scrollTop: target
			}, 'slow');
		}
	});
    $("iframe").each(function () {
        $(this).attr("loading", "lazy");
        $(this).data("src", $(this).attr("src"));
        $(this).addClass("lazyload");
    });
    $(document).on("click", ".btnSubmitForm", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let $this = $(this);
        $this.attr("disabled", "disabled");
        createAjax($this.data("url"), new FormData(document.getElementById("contact-form")), function () {
            $("#contact-form")[0].reset();
            $this.removeAttr("disabled");
        }, function () {
            $this.removeAttr("disabled");
        });
    });
    setTimeout(function () {
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]',
            trigger: "hover",
            container: "body",
            placement: "top",
            boundary: "window"
        });
    }, 1000);
});



function createAjax(e, t, n = function () { }, o = function () { }) {
    $.ajax({
        type: "POST",
        url: e,
        data: t,
        cache: !1,
        contentType: !1,
        processData: !1,
        dataType: "JSON"
    }).done(function (e) {
        e.success ? (iziToast.success({
            title: e.title,
            message: e.message,
            position: "topCenter",
            displayMode: "once"
        }), n(e), null !== e.redirect && "" !== e.redirect && void 0 !== e.redirect && setTimeout(function () {
            window.location.href = e.redirect
        }, 2e3)) : (iziToast.error({
            title: e.title,
            message: e.message,
            position: "topCenter",
            displayMode: "once"
        }), o(e), null !== e.redirect && "" !== e.redirect && void 0 !== e.redirect && setTimeout(function () {
            window.location.href = e.redirect
        }, 2e3))
    })
}

function setCookie(e, t, n) {
    let o;
    if (n) {
        let e = new Date;
        e.setTime(e.getTime() + 24 * n * 60 * 60 * 1e3), o = "; expires=" + e.toGMTString()
    } else o = "";
    document.cookie = encodeURIComponent(e) + "=" + encodeURIComponent(t) + o + "; path=/"
}

function getCookie(e) {
    let t = encodeURIComponent(e) + "=",
        n = document.cookie.split(";");
    for (let e = 0; e < n.length; e++) {
        let o = n[e];
        for (;
            " " === o.charAt(0);) o = o.substring(1, o.length);
        if (0 === o.indexOf(t)) return decodeURIComponent(o.substring(t.length, o.length))
    }
    return null
}

function deleteCookie(e) {
    setCookie(e, "", -1)
}