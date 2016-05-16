<?php 

//Toutes ces fonctions exécutent ce que leur nom désigne en général, et concerne des informations sur les utilisateurs, médecins et admins
class ModelUser extends Model {

    public static function Inscrire($tab){
        
    $req = self::$pdo->prepare('INSERT INTO medecin(photo,nom,prenom,login,mdp,tel,mail,admin,clecrypt) VALUES( :chemin, :nom, :prenom,:login, :mdp, :tel, :mail, 0,:clecrypt)');

    $req->execute($tab);
    
    }

    
   public static function selectUsers($ville2){
        
        $req=self::$pdo->prepare("SELECT login,photo,nom, prenom,tel,mail,retard FROM medecin m, travailler t, ville v WHERE m.id=t.id_user and t.id_ville=v.id AND nomV = :ville AND admin=0 ORDER BY nom ");

        $req->execute($ville2);
    
        return $req->fetchAll(PDO::FETCH_OBJ);
    
    }
    
    public static function selectMdp($login){
        
        $req=self::$pdo->prepare('SELECT id,nom,prenom, login, mdp

        FROM medecin WHERE login = :login');

        $req->bindValue(':login',$login, PDO::PARAM_STR);
        
        $req->execute();

        return $req->fetch();
        
        
    }
    
    public static function isAdmin($login){
        $data=array(
            'login' => $login
        );
        $req=self::$pdo->prepare('SELECT admin FROM medecin WHERE login=:login');
        
        
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if($data2['admin']==1)
            return true;
        else
            return false;
        
        //return $data;
        
        
            
    }
    
    public static function selectAllUsers(){
        $req=self::$pdo->query("SELECT photo,nom, prenom, login FROM medecin WHERE admin=0 ORDER BY nom");
  
        return $req->fetchAll(PDO::FETCH_OBJ);
        
    }
    
    
    
    public static function delete($login){
         $req=self::$pdo->prepare('DELETE FROM medecin WHERE login=:login');
         
         $req->bindvalue(':login',$login,PDO::PARAM_STR);
         
         $req->execute();
    }
    
    public static function selectUsersByName($data){
        
        $req=self::$pdo->prepare("SELECT DISTINCT photo,nom, prenom,login FROM medecin WHERE nom = ':nom' OR prenom = :nom OR login = :nom AND admin=0 ORDER BY nom");

        $req->execute($data);
    
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
    
    public static function selectUsersByNameAndCity($data){
        
        $req=self::$pdo->prepare("SELECT DISTINCT login,photo,nom, prenom,tel,mail,retard FROM medecin m, travailler t, ville v WHERE m.id=t.id_user and t.id_ville=v.id and nom = :nom OR prenom = :nom and nomV=:ville and admin=0 ORDER BY nom");

        $req->execute($data);
    
        return $req->fetchAll(PDO::FETCH_OBJ);
        
    }
         
    public static function alreadyExists($login){
         $data=array(
            ':login' => $login
        );
        
        $req=self::$pdo->prepare('SELECT m.login,v.login FROM medecin m, validation v WHERE m.login=:login OR v.login=:login');
         
         
         $req->execute($data);
         
         $data2=$req->fetch();
         
         if (empty($data2)){
             return false;
         }
         else{
             return true;
         }
       
    }    
        
    public static function modifMdp($mdp,$login){
        $req=self::$pdo->prepare("UPDATE medecin SET mdp=:mdp WHERE login = :login");
        
        $req->bindValue(':login',$login, PDO::PARAM_STR);
        
        $req->bindValue(':mdp',$mdp, PDO::PARAM_STR);
        
        $req->execute();
    }
    
    public static function modifTel($tel,$login){
        $req=self::$pdo->prepare("UPDATE medecin SET tel=:tel WHERE login = :login");
        
        $req->bindValue(':login',$login, PDO::PARAM_STR);
        $req->bindValue(':tel',$tel, PDO::PARAM_STR);
        
        $req->execute();
    }
    
    public static function modifMail($mail,$login){
        $req=self::$pdo->prepare("UPDATE medecin SET mail=:mail WHERE login = :login");
        
        $req->bindValue(':login',$login, PDO::PARAM_STR);
        $req->bindValue(':mail',$mail, PDO::PARAM_STR);
        
        $req->execute();
    }
    
    public static function modifImg($chemin,$login){
        $req=self::$pdo->prepare("UPDATE medecin SET photo=:chemin WHERE login = :login");
        
        $req->bindValue(':login',$login, PDO::PARAM_STR);
        $req->bindValue(':chemin',$chemin, PDO::PARAM_STR);
        
        $req->execute();
    }
    
    public static function InscrireValidation($tab){
        
    $req = self::$pdo->prepare('INSERT INTO validation(photo,nom,prenom,login,mdp,tel,mail,ville,specialite) VALUES( :chemin, :nom, :prenom,:login, :mdp, :tel, :mail, :ville,:specialite)');

    $req->execute($tab);
    
    }
    
    public static function selectAllUsersWaiting(){
        $req=self::$pdo->query("SELECT tel,photo,nom, prenom, login FROM validation ORDER BY nom");
  
        return $req->fetchAll(PDO::FETCH_OBJ);
        
    }
    
    public static function selectInfos($login){
        $req=self::$pdo->prepare("SELECT * FROM validation WHERE login=:login");
        
        $req->bindvalue(':login',$login,PDO::PARAM_STR);
        
        $req->execute();
        
        return $req->fetch();
    }
    
    public static function selectInfosSpeVille($login){
        $req=self::$pdo->prepare("SELECT nomS as specialite , nomV as ville FROM medecin m, effectuer e, travailler t, ville v, specialite s WHERE s.id=e.id_spe AND e.id_user=m.id AND m.id=t.id_user AND t.id_ville=v.id AND login=:login");
        
        $req->bindvalue(':login',$login,PDO::PARAM_STR);
        
        $req->execute();
        
        return $req->fetch();
    }
    
    
    public static function deleteValidation($login){
         $req=self::$pdo->prepare('DELETE FROM validation WHERE login=:login');
         
         $req->bindvalue(':login',$login,PDO::PARAM_STR);
         
         $req->execute();
    }
    
    public static function selectIdUser($login){
        
        $req=self::$pdo->prepare('SELECT id FROM medecin WHERE login = :login');

        $req->bindValue(':login',$login, PDO::PARAM_STR);
        
        $req->execute();

        return $req->fetch();
    }
    
    public static function selectCheminValidation($login){
        
        $req=self::$pdo->prepare('SELECT photo FROM validation WHERE login = :login');

        $req->bindValue(':login',$login, PDO::PARAM_STR);
        
        $req->execute();

        return $req->fetch();
    }
    
     public static function selectChemin($login){
        
        $req=self::$pdo->prepare('SELECT photo FROM medecin WHERE login = :login');

        $req->bindValue(':login',$login, PDO::PARAM_STR);
        
        $req->execute();

        return $req->fetch();
    }
    
    public static function updateClecrypt($login,$clecrypt){
        $req=self::$pdo->prepare("UPDATE medecin SET clecrypt=:clecrypt WHERE login = :login");
        
        $req->bindValue(':login',$login, PDO::PARAM_STR);
        $req->bindValue(':clecrypt',$clecrypt, PDO::PARAM_STR);
        
        $req->execute();
    }
    
    public static function Correspondre($login,$clecrypt){
        $data=array(
            'login' => $login,
            'clecrypt' => $clecrypt
        );
        $req=self::$pdo->prepare('SELECT * FROM medecin WHERE login=:login AND clecrypt=:clecrypt');
        
        
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if(!empty($data2))
            return true;
        else
            return false;
    }
}
    

   

