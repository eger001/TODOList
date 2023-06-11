<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="<?= url('user', 'store')?>" method="post">
            <input type="text" name="email"/>
            <input type="password" name="pass"/>
            <input type="submit"/>
        </form>
        <div>
            <?php if(!empty($errors)):?>
            <?php foreach ($errors as $error):?>
                    <div><?= $error?></div>
            <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</body>
</html>