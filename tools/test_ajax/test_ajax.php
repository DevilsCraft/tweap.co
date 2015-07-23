<?php
/*
 *  Script PHP qui traite les requêtes AJAX envoyées par le client 
**/
 
// Récupération des paramètres
$chaine = '';
if( isset($_GET['chaine']) ){
    $chaine = $_GET['chaine'];
}
 
// Traitements
$retour = array(
    'chaine'    => strtoupper($chaine),
    'date'      => date('d/m/Y H:i:s'),
    'phpversion'=> phpversion()
);
 
// Envoi du retour (on renvoi le tableau $retour encodé en JSON)
header('Content-type: application/json');
echo json_encode($retour);
?>