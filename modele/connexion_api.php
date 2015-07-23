<?php
/**
 * Description : Ici, connexion a l'api twiiter
 * @author  Quentin Aslan <quentin.aslan@outlook.com>
 */


$consumer_key='McHriElMr3EuZtknya6rRB6zJ'; //Provide your application consumer key
$consumer_secret='dFE7MiI8Ws8GPB2osPyrpYPsM1lVymb0dK3dKvpc112lYlNkzN'; //Provide your application consumer secret
$oauth_token = '3343333043-yhcM6voy6o2gzRJNOvkKavFlAVif08WliE81REj'; //Provide your oAuth Token
$oauth_token_secret = 'cBKeydlcsn3Fvp5InSX7V7BO9Z3GE1mym6AQFPHDAylWp'; //Provide your oAuth Token Secret


require_once('../tools/twitteroauth/twitteroauth.php');

$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
?>