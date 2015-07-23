<?php
/**
* Description : Update des informations membre de la bdd
* Crée le 11/07/2015
* @author Quentin Aslan <quentin.aslan@outlook.com> cloudflare
*/
require_once('../bdd.php');
session_start();

if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['mdp_verif'])){
	if($_POST['mdp'] == $_POST['mdp_verif']){
		$email = $_POST['email'];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Je verifie l'email [FONCTION PHP]
			$pseudo = $_POST['pseudo'];
			$mdp = $_POST['mdp'];
			$id_membre = $_SESSION['id_membre'];
			
			$rq = $bdd->prepare("UPDATE membres SET pseudo = :pseudo, mdp = :mdp, email = :email WHERE id_membre = '$id_membre'");
			$rq->execute(array('pseudo' => $pseudo,
							   'mdp' => $mdp,
							   'email' => $email)) or die('Une erreur est survenue lors de la modifications de vos identifiants');

			$headers ='From: "Tweap"<contact@tweap.co>'."\n"; 
			$headers .='Reply-To: contact@tweap.co'."\n"; 
			$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
			$headers .='Content-Transfer-Encoding: 8bit'; 

			$message_email ='<html><head><title>Changing Your Account</title></head><body><h1 style="color: #6718b1;">Changing Your Account</h1><br /><br /><h2 style="color: #6718b1;">Your new information is:</h2> <ul><li><b>Pseudo</b> : <em>'.$pseudo.'</em></li><li><b>Password</b> : <em>'.$mdp.'</em></li></ul> <br />
<a href="http://www.tweap.co" target="_blank">See you soon on tweap.co</a><br /><br /><b style="color: #6718b1">Sincerely, <br/><br/>Team Tweap.co</b></body></html>';
			if(mail($email, 'Changing Your Account', $message_email, $headers)){
				session_destroy();
				$reponse = "ok";
			}else {
				$reponse = "oups_send_email";
			}
		}else{
			$reponse = "oups_email";
		}
	}else{
		$reponse = "oups_mdp";
	}
}else{
	echo "Un des champs au moins n'est pas vide";
}
$array['reponse'] = $reponse; // Pour la reponse ajax
echo json_encode($array);
?>