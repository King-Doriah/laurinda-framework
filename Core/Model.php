<?php

include 'enviroment.php';

class Model
{

    private $connection;

    public function __construct()
    {
        $dbserver = DBSERVER;
        $dbuser = DBUSER;
        $dbpass = DBPASS;
        $dbname = DBNAME;

        try{
            $dsn = "mysql:host={$dbserver};dbname={$dbname};charset=UTF8";
            $this->connection = new PDO($dsn, $dbuser, $dbpass);
        }catch(Exception $error){
            echo $error->getMessage();
        }
    }

    public function findId($table, $camp, $id)
    {
        try{
            $sql = "SELECT * FROM {$table} WHERE {$camp} = {$id}";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $obj = $stmt->fetchObject();
            if(!$obj){return false;}
            return true;
        }catch(Exception $error){
            return false;
        }
    }

    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($table, $camp, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE {$camp} = '{$id}'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function insertData($table, $data)
    {
        try{
            $sql = "INSERT INTO {$table}(";
            $counter = 1;
            foreach(array_keys($data) as $index){
                if(count($data) > $counter)
                    $sql .= "{$index},";
                else
                    $sql .= "{$index}";
                $counter++;
            }
            $sql .= ") VALUES (";
            $counter = 1;
            foreach(array_keys($data) as $index){
                if(count($data) > $counter){
                    $sql .= "'{$data[$index]}',";
                }else{
                    $sql .= "'{$data[$index]}'";
                }
                $counter++;
            }
            $sql .= ")";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchObject();
        }catch(Exception $error){
            return false;
        }
    }
    
    public function upData($table, $data, $camp, $id)
    {
        $obj = $this->findId($table, $camp, $id);
        if($obj == true){
            try{
                $sql = "UPDATE {$table} set ";
                $counter = 1;
                foreach(array_keys($data) as $index){
                    if(count($data) > $counter)
                        $sql .= "{$index}='{$data[$index]}', ";
                    else
                    $sql .= "{$index}='{$data[$index]}'";
                    $counter++;
                }
                $sql .= " WHERE {$camp} = {$id}";
                //echo $sql;
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                //return $stmt->fetchObject();
                return true;
            }catch(Exception $error){
                return false;
            }
        }
        return false;
    }

    public function delData($table, $camp, $id)
    {
        $obj = $this->findId($table, $camp, $id);
        if($obj == true){
            try{
                $sql = "DELETE FROM {$table} WHERE {$camp} = '{$id}'";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
                return true;
            }catch(Exception){
                return false;
            }
        }
        return false;
    }
}