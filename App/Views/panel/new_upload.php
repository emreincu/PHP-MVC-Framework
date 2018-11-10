<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?= $title ?></h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts">
    <div class="container-fluid">
        <div class="row bg-white has-shadow mb-3">
            <div class="col">
                <form id="upload" method="post" action="<?= URL_ROOT ?>/panel/upload_file" enctype="multipart/form-data">
                    <div id="drop">
                        <?= $LANGUAGE['drop_files_here'] ?> <br>
                        <a><?= $LANGUAGE['browse_files'] ?></a>
                        <input type="file" name="upl" multiple />
                    </div>
                    <ul>
                        <!-- The file uploads will be shown here -->
                    </ul>
                </form>
                <!-- DEBUG
                <form id="upload" method="post" action="<?= URL_ROOT ?>/panel/upload_file" enctype="multipart/form-data">
                    <input type = "file" name = "upl"><input type = "submit" value = "gönder">
                </form>
                -->
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- JavaScript Includes -->
<script src="<?= URL_JS ?>/jquery.knob.js"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?= URL_JS ?>/jquery.ui.widget.js"></script>
<script src="<?= URL_JS ?>/jquery.iframe-transport.js"></script>
<script src="<?= URL_JS ?>/jquery.fileupload.js"></script>
<!-- Our main JS file -->
<script src="<?= URL_JS ?>/upload_script.js"></script>
