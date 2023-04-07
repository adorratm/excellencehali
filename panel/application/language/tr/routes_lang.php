<?php
$lang['(:any)'] = 'home/index';
$lang['(:any)/404.html'] = "my_controller/error";
$lang["(:any)/sitemap.xml"] = "home/sitemap";
$lang["(:any)/sitemapindex.xml"] = "home/sitemapindex";
$lang["(:any)/facebook-katalog.xml"] = "home/facebook_catalog";
$lang["(:any)/google-katalog.xml"] = "home/google_catalog";
$lang["(:any)/katalog"] = "home/catalog";
$lang['(:any)/cronjob'] = 'cronjob/index';
$lang['(:any)/cronjob/(:any)'] = 'cronjob/$2';

$lang["(:any)/blog"] = "blog/index";
$lang["(:any)/blog/(:num)"] = "blog/index/$2";
$lang["(:any)/blog/(:any)"] = "blog/index/$2";
$lang["(:any)/blog/(:any)/(:num)"] = "blog/index/$2/$3";
$lang["(:any)/blog/detay/(:any)"] = "blog/blog_detail/$2";

$lang["(:any)/koleksiyonlar"] = "product_collections/index";
$lang["(:any)/koleksiyonlar/(:num)"] = "product_collections/index/$2";
$lang["(:any)/koleksiyonlar/(:num)/(:any)"] = "products/index/$2/$3";
$lang["(:any)/koleksiyonlar/(:num)/(:any)/(:num)"] = "products/index/$2/$3/$4";
$lang["(:any)/koleksiyonlar/urun/(:num)/(:any)"] = "products/product_detail/$2/$3";
$lang["(:any)/koleksiyonlar/urun-detay/(:num)/(:any)"] = "products/product_detail_ajax/$2/$3";


$lang["(:any)/galeriler"] = "galleries/index";
$lang["(:any)/galeriler/(:num)"] = "galleries/index/$2";
$lang["(:any)/galeriler/(:any)"] = "galleries/index/$2";
$lang["(:any)/galeriler/(:any)/(:num)"] = "galleries/index/$2/$3";
$lang["(:any)/galeriler/galeri/(:any)"] = "galleries/gallery_detail/$2";

$lang['(:any)/iletisim'] = 'contact/index';
$lang['(:any)/iletisim-formu'] = 'contact/contact_form';

$lang['(:any)/sayfa/(:any)'] = 'pages/index/$2';

$lang['(:any)/dil-degistir'] = 'home/switchLanguage';

$lang['(:any)/sepet'] = 'cart/index';
$lang['(:any)/sepet/ust'] = 'cart/header_cart';
$lang['(:any)/sepet/adet'] = 'cart/quantity';
$lang['(:any)/sepet/ekle'] = 'cart/add';
$lang['(:any)/sepet/guncelle'] = 'cart/update';
$lang['(:any)/sepet/sil'] = 'cart/delete';
$lang['(:any)/sepet/temizle'] = 'cart/clear';
$lang['(:any)/sepet/sepet-sayfasi'] = 'cart/cart_page';
$lang['(:any)/sepet/siparis-adresi-secimi'] = 'cart/order_address';
$lang['(:any)/sepet/siparis-adresi-getir'] = 'cart/get_order_address';
$lang['(:any)/sepet/siparis-adresi-ekle'] = 'cart/add_order_address';
$lang['(:any)/sepet/siparis-adresi-guncelle/(:num)'] = 'cart/update_order_address/$2';
$lang['(:any)/sepet/siparis-adresi-sil/(:num)'] = 'cart/delete_order_address/$2';
$lang['(:any)/sepet/siparis-adresi-degistir'] = 'cart/change_order_address';



$lang['(:any)/odeme-yontemi-secimi'] = 'payment/index';
$lang['(:any)/odeme-yontemi-degistir'] = 'payment/payment_method_change';
$lang['(:any)/teslimat-yontemi-secimi'] = 'payment/delivery';
$lang['(:any)/teslimat-yontemi-degistir'] = 'payment/delivery_method_change';

$lang['(:any)/siparis-olustur'] = 'payment/order';
$lang['(:any)/siparis-basarili/(:any)'] = 'payment/order_success/$2';


$lang["(:any)/bayi-girisi"] = "login/login_form";
$lang["(:any)/giris"] = "login/login";
$lang["(:any)/bayi-kaydi"] = "login/register_form";
$lang["(:any)/kayit"] = "login/register";
$lang["(:any)/aktivasyon"] = "login/activation";
$lang["(:any)/oturumu-kapat"] = "login/logout";
$lang["(:any)/sifremi-unuttum"] = "login/forgot_password_form";
$lang["(:any)/sifremi-sifirla"] = "login/forgot_password";


// Account

$lang["(:any)/hesabim"] = "account/index";
$lang["(:any)/hesabimi-guncelle"] = "account/update";
$lang["(:any)/siparislerim"] = "account/orders";
$lang["(:any)/siparis-detayi/(:any)"] = "account/order_detail/$2";
$lang["(:any)/siparis-iptal-et/(:any)"] = "account/cancel_order/$2";
$lang["(:any)/adreslerim"] = "account/addresses";
$lang['(:any)/siparis-adresi-secimi'] = 'account/order_address';
$lang['(:any)/siparis-adresi-getir'] = 'account/get_order_address';
$lang['(:any)/siparis-adresi-ekle'] = 'account/add_order_address';
$lang['(:any)/siparis-adresi-guncelle/(:num)'] = 'account/update_order_address/$2';
$lang['(:any)/siparis-adresi-sil/(:num)'] = 'account/delete_order_address/$2';
