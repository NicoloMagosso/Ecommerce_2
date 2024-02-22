<?php

class DbManager
{

    public static function Connect($dbname)
    {
        $dsn = "mysql:dbname={$dbname};host=192.168.2.200";
        try {
            $pdo = new PDO($dsn, 'nicolo_magosso', 'enforcers.researchs.conches.');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $exception) {
            die("connection al DB Fallita: " . $exception->getMessage());
        }
    }

}

?>