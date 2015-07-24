<?php
/**
 * Description : Ajout d'un like a un tweet lors du click
 * Crée du 24/07/2015
 * @author  Quentin Aslan <quentin.aslan@outlook.com>
 */
require_once('../bdd.php');
session_start();

$id_membre = $_SESSION['id_membre'];
$id_tweet_tweap = $_POST['id_tweet_tweap'];
$id_ip = $_SESSION['id_ip'];

$recuperation_like = $bdd->query("SELECT * FROM tweets WHERE id_tweet_tweap = '$id_tweet_tweap'");
$data = $recuperation_like->fetch();

$like = $data['_like'];
$like++;

$ajout_like = $bdd->query("UPDATE tweets SET _like = '$like' WHERE id_tweet_tweap = '$id_tweet_tweap' ");

$recuperation_membre = $bdd->query("SELECT * FROM membres WHERE id_membre = '$id_membre'");
$data_membre = $recuperation_membre->fetch();

$like_membre = $data_membre['_like'];
$like_membre++;

$ajout_like = $bdd->query("UPDATE membres SET like = '$like_membre' WHERE id_membre = '$id_membre' ");

$ajout_securite = $bdd->query("INSERT INTO _like (id_like, id_ip, id_tweet_tweap) VALUES ('', '$id_ip', '$id_tweet_tweap') ");

$_SESSION['like'] = $like_membre;

$reponse = "ok";

$reponse = array('status' => 'ok',
				 'like' => $like);
echo json_encode($reponse);
?>