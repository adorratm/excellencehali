<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <?php $this->load->view("includes/head"); ?>
</head>

<body>
    <!--============= start main area -->

    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <!-- APP NAVBAR ==========-->
        <?php $this->load->view("includes/navbar"); ?>
        <!--========== END app navbar -->

        <!-- APP ASIDE ==========-->
        <?php $this->load->view("includes/aside"); ?>
        <!--========== END app aside -->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>

            <!-- APP FOOTER -->
            <?php $this->load->view("includes/footer"); ?>
        </div>
        <!-- /Main Content -->
    </div>
    <!-- /HK Wrapper -->
    <!--========== END app main -->

    <?php $this->load->view("includes/include_script"); ?>

</body>

</html>