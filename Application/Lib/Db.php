<?php

namespace Application\Lib;

use PDO;

class Db {

    protected $db;

    public function __construct() {
        $config = require 'Application/Config/db.php';
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].';charset='.$config['charset'].'', $config['user'], $config['password']);
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public static function model($name)
    {
        $path = 'Application\Models\\'.ucfirst($name);
        if (class_exists($path))
        {
            return new $path();
        }
        else {
            throw new Exception('Модель не найдена');
        }
    }

}