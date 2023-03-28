window.addEventListener('DOMContentLoaded', () => {
    $("iframe").each(() => {
        $(this).attr("loading", "lazy");
        $(this).data("src", $(this).attr("src"));
        $(this).addClass("lazyload");
    });
    $(document).on("click", ".btnSubmitForm", (e) => {
        e.preventDefault();
        e.stopImmediatePropagation();
        let $this = $(this);
        $this.attr("disabled", "disabled");
        createAjax($this.data("url"), new FormData(document.getElementById("contact-form")), () => {
            $("#contact-form")[0].reset();
            $this.removeAttr("disabled");
        }, () => {
            $this.removeAttr("disabled");
        });
    });
    setTimeout(() => {
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]',
            trigger: "hover",
            container: "body",
            placement: "top",
            boundary: "window"
        });
    }, 1000);
});

/** createModal */
function createModal(modalClass = null, modalTitle = null, modalSubTitle = null, width = 600, bodyOverflow = true, padding = "20px", radius = 0, headerColor = "#1c1833", background = "#fff", zindex = 1050, onOpening = function () { }, onOpened = function () { }, onClosing = function () { }, onClosed = function () { }, afterRender = function () { }, onFullScreen = function () { }, onResize = function () { }, fullscreen = true, openFullscreen = false, closeOnEscape = true, closeButton = true, overlayClose = false, autoOpen = 0) {
    if (modalClass !== "" || modalClass !== null) {
        $(modalClass).iziModal({
            title: modalTitle,
            subtitle: modalSubTitle,
            headerColor: headerColor,
            background: background,
            width: width,
            zindex: zindex,
            fullscreen: fullscreen,
            openFullscreen: openFullscreen,
            closeOnEscape: closeOnEscape,
            closeButton: closeButton,
            overlayClose: overlayClose,
            autoOpen: autoOpen,
            padding: padding,
            bodyOverflow: bodyOverflow,
            radius: radius,
            onFullScreen: onFullScreen,
            onResize: onResize,
            onOpening: onOpening,
            onOpened: onOpened,
            onClosing: onClosing,
            onClosed: onClosed,
            afterRender: afterRender
        });
    }
    $(modalClass).iziModal('setFullscreen', false);
}
/** createModal */

/** openModal */
function openModal(modalClass = null, event = function () { }) {
    $(modalClass).iziModal('open', event);
    $(modalClass).iziModal('setFullscreen', false);
}
/** openModal */

/** closeModal */
function closeModal(modalClass = null, event = function () { }) {
    $(modalClass).iziModal('setFullscreen', false);
    $(modalClass).iziModal('close', event);
}
/** closeModal */


const createAjax = (e, t, n = () => { }, o = () => { }) => {
    $.ajax({
        type: "POST",
        url: e,
        data: t,
        cache: !1,
        contentType: !1,
        processData: !1,
        dataType: "JSON"
    }).done((e) => {
        e.success ? (iziToast.success({
            title: e.title,
            message: e.message,
            position: "topCenter",
            displayMode: "once"
        }), n(e), null !== e.redirect && "" !== e.redirect && void 0 !== e.redirect && setTimeout(() => {
            window.location.href = e.redirect
        }, 2e3)) : (iziToast.error({
            title: e.title,
            message: e.message,
            position: "topCenter",
            displayMode: "once"
        }), o(e), null !== e.redirect && "" !== e.redirect && void 0 !== e.redirect && setTimeout(() => {
            window.location.href = e.redirect
        }, 2e3))
    })
}

const setCookie = (e, t, n) => {
    let o;
    if (n) {
        let e = new Date;
        e.setTime(e.getTime() + 24 * n * 60 * 60 * 1e3), o = "; expires=" + e.toGMTString()
    } else o = "";
    document.cookie = encodeURIComponent(e) + "=" + encodeURIComponent(t) + o + "; path=/"
}

const getCookie = (e) => {
    let t = encodeURIComponent(e) + "=",
        n = document.cookie.split(";");
    for (let e = 0; e < n.length; e++) {
        let o = n[e];
        for (;
            " " === o.charAt(0);) o = o.substring(1, o.length);
        if (0 === o.indexOf(t)) return decodeURIComponent(o.substring(t.length, o.length))
    }
    return null;
};

const deleteCookie = (e) => {
    setCookie(e, "", -1);
};