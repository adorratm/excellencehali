<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="tab-pane fade" id="site-analysis" role="tabpanel" aria-labelledby="site-analysis-tab">
	<div class="row">
		<div class="form-group col-md-12">
			<label>Google Analytics</label>
			<textarea name="analytics" class="m-0 form-control"><?= htmlspecialchars(html_entity_decode($item->analytics)); ?></textarea>
		</div>
		<div class="form-group col-md-12">
			<label>Yandex Metrica</label>
			<textarea name="metrica" class="m-0 form-control"><?= htmlspecialchars(html_entity_decode($item->metrica)); ?></textarea>
		</div>
	</div>
</div>