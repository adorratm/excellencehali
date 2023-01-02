$(document).ready(function() {
    /** WORST CODES */
    $(".tagsInput").select2({
        width: 'resolve',
        theme: "classic",
        tags: true,
        tokenSeparators: [',', ' ']
    });

    flatPickrInit();

    /** WORST CODES */

    /** OwlCarousel */
    $('.owl-carousel').owlCarousel({
        loop: true,
        items: 1,
    });
    /** OwlCarousel */

    /** Sortable */
    $(".sortable").sortable();
    $(document).on("sortupdate", '.sortable', function(event, ui) {
        let $data = $(this).sortable("serialize");
        let $data_url = $(this).data("url");
        $.post($data_url, {
            data: $data
        }, function(response) {});
    });
    /** Sortable */

    /** Button Usage */
    $(document).on("change", ".button_usage_btn", function() {
        $(this).parent().parent().find(".button-information-container").slideToggle();
    });
    /** Button Usage */

    /** Dropzone */
    if ($(".dropzone").length > 0) {
        Dropzone.autoDiscover = false;
        //;
        $('.dropzone').each(function(index) {
            let elem = "#" + $(this).attr("id");
            let $uploadSection = Dropzone.forElement(elem);
            $uploadSection.on("complete", function(file) {
                //console.log(file);
                let dataTable = $(elem).data("table");
                reloadTable(dataTable);
            });
        });
    }
    /** Dropzone */

    /** TinyMCE */
    TinyMCEInit();
    /** TinyMCE */

    /** IsActiveSetter */
    $(document).on("click", ".my-check", function() {
        let id = $(this).data("id");
        let url = $(this).data("url");
        let value = null;
        if ($(this).is(":checked")) {
            value = 1;
        } else {
            value = 0;
        }
        $.post(url, {
            "id": id,
            "data": value
        }, function(data) {
            if (data.success) {
                iziToast.success({
                    title: data.title,
                    message: data.msg,
                    position: "topCenter"
                });
            } else {
                iziToast.error({
                    title: data.title,
                    message: data.msg,
                    position: "topCenter"
                });
            }
        }, "json");
    });
    /** IsActiveSetter */

    /** IsCoverSetter */
    $(document).on('change', '.isCover', function() {
        let id = $(this).data("id");
        let url = $(this).data("url");
        let dataTable = $(this).data("table");
        let value = null;
        if ($(this).is(":checked")) {
            value = 1;
        } else {
            value = 0;
        }
        $.post(url, {
            "id": id,
            "data": value
        }, function(data) {
            if (data.success) {
                iziToast.success({
                    title: data.title,
                    message: data.msg,
                    position: "topCenter"
                });
                reloadTable(dataTable);
            } else {
                iziToast.error({
                    title: data.title,
                    message: data.msg,
                    position: "topCenter"
                });
                reloadTable(dataTable);
            }
        }, "json");
    });
    /** IsCoverSetter */

    /** Remove Button */
    $(document).on('click', '.remove-btn', function(e) {
        let url = $(this).data("url");
        let dataTable = $(this).data("table");
        swal.fire({
            title: 'Emin Misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: "Hayır"
        }).then(function(result) {
            if (result.value) {
                let formData = new FormData();
                createAjax(url, formData, function() {
                    reloadTable(dataTable);
                });
            }
        })
    });
    /** Remove Button */
});

/* Functions */

/** TinyMCE */
function TinyMCEInit(height = 300, fullpage = false, selector = '.tinymce') {
    /* TinyMCE */
    if ($("textarea" + selector).length <= 0) {
        return false;
    }
    tinymce.remove();
    tinymce.init({
        selector: selector,
        entity_encoding: (fullpage ? "''" : "'raw'"),
        forced_root_block: "",
        paste_auto_cleanup_on_paste: true,
        language: 'tr_TR', // select language
        language_url: 'https://cdn.jsdelivr.net/npm/tinymce-lang/langs/tr_TR.js',
        branding: false,
        image_advtab: true,
        plugins: (fullpage ? "fullpage " : "") + 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image responsivefilemanager media template link anchor codesample | ltr rtl',
        height: height,
        mobile: {
            theme: 'silver'
        },
        external_filemanager_path: base_url + "/filemanager/",
        filemanager_title: "Dosya Yöneticisi",
        external_plugins: {
            "filemanager": base_url + "/filemanager/plugin.min.js"
        },
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        },
        // without images_upload_url set, Upload tab won't show up
        images_upload_url: base_url + 'settings/uploadImage',
        convert_urls: false,
        // override default upload handler to simulate successful upload
        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', base_url + 'settings/uploadImage');

            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },
    });
    /* TinyMCE */
}
/** TinyMCE */

