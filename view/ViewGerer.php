<div class="entete centrage">Définissez le temps d'attente</div>
<br>
<div  class="col-lg-offset-3 col-lg-6 compteurdoc">
<div class="entete2">
 <?php if (ModelTime::isActif($_COOKIE['login'])) 
            echo $retard."<br> minutes";
         else
             echo 'inactif';?> 
</div>
<div class="entete2">  </div>

    <?php if (!ModelTime::isActif($_COOKIE['login'])) {?>
    
    <form method="post" action="index.php" class>
        <input type='hidden' value="time" name='controller' />
        <input type='hidden' value="actif" name='action'>
        
        
        
        <div class="col-lg-offset-5 col-lg-2 row">
            <input class="btn btn-success col-lg-12" type="submit" value="-> actif" style="margin-bottom: 20px"/>
        </div>
        
    </form>
    <?php } else { ?>
    <div class="row">
    <a href="index.php?action=moins&controller=time"><button class="btvar col-lg-offset-4 col-lg-2" >-</button></a>
    <a href="index.php?action=plus&controller=time"><button class="btvar col-lg-2">+</button></a>
</div>
<div class="row ">
    <form method="post" action="index.php" class>
        <input type='hidden' value="time" name='controller' />
        <input type='hidden' value="inactif" name='action'>
        
       
        
        <div class="col-lg-offset-5 col-lg-2 row">
            <input class="btn btn-success col-lg-12" type="submit" value="-> inactif" style="margin-bottom: 20px"/>
        </div>
        
    </form>
</div>
    <?php } ?>
</div>
</div>

