<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    let productArray = [];
    <?php $total_stock = 0 ?>
    <?php foreach ($products as $key => $value) : ?>
        <?php $total_stock = $total_stock+ $value->stock ?>
        productArray.push({
            stock: parseFloat("<?= $value->stock ?>"),
            category: "<?= $value->category ?>"
        });
    <?php endforeach ?>
    let yearArray = [];
    <?php $yearArray = [] ?>
    <?php $status = [] ?>
    <?php $total_order = 0 ?>
    <?php $beforeYear = null ?>
    <?php foreach ($items as $key => $value) : ?>
        <?php $total_order += 1 ?>
    <?php endforeach ?>

    let colorRandomProductArray = [];

    let colorRandomOrderMonthArray = [];
    <?php foreach ($products as $key) : ?>
        colorRandomProductArray.push(
            "<?= sprintf('#%06X', mt_rand(0, 0xFFFDDD)); ?>"
        );
    <?php endforeach ?>

    <?php foreach (range(0, 12) as $colorNumber) : ?>
        colorRandomOrderMonthArray.push(
            "<?= sprintf('#%06X', mt_rand(0, 0xFFFDDD)); ?>"
        );
    <?php endforeach ?>
</script>
<div class="container-fluid" style="padding-top: 30px">
    <div class="row text-center">
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4 mb-sm-4 mb-md-4 mb-lg-0 mb-xl-0">
            <div class="counter p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div><i class="fa fa-money-bill-alt fa-2x"></i></div>
                    <div>
                        <h2 class="timer count-title count-number" data-to="<?= $total_order ?>" data-speed="1500"></h2>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <p class="count-text ">Toplam Tamamlanan Şipariş</p>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 25%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4 mb-sm-4 mb-md-4 mb-lg-0 mb-xl-0">
            <div class="counter p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div><i class="fa fa-newspaper fa-2x"></i></div>
                    <div>
                        <h2 class="timer count-title count-number" data-to="<?= $total_products_count  ?>" data-speed="1500"></h2>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <p class="count-text ">Toplam Ürün</p>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width:75%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4 mb-sm-4 mb-md-4 mb-lg-0 mb-xl-0">
            <div class="counter p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div><i class="fa fa-dropbox fa-2x icon-warning-sign"></i></div>
                    <div>
                        <h2 class="timer count-title count-number" data-to="<?= $total_stock ?>" data-speed="1500"></h2>

                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <p class="count-text ">Toplam Stok</p>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4 mb-sm-4 mb-md-4 mb-lg-0 mb-xl-0">
            <div class="counter p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div> <i class="fa fa-users fa-2x"></i></div>
                    <div>
                        <h2 class="timer count-title count-number" data-to="<?= 0 ?>" data-speed="1500"></h2>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <p class="count-text ">Üyeler</p>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width:50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div class="row ">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-15">
            <div class="bg-white">
                <?php $statuses = ['Tamamlandı.', 'Ödeme Bekleniyor.', 'Ödeme Alındı.', 'Ödeme Onayı Bekleniyor.', 'Ödeme Onaylandı.', 'Hazırlanıyor.', 'Kargoya Verildi.', 'İptal Edildi.'] ?>
                <div class="d-flex align-items-center align-content-center align-middle py-15">
                    <div class="flex-grow-1 ml-15">
                        <h4 class="flex-grow-1 mr-15">Yıllık Şatış Grafiği</h4>
                    </div>
                    <div class="flex-shrink-1 mr-15">
                        <select class="form-control form-control-lg" onchange="getYearGraph(this.value)">
                            <?php foreach ($statuses as $status) : ?>
                                <option value="<?= $status ?>">
                                    <?= $status ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div id="orderYearChart" class="bg-white"></div>
                <script>
                    $(document).ready(function() {
                        getYearGraph()
                    })

                    function getYearGraph(status = null) {
                        let data = {};
                        let colorRandomOrderYearArray = [];
                        <?php foreach (range(0, 12) as $colorNumber) : ?>
                            colorRandomOrderYearArray.push(
                                "<?= sprintf('#%06X', mt_rand(0, 0xFFFDDD)); ?>"
                            );
                        <?php endforeach ?>
                        if (status !== 'Tamamlandı') {
                            data = {
                                status: status
                            };
                        }
                        $.post("<?= base_url("dashboard/orderTotalYear") ?>", data, function(response) {
                            $("#orderYearChart").empty();
                            if (response.data.length > 0) {
                                if (!$("#orderYearChartAlert").hasClass("d-none")) {
                                    $("#orderYearChartAlert").addClass("d-none");
                                }
                                Morris.Bar({
                                    // ID of the element in which to draw the chart.
                                    element: 'orderYearChart',
                                    // Chart data records -- each entry in this array corresponds to a point on
                                    // the chart.
                                    data: response.data,
                                    resize: true,
                                    // The name of the data record attribute that contains x-values.
                                    xkey: 'year',
                                    // A list of names of data record attributes that contain y-values.
                                    ykeys: ['value'],
                                    barColors: function(row, series, type) {
                                        return colorRandomOrderYearArray[row.x];
                                    },
                                    // Labels for the ykeys -- will be displayed when you hover over the
                                    // chart.
                                    labels: ['Yıllık Toplam Satış'],
                                    xLabelMargin: 0,
                                    xLabelAngle: '70',
                                });

                            } else {

                                if ($("#orderYearChartAlert").hasClass("d-none")) {
                                    $("#orderYearChartAlert").removeClass("d-none");
                                }
                            }
                        }, 'JSON')
                    }
                </script>
            </div>
            <div class="alert alert-danger text-center mt-15 d-none" id="orderYearChartAlert" role="alert">
                Seçmiş olduğunuz değer için veri bulunamadı!
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-15">
            <div class="bg-white">
                <?php $years = range(date('Y'), 1938) ?>
                <?php $statuses = ['Tamamlandı.', 'Ödeme Bekleniyor.', 'Ödeme Alındı.', 'Ödeme Onayı Bekleniyor.', 'Ödeme Onaylandı.', 'Hazırlanıyor.', 'Kargoya Verildi.', 'İptal Edildi.'] ?>
                <div class="d-flex justify-content-between align-items-center align-content-center align-middle py-15">
                    <div class="flex-grow-1">
                        <h4 class="flex-grow-1 ">Aylık Şatış Grafiği</h4>
                    </div>
                    <div class="flex-shrink-1 mr-5 ">
                        <select id="statusSelect" class="form-control  form-control-md" onchange="getMonthGraph(this.value,$('#yearSelect').val())">
                            <?php foreach ($statuses as $status) : ?>
                                <option value="<?= $status ?>">
                                    <p style="font-size:10px"><?= $status ?></p>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex-shrink-1 mr-15">
                        <select id="yearSelect" class="form-control form-control-md" onchange="getMonthGraph($('#statusSelect').val(),this.value)">
                            <?php foreach ($years as $year) : ?>
                                <option value="<?= $year ?>">
                                    <?= $year ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                </div>
                <div id="orderMonthChart" class="bg-white"></div>

                <script>
                    $(document).ready(function() {
                        getMonthGraph()

                    })

                    function getMonthGraph(status=null,year = null) {
                        let data = {};
                        if (status !== null && year!==null) {
                            data = {
                                year: year,
                                status:status
                            };
                        }
                        $.post("<?= base_url("dashboard/orderTotalMonth") ?>", data, function(response) {
                            $("#orderMonthChart").empty();
                            if (response.data.length > 0) {
                                if (!$("#orderMonthChartAlert").hasClass("d-none")) {
                                    $("#orderMonthChartAlert").addClass("d-none");
                                }
                                Morris.Bar({
                                    // ID of the element in which to draw the chart.
                                    element: 'orderMonthChart',
                                    // Chart data records -- each entry in this array corresponds to a point on
                                    // the chart.
                                    data: response.data,
                                    resize: true,
                                    // The name of the data record attribute that contains x-values.
                                    xkey: 'month',
                                    barColors: function(row, series, type) {
                                        return colorRandomOrderMonthArray[row.x];
                                    },
                                    // A list of names of data record attributes that contain y-values.
                                    ykeys: ['value'],
                                    // Labels for the ykeys -- will be displayed when you hover over the
                                    // chart.
                                    labels: ['Aylık Toplam Satış'],
                                    xLabelMargin: 0,
                                    xLabelAngle: '70',
                                });

                            } else {

                                if ($("#orderMonthChartAlert").hasClass("d-none")) {
                                    $("#orderMonthChartAlert").removeClass("d-none");
                                }
                            }
                        }, 'JSON')
                    }
                </script>
            </div>
            <div class="alert alert-danger text-center mt-15 d-none" id="orderMonthChartAlert" role="alert">
                Seçmiş olduğunuz tarih aralığında veri bulunamadı!
            </div>

        </div>
    </div>
    <div class="row">

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
            <div class="bg-white">
                <h4 class="p-4">Kategorilerine Göre Stok Grafiği</h4>
                <div id="productCategoryChart"></div>

                <script>
                    $(document).ready(function() {
                        Morris.Bar({
                            // ID of the element in which to draw the chart.
                            title: 'asdas',
                            element: 'productCategoryChart',
                            // Chart data records -- each entry in this array corresponds to a point on
                            // the chart.
                            data: productArray,
                            resize: true,
                            // The name of the data record attribute that contains x-values.
                            xkey: 'category',
                            // A list of names of data record attributes that contain y-values.
                            ykeys: ['stock'],
                            barColors: function(row, series, type) {
                                return colorRandomProductArray[row.x];
                            },
                            // Labels for the ykeys -- will be displayed when you hover over the
                            // chart.
                            labels: ['Toplam Stok'],
                            xLabelMargin: 0,
                        });

                    })
                </script>
            </div>
        </div>
    </div>
</div>