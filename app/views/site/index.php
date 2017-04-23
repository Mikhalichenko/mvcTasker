<?php require_once(VIES_PATH . 'layouts/header.php')?>

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h4>Мененджер задач</h4>
                <div class="table-responsive">


                    <table id="mytable" class="table table-bordred table-striped">

                        <thead>

                        <th><input type="checkbox" id="checkall" /></th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Описание задачи</th>
                        <th>Cтатус</th>
                        <th>Изображение</th>
                        <?php if (isset($_SESSION['loggetUser'])){ ?>
                            <th>Изменить</th>
                            <th>Удалить</th>
                        <?php }?>

                        </thead>
                        <tbody>


                            <?php if (sizeof($tasks)): ?>
                                <?php foreach ($tasks as $key => $val): ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkthis" /></td>
                                        <td><?= $val['name']  ?></td>
                                        <td><?= $val['email'] ?></td>
                                        <td><?= $val['description'] ?></td>
                                        <td><?= $val['fulfilled'] ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>' ?></td>
                                        <td><img  class="tableImg" src="<?= '/uploads/'. $val['img'] ?>" alt="<?= $val['name']  ?>"></td>

                                        <?php if (isset($_SESSION['loggetUser'])){ ?>
                                            <td><p title="Edit"><a href="/task/update/<?= $val['id']  ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></p></td>
                                            <td><p title="Delete"><a class="btn btn-danger btn-xs delete-btn" href="/task/delete/<?= $val['id']  ?>"><span class="glyphicon glyphicon-trash"></span></a></p></td>
                                        <?php }?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else:?>
                                <h5>Тасков нету</h5>
                            <?php endif; ?>


                        </tbody>

                    </table>

                    <div class="clearfix"></div>

                    <div class="pull-right">
                        <?= $pagination->get(); ?>
                    </div>



                </div>

            </div>
        </div>
    </div>

<?php require_once(VIES_PATH . 'layouts/footer.php')?>
