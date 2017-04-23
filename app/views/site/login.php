<?php require_once(VIES_PATH . 'layouts/header.php')?>

<div class="container">

    <?php  if (!empty($errors)):?>
    <div class="alert alert-danger">
        <strong>Ошибка!</strong>
        <?php foreach ($errors as $key):?>
            <?= $key ?>
        <?php endforeach;?>
    </div>
    <?php endif;?>

    <div class="row login">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
            <form role="form" action="login" method="post">
                <div class="form-group text-center">
                    <div class="logo">
                        <span class="glyphicon glyphicon-flash set-logo"></span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" id="userid" name="login" placeholder="Логин" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control input-lg" id="password"  name="password" placeholder="Пароль" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-lg btn-block btn-success">Войти</button>
                </div>
                <p class="help">Login: admin | Pass: 123</p>
            </form>
        </div>
    </div>
</div>

<?php require_once(VIES_PATH . 'layouts/footer.php')?>