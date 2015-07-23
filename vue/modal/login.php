<!-- FENETRE MODAL Login -->
<div class="modal-header">
<button  type="button" class="close" data-dismiss="modal">X</button>
<h4 class="modal-title text-gray-dark">Login</h4>
</div>
<div class="modal-body">
<p>
	<form action="modele/connexion.php" method="post">

		<div id="div_pseudo_connexion" class="form-group">
	 		  <label for="pseudo">Pseudo <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
			  <input name="pseudo" id="pseudo" type="text" class="form-control" placeholder="" required />
		</div>

		<div id="div_mdp_connexion" class="form-group">
		  <label for="message">Password <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
		  <input name="mdp" id="mdp" type="password" class="form-control" required />
		</div>

		<p><b>When you connect, you accept the <a href="cgu" target="_blank" style="color: #6719b1;">Terms & Conditions</a></b></p>

		<button type="submit" class="btn btn-warning" id="submit_login">Sign In <span class="glyphicon glyphicon-share-alt"></span></button>

	</form>
</p>
</div>
<div class="modal-footer">
	Not registered yet? <a href="inscription" style="color: #6718b1;">Inscription</a> 
</div>
<script>
	$(function(){

		$("#submit_login").click(function(e){
			e.preventDefault();

			var pseudo = $("#pseudo").val();
			var	mdp = $("#mdp").val();

			if(pseudo == ""){
				$("#div_pseudo_connexion").addClass("has-error");
			}else if(mdp == ""){
				$("#div_mdp_connexion").addClass("has-error");
			}else{
				$(this).after('  <i id="chargement_login" class="text-tweap fa fa-spinner fa-spin fa-2x"></i>');
				$.ajax({
				    type : "POST",
				    url: 'modele/connexion.php',
				    data: 'pseudo=' + pseudo + '&mdp=' + mdp,
				    dataType: 'json',
				    success : function(json) {
				    	if(json.reponse == "ok"){
				    		location.reload();
				    	}else if(json.reponse == "oups_identifiant"){
				    		alert('Wrong username or password');
				    	}
				    	$("#chargement_login").remove();
				    },
				    error: function(json) {
				        alert('Le service est actuellement indisponible');
				        $("#chargement_login").remove();
				    }
				});	
			}

		});

	});
</script>