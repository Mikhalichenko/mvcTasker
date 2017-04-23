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
        <form id="crateTask" action="/task/create" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputname">Имя</label>
                <input type="text" class="form-control" id="inputName" aria-describedby="emailHelp" placeholder="Введите имя" name="name" required value="<?= isset($data['name']) ? $data['name'] : '' ?>">
                <small id="emailHelp" class="form-text text-muted">Введите имя вашей задачи</small>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Ввидите email" name="email" required value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                <small id="emailHelp" class="form-text text-muted">Введите Email  для вашей задачи</small>
            </div>
            <div class="form-group">
                <label for="textDescription">Описание задачи</label>
                <textarea class="form-control" id="textDescription" rows="3" name="description" required ><?= isset($data['description']) ? $data['description'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Изображение</label>
                <input type="file" class="form-control-file" id="inputImg" name="img" required>
                <small id="fileHelp" class="form-text text-muted">Доступные форматы JPG/GIF/PNG, не более 320х240</small>
            </div>

            <a id="preview" class="btn btn-primary">Предварительный просмотр</a>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
</div>


<!-- Modal -->
<div id="preViewModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Предварительный просмотр</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="previewName">Имя</label>
                    <input type="text" class="form-control" id="previewName" aria-describedby="emailHelp" readonly>
                </div>
                <div class="form-group">
                    <label for="previewEmail">Email</label>
                    <input type="text" class="form-control" id="previewEmail" aria-describedby="emailHelp" readonly>
                </div>
                <div class="form-group">
                    <label for="previewDes">Описание задачи</label>
                    <textarea class="form-control" id="previewDes" rows="3" name="description" readonly></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Изображение</label>
                    <img id="previewImg" src="" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>

    </div>
</div>

<?php require_once(VIES_PATH . 'layouts/footer.php')?>
