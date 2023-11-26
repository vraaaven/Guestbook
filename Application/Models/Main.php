<?php

namespace Application\Models;

use Application\Core\Model;

class  Main extends Model
{
    public function getList($tableName)
    {
        return $this->db->row('SELECT * FROM '.$tableName.' ORDER BY date DESC');
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
    public function itemAdd($post,$tableName) {
        $params = [
            'id' =>$post['id'],
            'name' => $post['name'],
            'message' => $post['text'],
            'date' => $post['date']
        ];
        $this->db->query('INSERT INTO '.$tableName.' VALUES (:id, :name, :message, :date)', $params);
    }
}