/** TableInitializerV2 */
function TableInitializerV2(gelentablo, gelendata, gelencolumn, gelenurl, rankUrl, filterSearch = false, aocolumndefs = [{
    "sClass": "text-center justify-content-center align-middle",
    "aTargets": "_all"
}, {
    "type": 'turkish',
    "targets": '_all'
}, {
    "targets": ['nosort'],
    "orderable": false,
}, ]) {
    $('table.' + gelentablo).on('draw.dt', function() {
        $('table.' + gelentablo).DataTable().columns.adjust();
        $('table.' + gelentablo).DataTable().responsive.recalc();
    });
    $('table.' + gelentablo).DataTable({
        "destroy": true,
        "rowReorder": {
            selector: 'td:nth-child(2)'
        },
        "renderer": "bootstrap",
        "deferRender": true,
        "stateSave": true,
        "bstateSave": true,
        "responsive": true,
        "dom": (filterSearch === false ? "<'d-flex align-content-center flex-wrap justify-content-between' <'justify-content-start' l><'justify-content-center'r><'justify-content-end'f>>t<'d-flex flex-wrap justify-content-between' <'justify-content-start'i> <'justify-content-end'p>>" : "<'d-flex align-content-center justify-content-between' <'justify-content-start'><'justify-content-center text-center flex-grow-1'r><'justify-content-end'>>t<'d-flex flex-wrap align-content-center justify-content-between' <'justify-content-start text-center' <'pt-2'l>><'justify-content-end text-center'p>><i>"),
        "language": {
            sDecimal: ",",
            sEmptyTable: "Tabloda herhangi bir veri mevcut değil",
            sInfo: "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            sInfoEmpty: "Kayıt yok",
            sInfoFiltered: "(_MAX_ kayıt içerisinden bulunan)",
            sInfoPostFix: "",
            sInfoThousands: ".",
            sLengthMenu: "Sayfada _MENU_ kayıt göster",
            sLoadingRecords: "Yükleniyor...",
            sProcessing: "İşleniyor...",
            sSearch: "Ara:",
            sZeroRecords: "Eşleşen kayıt bulunamadı",
            oPaginate: {
                sFirst: "İlk",
                sLast: "Son",
                sNext: "Sonraki",
                sPrevious: "Önceki"
            },
            oAria: {
                sSortAscending: ": artan sütun sıralamasını aktifleştir",
                sSortDescending: ": azalan sütun sıralamasını aktifleştir"
            },
            select: {
                rows: {
                    0: "",
                    1: "1 kayıt seçildi",
                    _: "%d kayıt seçildi"
                }
            }
        },
        "order": [],
        "aaSorting": [],
        "bSort": true,
        "aoColumnDefs": aocolumndefs,
        columnDefs: [
            {
                "sClass": "text-center justify-content-center align-middle",
                "aTargets": "_all"
            },
            {
                type: 'turkish',
                targets: '_all'
            },
            {
                targets: ['nosort'],
                orderable: false,
            },
        ],
        "search": {
            "caseInsensitive": false
        },
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "pageLength": 25,
        "iDisplayLength": 25,
        "lengthMenu": [
            [25, 50, 100, 250],
            [25, 50, 100, 250]
        ],
        'ajax': {
            'url': gelenurl,
            'data': gelendata
        },
        //'columns': gelencolumn,
        "rowCallback": function(row, data) {
            if (data.satirrengi !== "" && data.satirrengi !== null) {
                $(row).addClass(data.satirrengi);
            }
            if (data.sutunrengi !== "" && data.sutunrengi !== null && data.sutunindex !== "" && data.sutunindex !== null) {

                $.each(data.sutunrengi, function(key, value) {
                    $(row).find('td:eq(' + data.sutunindex + ')').css("background-color", value);
                });
            }
        },
    });
    $('table.' + gelentablo).on("responsive-display", function() {
        $('table.' + gelentablo).DataTable().columns.adjust();
        $('table.' + gelentablo).DataTable().responsive.recalc();
    });
    $('table.' + gelentablo).on("responsive-resize", function() {
        $('table.' + gelentablo).DataTable().columns.adjust();
        $('table.' + gelentablo).DataTable().responsive.recalc();
    });
    $('table.' + gelentablo).DataTable().on('row-reorder', function(e, details) {
        e.preventDefault();
        e.stopImmediatePropagation();
        if (details.length) {
            let rows = [];
            details.forEach(element => {
                let elm = $('table.' + gelentablo).DataTable().row(element.node).data();
                rows.push({
                    id: $(elm[1]).data("id"),
                    position: element.newData
                });
            });
            $.ajax({
                method: 'POST',
                url: rankUrl,
                data: {
                    rows
                }
            }).done(function() {
                $('table.' + gelentablo).DataTable().ajax.reload()
            });
        }
    });
}

