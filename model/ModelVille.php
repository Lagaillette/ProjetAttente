<?php

class ModelVille extends Model {
    
    public static function selectAllVilles(){
        
        $req=self::$pdo->query("SELECT nomV FROM ville ORDER BY nomV");
  
        return $req->fetchAll();
    }
    
    public static function insertVille($data){
        $req = self::$pdo->prepare('INSERT INTO ville(nomV) VALUES( :ville)');
        
        $req->bindValue(':ville',$data, PDO::PARAM_STR);
    
        $req->execute();
    }
    
    public static function isNotInVille($ville){
        $data=array(
            ':ville' => $ville
        );
        $req = self::$pdo->prepare("SELECT nomv FROM ville WHERE nomV=:ville");
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if(empty($data2)){
            return true;
        }else{
            return false;
        }
       
        
    }
    
     public static function selectIdVille($ville){
        
        $req=self::$pdo->prepare('SELECT id FROM ville WHERE nomV = :nomV');

        $req->bindValue(':nomV',$ville, PDO::PARAM_STR);
        
        $req->execute();

        return $req->fetch();
    }
    
    public static function insertIntoTravailler($tab){
        $req=self::$pdo->prepare('INSERT INTO travailler VALUES( :iduser, :idville)');
        
        $req->execute($tab);
    }
            
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

