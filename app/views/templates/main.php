<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header>
    <div class="site-name grid-item">
        <h1>TODOList</h1>
    </div>
    <div>

    </div>
    <div class="locale-bar grid-item">
        <form method="post", action="<?= url('locale', 'change')?>">
            <select onchange="this.form.submit()" name="locale">
                <option value="ua" <?= $_SESSION['locale'] == 'ua' ? 'selected' : ''?>>UA</option>
                <option value="en" <?= $_SESSION['locale'] == 'en' ? 'selected' : ''?>>EN</option>
                <option value="es" <?= $_SESSION['locale'] == 'es' ? 'selected' : ''?>>ES</option>
                <option value="bg" <?= $_SESSION['locale'] == 'bg' ? 'selected' : ''?>>BG</option>
                <option value="pl" <?= $_SESSION['locale'] == 'pl' ? 'selected' : ''?>>PL</option>
            </select>
        </form>
    </div>
        <?php if (isset($_SESSION['authorized'])):?>
    <div class="logout grid-item">
            <a href="<?= url('authorization', 'logout')?>"><?= __('buttons.log out')?></a>
    </div>
        <?php endif;?>
</header>
<main>
    <aside class="grid-item">
        <?php if (isset($_SESSION['authorized'])):?>
            <ul>
                <li><?= __('other.company')?>
                    <ul>
                        <li><a href="<?= url('employee', 'index')?>"><?= __('other.coworkers')?></a></li>
                        <li></li>
                        <li></li>
                    </ul>
                </li>
                <li></li>
                <li></li>
            </ul>
        <?php endif;?>
    </aside>
    <div class="main-wrapper grid-item">
        <?php include_once \app\core\View::getPagePath()?>
    </div>

</main>
<footer>

</footer>
</body>
</html>