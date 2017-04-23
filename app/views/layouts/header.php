<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Приложение-задачник</title>
    <link rel="stylesheet" href="/libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="container">
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="<?= $_SERVER['REQUEST_URI'] == '/tasks' ? 'active' : '' ?>"><a href="/">Задачи <span class="sr-only">(current)</span></a></li>
                        <li class="<?= $_SERVER['REQUEST_URI'] == '/task/create' ? 'active' : '' ?>"><a href="/task/create">Добавить Задачу <span class="sr-only">(current)</span></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!isset($_SESSION['loggetUser'])){ ?>
                            <li class="<?= $_SERVER['REQUEST_URI'] == '/login' ? 'active' : '' ?>"><a href="/login">Авторизация</a></li>
                        <?php } else{ ?>
                            <li><a href="/logout">Выйти</a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>