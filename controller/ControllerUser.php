<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelUser.php';
require_once MODEL_PATH . 'ModelVille.php';

switch ($action) {
    
    case 'Inscription' :
        
        $login= $_POST['login'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $tel= $_POST['tel'];
        $mail= $_POST['mail'];
        $mdp = 'jig'.sha1($_POST['mdp']);
        $ville=$_POST['ville'];
        $specialite=$_POST['specialite'];
        $err=false;
        if(isset($_FILES['img']['tmp_name']))
        { 
             $dossier = 'img/';
             $fichier = ($_FILES['img']['name']);
             $chemin = $dossier . $fichier;
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
                
            'specialite' => $specialite
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


    
    
    
    
    
    case 'connexion' :

    $login = $_POST['login'];
    $mdp = 'jig'.sha1($_POST['mdp']);
    $tab=array(

        'login' => $login,

        'mdp' => $mdp
    );
    
    $data=ModelUser::selectMdp($login);
        
    if ($data['mdp'] == $mdp) // Acces OK !

    {
        
        setcookie('login',$login,time()+3600*24*7,null,null,false,true);
        header('Location: index.php');
        /*$view='PagePrincipale';
        $pagetitle='Page Principale';
        $data=ModelVille::selectAllVilles();*/
    }

    else // Acces pas OK !

    {

        $view='Error';
        $erreur='Mot de Passe ou login incorrect';
    }

    

    

    break;
        
    
    
    
    
    case 'deconnexion':
        setcookie('login','',time()+1,null,null,false,true);
         header('Location: index.php'); 
        /*$pagetitle="Page Principale";
        $view='PagePrincipale';
        $data=ModelVille::selectAllVilles();*/
        break;
    
    
    
    
    
    case 'delete' :
        try{
        $pagetitle="supprimer Médecin";
        $view='delete';
        $path=ModelUser::selectChemin($login);
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
    
    
    
    
    case 'rechercheDelete' :
        $pagetitle="supprimer Médecin";
        $view='delete';
        $nom2=array(
            'nom' => $nom,
        );
        $data=ModelUser::selectUsersByName($nom2);
     break;   
 
 
 
    case 'modification' :
        
        $login=$_COOKIE['login'];
        $tel= $_POST['tel'];
        $mail= $_POST['mail'];
 
        $pagetitle="Accueil";
        $view='PagePrincipale';
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
                  
             }
             ModelUser::modifImg($chemin,$login);
        }
        
    
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
}       
require VIEW_PATH . "view.php";

