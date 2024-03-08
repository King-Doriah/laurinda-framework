import os
import argparse

def makeModel(name, table):
    model = '''
<?php

include 'Core/Model.php';

class '''+name+'''Model
{
    private $model;
    private $table;

    public function __construct()
    {
        $this->table = \''''+table+'''\';
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
    '''
    with open('Demo/{}Model.php'.format(name), 'w') as fileController:
        fileController.write(model)
        print('[+] Model Created Successfully.')
    fileController.close()

def makeController(name):
    controller = '''
<?php

include 'Core/Controller.php';
include 'Model/'''+name+'''Model.php';

class '''+name+'''Controller
{

    private $model;
    private $controller;

    public function __construct()
    {
        $this->model = new '''+name+'''Model();
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

    '''
    with open('Demo/{}Controller.php'.format(name), 'w') as fileController:
        fileController.write(controller)
        print('[+] Controller Created Successfully.')
    fileController.close()

def main(name, table):
    makeModel(name, table)
    makeController(name)

if __name__ == '__main__':
    args = argparse.ArgumentParser()
    args.add_argument('-a', '--address', help='Server address to running application')
    args.add_argument('-p', '--port', help='Port to running application')
    args.add_argument('-n', '--name', help='Name to Controller and Model')
    args.add_argument('-t', '--table', help='Table to Model')
    args.add_argument('-r', '--run', help='Create Model and Controller.', action='store')
    args.add_argument('-s', '--server', help='Running server.', action='store')

    arg = args.parse_args();

    if(arg.server):
        os.system(f'php -S {arg.address}:{arg.port}')
    if(arg.run):
        main(arg.name, arg.table)
