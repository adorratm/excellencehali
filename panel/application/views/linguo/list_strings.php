<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <h3>
                <div class="col-md-6">
                    ÇEVİRİ DOSYASI
                </div>
                <div class="col-md-6 text-right">
                    <?php
                    if ($can_write) {
                        if (($master_language_id !== false) && $master_language_id !== $language_id) {
                    ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#syncLanguageFilesModal">Varsayılan Dil Klasöründen Senkronize Et</button>
                        <?php
                        }
                        ?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#newStringModal">Yeni Çeviri Ekle</button>
                    <?php
                    }
                    ?>
                </div>
            </h3>
        </div>
        <!-- /. ROW  -->
        <hr />

        <div class="row">
            <div class="col-lg-12">
                <p>
                    Düzenlemek için dil dizisine tıklayın ve düzenleyin, ardından başka bir alana gidin. Boş bir yere tıkladığınızda veriler kaydedilecektir.
                </p>

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="search_key" placeholder="Anahtar Aratın..." value="" />
                </div>
                <hr />
            </div>

            <div class="col-lg-12">
                <ul class="nav" id="ul-strings_list">
                    <?php
                    foreach ($strings as $string_id => $string) {
                    ?>
                        <li data-search-term="<?php echo $string['key']; ?>">
                            <i class="fa fa-key"></i>
                            <?php echo $string['key']; ?>
                            <div class="pull-right">
                                <button class="btn btn-danger btn-xs delete_string" id="del-<?php echo ($language_id); ?>-<?php echo ($file_id); ?>-<?php echo ($string['string_id']); ?>"><i class="fa fa-remove"></i></button>
                            </div>
                            <input type="text" class="form-control string_content" id="str-<?php echo ($language_id); ?>-<?php echo ($file_id); ?>-<?php echo ($string['string_id']); ?>" placeholder="Insert translation here." value="<?php echo htmlentities($string['value']); ?>" />
                            <br />
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>