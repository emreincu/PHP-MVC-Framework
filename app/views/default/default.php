<?php
if(!defined('DIRECT_ACCESS')) {
    die("Erişim izniniz bulunmamaktadır!");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $this->getTitle() ?></title>
        <meta name="description" content="<?= $this->getDescription() ?>">
        <meta name="keywords" content="<?= $this->getKeywords() ?>">
        <meta name="author" content="<?= $this->getAuthor() ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="<?= URL_CSS_BOOTSTRAP ?>/bootstrap.min.css">
        <link rel="stylesheet" href="<?= URL_CSS_CUSTOM ?>/home/main.css">
        <?= $this->CONTENT("head") ?>
    </head>
    <body>
        <ul>
            <li>dsadsa 1</li>
            <li>dsadsa 2</li>
            <li>dsadsa 3</li>
            <li>dsadsa 4</li>
        </ul>
        <?= $this->CONTENT("menu") ?>
        <?= $this->CONTENT("menu2") ?>
        <?= $this->CONTENT("body") ?>
        <script src="<?= URL_JS_JQUERY ?>/jquery-2.2.4.min.js"></script>
        <script src="<?= URL_JS_BOOTSTRAP ?>/bootstrap.min.js"></script>
    </body>
</html>
