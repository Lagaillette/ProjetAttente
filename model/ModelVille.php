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
    
    public static function insertSpe($data){
        $req = self::$pdo->prepare('INSERT INTO specialite(nomS) VALUES( :spe)');
        
        $req->bindValue(':spe',$data, PDO::PARAM_STR);
    
        $req->execute();
    }
    
    public static function isNotInSpe($spe){
        $data=array(
            ':spe' => $spe
        );
        $req = self::$pdo->prepare("SELECT nomS FROM specialite WHERE nomS=:spe");
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if(empty($data2)){
            return true;
        }else{
            return false;
        }
    }
    
    public static function insertIntoEffectuer($tab){
        $req=self::$pdo->prepare('INSERT INTO effectuer VALUES( :iduser, :idspe)');
        
        $req->execute($tab);
    }
    
    public static function selectIdSpe($spe){
        
        $req=self::$pdo->prepare('SELECT id FROM specialite WHERE nomS = :spe');

        $req->bindValue('spe',$spe, PDO::PARAM_STR);
        
        $req->execute();

        return $req->fetch();
    }
    
    public static function deleteVille($id){
        $req=self::$pdo->prepare('DELETE FROM ville WHERE id=:id');
         
         $req->bindvalue(':id',$id,PDO::PARAM_STR);
         
         $req->execute();
    }
      
    public static function deleteSpe($id){
        $req=self::$pdo->prepare('DELETE FROM specialite WHERE id=:id');
         
         $req->bindvalue(':id',$id,PDO::PARAM_STR);
         
         $req->execute();
    }
    
    public static function isNotInEffectuer($id){
        $data=array(
            ':id' => $id
        );
        $req = self::$pdo->prepare("SELECT id_spe FROM effectuer WHERE id_spe=:id");
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if(empty($data2)){
            return true;
        }else{
            return false;
        }
    }  
    
    public static function isNotInTravailler($id){
        $data=array(
            ':id' => $id
        );
        $req = self::$pdo->prepare("SELECT id_ville FROM travailler WHERE id_ville=:id");
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if(empty($data2)){
            return true;
        }else{
            return false;
        }
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

