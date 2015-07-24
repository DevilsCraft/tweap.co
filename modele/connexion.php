<?php
/**
* Description : Vérification des donnée envoyer par l'utilisateur, si c'est good, on start la session
* Crée le 05/07/2015
* @author Quentin Aslan <quentin.aslan@outlook.com>
*/
require_once('../bdd.php');

if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
	$pseudo = $_POST['pseudo'];
	$mdp = $_POST['mdp'];
	
	$rq = $bdd->query("SELECT * FROM membres WHERE pseudo = '$pseudo'");
	$data = $rq->fetch();
	
	if($mdp == $data['mdp']){
		session_start();
		$_SESSION['pseudo'] = $data['pseudo'];
		$_SESSION['id_membre'] = $data['id_membre'];
		$_SESSION['mdp'] = $data['mdp'];
		$_SESSION['email'] = $data['email'];
		$_SESSION['spread'] = $data['spread'];
		$_SESSION['view'] = $data['view'];
		$_SESSION['verifier'] = $data['verifier'];

		$reponse = "ok";
	}else{
		$reponse = "oups_identifiant";
	}
}else{
	$reponse = "Un des champs au moins n'est pas remplie !!";
}

$array['reponse'] = $reponse; // Pour la reponse ajax
echo json_encode($array);
?>