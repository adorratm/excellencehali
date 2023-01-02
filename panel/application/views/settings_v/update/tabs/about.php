<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<div class="tab-pane fade" id="about-informations" role="tabpanel" aria-labelledby="about-informations-tab">
	<div class="row">
		<div class="form-group col-md-12">
			<label>Misyon Bilgisi</label>
			<textarea name="mission" class="m-0 tinymce" required>
				<?= $item->mission; ?>
			</textarea>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label>Vizyon Bilgisi</label>
			<textarea name="vision" class="m-0 tinymce" required>
				<?= $item->vision; ?>
			</textarea>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<label>Motto Bilgisi</label>
			<textarea name="motto" class="m-0 tinymce" required>
				<?= $item->motto; ?>
			</textarea>
		</div>
	</div>
</div>