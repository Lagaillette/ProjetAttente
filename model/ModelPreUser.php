<?php

class ModelUser extends Model {

    public static function Inscrire($tab){
        
    $req = self::$pdo->prepare('INSERT INTO validation(photo,nom,prenom,login,mdp,tel,mail,ville) VALUES( :chemin, :nom, :prenom,:login, :mdp, :tel, :mail, :ville)');

    $req->execute($tab);
    
    }
    
    public static function selectAllUsersWainting(){
        $req=self::$pdo->query("SELECT photo,nom, prenom, login FROM validation ORDER BY nom");
  
        return $req->fetchAll(PDO::FETCH_OBJ);
        
    }
    
    public static function selectInfo($login){
        $req=self::$pdo->prepare("SELECT * FROM validation WHERE login=:login");
        
        $req->bindvalue(':login',$login,PDO::PARAM_STR);
        
        $req->execute();
        
        return $req->fetch();
    }
    
    public static function delete($login){
         $req=self::$pdo->prepare('DELETE FROM validation WHERE login=:login');
         
         $req->bindvalue(':login',$login,PDO::PARAM_STR);
         
         $req->execute();
    }
}
?>