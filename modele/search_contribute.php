<?php
/**
 * Description : Recuperation du tweet envoyer par l'utilisateur et insertion dans la bdd
 * @author  Quentin Aslan <quentin.aslan@outlook.com>
 */
require_once('../bdd.php');
require('../modele/connexion_api.php');
session_start();

$pseudo_search = "tweapnws";

$query='https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$pseudo_search.'&count=1';
$content = $connection->get($query);

$pseudo_twitter = $content->user->name;
$message = $content->text;
$img = $content->user->profile_image_url;


$reponse = array(
	'status' => 'ok',
	'pseudo_twitter' => $pseudo_twitter,
	'message' => $message,
	'img' => $img,
	'nom_twitter' => $pseudo_search
	);

echo json_encode($reponse);
?>