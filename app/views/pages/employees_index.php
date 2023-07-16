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
<table>
    <thead>
        <tr>
            <th>#</th>
            <th><?= __('other.coworker')?></th>
            <th><?= __('other.email')?></th>
            <th><?= __('other.role')?></th>
            <th><?= __('other.telephone')?></th>
            <th><?= __('other.telegram')?></th>
            <th><?= __('other.head')?></th>
            <th><?= __('other.status')?></th>
            <th><?= __('other.employment date')?></th>
            <th><?= __('other.date of dismissal')?></th>
            <th><?= __('other.actions')?></th>
        </tr>
    </thead>
    <tbody>
    <?php if(isset($employees)):?>
        <?php foreach ($employees as $employee):?>
            <tr>
                <td><?= $employee['id']?></td>
                <td><?= $employee['employee']?></td>
                <td><?= $employee['email']?></td>
                <td><?= $employee['role']?></td>
                <td><?= $employee['phone']?></td>
                <td><?= $employee['telegram']?></td>
                <td><?= $employee['head']?></td>
                <?php if($employee['status'] === 'активный'):?>
                    <td><?= __('other.active')?></td>
                <?php elseif ($employee['status'] === 'не активный'):?>
                    <td><?= __('other.inactive')?></td>
                <?php endif;?>
                <td><?= $employee['employment date']?></td>
                <td><?= $employee['dismissal date']?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
    </tbody>
</table>
<a href="<?= url('user','index')?>"><?= __('buttons.back')?></a>
</body>
</html>