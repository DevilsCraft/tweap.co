<?php
/**
 * Description : Code qui recupere l'adresse ip du visiteur pour pas qu'il spread VINGTS FOIT
 * Crée le 11 Juillet (a 00h01 xD)
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */

$ip = $_SERVER['REMOTE_ADDR'];

$rq_ajouter_ip = $bdd->query("INSERT INTO adresse_ip (id_ip, ip, date) VALUES ('', '$ip', NOW())");

$rq_recherche_ip = $bdd->query("SELECT * FROM adresse_ip WHERE ip LIKE '%".$ip."%' ") or die('Erreur lors de la recherche de votre adresse IP dans notre base de donee');
$data = $rq_recherche_ip->fetch();

session_start();
$_SESSION['id_ip'] = $data['id_ip'];
$_SESSION['ip'] = $data['ip'];

// On efface tout les IP qui ne sont pas a la date du jour wsh

$rq_delete_ip = $bdd->query("DELETE FROM adresse_ip WHERE date = NOW()");



?>