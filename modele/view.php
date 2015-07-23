<?php
/**
 * Description : Page qui compte les vues
 * Crée le : 20/07/2015 (cause : ajax nous a ralentit)
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */
require_once('../bdd.php');
session_start();

$id_membre = $_SESSION['id_membre'];
$id_tweet_tweap = $_POST['id_tweet_tweap'];

$recuperation_view = $bdd->query("SELECT * FROM tweets WHERE id_tweet_tweap = '$id_tweet_tweap'");
$data = $recuperation_view->fetch();

$view = $data['view'];
$view++;

$ajout_view = $bdd->query("UPDATE tweets SET view = '$view' WHERE id_tweet_tweap = '$id_tweet_tweap' ");

$recuperation_membre = $bdd->query("SELECT * FROM membres WHERE id_membre = '$id_membre'");
$data_membre = $recuperation_membre->fetch();

$view_membre = $data_membre['view'];
$view_membre++;

$ajout_view = $bdd->query("UPDATE membres SET view = '$view_membre' WHERE id_membre = '$id_membre' ");

$_SESSION['view'] = $view_membre;

$reponse = "ok";

$array['reponse'] = $reponse; // Pour la reponse ajax
echo json_encode($array);