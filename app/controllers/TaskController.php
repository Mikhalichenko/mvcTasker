<?php

namespace app\controllers;

use app\components\BaseController;
use app\components\Pagination;
use app\models\TaskModel;

class TaskController extends BaseController
{

    const UPLOADER_PATH =  WEB_PATH . 'uploads/';
    const DEFAULT_IMG_WIDTH = 320;
    const DEFAULT_IMG_HEIGHT = 240;

    /**
     * Home page
     */
    public function actionIndex($page = 1)
    {
        $filterParams = null;

        if($_SERVER['REQUEST_METHOD'] == 'POST' &&  !empty($_POST)) {
            $filterParams = $_POST;

            if (isset($filterParams['reset'])) {
                $tasksList  = TaskModel::getTasks($page);
                $countTasks = TaskModel::getCountTask();
                $filterParams = null;

            } else {
                $tasksList = TaskModel::getTasks($page, $filterParams);
                $countTasks = TaskModel::getCountTask($filterParams);
            }

        } else {
            $tasksList  = TaskModel::getTasks($page);
            $countTasks = TaskModel::getCountTask();
        }

        $pagination = new Pagination($countTasks[0], $page, TaskModel::SHOW_BY_DEFAULT, '');

        $this->render('site/index', [
            'tasks'       => $tasksList,
            'pagination'  => $pagination,
            'filterParams' => $filterParams
        ]);
    }

    /**
     * Create new Task
     */
    public function actionCreate()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' &&  !empty($_POST)) {
            $formData = $_POST;

            if (is_array(self::uploadImg($_FILES['img']))) {
                $this->render('task/create', [
                    'errors' => self::uploadImg($_FILES['img']),
                    'data' => $formData
                ]);
            }

            if (TaskModel::createTask($formData, $_FILES['img']['name'])) {
                header('Location: /');
            }
        }

        $this->render('task/create');
    }

    /**
     * Load img to server
     * @param $img
     * @return array|bool
     */
    public static function uploadImg($img)
    {
        $errors = [];
        $target_file = self::UPLOADER_PATH . basename($img["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (file_exists($target_file)) {
            $errors[] = 'Картинка была уже загружена';
        }

        if ($img["size"] > 500000) {
            $errors[] = 'Изображение слишком большое';
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $errors[] = 'Не верный формат изображения';
        }

        if (empty($errors)) {

            if (move_uploaded_file($img["tmp_name"], $target_file)) {
                return true;
            } else {
                $errors[] = "Не удалось загрузить картинку";
            }

        } else {
            return $errors;
        }
    }


    /**
     * Update row from Task
     * @param $id
     */
    public function actionUpdate($id)
    {
        $this->accessUser();

        if($_SERVER['REQUEST_METHOD'] == 'POST' &&  !empty($_POST)) {

            $formData = $_POST;

            if($formData['fulfilled'] == 'on') {
                $formData['fulfilled'] = 1;

            }else if(!isset($formData['fulfilled'])) {
                $formData['fulfilled'] = 0;
            }

            if (TaskModel::updateTask($id, $formData)) {
                header('Location: /');
            }
        }

        $this->render('task/update', [
            'data' => TaskModel::getTaskByid($id)
        ]);
    }

    /**
     * Delete row from Task
     * @param $id
     */
    public function actionDelete($id)
    {
        $this->accessUser();

        if (TaskModel::deleteTask($id)) {
            header('Location: /');
        }

    }

}