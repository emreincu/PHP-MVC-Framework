<?php

class tr{
    private $_app, $_validate, $_label, $_shortLabel, $_link;
    public function __construct() {
        $this->_label = "Türkçe";
        $this->_shortLabel = "tr";
        $this->_link = "tr";

        $this->_validate = [
            "required" => ":label boş bırakılamaz!",
            "min" => ":label minimum :value karakterli olmalıdır!",
            "max" => ":label maximum :value karakterli olmalıdır!",
            "matches" => ":label1 ve :label2 uyuşmuyor!",
            "unique" => "Bu :label daha önce kullanılmış! Lütfen başka bir :label seçiniz.",
            "unique_update" => "Bu :label başka biri tarafından kullanılıyor! Lütfen başka bir :label seçiniz.",
            "is_exists" => "Üzgünüz, bu :label ile kayıtlarımızda veri yok!",
            "equals" => ":label hatalı!",
            "numeric" => ":label sadece rakamlardan oluşmalıdır!",
            "email" => "Girilen :label doğru bir e-posta adresi değil!"
        ];

        $this->_app = [
            "home" => "Ana Sayfa",
            "contact" => "İletişim",
            "admin_login_form_title" => "Yönetim Paneli Giriş Formu",
            "admin_forgot_password_title" => "Yönetici şifre yenileme formu",
            "admin_forgot_password_description" => "Lütfen kayıtlı eposta adresinizi yazınız.",
            "your_first_name" => "Adınız",
            "your_last_name" => "Soyadınız",
            "your_user_name" => "Kullanıcı Adınız",
            "your_password" => "Şifreniz",
            "your_email" => "E Posta Adresiniz",
            "email" => "E Posta",
            "password" => "Şifre",
            "your_old_password" => "Eski Şifreniz",
            "user_name" => "Kullanıcı Adı",
            "submit" => "Gönder",
            "login" => "Giriş Yap",
            "register" => "Yeni Kayıt",
            "new_user" => "Yeni Kullanıcı",
            "enter" => "Giriş",
            "logout" =>  "Çıkış Yap",
            "login" => "Giriş Yap",
            "send" => "Gönder",
            "remember_me" => "Beni Hatırla",
            "forgot_password" => "Şifremi unuttum",
            "forgot_password_link" => "sifremi-unuttum",
            "navigation" => "Menü",
            "admin_settings" => "Yönetici Ayarları",
            "others" => "Diğerleri",
            "language" => "Dil",
            "site_name" => "Site Adı",
            "site_slogan" => "Site Sloganı",
            "site_title" => "Site Başlığı",
            "site_description" => "Site Açıklaması",
            "site_keywords" => "Anahtar Kelimeler",
            "your_current_password" => "Mevcut Şifreniz",
            "your_new_password" => "Yeni Şifreniz",
            "new_password_repeat" => "Şifre Tekrarı",
            "update" => "Güncelle",
            "success" => "Başarılı",
            "success_updated" => "Başarıyla Güncellendi",
            "admin_settings" => "Yönetici Ayarları",
            "system" => "Sistem",
            "upload" => "Yükleme",
            "uploads" => "Yüklemeler",
            "upload_error" => "Yükleme hatası",
            "upload_success" => "Yükeleme başarılı",
            "for_upload_a_new_file" => "Yeni bir dosya yüklemek için",
            "choose_a_file" => "Bir dosya seçin",
            "click_here" => "Buraya Tıklayın",
            "drop_files_here" => "Dosyaları buraya bırakın",
            "browse_files" => "Dosyalara Gözat",
            "invalid_file_extension" => "Geçersiz dosya uzantısı",
            "undefined_error" => "Bilinmeyen hata",
            "new_upload" => "Yeni yükleme",
            "upload_new_files" => "Yeni dosyalar yükle",
            "images" => "Görüntüler",
            "documents" => "Belgeler",
            "archives" => "Arşivler",
            "audios" => "Sesler",
            "videos" => "Videolar",
            "empty" => "Boş",
            "delete" => "Sil",
            "yes" => "Evet",
            "no" => "Hayır",
            "cancel" => "Vazgeç",
            "_no_uploads" => "Henüz herhangi bir dosya yüklenmiş değil!",
            "_sure_delete" => "Silmek istediğnize emin misiniz?",
            "are_you_sure" => "Emin misiniz?",
            "_delete_operation_successful" => "Silme işlemi başarılı",
            "_deletion_failed" => "Sil işlemi başarısız",
            "sorry" => "Üzgünüz"
        ];
    }

    public function getApp() {
        return $this->_app;
    }

    public function getValidate() {
        return $this->_validate;
    }

    public function getLink() {
        return $this->_link;
    }

    public function getShortLAbel() {
        return $this->_shortLabel;
    }

    public function getLabel() {
        return $this->_label;
    }
}
