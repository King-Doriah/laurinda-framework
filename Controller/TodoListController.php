
<?php

include 'Core/Controller.php';
include 'Model/TodoListModel.php';

class TodoListController
{

    private $model;
    private $controller;

    public function __construct()
    {
        $this->model = new TodoListModel();
        $this->controller = new Controller();        
    }

    public function index()
    {
 
    }

    public function show($id)
    {
 
    }

    public function store()
    {
 
    }

    public function update($id)
    {
 
    }

    public function delete($id)
    {
 
    }
}

    