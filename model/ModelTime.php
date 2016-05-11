
<?php



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
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

