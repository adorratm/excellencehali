<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $addressTitles = @json_decode($item->address_title, TRUE); ?>
<?php $phones = @json_decode($item->phone, TRUE); ?>
<?php $faxes = @json_decode($item->fax, TRUE); ?>
<?php $addresses = @json_decode($item->address, TRUE); ?>
<?php $whatsapps = @json_decode($item->whatsapp, TRUE); ?>
<?php $maps = @json_decode($item->map, TRUE); ?>
<div class="tab-pane fade" id="address-informations" role="tabpanel" aria-labelledby="address-informations-tab">
	<div class="rows">
		<?php if (empty($phones)) : ?>
			<div class="row border py-2 m-2" id="row-0">
				<div class="form-group col-md-12">
					<label for="addressTitle-0">Adres Başlığı</label>
					<input class="form-control form-control-sm rounded-0" placeholder="Adres Başlığı" name="address_title[]" id="addressTitle-0" required>
				</div>
				<div class="form-group col-md-4">
					<label for="phone-0">Telefon Numarası</label>
					<input class="form-control form-control-sm rounded-0" placeholder="Telefon Numarası" name="phone[]" id="phone-0" required>
				</div>
				<div class="form-group col-md-4">
					<label for="fax-0">Fax Numarası</label>
					<input class="form-control form-control-sm rounded-0" placeholder="Fax Numarası" name="fax[]" id="fax-0" required>
				</div>
				<div class="form-group col-md-4">
					<label for="whatsapp-0">Whatsapp Numarası</label>
					<input class="form-control form-control-sm rounded-0" placeholder="Whatsapp Numarası" name="whatsapp[]" id="whatsapp-0" required>
				</div>
				<div class="form-group col-md-12">
					<label for="address-0">Adres Bilgisi</label>
					<textarea class="form-control form-control-sm rounded-0" placeholder="Adres Bilgisi" name="address[]" id="address-0" required rows="5"></textarea>
				</div>
				<div class="form-group col-md-12">
					<label for="map-0">Harita Bilgisi</label>
					<input class="form-control form-control-sm rounded-0" placeholder="Harita Bilgisi" name="map[]" id="map-0" required>
				</div>
				<div class="form-group col-md-12 text-center">
					<button type="button" role="button" class="btn btn-primary rounded-circle" onclick="cloneRow($(this).parent().parent())"><i class="fa fa-plus"></i></button>
					<button type="button" role="button" class="btn btn-danger rounded-circle" onclick="removeRow($(this).parent().parent())"><i class="fa fa-times"></i></button>
				</div>
			</div>
		<?php else : ?>
			<?php foreach ($phones as $key => $value) : ?>
				<div class="row border py-2 m-2" id="row-<?= $key ?>">
					<div class="form-group col-md-12">
						<label for="addressTitle-<?= $key ?>">Adres Başlığı</label>
						<input class="form-control form-control-sm rounded-0" placeholder="Adres Başlığı" name="address_title[]" id="addressTitle-<?= $key ?>" value="<?= @$addressTitles[$key] ?>" required>
					</div>
					<div class="form-group col-md-4">
						<label for="phone-<?= $key ?>">Telefon Numarası</label>
						<input class="form-control form-control-sm rounded-0" placeholder="Telefon Numarası" name="phone[]" id="phone-<?= $key ?>" value="<?= @$value ?>" required>
					</div>
					<div class="form-group col-md-4">
						<label for="fax-<?= $key ?>">Fax Numarası</label>
						<input class="form-control form-control-sm rounded-0" placeholder="Fax Numarası" name="fax[]" id="fax-<?= $key ?>" value="<?= @$faxes[$key] ?>" required>
					</div>
					<div class="form-group col-md-4">
						<label for="whatsapp-<?= $key ?>">Whatsapp Numarası</label>
						<input class="form-control form-control-sm rounded-0" placeholder="Whatsapp Numarası" name="whatsapp[]" id="whatsapp-<?= $key ?>" value="<?= @$whatsapps[$key] ?>" required>
					</div>
					<div class="form-group col-md-12">
						<label for="address-<?= $key ?>">Adres Bilgisi</label>
						<textarea class="form-control form-control-sm rounded-0" placeholder="Adres Bilgisi" name="address[]" id="address-<?= $key ?>" required rows="5"><?= @$addresses[$key] ?></textarea>
					</div>
					<div class="form-group col-md-12">
						<label for="map-<?= $key ?>">Harita Bilgisi</label>
						<input class="form-control form-control-sm rounded-0" placeholder="Harita Bilgisi" name="map[]" id="map-<?= $key ?>" value="<?= @htmlspecialchars(@html_entity_decode(@$maps[$key])) ?>" required>
					</div>
					<div class="form-group col-md-12 text-center">
						<button type="button" role="button" class="btn btn-primary rounded-circle" onclick="cloneRow($(this).parent().parent())"><i class="fa fa-plus"></i></button>
						<button type="button" role="button" class="btn btn-danger rounded-circle" onclick="removeRow($(this).parent().parent())"><i class="fa fa-times"></i></button>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>
	</div>
</div>

<script>
	function cloneRow($row) {
		let key = 0;
		$(".rows").find(".row").each(function() {
			key++
		});
		let cloned = $($row).clone(true, true);
		let oldKey = parseInt(cloned.attr("id").split("-")[1]);
		cloned.attr("id", "row-" + key);
		cloned.find("label[for='addressTitle-" + oldKey + "']").attr('for', 'addressTitle-' + key);
		cloned.find("input[id='addressTitle-" + oldKey + "']").attr('id', 'addressTitle-' + key);
		cloned.find("input[name='address_title[]']").val('');

		cloned.find("label[for='phone-" + oldKey + "']").attr('for', 'phone-' + key);
		cloned.find("input[id='phone-" + oldKey + "']").attr('id', 'phone-' + key);
		cloned.find("input[name='phone[]']").val('');

		cloned.find("label[for='fax-" + oldKey + "']").attr('for', 'fax-' + key);
		cloned.find("input[id='fax-" + oldKey + "']").attr('id', 'fax-' + key);
		cloned.find("input[name='fax[]']").val('');

		cloned.find("label[for='whatsapp-" + oldKey + "']").attr('for', 'whatsapp-' + key);
		cloned.find("input[id='whatsapp-" + oldKey + "']").attr('id', 'whatsapp-' + key);
		cloned.find("input[name='whatsapp[]']").val('');

		cloned.find("label[for='address-" + oldKey + "']").attr('for', 'address-' + key);
		cloned.find("textarea[id='address-" + oldKey + "']").attr('id', 'address-' + key);
		cloned.find("textarea[name='address[]']").val('');

		cloned.find("label[for='map-" + oldKey + "']").attr('for', 'map-' + key);
		cloned.find("input[id='map-" + oldKey + "']").attr('id', 'map-' + key);
		cloned.find("input[name='map[]']").val('');
		$(".rows").append(cloned);
	}

	function removeRow($row) {
		let key = 0;
		$(".rows").find(".row").each(function() {
			key++
		});
		if (key > 1) {
			$($row).remove();
		}
	}
</script>