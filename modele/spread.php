<?php
/**
 * Description : Ajout d'un spread a un tweet lors du click
 * Crée du 09/07/2015
 * @author  Quentin Aslan <quentin.aslan@outlook.com>
 */
require_once('../bdd.php');
session_start();

$id_membre = $_SESSION['id_membre'];
$id_tweet_tweap = $_POST['id_tweet_tweap'];
$id_ip = $_SESSION['id_ip'];

$recuperation_spread = $bdd->query("SELECT * FROM tweets WHERE id_tweet_tweap = '$id_tweet_tweap'");
$data = $recuperation_spread->fetch();

$spread = $data['spread'];
$spread++;

$ajout_spread = $bdd->query("UPDATE tweets SET spread = '$spread' WHERE id_tweet_tweap = '$id_tweet_tweap' ");

$recuperation_membre = $bdd->query("SELECT * FROM membres WHERE id_membre = '$id_membre'");
$data_membre = $recuperation_membre->fetch();

$spread_membre = $data_membre['spread'];
$spread_membre++;

$ajout_spread = $bdd->query("UPDATE membres SET spread = '$spread_membre' WHERE id_membre = '$id_membre' ");

$ajout_securite = $bdd->query("INSERT INTO spread (id_spread, id_ip, id_tweet_tweap) VALUES ('', '$id_ip', '$id_tweet_tweap') ");

$_SESSION['spread'] = $spread_membre;

$reponse = "ok";

$reponse = array('status' => 'ok',
				 'spread' => $spread);
echo json_encode($reponse);
?>