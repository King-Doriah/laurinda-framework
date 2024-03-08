<?php

class Routes
{
    private $exists;
    private $pathUri;
    private $class_name;
    private $id;

    public function __construct()
    {
        $this->pathUri = $_SERVER['REQUEST_URI'];
    }

    public function checkIdExists($route)
    {
        $make = preg_match("{id}", $route, $matches);
        //var_dump($route, $matches[0]);
        if(!empty($matches[0])){
            $this->exists = $matches[0];
            return true;
        }
        return false;
    }

    public function checkRoute($route)
    {
        $new_route = '';
        if($this->checkIdExists($route)){
            $mts = preg_match('/(\d+)/', $this->pathUri, $matches);
            if($mts){
                $this->id = $matches[0];
                $new_route = str_replace('{id}', $matches[0], $route);
            }
        }else{
            $new_route = $route;
        }
        return $new_route;
        
    }

    public function addRoute($route, $action, $class_name)
    {
        try{
            $exec_route = $this->checkRoute($route);
            if($exec_route == $this->pathUri){
                $file_class = 'Controller/' . $class_name . '.php';
                include($file_class);
                if(class_exists($class_name)){
                    if(method_exists($class_name, $action)){                        
                        $obj_class = new $class_name();
                        if($this->id){
                            $obj_class->$action($this->id);
                        }else{
                            $obj_class->$action();
                        }
                    }else{
                        echo "Erro no Method";
                    }
                }else{
                    echo "Erro na Classe";
                }
            }
        }catch(Exception $error){
            echo $error->getMessage();
        }
    }
}