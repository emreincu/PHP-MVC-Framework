<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <ul>
            <?php foreach($users as $user): ?>
                <li><?= $user['email'] ?></li> 
            <?php endforeach ?>
        </ul>
    </body>
</html>