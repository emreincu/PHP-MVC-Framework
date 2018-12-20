<html>
    <head>
        <title>Test</title>
        <?= $this->content('default_css') ?>
    </head>
    <body>
        <ul>
            <?php foreach($users as $user): ?>
                <li><?= $user['email'] ?></li> 
            <?php endforeach ?>
        </ul>
        <pre>
            <?= $language->hello ?>
        </pre>
        <a href = '#' onclick = 'notification("error", "message")'>ERROR TEST</a>
        <a href = '#' onclick = 'notification("success", "message")'>SUCCESS TEST</a>
        <a href = '#' onclick = 'notification("warning", "message")'>WARNING TEST</a>
        <a href = '#' onclick = 'notification("message", "message")'>MESSAGE TEST</a>
        <?= $this->content('default_js') ?>
        <?= $this->content('alertify_script') ?>
    </body>
</html>