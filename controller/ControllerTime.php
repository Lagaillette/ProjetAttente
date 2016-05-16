<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelTime.php';
require_once "model/ModelUser.php";

switch ($action) {
    //cas où le médecin appuie sur le bouton moins
    case "moins" :
        if(!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        ModelTime::moins($_COOKIE['login']);
        $view = "Gerer";
        $retard1=ModelTime::recupRetard($_COOKIE['login']);
        $retard = $retard1[0];
        $pagetitle="Gérez le retard";
        }
        else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
    
     //cas où le médecin appui sur le bouton plus
    case "plus" :
        if(!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        ModelTime::plus($_COOKIE['login']);
        $view = "Gerer";
        $retard1=ModelTime::recupRetard($_COOKIE['login']);
        $retard = $retard1[0];
        $pagetitle="Gérez le retard";
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
    
        //cas où l'on récupère la valeur du retard en base de données
    case "RecupRetard" :
        if(!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        $view="Gerer";
        $retard1=ModelTime::recupRetard($_COOKIE['login']);
        $retard = $retard1[0];
        $pagetitle="Gérez le retard";
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
        
        //cas où le médecin se rend actif
    case "actif":
        ModelTime::rendreActif($_COOKIE['login']);
        if(!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        $view="Gerer";
        $retard1=ModelTime::recupRetard($_COOKIE['login']);
        $retard = $retard1[0];
        $pagetitle="Gérez le retard";
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;    
        
    //cas où le médecin se rend inactif
    case "inactif":
        ModelTime::rendreinactif($_COOKIE['login']);
        ModelTime::restartRetard($_COOKIE['login']);
        if(!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        $view="Gerer";
        $retard1=ModelTime::recupRetard($_COOKIE['login']);
        $retard = $retard1[0];
        $pagetitle="Gérez le retard";
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
        
}
    
require VIEW_PATH . "view.php";


