<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<div class="tab-pane fade" id="meta-tag" role="tabpanel" aria-labelledby="meta-tag-tab">
	<div class="row">
		<div class="form-group col-md-12">
			<label>Meta Description (Maks. 255 Karakter)</label>
			<textarea name="meta_description" class="m-0 form-control rounded-0" ><?= @stripslashes($item->meta_description); ?></textarea>
		</div>
	</div>
</div>