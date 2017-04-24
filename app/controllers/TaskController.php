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
                self::resize(self::DEFAULT_IMG_WIDTH, self::UPLOADER_PATH . $img['name'],  self::UPLOADER_PATH . $img['name']);
                return true;
            } else {
                $errors[] = "Не удалось загрузить картинку";
            }

        } else {
            return $errors;
        }
    }

    /**
     * @param $newWidth
     * @param $targetFile
     * @param $originalFile
     * Resize img if width > DEFAULT_IMG_WIDTH
     */
    public static function resize($newWidth, $targetFile, $originalFile) {

        $info = getimagesize($originalFile);

        if ($info[0] > self::DEFAULT_IMG_WIDTH) {
            $mime = $info['mime'];

            switch ($mime) {
                case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

                case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

                case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

                default:
                    throw new Exception('Unknown image type.');
            }

            $img = $image_create_func($originalFile);
            list($width, $height) = getimagesize($originalFile);

            $newHeight = ($height / $width) * $newWidth;
            $tmp = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            if (file_exists($targetFile)) {
                unlink($targetFile);
            }
            $image_save_func($tmp, "$targetFile.$new_image_ext");
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