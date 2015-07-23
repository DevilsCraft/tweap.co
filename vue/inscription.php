<div class="row">

	<fieldset class="col-lg-5">
		<legend>Connexion</legend>

		<form action="modele/connexion.php" method="post">

			<div id="div_pseudo_connexion" class="form-group">
		 		  <label for="pseudo_connexion">Name <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
				  <input name="pseudo_connexion" id="pseudo_connexion" type="text" class="form-control" placeholder="" required />
			</div>

			<div id="div_mdp_connexion" class="form-group">
			  <label for="mdp_connexion">Password <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
			  <input name="mdp_connexion" id="mdp_connexion" type="password" class="form-control" required />
			</div>

			<button type="submit" class="btn btn-warning" name="submit_connexion" id="submit_connexion">Sign In <span class="glyphicon glyphicon-share-alt"></span></button>

		</form>
	</fieldset>

	<fieldset class="col-lg-6">
		<legend>Inscription</legend>
		<form action="modele/inscription.php" method="post">

			<div id="div_pseudo_inscription" class="form-group">
		 		  <label for="pseudo_inscription">Pseudo <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
				  <input name="pseudo_inscription" id="pseudo_inscription" type="text" class="form-control" placeholder="" required />
			</div>

			<div id="div_mdp_inscription" class="form-group">
			  <label for="mdp_inscription">Password <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
			  <input name="mdp_inscription" id="mdp_inscription" type="password" class="form-control" required />
			</div>

			<div id="div_mdp_verif_inscription" class="form-group">
			  <label for="mdp_verif_inscription">Password (verification) <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
			  <input name="mdp_verif_inscription" id="mdp_verif_inscription" type="password" class="form-control" required />
			</div>

			<div id="div_email_inscription" class="form-group">
		 		  <label for="email_inscription">Email <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
				  <input name="email_inscription" id="email_inscription" type="email" class="form-control" placeholder="" required />
			</div>
			<p><b>When you connect, you accept the <a href="vue/modal/cgu.php" class="text-tweap" data-toggle="modal" data-target="#modal_cgu">Terms & Conditions</a></b></p>
				<div class="modal fade" id="modal_cgu">
		          <div class="modal-dialog"> 
		            <div class="modal-content"></div>  
		          </div>
		        </div> 
			<button type="submit" id="submit_inscription" class="btn btn-warning">Sign Up <span class="glyphicon glyphicon-share-alt"></span></button>

		</form>
		<br /><br /><br /><br />&nbsp;
	<fieldset>
</div>
<script>
	$(function(){
		$("#submit_connexion").click(function(e){
			e.preventDefault();

			var pseudo = $("#pseudo_connexion").val();
			var mdp = $("#mdp_connexion").val();

			if(pseudo == ""){
				$("#div_pseudo_connexion").addClass("has-error");
			}else if(mdp == ""){
				$("#div_mdp_connexion").addClass("has-error");
			}else{
				$(this).after('  <i id="chargement_connexion" class="text-tweap fa fa-spinner fa-spin fa-2x"></i>');
				$.ajax({
				    type : "POST",
				    url: 'modele/connexion.php',
				    data: 'pseudo=' + pseudo + '&mdp=' + mdp,
				    dataType: 'json',
				    success : function(json) {
				    	if(json.reponse == "ok"){
				    		document.location.href="index" 
				    	}else if(json.reponse == "oups_identifiant"){
				    		alert('Mauvais identifiant ou mots de passe');
				    	}
				    	$("#chargement_connexion").remove();
				    },
				    error: function(json) {
				        alert('Le service est actuellement indisponible');
				        $("#chargement_connexion").remove();
				    }
				});	
			}
		});

		$("#submit_inscription").click(function(e){
			e.preventDefault();
			var pseudo = $("#pseudo_inscription").val();
			var mdp = $("#mdp_inscription").val();
			var mdp_verif = $("#mdp_verif_inscription").val();
			var email = $("#email_inscription").val();

			if(pseudo == ""){
				$("#div_pseudo_inscription").addClass("has-error");
			}else if(mdp == ""){
				$("#div_mdp_inscription").addClass("has-error");
			}else if(email == ""){
				$("#div_email_inscription").addClass("has-error");
			}else if(mdp != mdp_verif){
				$("#div_mdp_verif_inscription").addClass("has-error");
			}else{
				$(this).after('  <i id="chargement_inscription" class="text-tweap fa fa-spinner fa-spin fa-2x"></i>');
				$.ajax({
				    type : "POST",
				    url: 'modele/inscription.php',
				    data: 'pseudo=' + pseudo + '&mdp=' + mdp + '&mdp_verif=' + mdp_verif + '&email=' + email,
				    dataType: 'json',
				    success : function(json) {
				    	if(json.reponse == "ok"){
				    		$("#submit_inscription").replaceWith("<h2 class='text-tweap'>Un email recapitulatif vous a été envoyé</h2>");
				    	}else if(json.reponse == "oups_email"){
				    		alert('Merci de rentrer une email valide !');
				    	}else if(json.reponse == "oups_send_email"){
				    		$("#submit_inscription").replaceWith("Merci de vous inscription");
				    	}
				    	$("#chargement_inscription").remove();
				    },
				    error: function(json) {
				        alert('Le service est actuellement indisponible');
				        $("#chargement_inscription").remove();
				    }
				});	
			}
		});
	});
</script>