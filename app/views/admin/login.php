
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?= $this->getDescription() ?>">
        <meta name="author" content="<?= $this->getAuthor() ?>">

        <title><?= $this->getTitle() ?></title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?= URL_VENDOR ?>/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="<?= URL_VENDOR ?>/font-awesome/css/all.css">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="<?= URL_CSS ?>/login.css">
    </head>

    <body>
        <form class="form-signin rounded shadow-sm" id = "loginForm" method = "POST" action = "<?= URL_ROOT ?>/admin/login">
            <div class="text-center mb-4">
                <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal"><?= $LANGUAGE['admin_login_form_title'] ?></h1>
            </div>

            <div class="form-label-group">
                <input type="text" id="email" name='email' class="form-control " placeholder="<?= $LANGUAGE['email'] ?>">
                <label for="email"><?= $LANGUAGE['your_email'] ?></label>
            </div>
            <div class="form-label-group">
                <input type="password" id="password" name='password' class="form-control" placeholder="<?= $LANGUAGE['password'] ?>">
                <label for="password"><?= $LANGUAGE['your_password'] ?></label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember_me" value="remember-me"> <?= $LANGUAGE['remember_me'] ?>
                </label>
            </div>
            <ul class="list-group mb-3 errors">
            </ul>
            <button class="btn btn-lg btn-primary btn-block" type="submit"><?= $LANGUAGE['login'] ?></button>
            <div class="form-label-group pt-4">
                <a href = "<?= URL_ROOT ?>/admin/<?= $LANGUAGE['forgot_password_link'] ?>"><?= $LANGUAGE['forgot_password'] ?></a>
            </div>
            <div class="form-label-group text-right pt-4">
                <a href = "<?= URL_ROOT ?>/dil/degistir/tr">TR</a> |
                <a href = "<?= URL_ROOT ?>/language/change/en">EN</a>
            </div>
        </form>

        <script src="<?= URL_JS ?>/jquery-2.2.4.min.js"></script>
        <script src="<?= URL_VENDOR ?>/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $( document ).ready(function() {
                var request;

                $('#loginForm').submit(function( event ) {
                    event.preventDefault();
                    if (request) {
                        request.abort();
                    }

                    var $form = $(this);
                    var $inputs = $form.find("input, select, textarea, chechbox");
                    var serializedData = $form.serialize();
                    $inputs.prop("disabled", true);

                    // Fire off the request to /form.php
                    request = $.ajax({
                        cache: false,
                        url: "<?= URL_ROOT ?>/admin/login",
                        type: "post",
                        data: serializedData
                    });

                    request.done(function (response, textStatus, jqXHR){
                        var result = $.trim(response);
                        var errors = "";
                        var obj = jQuery.parseJSON( result );

                        if(obj == "okey") {
                            errors = "<li class='list-group-item list-group-item-success'></i><i class='fas fa-check-circle'></i> Başarıyla giriş yaptınız.</li>";
                            $(".errors").html(errors);
                            setTimeout(function() {
                                window.location.href = "<?= URL_ROOT . DS . 'panel'; ?>";
                            }, 500);
                        }

                        $.each(obj, function( i ) {
                            errors += "<li class='list-group-item list-group-item-danger text-danger pb-1 pt-1'></i><small><i class='fas fa-exclamation-circle'></i> " + obj[i][1] + "</small></li>";
                            $('#' + obj[i][0]).addClass('border-danger');
                        });
                        $(".errors").html(errors);
                    });

                    request.fail(function (jqXHR, textStatus, errorThrown){

                    });

                   request.always(function () {
                       $inputs.prop("disabled", false);
                    });
                });
            });
        </script>
    </body>
</html>
