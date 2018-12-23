<html>
    <head>
        <title>Test</title>
        <?= $this->content('default_css') ?>
        <?= $this->content('default_js') ?>
        <?= $this->content('alertify_script') ?>
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
        <a href = '#' onclick = 'notification("error", "message")'>ERROR TEST</a>
        <a href = '#' onclick = 'notification("success", "message")'>SUCCESS TEST</a>
        <a href = '#' onclick = 'notification("warning", "message")'>WARNING TEST</a>
        <a href = '#' onclick = 'notification("message", "message")'>MESSAGE TEST</a>   
    </body>
</html>