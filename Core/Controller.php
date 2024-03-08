<?php

class Controller 
{
    public $method;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];    
    }
    
    public function returnJSON(string|array $data = [], int $status = 200)
    {
        http_response_code(intval($status));
        $response = [
            'status' => $status,
            'content' => $data
        ];
        echo json_encode($response);
    }

    public function getData()
    {
        switch($this->method){
            case 'GET':
                return $_GET;
                break;
            case 'POST':
                if(isset($header['Content-Type']) and $header['Content-Type'] == 'application/json'){
                    $data = json_decode(file_get_contents('php://input'), true);
                }else{
                    $data = file_get_contents('php://input');
                }
                if(empty($data))
                    $data = $_POST;
 
                return (array) $data;
                break;
            case 'PUT':
            case 'DELETE':
                $header = getallheaders();
                if(isset($header['Content-Type']) and $header['Content-Type'] == 'application/json'){
                    $data = json_decode(file_get_contents('php://input'));
                }else{
                    parse_str(file_get_contents('php://input'), $data);
                }
                return (array) $data;
                break;
        }
    }
}