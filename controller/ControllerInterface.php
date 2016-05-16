<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelUser.php';
require MODEL_PATH.'ModelVille.php';
//ControllerInterface contient les actions concernant le déplacement sur le site.
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
        //On vérifie si un cookie a été mis en place et si les deux cookies mis en place correspondent
        if (!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
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
        $pagetitle = "Inscritpion";
        break;
    
    case"delete" :
        //On vérifie si un cookie a été mis en place et si les deux cookies mis en place correspondent et si le cookie login correspond au login de l'admin
        if (!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt']) && ModelUser::isAdmin($_COOKIE['login'])){
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
        //On vérifie si un cookie a été mis en place et si les deux cookies mis en place correspondent
        if (!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        $view='ModifProfil';
        $pagetitle='Modifications';
        break;
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        
    case "appercu":
        if (!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt']) && ModelUser::isAdmin($_COOKIE['login'])){
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
        //On vérifie si un cookie a été mis en place et si les deux cookies mis en place correspondent
        if (!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
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


