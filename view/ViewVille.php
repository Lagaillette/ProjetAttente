
<div class="entete centrage"> Liste des docteurs de <?php echo $ville ?> </div>


    <form method="post" action="index.php" >
        <input type='hidden' value="Ville" name='controller' />
        <input type='hidden' value="<?php echo $ville;?>" name='ville' />
        <input type='hidden' value="recherche" name='action'>
        
        <div class="col-lg-3 col-lg-offset-4 row">
        <input type="text" name="nom" placeholder="rechercher ..." class="form-control"/>
        </div>
        
        <div class="col-lg-1 row">
        <input class="btn btn-success" type="submit" value="recherche" style="margin-bottom: 20px"/>
        </div>
        
    </form>

    
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
                        <th>temps d'attente</th>
                        
                        
                    </tr>
                </thead>
					
                <tbody>
                    <?php
                    
                    foreach ($data2 as $row){
                        $nom = $row->nom;
                        $prenom = $row->prenom;
                        $tel = $row->tel;
                        $mail = $row->mail;
                        $retard = $row->retard;
                        $photo = $row->photo;
                        
                      
                ?>        
                      
                   
                       
                
                        <tr> 
                            
                            <td style="width: 50px"><img src="<?php echo $photo ?>" style="width: 130px; height: 130px"/></td>
                            <td style='text-align : center'><?php echo $nom; ?></td>
                            <td style='text-align : center'><?php echo $prenom; ?></td>
                            <td style='text-align : center'><?php echo $tel; ?></td>
                            <td style='text-align : center'><?php echo $mail; ?></td>
                            <td style='text-align : center; font-weight: bold; ' ><?php echo $retard; ?> <br> minutes</td>
                            
                         
                               
                            
                        </tr> 
                <?php   
                    }
                ?>
                </tbody>
            </table>
            
           
        </div>
    </div>
    
    
</div>


