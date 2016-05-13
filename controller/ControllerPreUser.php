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
        try{
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
            
            'chemin' => $infos['photo'],
        );
        
        ModelUser::Inscrire($tab);
        
        if(ModelVille::isNotInVille($infos['ville'])){
            
            ModelVille::insertVille($infos['ville']);
           
        
        }
        if(ModelVille::isNotInSpe($infos['specialite'])){
            
            ModelVille::insertSpe($infos['specialite']);
           
        }
        $idv=  ModelVille::selectIdVille($infos['ville']);
        $ids=  ModelVille::selectIdSpe($infos['specialite']);
        $idu=  ModelUser::selectIdUser($infos['login']);
        $tab1=array(
            'iduser' => $idu['id'],
            'idville' => $idv['id'],
        );
        $tab2=array(
            'iduser' => $idu['id'],
            'idspe' => $ids['id']
        );
        
        ModelVille::insertIntoEffectuer($tab2);
        ModelVille::insertIntoTravailler($tab1);
        
        
        
        ModelUser::deleteValidation($login);
        $data=ModelUser::selectAllUsersWaiting();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        break;
    
    case 'delete' :
        $pagetitle="gérer les attentes";
        $view='accepter';
        $path=ModelUser::selectCheminValidation($login);
        if($path['photo']!='img/default.jpg'){
            unlink($path['photo']);
        }
        ModelUser::deleteValidation($login);
        
        $data=ModelUser::selectAllUsersWaiting();
        break;
        
    
}
require VIEW_PATH . "view.php";

