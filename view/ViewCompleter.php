<html>
<body>
<div class="row">
<div class="entete centrage">Complétez votre profil:</div>
<div class="entete2n centrage" style="margin-bottom: 20px;"> Ajoutez une ville ou une spécialité dans laquelle vous travaillez :</div> 

            
            <form method="post" action="index.php" class>
                <input type="hidden" value="ajoutVille" name='action' >
                <input type="hidden" value="user" name='controller' >
                <div class="col-lg-3 col-lg-offset-4 row">
                <input type="text" name="ville" placeholder="nouvelle ville" class="form-control"/>
                </div>

                <div class="col-lg-1 row">
                <input class="btn btn-success" type="submit" value="Ajouter" style="margin-bottom: 25px"/>
                </div>
                
            </form>
        

            <form method="post" action="index.php" class>
                <input type="hidden" value="ajoutSpe" name='action' >
                <input type="hidden" value="user" name='controller' >
                
                <div class="col-lg-3 col-lg-offset-4 row">
                <input type="text" name="specialite" placeholder="nouvelle Spécialité" class="form-control"/>
                </div>

                <div class="col-lg-1 row">
                <input class="btn btn-success" type="submit" value="Ajouter" style="margin-bottom: 20px"/>
                </div>

            </form>
</div>            
    
<div class="row">
<div class="entete2n centrage" style="margin-bottom: 20px;"> Supprimez une ville ou une spécialité dans laquelle vous travaillez :</div> 

            
            <form method="post" action="index.php" class>
                <input type="hidden" value="supVille" name='action' >
                <input type="hidden" value="user" name='controller' >
                <div class="col-lg-3 col-lg-offset-4 row">
                <input type="text" name="ville" placeholder="Ville à supprimer" class="form-control"/>
                </div>

                <div class="col-lg-1 row">
                <input class="btn btn-success" type="submit" value="supprimer" style="margin-bottom: 25px"/>
                </div>
                
            </form>
        

            <form method="post" action="index.php" class>
                <input type="hidden" value="supSpe" name='action' >
                <input type="hidden" value="user" name='controller' >
                
                <div class="col-lg-3 col-lg-offset-4 row">
                <input type="text" name="specialite" placeholder="Spécialité à supprimer" class="form-control"/>
                </div>

                <div class="col-lg-1 row">
                <input class="btn btn-success" type="submit" value="supprimer" style="margin-bottom: 20px"/>
                </div>

            </form>
</div>            
</body>
</html>
