<?php
/**
* Description : Vérification des donnée envoyer par l'utilisateur, insertion des infos dans la bdd
* Crée le 05/07/2015
* @author Quentin Aslan <quentin.aslan@outlook.com>
*/
require_once('../bdd.php');

if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['mdp_verif'])){
	if($_POST['mdp'] == $_POST['mdp_verif']){
		$email = $_POST['email'];
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Je verifie l'email [FONCTION PHP]
			$pseudo = $_POST['pseudo'];
			$mdp = $_POST['mdp'];
			$token = sha1(uniqid(rand()));
			
			$rq = $bdd->prepare("INSERT INTO membres (id_membre, pseudo, mdp, email, date, spread, view, _like, dislike, token, verifier) VALUES ('', :pseudo, :mdp, :email, NOW(), '0', '0', '0', '0', $token', '2')");
			$rq->execute(array('pseudo' => $pseudo,
							   'mdp' => $mdp,
							   'email' => $email)) or die('Une erreur est survenue');

			$headers ='From: "Tweap"<contact@tweap.co>'."\n"; 
			$headers .='Reply-To: contact@tweap.co'."\n"; 
			$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
			$headers .='Content-Transfer-Encoding: 8bit'; 

			$message_email ='<html><head><title>Welcome to Tweap.co</title></head><body><h1 style="color: #6718b1;">Hello '.$pseudo.'</h1><br /><br /><h2 style="color: #6718b1;">Thank you for your registration to Tweap.co. Here is the information related to your account:</h2> <ul><li><b>Pseudo</b> : <em>'.$pseudo.'</em></li><li><b>Password</b> : <em>'.$mdp.'</em></li></ul> <br /><h2 style="color: #6718b1;">You can activate your account by clicking on the link below: </h2><a href="http://tweap.co/activate?token='.$token.'&email='.$email.'">http://tweap.co/activate?token='.$token.'&email='.$email.'</a></h2><br />
<a href="http://www.tweap.co" target="_blank">See you soon on tweap.co</a><br /><br /><b style="color: #6718b1">Regards, <br/><br/>Team Tweap.co</b></body></html>';
			if(mail($email, 'Welcome to Tweap.co', $message_email, $headers)){
				$reponse = "ok";
			}else {
				$reponse = "oups_send_email";
			}
		}else{
			$reponse = "oups_email";
		}
	}else{
		$reponse = "Les mots de passe ne corresponde pas...";
	}
}else{
	$reponse = "Un des champs au moins n'est pas vide";
}

$array['reponse'] = $reponse; // Pour la reponse ajax
echo json_encode($array);
?>