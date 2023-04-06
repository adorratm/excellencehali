<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->product_detail_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= $page_title ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->




<!-- BEGIN: Shop Details Section -->
<section class="shopDetailsPageSection">
    <div class="container detailContent">
        <?php $this->load->view(str_replace("index", "", $this->viewFolder) . "detail") ?>
    </div>
</section>
<!-- END: Shop Details Section -->

<script>
    window.addEventListener('DOMContentLoaded', () => {
        $(document).on("click", ".dimensionLabel", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let codes_id = $(this).data("codes-id");
            $.post("<?= base_url(lang("routes_product-collections") . "/" . lang("routes_product-detail") . "/" . $product->codes . "/" . $product->seo_url) ?>", {
                codes_id: codes_id,
                "<?= $this->security->get_csrf_token_name() ?>": "<?= $this->security->get_csrf_hash() ?>",
            }, function(response) {
                if (response !== "") {
                    $(".detailContent").html(response);
                    if (($('#lightgallery, .lightgallery').length > 0)) {
                        $('#lightgallery, .lightgallery').lightGallery({
                            selector: '.lightimg',
                            loop: !0,
                            thumbnail: !0,
                            exThumbImage: 'data-exthumbimage',
                            download: false,
                        })
                    }
                    let carousel = new bootstrap.Carousel(".carousel", {
                        interval: 2000,
                        touch: true
                    });
                    $(".carousel").on("slid.bs.carousel", (event) => {
                        $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.from + "]").removeClass("active");
                        $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.to + "]").addClass("active");
                        let x = $(".owl-thumb-item.active:not('.d-none')[data-bs-slide-to=" + event.to + "]").width();
                        $('.owl-thumbs').animate({
                            scrollLeft: event.to * x
                        }, 500);
                    });

                    if ($('.productCarousel').length > 0) {
                        $('.productCarousel').owlCarousel({
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
                }
            });
        });
    });
</script>