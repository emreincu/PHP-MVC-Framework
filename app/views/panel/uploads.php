<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?= $title ?></h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts">
    <div class="container-fluid">

        <div class="row bg-white has-shadow">
            <div class = "text-right w-100 mb-3">
                <a class="btn btn-primary" href = "<?= URL_ROOT ?>/panel/new_upload"><?= $LANGUAGE['upload_new_files'] ?></a>
            </div>
            <ul class="nav nav-tabs menu" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL_ROOT ?>/panel/uploads/images/1"><?= $LANGUAGE['images'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL_ROOT ?>/panel/uploads/videos/1"><?= $LANGUAGE['videos'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL_ROOT ?>/panel/uploads/audios/1"><?= $LANGUAGE['audios'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL_ROOT ?>/panel/uploads/documents/1"><?= $LANGUAGE['documents'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL_ROOT ?>/panel/uploads/archives/1"><?= $LANGUAGE['archives'] ?></a>
                </li>
            </ul>
            <div class="uploads tab-content w-100">
                <div class="container tab-pane active pt-4">
                    <?php if($uploads): ?>
                    <ul class="list-group notifications p-0 m-0"></ul>
                    <div class="row p-0 grid ">
                        <?php foreach($uploads as $upload): ?>
                            <div class="col-md-6 col-lg-4 p-2 grid-item item-id-<?= $upload['upload_id'] ?>">
                                <div class="card border m-0">
                                    <div class="card-body p-0">
                                        <img class= "img-fluid" src = "<?= URL_UPLOADS ?>/images/<?= $upload['upload_path'] . '.' . $upload['upload_extension'] ?>">
                                    </div>
                                    <div class="card-footer p-1 border-top">
                                        <div class="float-left font-italic text-secondary p-1">
                                            <small>
                                                <?= $upload['upload_date'] ?>
                                            </small>
                                        </div>
                                        <div class="float-right">
                                            <a class='btn btn-sm text-danger delete' href = "#" data-id = "<?= $upload['upload_id'] ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>

                    </div>
                    <?php else: ?>
                    <div class = " p-5">
                        <h1 class="text-center text-secondary">
                            <i class="fas fa-tint"></i>
                        </h1>
                        <h1 class="text-center text-secondary w-100">
                            <?= $LANGUAGE['empty'] ?>
                        </h1>
                    </div>
                    <?php endif ?>

                    <?php for($i = 1 ; $i <= $lastPage; $i++): ?>
                        <?php ($i == $currentPage) ? $active = "active" : $active = ""; ?>
                        <a class= "<?= $active ?>" href = "<?= URL_ROOT ?>/panel/uploads/<?= $type ?>/<?= $i ?>">&nbsp;<?= $i ?>&nbsp;</a>
                    <?php endfor ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal HTML-->
<div id="deleteModal" class="modal hide fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
                    <i class="fas fa-trash-alt"></i>
				</div>
				<h4 class="modal-title"><?= $LANGUAGE['are_you_sure'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>
                    <?= $LANGUAGE["_sure_delete"] ?>
                </p>
			</div>
			<div class="modal-footer">
                <form method = "post" id = "delete-form">
    				<button type="button" class="btn btn-info text-white" data-dismiss="modal"><?= $LANGUAGE['cancel'] ?></button>
    				<button type="submit" class="btn btn-danger text-white delete-btn"><?= $LANGUAGE['delete'] ?></button>
                </form>
			</div>
		</div>
	</div>
</div>
<script src="<?= URL_JS ?>/masonry.min.js"></script>
<script>
    $( document ).ready(function() {
        $('a.delete').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#deleteModal').data('id', id).modal('show');
        });

        $('.delete-btn').click(function() {
            // handle deletion here
          	var id = $('#deleteModal').data('id');
            $(this).attr('formaction', '<?= URL_ROOT ?>/panel/uploads/'+id);
            $('#deleteModal').modal('hide');
        });


        $('#delete-form').submit(function( event ) {
            var notifications = "";
            var request;
            event.preventDefault();
            if (request) {
                request.abort();
            }
            var id = $('#deleteModal').data('id');
            var $form = $(this);
            var $inputs = $form.find("input, select, textarea, chechbox, button");
            $inputs.prop("disabled", true);

            // Fire off the request to /form.php
            request = $.ajax({
                cache: false,
                url: "<?= URL_ROOT ?>/panel/upload_delete/"+id,
                type: "get"
            });

            request.done(function (response, textStatus, jqXHR){
                var result = $.trim(response);
                try{
                    var obj = jQuery.parseJSON( result );
                    if(obj == "okey") {
                        notifications = "<?= $LANGUAGE['_delete_operation_successful'] ?>";
                        $('.item-id-'+ id +'').remove();
                        $grid.masonry('destroy');
                        $grid.masonry();
                    }else{
                        notifications = "<?= $LANGUAGE['sorry'] ?>, <?= $LANGUAGE['_deletion_failed'] ?>";
                    }
                    Toast('success', notifications);
                    $(".uploads").load(location.href + " .uploads");
                }catch(e){
                    location.reload();
                }
            });

            request.fail(function (jqXHR, textStatus, errorThrown){

            });

           request.always(function () {
               $inputs.prop("disabled", false);
            });
        });

        var $grid = $('.grid').masonry({
            itemSelector: '.grid-item',
            percentPosition: true
        });
        $grid.imagesLoaded().progress( function() {
          $grid.masonry();
        });
    });
</script>
