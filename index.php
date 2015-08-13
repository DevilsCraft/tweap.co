<?php
/**
 * Descirption : Index du site Tweap.co
 * Crée le 30/06/2015
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */
require_once('tools/head_php.php');
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
			<?php include('vue/index.php'); ?>
		</section>

		<footer>
			<?php include('tools/footer.html'); ?>
		</footer>
	</div>
</body>
</html>
