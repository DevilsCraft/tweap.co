<?php
/**
 * Dossier avec les code pour ce connecter a la BDD.
 * Crée le 30/06/2015
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */
$hote = "localhost";  
$pseudo_bdd = "github";
$mdp_bdd = "github";
$nom_bdd = "tweap";

try {
        $bdd = new PDO("mysql:host=$hote;dbname=$nom_bdd", $pseudo_bdd, $mdp_bdd);
    } catch (Exception $e) {
        die ('Erreur : ' . $e->getMessage());
    }

?>