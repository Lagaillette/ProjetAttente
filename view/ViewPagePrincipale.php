<?php

?>
<html>
<body>
<div class="entete centrage"> Bienvenue </div>


<div class="entete2n " style="margin-bottom: 20px;"> Choisissez la ville de votre médecin </div>
    <?php
    
     foreach($data as $row){
     ?>
     
    <div class="list-group col-lg-12" style="margin-top : -25px; margin-bottom: 10px; " >

         <form method='post' action='index.php'>
             <input type='hidden' value="Ville" name='controller' />
             <input type='hidden' value="<?php echo $row['nomV'];?>" name='ville' />
             <input type='hidden' value="villes" name='action'>
             <input class=" list-group-item policeGen col-lg-6 btn-lg btn-default" style="color : darkslategrey; margin-top : 0px; margin-bottom: 0px;  " type='submit' value="<?php echo $row['nomV'];?>"/>
          </form>   
    </div>
    <?php } ?>


<div  class="indices" > TicTacDoc, Comment ça marche? <a href="ViewEnSavoirPlus.php">En Savoir Plus</a> </div>
<?php  
       
       ?>


</body>
</html>