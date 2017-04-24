<?php require_once(VIES_PATH . 'layouts/header.php')?>

<div class="container">
    <div class="row">
        <?php  if (!empty($errors)):?>
            <div class="alert alert-danger">
                <strong>Ошибка!</strong>
                <?php foreach ($errors as $key):?>
                    <?= $key ?>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    </div>
</div>

<div class="container">
    <div class="row">
        <form id="crateTask" action="/task/update/<?= $data['id']?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="textDescription">Описание задачи</label>
                <textarea class="form-control" id="textDescription" rows="3" name="description" required ><?= $data['description'] ?></textarea>
            </div>

            <div class="checkbox">
                <label><input type="checkbox" name="fulfilled" <?= $data['fulfilled'] ? 'checked' : '' ?>>Выполнено</label>
            </div>

            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
        <img style="display: block; margin: 0 auto" src="/uploads/<?= $data['img'] ?>" alt="">
    </div>
</div>



<?php require_once(VIES_PATH . 'layouts/footer.php')?>
