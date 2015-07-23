<?php
/**
 * Description : Déconnexion de L'utilisateur
 * Crée le 12/07/2015
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */
session_start();

session_destroy();

header('location: /index.php');
