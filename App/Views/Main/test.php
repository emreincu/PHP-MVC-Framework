<html>
    <head>
        <title>Test</title>
        <?= $this->content('default_css') ?>
        <?= $this->content('default_js') ?>
    </head>
    <body>
        <ul>
            <?php foreach($users as $user): ?>
                <li><?= $user['email'] ?></li> 
            <?php endforeach ?>
        </ul>
        <a href = "<?= URL_ROOT ?>/language/set/tr">TURKISH</a>
        <a href = "<?= URL_ROOT ?>/language/set/en">ENGLISH</a>
        <pre>
            <?= $language->hello ?>
        </pre>  
    </body>
</html>