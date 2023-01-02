<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no" />
<?php $settings = get_settings(); ?>
<title><?= $settings->company_name; ?> | Yönetim Paneli</title>
<meta name="description" content="Admin, Dashboard by Mutfak Yapım" />
<?php if ($settings->logo == "default") : ?>
    <?php $favicon_image = base_url("assets/images/logo.png"); ?>
<?php else : ?>
    <?php $favicon_image = get_picture("settings_v", $settings->favicon); ?>
<?php endif ?>
<!-- Favicon -->
<link rel="shortcut icon" href="<?= $favicon_image ?>">
<link rel="icon" href="<?= $favicon_image ?>" type="image/x-icon">

<?php $this->load->view("includes/include_style"); ?>