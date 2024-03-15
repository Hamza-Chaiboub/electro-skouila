<?php

class DatabaseConnection
{
    public PDO $db;

    public function __construct()
    {
        try{
            $db = new PDO('mysql:host=localhost;dbname=full', 'root', '');
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
        return $this->db = $db;
    }

    public function run($sql, $args = [])
    {
        if (empty($args)) {
            return $this->db->query($sql);
        }

        $is_assoc = (array() !== $args) && array_keys($args) !== range(0, count($args) - 1);
        $stmt = $this->db->prepare($sql);

        if ($is_assoc) {
            foreach ($args as $key => $value) {
                if (is_int($value)) {
                    $stmt->bindValue(":$key", $value, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue(":$key", $value);
                }
            }
            $stmt->execute();
        } else {
            $stmt->execute($args);
        }

        return $stmt;
    }

    public function record($sql, $args = [])
    {
        return $this->run($sql, $args)->fetch();
    }
}