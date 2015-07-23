<?php
/**
 * Desription : Page pour s'inscrire et se connecter si erreurs dans la modal
 * Crée le 05/07/2015
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */
require_once('bdd.php');
session_start();
require_once('modele/recuperation_ip.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="description" content="Tweap.co, Venez vous inscrire !" />
	<?php include('tools/head.html'); ?>
	<title>Tweap || Register</title>
</head>
<body>
  
	<div class="container-fluid">
		<header>
			<?php include('tools/menu.html'); ?>
		</header>
                
    <section>
      <?php include('vue/inscription.php'); ?>
    </section>
      
    <footer>
      <?php include('tools/footer.html'); ?>
    </footer>

	</div>

</body>
</html>