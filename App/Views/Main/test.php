<html>
    <head>
        <title>Test</title>
        <?= $this->content('default_css') ?>
        <?= $this->content('default_js') ?>
    </head>
    <body>
        <a href = "<?= URL_ROOT ?>/language/set/tr">TURKISH</a>
        <a href = "<?= URL_ROOT ?>/language/set/en">ENGLISH</a>
        <pre>
            <?= $language->hello ?>
        </pre>
        <p><a href = "<?= URL_ROOT ?>/language/kill">KILL THE LANGUAGE</a></p>
    </body>
</html>