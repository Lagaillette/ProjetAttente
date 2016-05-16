
<?php


//ModelTime contient les fonctions concernant 
class ModelTime extends Model{
    
    public static function moins($login){
        $req=self::$pdo->prepare("UPDATE medecin SET retard=retard-5 WHERE login = :login AND retard>0");
        
        $req->bindValue(':login',$login, PDO::PARAM_STR);
        
        $req->execute();
        
    }
    
    public static function plus($login){
        $req=self::$pdo->prepare("UPDATE medecin SET retard=retard+5 WHERE login = :login");
        
        $req->bindValue(':login',$login, PDO::PARAM_STR);
        
        $req->execute(); 
        
    }
    
    public static function recupRetard($login){
            
                $req = self::$pdo->prepare("SELECT retard FROM medecin WHERE login=:login");
                
                $req->bindValue(':login',$login, PDO::PARAM_STR);
                
                $req->execute();
                
                return $req->fetch();
    }
    
    public static function restartRetard($login){
            
                $req = self::$pdo->prepare("UPDATE medecin SET retard=0 WHERE login = :login");
                
                $req->bindValue(':login',$login, PDO::PARAM_STR);
                
                $req->execute();
                
                return $req->fetch();
    }
    
    public static function isActif($login){
        $data=array(
            'login' => $login
        );
        $req=self::$pdo->prepare('SELECT actif FROM medecin WHERE login=:login');
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if($data2['actif']==1)
            return true;
        else
            return false;
        
    }
    
    public static function rendreActif($login){
        $req = self::$pdo->prepare("UPDATE medecin SET actif=1 WHERE login = :login");
                
        $req->bindValue(':login',$login, PDO::PARAM_STR);
                
        $req->execute();
        
    }
    
    public static function rendreInactif($login){
        $req = self::$pdo->prepare("UPDATE medecin SET actif=0 WHERE login = :login");
                
        $req->bindValue(':login',$login, PDO::PARAM_STR);
                
        $req->execute();
    }
    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

