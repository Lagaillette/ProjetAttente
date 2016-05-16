<?php
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'ModelUser.php';
?>
<head>
<meta charset="UTF-8">
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/style.css"
         <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
         <link href="assets/css/bootstrap-3.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="assets/js/jquerry/jquery-ui.css">
         <link rel="stylesheet" href="assets/js/jquerry/jquery-ui.theme.css">
         <link rel="stylesheet" href="assets/js/jquerry/jquery-ui.structure.css">
         <link rel="stylesheet" href="assets/css/font-awesome-4.4.0/css/font-awesome.min.css">
         <link rel="stylesheet" href="assets/css/bootstrap-3.3.4/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
         <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-3.3.4/dataTables.bootstrap.min.css">
         <link href="assets/css/datepicker/css/bootstrap-datepicker3.css" rel="stylesheet">
         <title> <?php echo $pagetitle ?></title>
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php"><strong>TicTacDoc</strong></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="index.php?action=ensavoirplus">Aide</a></li>
      
       <?php if (!empty($_COOKIE['login'])){ 
                if(ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt']) && ModelUser::isAdmin($_COOKIE['login'])){?>
                    <li><a href="index.php?controller=interface&action=delete">Supprimer</a></li>
                    <li><a href="index.php?controller=preuser&action=appercu">Accepter</a></li>
                <?php
                }
       }             
      ?>
                    
      <?php if (!empty($_COOKIE['login']) && ModelUser::Correspondre($_COOKIE['login'],$_COOKIE['clecrypt']) && !ModelUser::isAdmin($_COOKIE['login']) ){?>
      <li>
          
          <a href="index.php?action=RecupRetard&controller=time">
               Gerer
          </a>
      </li>
      <li>
          <a href="index.php?action=completer">
               Compléter
          </a>
          
      </li>
      <?php } ?>
      
      <?php if (!empty($_COOKIE['login'])){?>
      <li>
          
          <a href="index.php?action=modifier">
               Modifier
          </a>
          
      </li>
      <?php } ?>
     
         
                    
      <?php if (empty($_COOKIE['login'])){?>            
      <li><a href="index.php?controller=interface&action=contact">Contact</a></li>
      <?php } ?>
      
       <?php if (empty($_COOKIE['login'])){?> 
      <li><a href="index.php?action=inscription">Inscription</a></li>
      <?php } ?>
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
        
         <?php if (empty($_COOKIE['login'])){ ?>
        
        <li><a href="index.php?action=connexion"><span class="glyphicon glyphicon-log-in"></span> 
           connexion </a>
        </li>
        
         <?php } else { ?>
        <li><a href="index.php?controller=user&action=deconnexion"><span class="glyphicon glyphicon-log-in"></span> 
           deconnexion </a>
        </li>
        
        <?php }  ?>
        
        
    </ul>
  </div>
</nav>
</head>

