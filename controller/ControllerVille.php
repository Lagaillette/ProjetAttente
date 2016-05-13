<?php
require MODEL_PATH . 'Model.php';
require MODEL_PATH . 'ModelUser.php';
require "model/ModelVille.php";

$pagetitle = $ville;
$view = 'ville';
$ville2=array(
    'ville' => $ville
);

switch ($action) {
    
    case 'villes' :
        $data2=ModelUser::selectUsers($ville2);
        break;
    
    case 'recherche' :
        $infos=array(
            'nom' => $nom,
            'ville' => $ville
        );
        $data2=ModelUser::selectUsersByNameAndCity($infos);
        
        
        break;
}





require_once VIEW_PATH . "view.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

