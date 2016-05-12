

<?php
require_once "model/Model.php";
class ModelVille extends Model {
    
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


