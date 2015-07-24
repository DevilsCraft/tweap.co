<?php
/**
 * Description : Script qui delete un Spread au bout de 1 outdated + si un tweet a 0 de spread, cela ne fait rien)
 * Crée le 21/07/2015
 * @author Quentin Aslan <quentin.aslan@outlook.com> 
*/
require_once('../bdd.php');
session_start();

$id_membre = $_SESSION['id_membre'];
$id_tweet_tweap = $_POST['id_tweet_tweap'];
$id_ip = $_SESSION['id_ip'];

$recuperation_outdated = $bdd->query("SELECT * FROM tweets WHERE id_tweet_tweap = '$id_tweet_tweap'");
$data = $recuperation_outdated->fetch();

$outdated = $data['outdated'];
$outdated++;

$ajout_outdated = $bdd->query("UPDATE tweets SET outdated = '$outdated' WHERE id_tweet_tweap = '$id_tweet_tweap' ");

if($outdated == 3 or 6 or 9 or 12 or 15 or 18 or 21 or 25 or 28 or 31 or 34 or 37 or 40 or 43 or 47 or 50 or 53 or 56 or 59 or 62 or 65 or 68 or 71 or 74 or 77 or 80 or 83 or 86 or 89 or 92 or 95 or 98 or 101 or 104 or 107 or 110 or 113 or 116 or 119 or 122 or 125 or 128 or 131 or 134 or 137 or 140 or 143 or 146 or 149 or 152 or 155 or 158 or 161 or 164 or 167 or 170 or 173 or 176 or 179 or 182 or 185 or 188 or 191 or 194 or 197 or 200 or 203 or 205 or 208 or 211 or 214 or 217 or 220 or 223 or 226 or 229 or 232 or 235 or 237 or 240 or 243 or 246 or 249 or 251 or 254 or 257 or 260 or 263 or 266 or 269 or 272 or 275 or 278 or 281 or 284 or 287 or 290 or 293 or 296 or 299 or 302 or 305 or 308 or 311 or 314 or 317 or 320 or 323 or 326 or 329 or 332 or 335 or 337 or 340 or 343 or 346 or 349 or 352 or 355 or 358 or 361 or 364 or 367 or 370 or 373 or 376 or 379 or 382 or 385 or 388 or 391 or 394 or 397 or 400 or 403 or 406 or 409 or 412 or 415 or 418 or 421 or 424 or 427 or 430 or 433 or 436 or 439 or 442 or 445 or 448 or 451 or 454 or 457 or 460 or 463 or 466 or 469 or 471 or 474 or 477 or 480 or 483 or 486 or 489 or 492 or 495 or 498 or 501){
	$recuperation_spread = $bdd->query("SELECT * FROM tweets WHERE id_tweet_tweap = '$id_tweet_tweap'");
	$data = $recuperation_spread->fetch();

	$spread = $data['spread'];
	if($spread == 0){
		// on fait rien car il est déja a 0
	}else{
		$spread--;
		$ajout_spread = $bdd->query("UPDATE tweets SET spread = '$spread' WHERE id_tweet_tweap = '$id_tweet_tweap' ");
	}
}

$ajout_securite = $bdd->query("INSERT INTO outdated (id_outdated, id_ip, id_tweet_tweap) VALUES ('', '$id_ip', '$id_tweet_tweap') ");

$reponse = "ok";

$array['reponse'] = $reponse; // Pour la reponse ajax
echo json_encode($array);
?>