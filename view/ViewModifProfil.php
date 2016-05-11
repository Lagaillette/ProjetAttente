<html>
<body>
<div class="row">
<div class="entete centrage">Modifiez votre profil:</div>
<div class="entete2n centrage" style="margin-bottom: 20px;"> Modifiez les informations que vous voulez changer </div> 

            
            
            <form action="index.php"  name="login1" role="form" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                <input type="hidden" value="modification" name='action' >
                <input type="hidden" value="user" name='controller' >
                <div class="form-group">
                <div class="col-md-6 col-lg-6 col-lg-offset-3"><input name="login" placeholder="Idenfiant" class="form-control" type="text" id="Userlogin" /></div>
                </div> 
                
                <div class="form-group">
                    <div class="col-md-6 col-lg-6 col-lg-offset-3"><input name="mdp" placeholder="Mot de passe" class="form-control" type="password" id="UserPassword" /></div>
                </div> 
    
                <div class="form-group">
                    <div class="col-md-6 col-lg-6 col-lg-offset-3"><input name="mail" placeholder="email" class="form-control" type="email" id="Usermail" /></div>
                </div> 
    
                <div class="form-group">
                    <div class="col-md-6 col-lg-6 col-lg-offset-3"><input name="tel" placeholder="numéro de téléphone" class="form-control" type="tel" id="Usertel" /></div>
                </div> 
                
                <div class="form-group">
                    <div class="col-md-6 col-lg-6 col-lg-offset-3"><input type="file" name="img"></div>
                </div> 
                
                
                
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-8"><input   class="btn btn-success btn btn-success" tyhref="outilDocteur.php"type="submit" value="modifier"/></div>
                </div>
        </div>
            </form>
</div>
</body>
</html>