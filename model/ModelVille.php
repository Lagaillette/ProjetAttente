<?php
//le ModelVille contient les fonctions concernant Les villes mais aussi les spécialités. 
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
    
    public static function isInEffectuer($id){
        $data=array(
            ':id' => $id
        );
        $req = self::$pdo->prepare("SELECT id_spe FROM effectuer WHERE id_spe=:id");
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if(empty($data2)){
            return false;
        }else{
            return true;
        }
    }  
    
    public static function isInTravailler($id){
        $data=array(
            ':id' => $id
        );
        $req = self::$pdo->prepare("SELECT id_ville FROM travailler WHERE id_ville=:id");
        
        $req->execute($data);
        
        $data2=$req->fetch();
        
        if(empty($data2)){
            return false;
        }else{
            return true;
        }
    }
    
    public static function recupSpe($login){
        $data=array(
            'login'=>$login
        );
        
        $req=self::$pdo->prepare("Select nomS from medecin m, effectuer e, specialite s WHERE m.id=e.id_user AND e.id_spe=s.id AND login=:login");
        
        $req->execute($data);
    
        return $req->fetchAll();
    }
    
    public static function deleteInEffectuer($data1,$data2){
        
        $req=self::$pdo->prepare('DELETE FROM effectuer WHERE id_spe=:idspe AND id_user=:iduser');
         
        $req->bindValue(':idspe',$data1, PDO::PARAM_INT);
        $req->bindValue(':iduser',$data2, PDO::PARAM_INT);
        
        $req->execute();
      
        
    }
    
    public static function deleteInTravailler($data1,$data2){
        
        $req=self::$pdo->prepare('DELETE FROM travailler WHERE id_ville= :idville AND id_user=:iduser');
         
        $req->bindValue(':idville',$data1, PDO::PARAM_INT);
        $req->bindValue(':iduser',$data2, PDO::PARAM_INT);
        
        $req->execute();
      
        
    }
}



