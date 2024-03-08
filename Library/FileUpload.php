<?php

class FileUpload
{

    public function __construct() //file_camp ==> $data['arquivo'];
    {
    }

    public function checkFile($tmp_name)
    {
        if(is_file($tmp_name) and file_exists($tmp_name)){
            return true;
        }else{
            return false;
        }
    }

    public function uploadFile($tmp_name, $file_name, $path_upload)
    {
        $path = $path_upload . '/' . $file_name;
        if(move_uploaded_file($tmp_name, $path))
            return true;
        else
            return false;
    }

    public function makeUpload($file_camp, $path_to_upload)
    {
        $file_name = $file_camp['name'];
        $tmp_name = $file_camp['tmp_name'];
        $total = count($tmp_name);
        for($i = 0; $total > $i; $i++){
            if($this->checkFile($tmp_name[$i])){
                if($this->uploadFile($tmp_name[$i], $file_name[$i], $path_to_upload)){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
}
