<?php

use Random\RandomException;

class DatabaseConnection
{
    static $db;

    public function __construct()
    {
        try{
            $db = new PDO('mysql:host=localhost;dbname=full', 'root', '');
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
        return self::$db = $db;
    }

    public static function run($sql, $args = []): false|PDOStatement
    {
        if (empty($args)) {
            return self::$db->query($sql);
        }

        $is_assoc = (array() !== $args) && array_keys($args) !== range(0, count($args) - 1);
        $stmt = self::$db->prepare($sql);

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

    public static function record($sql, $args = [])
    {
        return self::run($sql, $args)->fetch();
    }

    public function select($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE `id` = :id";

        return self::record($sql, ["id" => $id]);
    }

    public function insert($table, $fillable): void
    {

        $placeHolders = array_map(fn($v) =>  $v = "?" ,$fillable);
        $sql = "INSERT INTO " . $table . "(". implode(",", $fillable) .", username) values (". implode(",", $placeHolders) .", ?)";

        $values = [];

        foreach ($_POST as $key => $value) {
            foreach ($fillable as $fillKey) {
                if ($fillKey === $key) {
                    $values[] = $value;
                }
            }
        }

        $values[] = "user" . bin2hex(random_bytes(3));

        self::run($sql, $values);
    }

    public function update($table, $id, $data): void
    {
        $keys = [];
        foreach ($data as $key) {
            $keys[] = $key;
        }
        $placeHolders = array_map(fn($v) =>  $v = $v . " = :" . $v ,$keys);

        $sql = "UPDATE " . $table . " SET " . implode(",", $placeHolders) . " WHERE `id` = :id";

        $values = [];

        $values["id"] =$id;

        foreach ($data as $postKey) {
            $values[$postKey] = $_POST["$postKey"];
        }

        self::run($sql, $values);
    }

    public static function checkRecordExistence($table, $column, $value)
    {
        $sql = "SELECT * FROM " . $table . " WHERE `" . $column . "` = :" . $column . " LIMIT 1";
        $param = [$column => $value];
        $stmt = self::$db->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetch();
    }

    public static function closeConnection(): void
    {
        self::$db = null;
    }
}