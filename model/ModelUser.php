<?php 
    
class ModelUser extends Model {

    public static function Inscrire($tab){
        
    $req = self::$pdo->prepare('INSERT INTO medecin(photo,nom,prenom,login,mdp,tel,mail,ville,admin) VALUES( :chemin, :nom, :prenom,:login, :mdp, :tel, :mail, :ville , 0)');

    $req->execute($tab);
    
    }

    
   public static function selectUsers($ville2){
        
        $req=self::$pdo->prepare("SELECT photo,nom, prenom,tel,mail,retard FROM medecin WHERE ville = :ville AND admin=0 ORDER BY nom ");

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
        
        $req=self::$pdo->prepare("SELECT photo,nom, prenom,login FROM medecin WHERE nom LIKE ':nom%' OR prenom = :nom OR login = :nom AND admin=0 ORDER BY nom");

        $req->execute($data);
    
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
    
    public static function selectUsersByNameAndCity($data){
        
        $req=self::$pdo->prepare("SELECT photo,nom, prenom,tel,mail,retard FROM medecin WHERE nom = :nom OR prenom = :nom and ville=:ville and admin=0 ORDER BY nom");

        $req->execute($data);
    
        return $req->fetchAll(PDO::FETCH_OBJ);
        
    }
         
    public static function alreadyExists($login){
         $data=array(
            ':login' => $login
        );
        
        $req=self::$pdo->prepare('SELECT login FROM medecin WHERE login=:login');
         
         
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
        
    $req = self::$pdo->prepare('INSERT INTO validation(photo,nom,prenom,login,mdp,tel,mail,ville) VALUES( :chemin, :nom, :prenom,:login, :mdp, :tel, :mail, :ville)');

    $req->execute($tab);
    
    }
    
    public static function selectAllUsersWaiting(){
        $req=self::$pdo->query("SELECT photo,nom, prenom, login FROM validation ORDER BY nom");
  
        return $req->fetchAll(PDO::FETCH_OBJ);
        
    }
    
    public static function selectInfos($login){
        $req=self::$pdo->prepare("SELECT * FROM validation WHERE login=:login");
        
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
}
   

