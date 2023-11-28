<?php

namespace Application\Controllers;
use Application\Core\Controller;
use Application\Lib\Db;
use Application\Models\Main;

class MainController extends Controller
{
    public function listAction(){
        $tableName1 = "Book";
        $tableName2 = "Comments";
        $model = Db::model('Main');
        $view="Main/list";
        $postsList = $model->getList($tableName1);
        $comList = $model->getList($tableName2);
        $arResult = $model->linkArrays($postsList,$comList);
        $vars = [
            'arResult' => $arResult,
            'head'=> "Главная"
        ];
        $this->view->render($view,$vars);
    }
    public function addAction()
    {
       if($_POST['g-recaptcha-response'] != "") {
           if (!empty($_POST["message-author"] && $_POST["message-text"])) {
               $tableName = "Book";
               $model = Db::model('Main');
               $lastItem = $model->getLastestItem($tableName);
               if ($lastItem != null)
                   $id = $lastItem[0]["id"] + 1;
               else
                   $id = 1;
               if(isset($_POST["rating"])){
                   $rating = $_POST["rating"];
               } else {
                   $rating = 0;
               }
               $post = [
                   "id" => $id,
                   "name" => $_POST["message-author"],
                   "text" => $_POST["message-text"],
                   "date" => date('Y-m-d H:i:s'),
                   "rating" => $rating
               ];
               $model->itemAdd($post, $tableName);
               if ($_FILES['img']['tmp_name']) {
                   $model->uploadImage($_FILES['img']['tmp_name'], $id);
               }
               $result['status'] = 'success';
               $result['message'] = $post;
           } else {
               $result['status'] = 'error';
               $result['message'] = 'Имя и сообщение обязательны';
           }

       }
       else {
           $result['status'] = 'error-captcha';
           $result['message'] = 'Капча обязательна';
       }
        echo json_encode($result);
    }
    public function  ratingAction() {
        $rating = $_POST['rating'];
        $id = $_POST['id'];
        $model = Db::model('Main');
        $ratingId = $model ->getLastestItem('Rating');
        $model->saveRating($ratingId[0]['id']+1,$id,$rating);
        $tableName = "Book";
        $item = $model->getItem($id,$tableName);
        $ratingData = $model->getRatingData($id);
        $newRating = $model->caclRating($rating,$ratingData[0]['sum'],$ratingData[0]['count']);
        $model->updatePostRating($id,$newRating);
        $result['status'] = 'success';
        echo json_encode($result);
    }
    public function commentAction() {
        if (!empty($_POST["name-comment"] && $_POST["message-comment"])) {
            $tableName = "Comments";
            $model = Db::model('Main');
            $lastItem = $model->getLastestItem($tableName);
            if ($lastItem != null)
                $lastItem = $lastItem[0]["id"] + 1;
            else
                $lastItem = 0;
            $post = [
                "id" => $lastItem,
                "name" => $_POST["name-comment"],
                "message" => $_POST["message-comment"],
                "date" => date('Y-m-d H:i:s'),
                "idParent" => intval($_POST["id"])
            ];
            $model->commentAdd($post, $tableName);
            $result['status'] = 'success';
            $result['message'] = $post;
        } else {
            $result['status'] = 'error';
            $result['message'] = 'Имя и сообщение обязательны';
        }
        echo json_encode($result);

    }
    public function deleteAction() {
        $model = Db::model('Main');
        $model->deleteItem($_POST["id"]);
        $result['status'] = 'success';
        echo json_encode($result);
    }
    public function editAction() {
        $model = Db::model('Main');
        $model->editItem($_POST,$_POST["id"]);
        $result['status'] = 'success';
        $result['message'] = $_POST;
        echo json_encode($result);
    }

}