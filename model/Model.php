<?php
/*! \brief Classe général pour les models
 *         
 * Cette classe permet de définir des fonctions communes à toutes les classes qui héritent de celle-ci
 *  
 */


// On va chercher le fichier de configuration dans "./config/Conf.php"
//require_once ROOT . DS . 'config' . DS . 'Conf.php';

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

// On initiliase la connexion $pdo un fois pour toute
Model::set_static();

