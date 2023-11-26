<?php

namespace Application\Controllers;
use Application\Core\Controller;
use Application\Lib\Db;
use Application\Lib\Pagination;
use Application\Models\Main;

class MainController extends Controller
{

    public function listAction(){
        $tableName = "Book";
        $route = $this->route;
        $news = Db::model('Main');
        $pagesNum = $news->getCount($tableName);
        $view="Main/list";
        $list = $news->getList($tableName);
        $vars = [
            'arResult' => $list,
            'head'=> "Главная"
        ];
        $this->view->render($view,$vars);
    }
    public function addAction()
    {
        if (!empty($_POST["message-author"] && $_POST["message-text"])) {
            $tableName = "Book";
            $model = Db::model('Main');
            $lastItem = $model->getLastestItem($tableName);
            $post = [
                "id" => $lastItem[0]["id"] + 1,
                "name" => $_POST["message-author"],
                "text" => $_POST["message-text"],
                "date" => date('Y-m-d H:i:s')
            ];
            $model->itemAdd($post, $tableName);
            $result['status'] = 'success';
            $result['message'] = $post;
        }
        else {
            $result['status'] = 'error';
            $result['message'] = 'Имя и сообщение обязательны';
        }
        echo json_encode($result);
    }

}