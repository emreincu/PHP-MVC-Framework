<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?= $this->getDescription() ?>">
        <meta name="author" content="<?= $this->getAuthor() ?>">

        <title><?= $this->getTitle() ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?= URL_CSS_BOOTSTRAP ?>/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
         integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="<?= URL_CSS_CUSTOM ?>/admin/floating-labels.css" rel="stylesheet">
    </head>

    <body>
        <form class="form-signin rounded shadow-sm" id = "forgotPasswordForm" method = "POST" action = "<?= URL_ROOT ?>/admin/send_forgot_password">
            <div class="text-center mb-4">
                <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                <h1 class="h3 mb-1 font-weight-normal"><?= $LANGUAGE['admin_forgot_password_title'] ?></h1>
                <p class="mb-3"><?= $LANGUAGE['admin_forgot_password_description'] ?></p>
            </div>
            <?= $this->CONTENT("email"); ?>
            <ul class="list-group mb-3 errors">
            </ul>
            <button class="btn btn-lg btn-primary btn-block" type="submit"><?= $LANGUAGE['send'] ?></button>
            <div class="form-label-group pt-4">
                <a href = "<?= URL_ROOT ?>/admin/login"><?= $LANGUAGE['login'] ?></a>
            </div>
            <?= $this->CONTENT("pick-language"); ?>
        </form>

        <script src="<?= URL_JS_JQUERY ?>/jquery-2.2.4.min.js"></script>
        <script src="<?= URL_JS_BOOTSTRAP ?>/bootstrap.min.js"></script>
        <?= $this->CONTENT("ajax-forgot-password"); ?>

    </body>
</html>
