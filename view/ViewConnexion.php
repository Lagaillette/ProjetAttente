

<div class="container">
<div class="row">
<div class="col-xs-12">
    
    <div class="main">
            
        <div class="row">
        <div  class="col-xs-12 col-sm-6 col-lg-6 col-sm-offset-3 ">
                    
            <div class="entete centrage">Connexion</div>
            <div class="indices centrage">Gérez votre salle d'attente</div>
                    
            <form action="index.php" name="login2" role="form" class="form-horizontal" method="post" accept-charset="utf-8">
                <input type="hidden" value="connexion" name='action' >
                <input type="hidden" value="user" name='controller' >
                <div class="form-group">
                <div class="col-md-8 col-lg-10  col-md-offset-1"><input name="login" placeholder="Idenfiant" class="form-control" type="text" id="UserUsername" required/></div>
                </div>  
                
                <div class="form-group">
                <div class="col-md-8 col-lg-10 col-md-offset-1"><input name="mdp" placeholder="Mot de passe" class="form-control" type="password" id="UserPassword" required/></div>
                </div> 
                
                <div class="form-group">
                <div class="col-md-offset-1 col-md-8 col-lg-2"><input class="btn btn-success btn btn-success" type="submit" value="Valider" /></div>
                </div>
            
            </form>
            </div>
        </div>
        
    </div>
</div>
</div>
</div>