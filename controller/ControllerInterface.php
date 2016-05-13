<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelUser.php';
require MODEL_PATH.'ModelVille.php';
//require MODEL_PATH.'ModelPreUser.php';
switch ($action) {
    
    /*
    * @param aucun paramètre
    *
    * @return nous redirige vers la page de connexion
    */
    case "PagePrincipale" :
        
        $view = "PagePrincipale";
        $pagetitle = "Page Principale";
        $data=ModelVille::selectAllVilles();
       break;
   
    case "connexion" :
        $view = "Connexion";
        $pagetitle = "Page de Connexion";
        break;
    
    case "outilDocteur" :
        if (!empty($_COOKIE['login'])){
        $view = "Gerer";
        $pagetitle = "Gérer temps d'attente";
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
    
    case "inscription" :
        $view = "Inscription";
        $pagetitle = "Gérer temps d'attente";
        break;
    
    case"delete" :
        if (!empty($_COOKIE['login']) && ModelUser::isAdmin($_COOKIE['login'])){
        $view='Delete';
        $pagetitle='supprimer';
        $data=ModelUser::selectAllUsers();
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
            
        
        break;
        
    case "contact" :
        $view ='Contact';
        $pagetitle='Contact';
        break;
    
    case "modifier" :
        if (!empty($_COOKIE['login'])){
        $view='ModifProfil';
        $pagetitle='Modifications';
        break;
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        
    case "appercu":
        if (!empty($_COOKIE['login']) && ModelUser::isAdmin($_COOKIE['login'])){
            $view='Accepter';
            $pagetitle='gerez les inscriptions';
            $data=ModelUser::selectAllUsersWainting();
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
    
    case "completer":
        if (!empty($_COOKIE['login'])){
        $view='Completer';
        $pagetitle='Complétez votre profil';
        break;
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
    
    case "ensavoirplus":
        $view='EnSavoirPlus';
        $pagetitle='En Savoir Plus';
        break;
}

require VIEW_PATH . "view.php";


