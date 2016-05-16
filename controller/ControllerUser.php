<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelUser.php';
require_once MODEL_PATH . 'ModelVille.php';
require_once "model/ModelTime.php";

// ce controlleur gère les actions concernant les utilisateurs surtout
switch ($action) {
    //cas de l'inscription d'un utilisateur dans la table validation
    case 'Inscription' :
        
        $login= $_POST['login'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $tel= $_POST['tel'];
        $mail= $_POST['mail'];
        $mdp = 'jig'.sha1($_POST['mdp']);
        $ville= ucfirst($_POST['ville']);
        $specialite=$_POST['specialite'];
        $err=false;
        //on regarde si une image a été récupérée
        if(isset($_FILES['img']['tmp_name']))
        { 
             $dossier = 'img/';
             $fichier = ($_FILES['img']['name']);
             $chemin = $dossier . $fichier;
             //si l'action ne s'effectue pas correctement alors on passe par l'image par défaut
             if(move_uploaded_file($_FILES['img']['tmp_name'], $chemin)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
             {
                  
             }
             else //Sinon (la fonction renvoie FALSE).
             {
                  $chemin='img/default.jpg';
             }
        }else{
            $chemin='img/default.jpg';
            
        }
        

        
        
        if(ModelUser::alreadyExists($login)){     
            $err=true;
            $erreur="Login déjà existant";
        } 
        
        
        if($err!=true){
            
        $tab=array(

            'login' => $login,

            'mdp' => $mdp,

            'nom' => $nom,

            'prenom' => $prenom,

            'mail' => $mail,

            'tel' => $tel,

            'ville' => $ville,
            
            'chemin' => $chemin,
                
            'specialite' => $specialite,
                
            
        );
        
        
        ModelUser::InscrireValidation($tab);    
        $view="PagePrincipale";
        $pagetitle="Page principale";
        $data=ModelVille::selectAllVilles();
        }
        else{
            $view='error';
            $pagetitle='erreur';
        }
        
    break;


    
    
    
    
    // cas de la connexion
    case 'connexion' :

    $login = $_POST['login'];
    $mdp = 'jig'.sha1($_POST['mdp']);
    
    
    $tab=array(

        'login' => $login,

        'mdp' => $mdp
    );
    
    $data=ModelUser::selectMdp($login);
        
    if ($data['mdp'] == $mdp) // Acces OK !

    {   //on modifie la veleur de la clé cryptée pour plus de sécurité
        $clecrypt = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
        ModelUser::updateClecrypt($login, $clecrypt);
        //On initialise les deux cookies dont on a besoin
        
        setcookie('login',$login,time()+3600*24*7,null,null,false,true);
        setcookie('clecrypt',$clecrypt,time()+3600*24*7,null,null,false,true);
        header('Location: index.php');
    }

    else // Acces pas OK !

    {

        $view='Error';
        $erreur='Mot de Passe ou login incorrect';
    }

    

    

    break;
        
    
    
    
    
    case 'deconnexion':
        ModelTime::restartRetard($_COOKIE['login']);
        ModelTime::rendreInactif($_COOKIE['login']);
        //on change le cookie en cookie vide d'une durée très faible ce qui fait que la personne n'a plus de cookie après cette action
        setcookie('login','',time()+1,null,null,false,true);
         header('Location: index.php'); 
        break;
    
    
    
    
    //cas de la suppression d'un médecin
    case 'delete' :
        try{
        $pagetitle="supprimer Médecin";
        $view='delete';
        $path=ModelUser::selectChemin($login);
        //on supprime la photo à laquelle est associée le chemin stocké en base de données si celle-ci n'est pas l'image par défaut
        if($path['photo']!='img/default.jpg'){
            unlink($path['photo']);
        }
        
        
        ModelUser::delete($login);
        $data=ModelUser::selectAllUsers();
         } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        break;
    
    
    
    // cas où l'on affiche les personnes pour supprimer qui l'on veut
    case 'rechercheDelete' :
        $pagetitle="supprimer Médecin";
        $view='delete';
        $nom2=array(
            'nom' => $nom,
        );
        $data=ModelUser::selectUsersByName($nom2);
     break;   
 
 
     //cas où l'on modifie les informations qui ne sont pas vides
    case 'modification' :
        
        $login=$_COOKIE['login'];
        $tel= $_POST['tel'];
        $mail= $_POST['mail'];
 
        
        if($_POST['mdp']!=''){
            $mdp = 'jig'.sha1($_POST['mdp']);
            ModelUser::modifMdp($mdp,$login);
        }
        if($mail!=''){
            ModelUser::modifMail($mail,$login);        
        }
        if($tel!=''){
            ModelUser::modifTel($tel,$login);        
        }
        $data=ModelVille::selectAllVilles();
        if($_FILES['img']['name']!='')
        { 
             
             $dossier = 'img/';
             $fichier = ($_FILES['img']['name']);
             $chemin = $dossier . $fichier;
             if(move_uploaded_file($_FILES['img']['tmp_name'], $chemin)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
             {
                unlink(ModelUser::selectChemin($login)['photo']);  
             }
             ModelUser::modifImg($chemin,$login);
        }
        
        if (!empty($_COOKIE['login']) &&  ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        $pagetitle="Accueil";
        $view='PagePrincipale';
        }
        else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        
    break;
    
    //cas où le médecin ajoute une ville à son actif
    case 'ajoutVille'  :
        if(ModelVille::isNotInVille($ville)){    
            ModelVille::insertVille($ville);
        }
        
        $idv=  ModelVille::selectIdVille($ville);
        $idu=  ModelUser::selectIdUser($_COOKIE['login']);
        
        $tab=array(
            'iduser' => $idu['id'],
            'idville' => $idv['id'],
        );
        ModelVille::insertIntoTravailler($tab);
        
        if (!empty($_COOKIE['login']) &&  ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        $view='Completer';
        $pagetitle='Complétez votre profil';
        }
        else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        
        break;
    
    //cas où le médecin ajoute une spécialité à son actif
    case 'ajoutSpe' :
        if(ModelVille::isNotInSpe($specialite)){
            ModelVille::insertSpe($specialite);           
        }
        
        $ids=  ModelVille::selectIdSpe($specialite);
        $idu=  ModelUser::selectIdUser($_COOKIE['login']);
        
        $tab=array(
            'iduser' => $idu['id'],
            'idspe' => $ids['id']
        );
        
        ModelVille::insertIntoEffectuer($tab);
        
        if (!empty($_COOKIE['login'])){
        $view='Completer';
        $pagetitle='Complétez votre profil';
        }
        else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        break;
    
    //cas où le médecin supprime une spécialité
    case 'supSpe' :
        
        if (!ModelVille::isNotInSpe($specialite)){
            $ids=ModelVille::selectIdSpe($specialite);
            $idu=  ModelUser::selectIdUser($_COOKIE['login']);
            ModelVille::deleteInEffectuer($ids['id'],$idu['id']);
        }
            
        if (!empty($_COOKIE['login']) &&  ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        $view='Completer';
        $pagetitle='Complétez votre profil';
        }
        else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        
        break;
    
        //cas où le médecin supprime une ville
    case 'supVille' :
        if (!ModelVille::isNotInVille($ville)){
            $idv=ModelVille::selectIdVille($ville);
            $idu=  ModelUser::selectIdUser($_COOKIE['login']);
            ModelVille::deleteInTravailler($idv['id'],$idu['id']);
        }
            
        if (!empty($_COOKIE['login']) &&  ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt'])){
        $view='Completer';
        $pagetitle='Complétez votre profil';
        }
        else{
            $view='error';
            $pagetitle='erreur';
            $erreur='vous ne pouvez pas accéder à cette page';
        }
        
        
        break;
}       
require VIEW_PATH . "view.php";

