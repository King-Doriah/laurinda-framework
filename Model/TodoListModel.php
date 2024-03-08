
<?php

include 'Core/Model.php';

class TodoListModel
{
    private $model;
    private $table;

    public function __construct()
    {
        $this->table = 'tarefas';
        $this->model = new Model();
    }

    public function searchId($camp, $id)
    {
        $row = $this->model->findId($this->table, $camp, $id);
        return $row;
    }

    public function selectAll()
    {
        $rows = $this->model->getAll($this->table);
        return $rows;
    }

    public function selectOne($camp, $id)
    {
        $rows = $this->model->getOne($this->table, $camp, $id);
        return $rows;
    }

    public function saveData($data)
    {
        try{
            $this->model->insertData($this->table, $data);
            return true;
        }catch(Exception){
            return false;
        }
    }

    public function updateData($data, $camp, $id)
    {
        try{
            if($this->model->upData($this->table, $data, $camp, $id)){ return true; }
            return false;
        }catch(Exception){
            return false;
        }
    }

    public function destroyData($camp, $id)
    {
        try{
            if($this->model->delData($this->table, $camp, $id)){return true;}
            return false;
        }catch(Exception){
            return false;
        }
    }
}    
    