function reloadTable(table) {
    $('.' + table).DataTable().ajax.reload(null, false);
}

function clearFilter(form, table) {
    $("#" + form)[0].reset();
    reloadTable(table)
}

function runScript(e, table) {
    //See notes about 'which' and 'key'
    if (e.keyCode == 13) {
        reloadTable(table);
        return false;
    }
}
/** TableInitializerV2 */

/** createAjax */
function createAjax(url, formData, successFnc = function() {}, errorFnc = function() {}) {
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON"
    }).done(function(response) {
        if (response.success) {
            iziToast.success({
                title: response.title,
                message: response.message,
                position: "topCenter",
                displayMode: 'once',
            });
            successFnc(response);
            if (response.redirect !== null && response.redirect !== "" && response.redirect !== undefined) {
                setTimeout(function() {
                    window.location.href = response.redirect;
                }, 2000);
            }
        } else {
            iziToast.error({
                title: response.title,
                message: response.message,
                position: "topCenter",
                displayMode: 'once',
            });
            errorFnc(response);
            if (response.redirect !== null && response.redirect !== "" && response.redirect !== undefined) {
                setTimeout(function() {
                    window.location.href = response.redirect;
                }, 2000);
            }
        }
    });
}
/** createAjax */

/** createModal */
function createModal(modalClass = null, modalTitle = null, modalSubTitle = null, width = 600, bodyOverflow = true, padding = "20px", radius = 0, headerColor = "#e20e17", background = "#fff", zindex = 1040, onOpening = function() {}, onOpened = function() {}, onClosing = function() {}, onClosed = function() {}, afterRender = function() {}, onFullScreen = function() {}, onResize = function() {}, fullscreen = true, openFullscreen = false, closeOnEscape = true, closeButton = true, overlayClose = false, autoOpen = 0) {
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
function openModal(modalClass = null, event = function() {}) {
    $(modalClass).iziModal('open', event);
    $(modalClass).iziModal('setFullscreen', false);
}
/** openModal */

/** closeModal */
function closeModal(modalClass = null, event = function() {}) {
    $(modalClass).iziModal('setFullscreen', false);
    $(modalClass).iziModal('close', event);
}
/** closeModal */

/** setCookie */
function setCookie(name, value, days) {
    let expires;

    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}
/** setCookie */

/** getCookie */
function getCookie(name) {
    let nameEQ = encodeURIComponent(name) + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}
/**getCookie */

/** deleteCookie */
function deleteCookie(name) {
    setCookie(name, "", -1);
}
/** deleteCookie */

function flatPickrInit() {
    $("input.datetimepicker").each(function() {
        $(this).flatpickr({
            enableTime: true,
            enableSeconds: true,
            dateFormat: "Y-m-d H:i:s",
            time_24hr: true,
            disableMobile: true,
            inline: false,
            locale: "tr"
        });
    });
}

/* Functions */