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
        <form method="post", action="<?= url('locale', 'change')?>">
            <select onchange="this.form.submit()" name="locale">
                <option value="ua" <?= $_SESSION['locale'] == 'ua' ? 'selected' : ''?>>UA</option>
                <option value="en" <?= $_SESSION['locale'] == 'en' ? 'selected' : ''?>>EN</option>
                <option value="es" <?= $_SESSION['locale'] == 'es' ? 'selected' : ''?>>ES</option>
                <option value="bg" <?= $_SESSION['locale'] == 'bg' ? 'selected' : ''?>>BG</option>
                <option value="pl" <?= $_SESSION['locale'] == 'pl' ? 'selected' : ''?>>PL</option>
            </select>
        </form>
        <?php include_once \app\core\View::getPagePath()?>
        <?php if(isset($_SESSION['user_name'])):?>
        <div>
            <span><?= __('common.greetings')?>, <?= $_SESSION['user_name']?></span>
        <?php endif; ?>
        </div>
    </div>
    </body>
</html>