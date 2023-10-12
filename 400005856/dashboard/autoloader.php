<?php

spl_autoload_register(function($class_name)
{
    if(file_exists('../app/classes/'.$class_name.'.php'))
    {
        require '../app/classes/'.$class_name.'.php';
    } 
    elseif(file_exists('../app/classes/'.$class_name.'Interface.php'))
    {
        require '../app/classes/'.$class_name.'Interface.php';
    }
    elseif(file_exists('../app/controllers/'.$class_name.'.php'))
    {
        require '../app/controllers/' . $class_name . '.php';
    } 
    elseif(file_exists('../app/models/'.$class_name.'.php'))
    {
        require '../app/models/'. $class_name .'.php';
    } else {
        trigger_error('Cannot find class/interface/abstract class: '. $class_name, E_USER_WARNING);
        debug_print_backtrace();
    }
});