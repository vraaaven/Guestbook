<?php

namespace Application\Models;

use Application\Core\Model;
use Imagick;

class  Main extends Model
{
    public function getList($tableName)
    {
        return $this->db->row('SELECT * FROM '.$tableName.' ORDER BY date DESC');
    }
    public function linkArrays($array1,$array2){
        $arResult =[];
        foreach ($array1 as $item) {
            $arResult[$item["id"]]["name"] = $item["name"];
            $arResult[$item["id"]]["id"] = $item["id"];
            $arResult[$item["id"]]["message"] = $item["message"];
            $arResult[$item["id"]]["date"] = $item["date"];
            $arResult[$item["id"]]["rating"] = $item["rating"];
            foreach ($array2 as $com) {
                if ($item["id"] == $com["idParent"]){
                    $arResult[$item["id"]]["comments"][] = $com;
                }
            }
        }
        return $arResult;
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
        $result = $this->db->row('SELECT * FROM '.$tableName.' ORDER BY id DESC LIMIT 1;');
        return $result;
    }
    public function itemAdd($post,$tableName) {
        $params = [
            'id' =>$post['id'],
            'name' => $post['name'],
            'message' => $post['text'],
            'date' => $post['date'],
            'rating' => $post['rating']
        ];
        $this->db->query('INSERT INTO '.$tableName.' VALUES (:id, :name, :message, :date, :rating)', $params);
    }
    public function uploadImage($path, $id) {
        $img = new Imagick($path);
        $img->cropThumbnailImage(1080, 600);
        $img->setImageCompressionQuality(80);
        $img->writeImage($_SERVER['DOCUMENT_ROOT'].'/Public/Images/'.$id.'.jpg');
    }
    public function commentAdd($post,$tableName) {
        $params = [
            'id' =>$post['id'],
            'name' => $post['name'],
            'message' => $post['message'],
            'date' => $post['date'],
            'idParent' => $post['idParent']
        ];
        $this->db->query('INSERT INTO '.$tableName.' VALUES (:id, :name, :message,:idParent, :date)', $params);
    }
    public function  deleteItem($id){
        $params = [
            'id' => $id,
        ];
        unlink($_SERVER['DOCUMENT_ROOT'].'/Public/Images/'.$id.'.jpg');
        $this->db->query('DELETE FROM Comments WHERE idParent = :id', $params);
        $this->db->query('DELETE FROM Book WHERE id = :id', $params);
    }
    public function editItem($post, $id) {
        $params = [
            'id' => $id,
            'name' => $post['name'],
            'message' => $post['message'],
        ];
        $this->db->query('UPDATE Book SET name = :name, message = :message WHERE id = :id', $params);
    }
    public function updatePostRating($id,$rating) {
        $params = [
            'id' => $id,
            'rating' => $rating,
        ];
        $this->db->query('UPDATE Book SET rating = :rating WHERE id = :id', $params);
    }
    public function caclRating($rating,$sum,$count) {
        $newRating = ($rating+$sum)/($count+1);
        return $newRating;
    }
    public function saveRating($id,$idRev,$rating) {
        $params = [
            'id' => $id,
            'idRev' => $idRev,
            'value' => $rating
        ];
        $this->db->query('INSERT INTO Rating VALUES (:id, :idRev, :value)', $params);
    }
    public function getRatingData($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT SUM(value ) sum, COUNT(id) count FROM Rating WHERE idRev = :id', $params);

    }

}
