<?php
/**
 * Description : Recuperation du tweet envoyer par l'utilisateur et insertion dans la bdd
 * @author  Quentin Aslan <quentin.aslan@outlook.com>
 */
require_once('../bdd.php');
require('../modele/connexion_api.php');
session_start();

$url_tweet = explode("/", $_POST['url']);

$verification = $url_tweet[2];

if($verification != "twitter.com"){
	$reponse = "oups_twitter.com";
}else{

	$id_tweet = $url_tweet[5];

	$query='https://api.twitter.com/1.1/statuses/show.json?id='.$id_tweet;
	$content = $connection->get($query);

	$id_membre = $_SESSION['id_membre'];
	$pseudo_twitter = $content->user->name;
	$nom_twitter = $content->user->screen_name;
	$message = $content->text;
	$img = $content->user->profile_image_url;
	$date_twitter = $content->created_at;

	$rq_ajouter_tweet = $bdd->prepare("INSERT INTO tweets (id_tweet, id_tweet_tweap, pseudo_twitter, nom_twitter, id_membre, img, message, date_tweap, date_twitter, spread, vue, like, dislike) VALUES (:id_tweet, '', :pseudo_twitter, :nom_twitter, '$id_membre', :img, :message, NOW(), '$date_twitter', '0', '0', '0', '0') ");
	$rq_ajouter_tweet->execute(array(
								'id_tweet' => $id_tweet,
								'pseudo_twitter' => $pseudo_twitter,
								'nom_twitter' => $nom_twitter,
								'img' => $img,
								'message' => $message
								));
	$reponse = "ok";
}

$array['reponse'] = $reponse; // Pour la reponse ajax
echo json_encode($array);
?>