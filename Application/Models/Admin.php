<?php

namespace Application\Models;

use Application\Core\Model;
use Imagick;

class Admin extends Model {

    public $error;

    public function loginValidate($post) {
        $config = require 'Application/Config/admin.php';
        if ($config['login'] != $post['login'] or $config['password'] != $post['password']) {
            $this->error = 'Логин или пароль указан неверно';
            return false;
        }
        return true;
    }

    public function postValidate($post, $type) {
        return true;
    }

    public function postEdit($post, $id) {
        $params = [
            'id' => $id,
            'name' => $post['name'],
            'message' => $post['text'],
        ];
        $this->db->query('UPDATE Book SET id = :id, name = :name, message = :message WHERE id = '.$id, $params);
    }

    public function postUploadImage($path, $id) {
        $img = new Imagick($path);
        $img->cropThumbnailImage(1080, 600);
        $img->setImageCompressionQuality(80);
        $img->writeImage('public/materials/'.$id.'.jpg');
    }

    public function isPostExists($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->column('SELECT id FROM Book WHERE id = :id', $params);
    }

    public function postDelete($id) {
        $params = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM Book WHERE id = :id', $params);
        //unlink('public/materials/'.$id.'.jpg');
    }

    public function postData($id) {
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM Book WHERE id = :id', $params);
    }

}