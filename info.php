<?php
/**
 * Descirption : Page pour afficher des message si besoin avec l'url
 * Crée le 23/07/2015
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */
extract($_GET);
require_once('tools/head_php.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('tools/head.html'); ?>
	<meta name="google-site-verification" content="IExM4BDYL_3ACbwFqlfoU4MW5W26YSJtfBUiOJTxXfs" />
	<title>Tweap</title>
</head>
<body>
	<?php include_once('tools/google_stats.html'); ?>
	<div class="container-fluid">
		<header>
			<?php include('tools/menu.html'); ?>
		</header>
                
    <section>
    	<?php if($parametre == 'verifier'){ ?>
	    	<div class="well">
	      		<h1 class="text-tweap">Votre compte a bien été verifier</h1>
	    	</div>
    		<?php include('vue/inscription.php');
    	}else if($parametre == 'non_verifier'){
    		echo "<div class='well'><h1 class='text-tweap'> Votre compte n'a pas encore été verfié, merci de verifier votre boite mail</h1></div>";
    		include('vue/inscription.php');
    	}else if($parametre == "contribute_ok"){
            echo "<div class='well'><h3 class='text-tweap'>Votre tweet a bien été ajouté</h2></div>";
    		include('vue/index.php');
    	}else if($parametre == "edit_membre_ok"){
            echo "<div class='well'><h3 class='text-tweap'>Your account has been modified</h3></div>";
            include('vue/index.php');
        }else{
            include('vue/index.php');
        }  ?>
    </section>
      
    <footer>
      <?php include('tools/footer.html'); ?>
    </footer>

	</div>

</body>
</html>