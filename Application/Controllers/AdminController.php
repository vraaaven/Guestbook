<?php

namespace Application\Controllers;

use Application\Core\Controller;
use Application\Models\Main;
use Application\Lib\Db;

class AdminController extends Controller {

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function loginAction() {
        $view="Admin/login";
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('/admin/posts');
        }
        if (!empty($_POST)) {
            if (!$model = Db::model('Admin')->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('admin/posts');

        }
        $this->view->render($view);
    }

    public function editAction() {
        $model = Db::model('Admin');
        if (!$model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        if (!empty($_POST)) {
            if (!$model->postValidate($_POST, 'edit')) {
                $this->view->message('error', $this->model->error);
            }
            $model->postEdit($_POST, $this->route['id']);
            if ($_FILES['img']['tmp_name']) {
                $model->postUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
            }
        }
        $vars = [
            'data' => $model->postData($this->route['id'])[0],
        ];
        $view="Admin/edit";
        $this->view->render($view, $vars);
    }

    public function deleteAction() {
        $model = Db::model('Admin');
        if (!$model->isPostExists($this->route['id'])) {
            $this->view->errorCode(404);
        }
        $model->postDelete($this->route['id']);
        $this->view->redirect('/admin/posts');
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        $this->view->redirect('/admin/login');
    }

    public function postsAction() {
        $mainModel = new Main;
        $view="Admin/posts";
        $vars = [
            'list' => $mainModel->getList('Book'),
        ];
        $this->view->render($view, $vars);
    }
}