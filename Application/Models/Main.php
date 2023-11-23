<?php

namespace Application\Models;

use Application\Core\Model;
use Application\Lib\Pagination;
class  Main extends Model
{
    public function getList($start,$limit,$tableName)
    {
        $params = [
            'start' => $start,
            'limit' => $limit,
        ];
        return $this->db->row('SELECT * FROM '.$tableName.' ORDER BY date DESC LIMIT :start, :limit',$params);
    }
    public function getCount($tableName)
    {
        return $this->db->column('SELECT COUNT(id) FROM '.$tableName);
    }
    public function getItem($id,$tableName)
    {

        return $this->db->row('SELECT * FROM '.$tableName.' WHERE id ='.$id);
    }
    public function getLastestItem($tableName)
    {
        $result = $this->db->row('SELECT * FROM '.$tableName.' ORDER BY date DESC LIMIT 1;');
        return $result;
    }
}
