<?php

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

    public function select($table, $field = [])
    {
        if(!empty($field)) {
            $sql = "SELECT * FROM $table WHERE `". array_key_first($field) ."` = :" . array_key_first($field);
            //dd(self::record($sql, [array_key_first($field) => $field[array_key_first($field)]]));
            return self::record($sql, [array_key_first($field) => $field[array_key_first($field)]]);
        } else {
            $sql = "SELECT * FROM $table";

            return self::record($sql);
        }
    }

    public function selectAll($table, $field = []): false|array
    {
        if(!empty($field)) {
            $sql = "SELECT * FROM $table WHERE `". array_key_first($field) ."` = :" . array_key_first($field);

            return self::run($sql, [array_key_first($field) => $field[array_key_first($field)]])->fetchAll();
        } else {
            $sql = "SELECT * FROM $table";

            return self::run($sql)->fetchAll();
        }
    }

    public static function insert($table, $fillable): void
    {

        $placeHolders = array_map(fn($v) =>  $v = "?" ,$fillable);
        $sql = "INSERT INTO " . $table . "(". implode(",", $fillable) .") values (". implode(",", $placeHolders) .")";

        $values = [];

        foreach ($fillable as $fillKey) {
            foreach ($_POST as $key => $value) {
                if ($fillKey === $key) {
                    $values[] = $value;
                }
            }
        }

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

    public static function destroy($table, $id): void
    {
        $sql = "DELETE FROM " . $table . " WHERE `id` = :id";
        $param = ["id" => $id];
        self::run($sql, $param);
    }

    public static function closeConnection(): void
    {
        self::$db = null;
    }

    public function selectAllNewerBy(string $table, $count, $by, $date = ""): false|array
    {
        $sql = "SELECT * FROM $table WHERE `created_at` > :created_at";

        return self::run($sql, ["created_at" => date('Y-m-d', strtotime("$date - $count $by"))])->fetchAll();
    }

    public function selectAllExcept($table, $field = []): false|array
    {
        if(!empty($field)) {
            $keys = array_keys($field);
            $sql = "SELECT * FROM $table WHERE `". $keys[0] ."` != :" . $keys[0] . " AND " . $keys[1] . " = :" . $keys[1];

            return self::run($sql, [
                $keys[0] => $field[$keys[0]],
                $keys[1] => $field[$keys[1]],
            ])->fetchAll();
        } else {
            $sql = "SELECT * FROM $table";

            return self::run($sql)->fetchAll();
        }
    }
}