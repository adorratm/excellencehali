<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <?php $this->load->view("includes/head"); ?>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
    <!-- HK Wrapper -->
    <div class="hk-wrapper">

        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">
            <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->
    <?php $this->load->view("includes/include_script"); ?>
</body>

</html>