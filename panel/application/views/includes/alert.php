
<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php $alert = $this->session->userdata("alert"); ?>
<?php if ($alert) : ?>
	<?php if ($alert["type"] === "success") : ?>
		<script>
			iziToast.success({
				title: '<?= $alert["title"]; ?>',
				message: '<?= $alert["text"]; ?>',
				position: "topCenter"
			});
		</script>
	<?php else : ?>
		<script>
			iziToast.error({
				title: '<?= $alert["title"]; ?>',
				message: '<?= $alert["text"]; ?>',
				position: "topCenter"
			});
		</script>
	<?php endif ?>
	<?php $this->session->set_flashdata("alert",null)?>
<?php endif ?>