<?php

class en{
    private $_app, $_validate, $_label, $_shortLabel, $_link;
    public function __construct() {

        $this->_label = "English";
        $this->_shortLabel = "en";
        $this->_link = "en";

        $this->_validate = [
            "required" => ":label is required!",
            "min" => ":label must have a minimum of :value characters!",
            "max" => ":label must have a maximum of :value characters!",
            "matches" => ":label1 and :label2 must match!",
            "unique" => "This :label has already been used! Please choose another :label.",
            "unique_update" => "This :label has already been used! Please choose another :label.",
            "is_exists" => "There is no register with this :label!",
            "equals" => ":label is wrong!",
            "numeric" => ":label must be numeric!",
            "email" => "This :label address is not a correct email address!"
        ];


        $this->_app = [
            "home" => "Home",
            "contact" => "Contact",
            "admin_login_form_title" => "Admin Panel Login Form",
            "admin_forgot_password_title" => "Admin password renewal form",
            "admin_forgot_password_description" => "Please enter your email address.",
            "your_first_name" => "Your First Name",
            "your_last_name" => "Your Last Name",
            "your_user_name" => "Your Username",
            "your_password" => "Your Password",
            "your_email" => "Your Email",
            "email" => "Email",
            "password" => "Password",
            "your_old_password" => "Your Old Password",
            "user_name" => "Username",
            "submit" => "Submit",
            "login" => "Login",
            "register" => "Register",
            "new_user" => "New User",
            "enter" => "Enter",
            "logout" =>  "Log Out",
            "login" => "Log in",
            "send" => "Send",
            "remember_me" => "Remember me",
            "forgot_password" => "I forgot my password",
            "forgot_password_link" => "i-forgot-my-password",
            "navigation" => "Navigation",
            "admin_settings" => "Admin Settings",
            "others" => "Others",
            "language" => "Language",
            "site_name" => "Site Name",
            "site_slogan" => "Site Slogan",
            "site_title" => "Site Title",
            "site_description" => "Site Description",
            "site_keywords" => "Keywords",
            "your_current_password" => "Your Current Password",
            "your_new_password" => "Your New Password",
            "new_password_repeat" => "New Password Repeat",
            "update" => "Update",
            "success" => "Success",
            "success_updated" => "Successfully Updated",
            "admin_settings" => "Admin settings",
            "system" => "System",
            "uploads" => "Uploads",
            "upload_error" => "Upload error",
            "upload_success" => "Successful upload",
            "for_upload_a_new_file" => "For upload a new file",
            "choose_a_file" => "Choose a file",
            "click_here" => "Click here",
            "drop_files_here" => "Drop files here",
            "browse_files" => "Browse",
            "invalid_file_extension" => "Invalid file extension",
            "undefined_error" => "Undefined error",
            "new_upload" => "New upload",
            "upload_new_files" => "Upload new files",
            "images" => "Images",
            "documents" => "Documents",
            "archives" => "Archives",
            "audios" => "Audios",
            "videos" => "Videos",
            "empty" => "Boş",
            "delete" => "Delete",
            "yes" => "Yes",
            "no" => "No",
            "cancel" => "Cancel",
            "_sure_delete" => "Are you sure to delete?",
            "_no_uploads" => "There is no upload yet",
            "are_you_sure" => "Are you sure?",
            "_delete_operation_successful" => "Delete operation successful",
            "_deletion_failed" => "Deletion failed",
            "sorry" => "Sorry"

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
