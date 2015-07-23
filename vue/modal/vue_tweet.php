<?php
require_once('../../bdd.php');
$id_tweet = $data['id_tweet'];

$recuperation_vue = $bdd->query("SELECT * FROM tweets WHERE id_tweet = '$id_tweet'");
$data = $recuperation_vue->fetch();

$vue = $data['vue'];
$vue++;

$ajout_vue = $bdd->query("UPDATE tweets SET vue = '$vue' WHERE id_tweet = '$id_tweet' ");
$nom_twitter = $data['nom_twitter'];
$pseudo_twitter = $data['pseudo_twitter'];
$message = $data['message'];
?>
<meta charset="UTF-8">
<!-- FENETRE MODAL Tweap -->
<div class="modal-header">
	<button  type="button" class="close" data-dismiss="modal">X</button>
	<h4 class="modal-title text-info"><a href="http://twitter.com/<?php echo $nom_twitter; ?>/status/<?php echo $id_tweet; ?>" target="_blank">Voir sur twitter</h4>
</div>

<div class="modal-body">
	<blockquote class="twitter-tweet" lang="fr"><p lang="fr" dir="ltr"><?php echo $message; ?></p>&mdash; <?php echo $pseudo_twitter; ?> (@<?php echo $nom_twitter; ?>) <a href="http://twitter.com/<?php echo $nom_twitter; ?>/status/<?php echo $id_tweet; ?>"><?php echo $data['data_twitter']; ?></a></blockquote>
	<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>

<div class="modal-footer">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Tweap 468 x 60 -->
	<ins class="adsbygoogle"
	     style="display:inline-block;width:468px;height:60px"
	     data-ad-client="ca-pub-4036833234105270"
	     data-ad-slot="2335832740"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>