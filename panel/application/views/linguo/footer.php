  	<div class="modal fade" id="newLanguageModal" tabindex="-1" role="dialog" aria-labelledby="newLanguageModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newLanguageModalLabel">Yeni Dil Ekle</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="string-key" class="control-label">Dil Adı (Max 2 Karakter):</label>
                            <input type="text" class="form-control" id="language-name">
                        </div>
                        <?php
                            if($master_language_id !== false){
                            ?>
                            <p>
                                Çevirileri varsayılan dilden kopyalayabilirsiniz.
                            </p>
                            <div class="form-group">
                                <label for="string-key" class="control-label">Çevirileri varsayılan dilden kopyala:</label>
                                <br />
                                <input type="radio" class="form-check-input" value="1" name="language-clone_from_master"> Evet
                                &nbsp;&nbsp;
                                <input type="radio" class="form-check-input" value="0" name="language-clone_from_master" checked=""> Hayır
                            </div>
                            <?php
                            }
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" id="btn-new_language" data-dismiss="modal" class="btn btn-primary">Dil Oluştur</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newFileModal" tabindex="-1" role="dialog" aria-labelledby="newFileModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newFileModalLabel">Yeni Dil Dosyası Oluştur</h4>
                </div>
                <div class="modal-body">
                	<div class="col-md-12">
                		<p>
                            Oluşturmak istediğiniz dosyayı klasörün içerisinde tutmak istiyorsanız başına klasör adını yazın (sonunda _lang.php olmak zorundadır.):
                			<br/>
                			<code>
                				<small>klasor/dosyaadi_lang.php</small>
                			</code>
                		</p>
                	</div>
                    <form>
                        <div class="form-group">
                            <label for="string-key" class="control-label">Dosya Adı (Lütfen sonuna, .php ekleyin.):</label>
                            <input type="text" class="form-control" id="file-name">
                        </div>
                        <?php
                            if($master_language_id !== false){
                            ?>
                            <p>
                                Çevirileri varsayılan dil klasöründen kopyalayabilirsiniz.
                            </p>
                            <div class="form-group">
                                <label for="string-key" class="control-label">Çevirileri varsayılan dil klasöründen kopyala:</label>
                                <br />
                                <input type="radio" class="form-check-input" value="1" name="file-clone_from_master"> Evet
                                &nbsp;&nbsp;
                                <input type="radio" class="form-check-input" value="0" name="file-clone_from_master" checked=""> Hayır
                            </div>
                            <?php
                            }
                        ?>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" id="btn-new_file" data-dismiss="modal" class="btn btn-primary">Dosya Oluştur</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newStringModal" tabindex="-1" role="dialog" aria-labelledby="newStringModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newStringModalLabel">Yeni Çeviri</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="string-key" class="control-label">Anahtar:</label>
                            <input type="text" class="form-control" id="string-key">
                        </div>
                        <div class="form-group">
                            <label for="string-value" class="control-label">Değer:</label>
                            <textarea class="form-control" id="string-value"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" id="btn-new_string" data-dismiss="modal" class="btn btn-primary">Yeni Çeviri Oluştur</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delStringModal" tabindex="-1" role="dialog" aria-labelledby="delStringModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="delStringModalLabel">Çeviriyi Sil</h4>
                </div>
                <div class="modal-body">
                    <p>Çeviriyi silmek istediğinize emin misiniz? Bu işlemi geri alamazsınız.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" id="btn-del_string" data-dismiss="modal" class="btn btn-danger">Çeviriyi Sil</button>
                </div>
                <input type="hidden" id="ds-language_id" value=""/>
                <input type="hidden" id="ds-file_id" value=""/>
                <input type="hidden" id="ds-string_id" value=""/>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delFileModal" tabindex="-1" role="dialog" aria-labelledby="delFileModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="delFileModalLabel">Çeviri Dosyasını Sil</h4>
                </div>
                <div class="modal-body">
                    <p>Seçmiş olduğunuz çeviri dosyası ve içerisindeki çeviriler silinecektir. Bu işlem geri alınamaz emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" id="btn-del_file" data-dismiss="modal" class="btn btn-danger">Çeviri Dosyasını Sil</button>
                </div>
                <input type="hidden" id="df-language_id" value=""/>
                <input type="hidden" id="df-file_id" value=""/>
            </div>
        </div>
    </div>
    <div class="modal fade" id="syncLanguageStringsModal" tabindex="-1" role="dialog" aria-labelledby="syncLanguageStringsModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="syncLanguageStringsModalLabel">Çevirileri Eşitle</h4>
                </div>
                <div class="modal-body">
                    <p>Bu dosyada varsayılan dil klasörü içerisinde bir çeviri yoksa kaldırılır ve ana dilde bir çeviri varsa ve bu dosyada yoksa eklenir.</p>
                    <p>Bu dosyada çevirileri eşitlemek istediğinize emin misiniz? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" id="btn-sync_strings" data-dismiss="modal" class="btn btn-primary">Çevirileri Eşitle</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="syncLanguageFilesModal" tabindex="-1" role="dialog" aria-labelledby="syncLanguageFilesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="syncLanguageFilesModalLabel">Dosyaları Eşitle</h4>
                </div>
                <div class="modal-body">
                    <p>Ana dilde bu dilde bir dil dosyası yoksa kaldırılır ve ana dilde bir dil dosyası varsa ve bu dilde yoksa eklenir. Ayrıca tüm dosyalar ana dil ile senkronize edilecektir.</p>
                    <p>Dosyaları eşitlemek istediğinize emin misiniz? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="button" id="btn-sync_files" data-dismiss="modal" class="btn btn-primary">Dosyaları Eşitle</button>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
  <!-- JQUERY SCRIPTS -->
  <input type="hidden" id="language_id" value="<?php echo $language_id;?>">
  <input type="hidden" id="file_id" value="<?php echo $file_id;?>">
  <input type="hidden" id="linguo_url" value="<?php echo $linguo_url;?>">
  <script type="text/javascript">
    <?php echo $js_data;?>
  </script>
  </body>
</html>