<?php
    namespace project;
    
    use project\core\Router;
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    // set_error_handler(function($errno, $errstr, $errfile, $errline) {
    //     if($errno === E_WARNING) {
    //         throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    //     }
    //     else {
    //         echo "$errno: $errstr in $errfile on line $errline";
    //     }
    // });
    
    require_once __DIR__ . '/../vendor/autoload.php';
    
    header('Cache-Control: no-cache,no-store,must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    $obj = new Router();
    $obj->action();
    
    // include __DIR__ . '/app/view/pages/main.php';