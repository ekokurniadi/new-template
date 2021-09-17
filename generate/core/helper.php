<?php

function safe($str)
{
    return strip_tags(trim($str));
}

function readJSON($path)
{
    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}

function createFile($string, $path)
{
    $create = fopen($path, "w") or die("Unable to open file!");
    fwrite($create, $string);
    fclose($create);
    
    return $path;
}

function createModel($directory,$folder,$string, $path)
{
    $cek_folder = str_replace('_model.php','',$path);
    if(is_dir($cek_folder)===false){
        mkdir($cek_folder);
    }
   
    $create = fopen($cek_folder . '/' .$folder, "w") or die("Unable to open file!");
    fwrite($create, $string);
    fclose($create);
  
    return $path;
   
}
function createController($directory,$folder,$string, $path)
{
    $cek_folder = str_replace('.php','',$path);
    if(is_dir($cek_folder)===false){
        mkdir($cek_folder);
    }
   
    $create = fopen($cek_folder . '/' .$folder, "w") or die("Unable to open file!");
    fwrite($create, $string);
    fclose($create);
    return $path;
   
}
function createViewForm($directory,$folder,$string, $path)
{
    $cek_folder = str_replace('_form.php','',$path);
    if(is_dir($cek_folder)===false){
        mkdir($cek_folder);
    }
   
    $create = fopen($cek_folder . '/' .$folder, "w") or die("Unable to open file!");
    fwrite($create, $string);
    fclose($create);
    return $path;
   
}
function createViewList($directory,$folder,$string, $path)
{
    $cek_folder = str_replace('_list.php','',$path);
    if(is_dir($cek_folder)===false){
        mkdir($cek_folder);
    }
   
    $create = fopen($cek_folder . '/' .$folder, "w") or die("Unable to open file!");
    fwrite($create, $string);
    fclose($create);
    return $path;
   
}
function createViewRead($directory,$folder,$string, $path)
{
    $cek_folder = str_replace('_read.php','',$path);
    if(is_dir($cek_folder)===false){
        mkdir($cek_folder);
    }
   
    $create = fopen($cek_folder . '/' .$folder, "w") or die("Unable to open file!");
    fwrite($create, $string);
    fclose($create);
    return $path;
   
}

function label($str)
{
    $label = str_replace('_', ' ', $str);
    $label = ucwords($label);
    return $label;
}
