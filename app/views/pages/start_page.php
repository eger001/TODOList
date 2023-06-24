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
    <h1>MY SITE</h1>
    <?php if (!isset($_SESSION['authorized'])):?>
    <div>
        <form action="<?= url('user', 'store')?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']?>">
            <label for="email"><?= __('inputs.enter email')?></label>
            <input type="email" name="email" id="email"/>
            <label for="pass"><?= __('inputs.enter password')?></label>
            <input type="password" name="pass" id="pass"/>
            <button type="submit"><?= __('buttons.sign up')?></button>
        </form>
        <div>
            <?php if(!empty($errors)):?>
                <?php foreach ($errors as $error):?>
                    <div><?= $error?></div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
    <div>
        <form action="<?= url('authorization', 'login')?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']?>">
            <label for="email"><?= __('inputs.enter email')?></label>
            <input type="email" name="email" id="email"/>
            <label for="pass"><?= __('inputs.enter password')?></label>
            <input type="password" name="pass" id="pass"/>
            <button type="submit"><?= __('buttons.sign in')?></button>
        </form>
    </div>
    <?php else:?>
    <a href="<?= url('authorization', 'logout')?>"><?= __('buttons.log out')?></a>
    <?php endif;?>
</body>
</html>

