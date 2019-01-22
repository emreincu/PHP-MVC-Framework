<?php $this->start('default_css') ?>
    <link rel="stylesheet" href="<?= URL_ROOT ?>/App/Views/Main/css/alertify.min.css">
    <link rel="stylesheet" href="<?= URL_ROOT ?>/App/Views/Main/css/themes/semantic.rtl.css">
<?php $this->end('default_css') ?>


<?php $this->start('default_js') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?= URL_ROOT ?>/App/Views/Main/js/alertify.min.js"></script>
<?php $this->end('default_js') ?>


<?php $this->start('alertify_script') ?>
    <script>
        function notification(type, message) {
            if(type == "success") {
                alertify.success(message);
            }else if(type == "warning") {
                alertify.warning(message);
            }else if(type == "error") {
                alertify.error(message);
            }else{
                alertify.message(message);
            }
        }
    </script>
<?php $this->end('alertify_script') ?>