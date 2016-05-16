<?php
require_once MODEL_PATH . 'Model.php';

require_once MODEL_PATH . 'ModelUser.php';
require_once MODEL_PATH . 'ModelVille.php';


//Ce contrôleur concerne les actions pour ceux qui attendent d'être acceptés dans le site
switch ($action){
    //cas où l'on va afficher les personnes qui doivent ou non être acceptés
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
        
        // cas où l'administateur accepte une inscription
    case 'accept':
        try{
        $pagetitle="gérer les attentes";
        $view='accepter';
        $infos=ModelUser::selectInfos($login);
        $clecrypt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
        $tab=array(
            'login' => $infos['login'],

            'mdp' => $infos['mdp'],

            'nom' => $infos['nom'],

            'prenom' => $infos['prenom'],

            'mail' => $infos['mail'],

            'tel' => $infos['tel'],
            
            'chemin' => $infos['photo'],
            
            'clecrypt' => $clecrypt
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
    
        //cas où l'administrateur rejète une inscription
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

