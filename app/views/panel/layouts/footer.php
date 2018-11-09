
            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>Your company &copy; 2017-2019</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p>Design by <a href="https://bootstrapious.com/admin-templates" class="external">Bootstrapious</a></p>
                            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
<!-- JavaScript files-->


<!-- JavaScript files-->
<script src="<?= URL_VENDOR ?>/popper.js/umd/popper.min.js"> </script>
<script src="<?= URL_VENDOR ?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= URL_VENDOR ?>/jquery.cookie/jquery.cookie.js"> </script>
<script src="<?= URL_VENDOR ?>/chart.js/Chart.min.js"></script>
<script src="<?= URL_VENDOR ?>/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= URL_VENDOR ?>/chart.js/charts-home.js"></script>
<!-- Main File-->
<script src="<?= URL_JS ?>/panel_front.js"></script>
<script src="<?= URL_JS ?>/panel_custom.js"></script>

<script src="<?= URL_JS ?>/jquery.toastmessage.js"></script>
<script>
    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }
    function Toast(type, message) {
        type = type.capitalize();
        var myToast =  $().toastmessage('show'+type+'Toast', message);
        setTimeout(function() {
            $().toastmessage('removeToast', myToast);
        }, 5000);

    }
</script>
<!-- TOAST DEBUG
<center>
    <span class="description">
        <a href="javascript:Toast('success','Test toast message');">Show Test Toast</a>
    </span>
</center>
-->
</body>
</html>
