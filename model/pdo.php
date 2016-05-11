
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=attente', 'bd', 'bd');
    
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>


