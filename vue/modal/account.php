<?php session_start();

require_once('../../bdd.php'); 

$id_membre = $_SESSION['id_membre'];

$rq_recuperation_contributions = $bdd->query("SELECT * FROM tweets WHERE id_membre = '$id_membre'") or die('Erreurs lors de la récuperation de vos contributions');

$nb_contribution = $rq_recuperation_contributions->rowCount();

?>



<!-- FENETRE MODAL Account -->

<div class="modal-header">

	<button  type="button" class="close" data-dismiss="modal">X</button>

	<h4 class="modal-title text-gray-dark">Account</h4>

</div>



<div class="modal-body">

	<ul class="nav nav-tabs">

		<li class="active"><a href="#profile" data-toggle="tab" class="text-tweap">Profile</a></li>

		<li><a href="#historique" data-toggle="tab" class="text-tweap">Logfile</a></li>

		<li><a href="#edit_membre" data-toggle="tab" class="text-tweap">Edit Profile</a></li>

	</ul>

	<div class="tab-content">

		<div class="tab-pane active" id="profile">

			<h3 class="text-tweap">Hello <?php echo $_SESSION['pseudo']; ?>,</h2>



			<div class="well">

				<b class="text-tweap h4">My Profile</b>

				<br /><br />

				<b>Nickname</b>: <?php echo $_SESSION['pseudo']; ?>

				<br />

				<b>Email</b>: <?php echo $_SESSION['email']; ?>

			</div>



			<div class="well">

				<b class="text-tweap h4">My Statistics</b>

				<br /><br />

				<b>Spread</b>: <?php echo $_SESSION['spread']; ?>

				<br />

				<b>Views</b>: <?php echo $_SESSION['view']; ?>

				<br />

				<b>Like</b>: --

				<br />

				<b>Dislike</b>: --

			</div>

			<br />



		</div>



		<div class="tab-pane" id="historique">

			<h3 class="text-tweap">You shared <b class="text-tweap"><?php echo $nb_contribution; ?></b> tweets</h2>

			<?php if($nb_contribution == 0){

				echo "<h4>You have not shared tweets yet</h4>";

			}else{

				while($data_contributions = $rq_recuperation_contributions->fetch()){

					    $nom_twitter = $data_contributions['nom_twitter'];

					    $pseudo_twitter = $data_contributions['pseudo_twitter'];

					    $message = $data_contributions['message'];

					    $id_tweet = $data_contributions['id_tweet'];

					    $view = $data_contributions['view'];

					    $spread = $data_contributions['spread']; ?>

					    

					   	<div class="panel panel-default">

					   		<div style="min-height: 180px; max-height: 180px;" class="panel-heading">

					          	<img src="<?php echo $data_contributions['img']; ?>" />

					          	<b class="h3 text-tweap"><?php echo $data_contributions['pseudo_twitter']; ?></b>

					          	<br /><br />

					          	<p><?php echo parsecontent(substr($data_contributions['message'], 0, 200)); ?></p>

				          	</div>



				        	<div class="panel-footer">

					        	<center>

						        	<a class="text-tweap btn"><b>Spread</b> <div class="badge"><?php echo $spread; ?></div></a>

						        	<a class="text-tweap btn"><span class="glyphicon glyphicon-eye-open"></span> <div class="badge"><?php echo $view; ?></div></a>

						        	<a class="text-tweap btn"><span class="glyphicon glyphicon-thumbs-up"></span> <div class="badge">1</div></a>

						        	<a class="text-tweap btn"><span class="glyphicon glyphicon-thumbs-down"></span> <div class="badge">1</div></a>

								</center>

							</div>

						</div>

				<?php }

			} ?>



		</div>

		

		<div class="tab-pane" id="edit_membre">

			<form action="modele/edit_membre.php" method="post">



				<div id="div_pseudo_edit_membre" class="form-group">

			 		  <label for="pseudo_edit_membre">Name <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>

					  <input name="pseudo_edit_membre" id="pseudo_edit_membre" type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['pseudo']; ?>" required />

				</div>



				<div id="div_mdp_edit_membre" class="form-group">

				  <label for="mdp_edit_membre">Password <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>

				  <input name="mdp_edit_membre" id="mdp_edit_membre" type="text" class="form-control" value="<?php echo $_SESSION['mdp']; ?>" required />

				</div>



				<div id="div_mdp_verif_edit_membre" class="form-group">

				  <label for="mdp_verif_edit_membre">Password (verification) <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>

				  <input name="mdp_verif_edit_membre" id="mdp_verif_edit_membre" type="password" class="form-control" required />

				</div>



				<div id="div_email_edit_membre" class="form-group">

			 		  <label for="email_edit_membre">Email <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>

					  <input name="email_edit_membre" id="email_edit_membre" type="email" class="form-control" placeholder="" value="<?php echo $_SESSION['email']; ?>" required />

				</div>



				<button type="submit" id="submit_edit_membre" class="btn btn-warning">Edit <span class="glyphicon glyphicon-edit"></span></button>

			</form>

		</div>

	</div>

</div>



<div class="modal-footer" style="">

	<a class="btn btn-danger" href="deconnexion">Log Out</a>

</div>



<?php

function parsecontent($text) { // Pour transformer les liens

    $text = preg_replace('#http://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text); //Link

    $text = preg_replace('#@([a-z0-9_]+)#i', '@<a  target="_blank" href="http://twitter.com/$1">$1</a>', $text); //usernames

    $text = preg_replace('# \#([a-z0-9_-]+)#i', ' #<a target="_blank" href="http://search.twitter.com/search?q=%23$1">$1</a>', $text); //Hashtags

    $text = preg_replace('#https://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text); //Links

    return $text;

} ?>

<script>

	$(function(){

		$("#submit_edit_membre").click(function(e){

			e.preventDefault();



			var pseudo = $("#pseudo_edit_membre").val();

			var mdp = $("#mdp_edit_membre").val();

			var mdp_verif = $("#mdp_verif_edit_membre").val();

			var email = $("#email_edit_membre").val();



			if(pseudo == ""){

				$("#div_pseudo_edit_membre").addClass("has-error");

			}else if(mdp == ""){

				$("#div_mdp_edit_membre").addClass("has-error");

			}else if(email == ""){

				$("#div_email_edit_membre").addClass("has-error");

			}else if(mdp != mdp_verif){

				$("#div_mdp_verif_edit_membre").addClass("has-error");

			}else{

				$(this).after('  <i id="chargement_edit_membre" class="text-tweap fa fa-spinner fa-spin fa-2x"></i>');

				$.ajax({

				    type : "POST",

				    url: 'modele/edit_membre.php',

				    data: 'pseudo=' + pseudo + '&mdp=' + mdp + '&mdp_verif=' + mdp_verif + '&email=' + email,

				    dataType: 'json',

				    success : function(json) {

				    	if(json.reponse == "ok"){

				    	$("#submit_edit_membre").replaceWith("<h3 class='text-tweap'>Your account has been modified</h3>");

				    	}else if(json.reponse == "oups_email"){

				    		alert('Merci de rentrer une email valide !');

				    	}else if(json.reponse == "oups_send_email"){

				    	$("#submit_edit_membre").replaceWith("<h3 class='text-tweap'>Your account has been modified</h3>");

				    	}

				    	$("#chargement_edit_membre").remove();

				    },

				    error: function(json) {

				        alert('Le service est actuellement indisponible');

				  		$("#chargement_edit_membre").remove();

				    }

				});	

			}

		});

	});