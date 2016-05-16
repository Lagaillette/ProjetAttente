<?php require_once MODEL_PATH."Model.php";
    require_once MODEL_PATH."ModelUser.php";
?>
<html>
    <div class="entete centrage"> Supprimez les médecins </div>
    
     <form method="post" action="index.php" class>
        <input type='hidden' value="user" name='controller' />
        <input type='hidden' value="rechercheDelete" name='action'>
        
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
        
                    <tr class="policeGen">
                        <th>photo</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>telephone</th>
                        <th>accepter</th>
                        <th>rejeter</th>
                    </tr>
                </thead>
                <?php
                //$data= ModelUser::selectAllUsers();
                  
                    foreach ($data as $row){
                        $nom = $row->nom;
                        $prenom = $row->prenom;
                        $login = $row->login;
                        $photo = $row->photo;
                        $tel = $row ->tel;
                ?>        
                      
                   
                       
                
                        <tr> 
                            <td style="width: 50px"><img src=<?php echo $photo ?> /></td>
                            <td style='text-align : center'><?php echo $nom; ?></td>
                            <td style='text-align : center'><?php echo $prenom; ?></td>
                            <td style='text-align : center'><?php echo $tel; ?></td>
                            <td style='text-align : center'>
                                <form method='post' action='index.php'>
                                    <input type="hidden" value="accept" name='action' >
                                    <input type="hidden" value="preuser" name='controller' >
                                    <input type="hidden" value="<?php echo $login; ?>" name='login' >
                                    <input type='submit' value='accept' class="btn btn-success" />
                                </form>
                            <td style='text-align : center'>
                                <form method='post' action='index.php'>
                                    <input type="hidden" value="delete" name='action' >
                                    <input type="hidden" value="preuser" name='controller' >
                                    <input type="hidden" value="<?php echo $login; ?>" name='login' >
                                    <input type='submit' value='delete' class="btn btn-success" />
                                </form>
                               
                            
                        </tr> 
                     <?php   
                      //list_user($data);
                    
                    }
                ?>
                    
                <tbody>
                    
                </tbody>
            </table>
</html>


