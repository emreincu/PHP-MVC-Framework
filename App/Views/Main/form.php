<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Emre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form method = "post" action = "<?= URL_ROOT ?>/Home/getForm" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email"><?= $language->name ?>:</label>
            <input type="text" name="name" class="form-control border">
        </div>
        <div class="form-group">
            <label for="email"><?= $language->surname ?>:</label>
            <input type="text" name="surname" class="form-control border">
        </div>
        <div class="form-group">
            <label for="email"><?= $language->age ?>:</label>
            <input type="text" name="yas" class="form-control border">
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="checkbox[]" class="form-check-input" value="bu gün hava çok güzel">Option 1
            </label>
            </div>
            <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="checkbox[]" class="form-check-input" value="2">Option 2
            </label>
            </div>
            <div class="form-check disabled">
            <label class="form-check-label">
                <input type="checkbox" name="checkbox[]" class="form-check-input" value="3">Option 3
            </label>
            <div class="form-check">
            <label class="form-check-label">
                <select name="city" class="form-check-input">
                    <option></option>
                    <option value = "İzmir">İzmir</option>
                    <option>Elazığ</option>
                    <option>Van</option>
                    <option>Ankara</option>
                </select>
            </label>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="file" name="photograph" multiple="multiple" class="form-control-file border">
        </div>
        <div class="form-group">
            <button class="btn">Send</button>
        </div>
    </form>
</body>
</html>