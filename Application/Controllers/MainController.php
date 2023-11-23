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
        $limit = 4;
        if (isset($route['page']) && $route['page']!=0){
            $page = ($route['page']);
        }
        else{
            $page = 1;
        }
        $start = ($page - 1) * $limit;
        $list = $news->getList($start,$limit,$tableName);
        $vars = [
            'page' => $page,
            'totalPages' => ceil(($pagesNum/$limit)),
            'arResult' => $list,
            'head'=> "Главная"
        ];
        $this->view->render($view,$vars);
    }

}