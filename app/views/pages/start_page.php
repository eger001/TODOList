<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/main-page.css">
</head>
<body>
    <?php if (!isset($_SESSION['authorized'])):?>
<!--    <div>-->
<!--        <form action="--><?php //= url('user', 'store')?><!--" method="post">-->
<!--            <input type="hidden" name="csrf_token" value="--><?php //= $_SESSION['csrf_token']?><!--">-->
<!--            <label for="email">--><?php //= __('inputs.enter email')?><!--</label>-->
<!--            <input type="email" name="email" id="email"/>-->
<!--            <label for="pass">--><?php //= __('inputs.enter password')?><!--</label>-->
<!--            <input type="password" name="pass" id="pass"/>-->
<!--            <button type="submit">--><?php //= __('buttons.sign up')?><!--</button>-->
<!--        </form>-->

    <div class="authorization">
        <form action="<?= url('authorization', 'login')?>" method="post" class="authorization-form">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']?>">
            <label for="email"><?= __('inputs.enter email')?></label>
            <input type="email" name="email" id="email" autofocus/>
            <label for="pass"><?= __('inputs.enter password')?></label>
            <input type="password" name="pass" id="pass"/>
            <button type="submit"><?= __('buttons.sign in')?></button>
            <?php if(!empty($errors)):?>
                <?php foreach ($errors as $error):?>
                    <span><?= $error?></span>
                <?php endforeach;?>
            <?php endif;?>
        </form>
    </div>
    <?php else:?>
        <?php if(isset($_SESSION['user_name'])):?>
        <span class="grid-item"><?= __('common.greetings')?>, <?= $_SESSION['user_name']?></span>
        <?php endif; ?>
    <?php endif;?>
</body>
</html>

