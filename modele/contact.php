<?php
/**
 * Description : Envoie du mail contact a l'email : contact@tweap.co & au client 
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 * Crée le 03/07/2015
 */

if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['message'])){
	$pseudo = $_POST['pseudo'];
	$email = $_POST['email'];
	$sujet = $_POST['sujet'];
	$message = $_POST['message'];

	$headers ='From: "'.$pseudo.'"<'.$email.'>'."\n"; 
	$headers .='Reply-To: '.$email."\n"; 
	$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
	$headers .='Content-Transfer-Encoding: 8bit'; 

	$message_email ='<html><head><title>Email de contact</title></head><body><h1 style="color: #6718b1;">Tweap.co</h1> <br /> <h2 style="color:red;">Message de '.$pseudo.' qui a pour sujet : <em>'.$sujet.'</em></h2><br /><br /><h2 style="color:blue;">Message :</h2><p><em>'.$message.'</em></p><br /></body></html>'; 


	if(mail('contact@tweap.co', $sujet, $message_email, $headers))
	{ 
		$headers ='From: "Tweap"<contact@tweap.co>'."\n"; 
		$headers .='Reply-To: contact@tweap.co'."\n"; 
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
		$headers .='Content-Transfer-Encoding: 8bit'; 

		$message_email ='<html><head><title>Email de contact</title></head><body><h1 style="color: #6718b1;">Hello '.$pseudo.'</h1> <br /> <h2 style="color:red;">Your contact message  <em>'.$sujet.'</em> has been sent. We will attempt to reply to you within 48 hours.</h2><br /><br /><h2 style="color:blue;">Here is a copy of the message that was reached us:</h2><p><em>'.$message.'</em></p><br /><b>Regards, <br/><br/>Team Tweap.co</body></html>'; 
		mail($email, $sujet, $message_email, $headers);

		$reponse = 'ok';
	} 
	else 
	{ 
	  $reponse = "Le message n\'a pu être envoyé <b>SI VOUS AVEZ CE MESSAGE C'EST QUE JAVASCRIPT EST DESACTIVER SUR VOTRE NAVIGATEUR</b>"; 
	} 
}else{
	$reponse = "un des champs est vide";
}

$array['reponse'] = $reponse;
echo json_encode($array);
?>