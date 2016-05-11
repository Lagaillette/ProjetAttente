<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelUser.php';
require_once MODEL_PATH . 'ModelVille.php';

switch ($action){
    
    case 'appercu':
        if (!empty($_COOKIE['login']) && ModelUser::isAdmin($_COOKIE['login'])){
            $view='Accepter';
            $pagetitle='gerez les inscriptions';
            $data=ModelUser::selectAllUsersWaiting();
        }else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
        
        
    case 'accept':
        $pagetitle="gérer les attentes";
        $view='accepter';
        $infos=ModelUser::selectInfos($login);
        $tab=array(
            'login' => $infos['login'],

            'mdp' => $infos['mdp'],

            'nom' => $infos['nom'],

            'prenom' => $infos['prenom'],

            'mail' => $infos['mail'],

            'tel' => $infos['tel'],

            'ville' => $infos['ville'],
            
            'chemin' => $infos['photo'],
        );
        
        ModelUser::Inscrire($tab);
        ModelUser::deleteValidation($login);
        
        if(ModelVille::isNotInVille($infos['ville'])){
            
            ModelVille::insertVille($infos['ville']);
        
        }
        $idv=  ModelVille::selectIdVille($infos['ville']);
        $idu=  ModelUser::selectIdUser($infos['login']);
        $tab=array(
            'iduser' => $idu['id'],
            'idville' => $idv['id']
        );
        ModelVille::insertIntoTravailler($tab);
        $data=ModelUser::selectAllUsersWaiting();
        break;
    
    case 'delete' :
        $pagetitle="gérer les attentes";
        $view='accepter';
        ModelUser::deleteValidation($login);
        $data=ModelUser::selectAllUsersWaiting();
        break;
}

require VIEW_PATH . "view.php";

