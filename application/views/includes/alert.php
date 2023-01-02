<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $alert = $this->session->userdata("alert"); ?>
<?php if ($alert) : ?>
	<?php if ($alert["success"]) : ?>
		<script>
			window.addEventListener('DOMContentLoaded', function() {
				iziToast.success({
					title: '<?= $alert["title"]; ?>',
					message: '<?= $alert["msg"]; ?>',
					position: "topCenter"
				});
			});
		</script>
	<?php else : ?>
		<script>
			window.addEventListener('DOMContentLoaded', function() {
				iziToast.error({
					title: '<?= $alert["title"]; ?>',
					message: '<?= $alert["msg"]; ?>',
					position: "topCenter"
				});
			});
		</script>
	<?php endif ?>
	<?php $this->session->set_flashdata("alert", null) ?>
<?php endif ?>