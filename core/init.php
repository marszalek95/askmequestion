<?php

require_once '/var/www/html/askmequestion/db/database.php';
require_once '/var/www/html/askmequestion/classes/session.php';

function classAutoLoader($class)
{
    $class = strtolower($class);
    $the_path = "/var/www/html/askmequestion/classes/{$class}.php";
    
    if(file_exists($the_path))
    {
        require_once($the_path);
    } 
    else
    {
    die("This file named $the_path was not found!");    
    }
}

spl_autoload_register('classAutoLoader');

function redirect($location)
{
    header("Location: {$location}");
}

function active_url($url)
{
    $url_page = pathinfo($_SERVER['REQUEST_URI']);
    return $url_page['filename'] === $url ? 'active' : false;
    
}
