<?php

define('MODEL_PATH', ROOT . DS . 'model' . DS);
define('VIEW_PATH', ROOT . DS . 'view' . DS);

function myGet($var)
{
    if (isSet($_GET[$var]))
    {
        return $_GET[$var];
    }
    else if (isSet($_POST[$var]))
    {
        return $_POST[$var];
    }
    else
    {
        return NULL;
    }
}

     session_start();



 



if (!is_null(myGet('controller')))
    $controller = myGet('controller'); //recupere le controlleur passe dans l'url
else
    $controller = "interface";



if (!is_null(myGet('action')))
    $action = myGet('action');    //recupere l'action  passee dans l'url
else
    $action = "PagePrincipale";

if (!is_null(myGet('login')))
    $login = myGet('login');

if (!is_null(myGet('ville')))
    $ville = myGet('ville');

if (!is_null(myGet('nom')))
    $nom = myGet('nom');



switch ($controller) {
    
    case "interface":
        require_once "ControllerInterface.php";
        break;
    
    case "Ville" :
        require_once "ControllerVille.php";
        break;
    
    case "user" :
        require_once "ControllerUser.php";
        break;
    
    case "time" :
        require_once 'ControllerTime.php';
        break;
    
    case 'preuser':
        require_once 'ControllerPreUser.php';
        break;
    default:
}
?>