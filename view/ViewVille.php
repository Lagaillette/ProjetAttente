<?php require_once "model/ModelTime.php"?>
<div class="entete centrage"> Liste des docteurs de <?php echo $ville ?> </div>

<div class="row" >
    <form method="post" action="index.php" >
        <input type='hidden' value="Ville" name='controller' />
        <input type='hidden' value="<?php echo $ville;?>" name='ville' />
        <input type='hidden' value="recherche" name='action'>
        
        <div class="col-lg-3 col-lg-offset-4 col-xs-9 row col-md-5">
        <input type="text" name="nom" placeholder="rechercher ..." class="form-control"/>
        </div>
        
        <div class="col-lg-1 col-xs-3 row col-md-1">
        <input class="btn btn-success" type="submit" value="recherche" style="margin-bottom: 20px"/>
        </div>
        
    </form>

</div>

<div class="col-lg-10 col-lg-offset-1 list-tab">
        <div class="table-responsive">
            <table id="tabListJeux" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
        
                    <tr class="policeGen" >
                        
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>mail</th>
                        <th>spécialité(s)</th>
                        <th>temps d'attente</th>
                        
                        
                    </tr>
                </thead>
					
                <tbody>
                    <?php
                    //on va afficher les informations pour chaque médecins
                    foreach ($data2 as $row){
                        $nom = $row->nom;
                        $prenom = $row->prenom;
                        $tel = $row->tel;
                        $mail = $row->mail;
                        $retard = $row->retard;
                        $photo = $row->photo;
                        $login = $row->login;
                        
                      
                ?>        
                      
                   
                       
                
                        <tr> 
                            
                            <td style="width: 50px"><img src="<?php echo $photo ?>" style="width: 130px; height: 130px"/></td>
                            <td style='text-align : center'><br><?php echo $nom; ?></td>
                            <td style='text-align : center'><br><?php echo $prenom; ?></td>
                            <td style='text-align : center'><br><?php echo $tel; ?></td>
                            <td style='text-align : center'><br><?php echo $mail; ?></td>
                            <td style='text-align : center'><br>
                                <?php foreach(ModelVille::recupSpe($login) as $row){echo $row['nomS']."<br>";}; ?>
                            </td>  
                            <td style='text-align : center; font-weight: bold; color:#8B0000; font-size:20px' ><br>
                            <?php if (ModelTime::isActif($login)) 
                                    echo $retard."<br> minutes";
                                 else
                                     echo 'inactif';?> 
                            </td>
                            
                         
                               
                            
                        </tr> 
                <?php   
                    }
                ?>
                </tbody>
            </table>
            
           
        </div>
    </div>
    
    
</div>


