<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>DİLLER</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        
        <div class="row">
            <div class="col-lg-12">
                <?php
                    //CHECK WRITING PERMISSIONS.
                    if(!$can_write){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Dosyalar Yazılamadı.</strong>
                        <br />
                        Lütfen <i>application</i> klasörü içerisindeki <i>language</i> klasörünün yazma izinlerinin sunucu tarafından verildiğine emin olun. Aksi takdirde çeviri sistemi dosyalarınızda değişiklik yapmanızı sağlayamaz.
                    </div>
                    <?php
                    }
                ?>
                <!-- DISCLAIMER -->
                <div class="alert alert-warning" role="alert">
                    <strong>Bilgilendirme</strong>
                    <br />
                    Çeviri dosyalarınızı oluştururken tr, en , de gibi isimlendirmeler ile oluşturmalısınız.
                    <br />
                    Varsayılan Dil klasörünü silmemeye özen gösterin ve aşağıdaki adımları uygulayın:
                    <br /><br />
                    <ol>
                        <li>Gerekiyorsa sunucunuzdaki dil dosyalarının yedeğini alın belgeler üzerinde köklü değişiklik yapıldığı için çevirilerinizde kaybolma gibi bir durum söz konusu olabilir.</li>
                        <li>Varsayılan dil klasöründen dosyaları senkronize ederek çevirilerinizi daha hızlı bir şekilde yapabilirsiniz.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>