window.addEventListener('DOMContentLoaded', function () {
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