<html>
<body>
<div class="row">
        <div  class="col-xs-12 col-sm-6 col-lg-6 col-sm-offset-3 ">
            
            <div class="entete centrage">Inscription</div>
            <div class="indices centrage">Données du médecin concerné</div>
            
            
            <form action="index.php"  name="login1" role="form" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                <input type="hidden" value="Inscription" name='action' >
                <input type="hidden" value="user" name='controller' >
                <div class="form-group">
                <div class="col-md-8 col-lg-8 col-lg-offset-2"><input name="login" placeholder="Idenfiant" class="form-control" type="text" id="Userlogin" required/></div>
                </div> 
                
                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2"><input name="mdp" placeholder="Mot de passe" class="form-control" type="password" id="UserPassword" required/></div>
                </div> 
    
                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2"><input name="nom" placeholder="nom" class="form-control" type="text" id="Username" required/></div>
                </div> 
    
                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2"><input name="prenom" placeholder="prénom" class="form-control" type="text" id="Userprenom" required/></div>
                </div> 
    
                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2"><input name="mail" placeholder="email" class="form-control" type="email" id="Usermail" required/></div>
                </div> 
    
                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2"><input name="tel" placeholder="numéro de téléphone" class="form-control" type="tel" id="Usertel" required/></div>
                </div> 
                
                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2"><input name="ville" placeholder="ville" class="form-control" type="text" id="Userville" required/></div>
                </div>  
                
                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2"><input name="specialite" placeholder="specialité" class="form-control" type="text" id="Userville" required/></div>
                </div>  
                
                <div class="form-group indices" style="font-size:20px">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2 ">insérez votre photo ici:</div>
                </div> 
                
                <div class="form-group">
                    <div class="col-md-8 col-lg-8 col-lg-offset-2"><input type="file" name="img" ></div>
                </div> 
                
                
                
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-8"><input   class="btn btn-success btn btn-success" tyhref="outilDocteur.php"type="submit" value="Inscription"/></div>
                </div>
        </div>
            </form>
</div>
</body>

</html>

