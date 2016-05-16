<?php
//Classe dont vont hériter les autres models permettant la connexion à la base de données

class Model {

    public static $pdo;

    /// Cette fonction permet d'établir la connexion à la base de données en créant un objet pdo (self::$pdo) qui permettra de communiquer avec la base de données.
    public static function set_static() {
       try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=attente', 'lui', 'lui');

            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
                }

   

}

// On initiliase la connexion $pdo
Model::set_static();

