<?php
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL); 
/**
* Description : Active un compte si le token est égal
* Crée le 23/07/2015
* @author Quentin Aslan <quentin.aslan@outlook.com>
*/
require_once('../bdd.php');
session_start();
extract($_GET);

$rq_select_membre = $bdd->query("SELECT * FROM membres WHERE token = '$token'");
$data = $rq_select_membre->fetch();

if($token == $data['token']){
	$rq_verifier_membre = $bdd->query("UPDATE membres SET verifier = 1 WHERE token = '$token' ");

	session_destroy();

	header('location: ../news?parametre=verifier');
}else{
	echo "impossible de verifier votre compte";
}
?>