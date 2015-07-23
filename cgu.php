<?php



// ini_set('display_errors', 1); 

// ini_set('log_errors', 1); 

// ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 

// error_reporting(E_ALL); 

/**
 * Descirption : Condition Général D'utilisation de l'application Tweap
 * Crée le 11/07/2015
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */

require_once('tools/head_php.php');

?>

<!DOCTYPE html>

<html>

<head>

	<meta name="description" content="Tweap.co Terms and Conditions" />

	<?php include('tools/head.html'); ?>

	<title>Tweap || Terms & Conditions</title>

</head>

<body>

	<?php include_once('tools/google_stats.html'); ?>

	<div class="container-fluid">

		<header>

			<?php include('tools/menu.html'); ?>

		</header>

                

    <section>

      <?php include('vue/cgu.php'); ?>

    </section>

      

    <footer>

      <?php include('tools/footer.html'); ?>

    </footer>



	</div>



</body>

</html>