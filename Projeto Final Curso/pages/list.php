<?php

if (!empty($_POST['type'])) {
    $type = $_POST['type'];
    
    $result = $__controller->getReports($type);

} else {
    header('Location: index.php');
    die;
}
?>

<form action="">
    <div>
        <h2 class="uppercase"><?= $result['title'] ?></h2>
    </div>

    <hr><br>

    <div>
        <?php foreach ($result['data'] as $key => $value) : ?>
        <?php if ($value['title'] != ''): ?>
            <hr>
                <div class="text-center separator-list"><?= $value['title'] ?></div>
            <hr>
        <?php endif ?>

            <table>
                <thead>
                <tr>
                    <?php foreach ($value['columns'] as $key2 => $value2) : ?>
                        <th><?= $result['columns'][$value2] ?></th>
                    <?php endforeach; ?>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($value['items'] as $key2 => $value2) : ?>
                    <tr>
                        <?php foreach ($value2 as $key3 => $value3) : ?>
                            <td><?= $value3 ?></td>
                        <?php endforeach; ?>
                        <td class="text-center cursor-pointer" onclick="editRegister(<?= $type ?>, <?= $value2['id'] ?>)">
                            <i class="fas fa-edit"></i>
                        </td>
                        <td class="text-center cursor-pointer" onclick="deleteRegister(<?= $type ?>, <?= $value2['id'] ?>)">
                            <i class="fas fa-trash-alt"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table><br>
        <?php endforeach; ?>
    </div>
</form>

<form action="index.php?page=edit" method="POST" id="editForm" style="display: none">
    <input type="hidden" name="type" id="edit_type" value="">
    <input type="hidden" name="id" id="edit_id" value="">
</form>




