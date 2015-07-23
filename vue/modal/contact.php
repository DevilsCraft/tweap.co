<div class="modal-header">
	<button  type="button" class="close" data-dismiss="modal">X</button>
	<h4 class="modal-title text-gray-dark">Contact</h4>
</div>

<div class="modal-body">
	<div id="div_form_contact" name="div_form_contact">
		<p>
			<form enctype="multipart/form-data" id="form_contact" name="form_contact" action="modele/contact.php" method="post">

				<div id="div_pseudo_contact" class="form-group">
				  <label for="pseudo">Name <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
				  <input name="pseudo" id="pseudo" type="text" class="form-control" placeholder="" required />
				</div>

				<div id="div_email_contact" class="form-group">
				  <label for="email">Email <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
				  <input name="email" id="email" type="Email" class="form-control champ" placeholder="" required />
				</div>

				<div id="div_sujet_contact" class="form-group">
				  <label for="sujet">Subject <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
				  <input name="sujet" id="sujet" type="text" class="form-control champ" placeholder="" required />
				</div>

				<div id="div_message_contact" class="form-group">
				  <label for="message">Message <span class="glyphicon glyphicon-exclamation-sign" style="color:red;"></span></label>
				  <textarea class="form-control champ" rows="3" id="message" name="message" placeholder="Hello, i love tweap" required></textarea>
				</div>

				<button type="submit" id="submit_contact" class="btn btn-warning">Send <span class="glyphicon glyphicon-share-alt"></span></button>


			</form>
		</p>
	</div>

</div>

<div class="modal-footer">
	You can contact us at the following adress: <b>contact@tweap.co</b>
</div>

<script>
	$(function(){
		
		$('#submit_contact').click(function(e){
			e.preventDefault();

			var pseudo = $("#pseudo").val();
			var	sujet = $("#sujet").val();
			var	message = $("#message").val();
			var	email = $("#email").val();

			if(pseudo == ""){
				$("#div_pseudo_contact").addClass("has-error");
			}else if(email == ""){
				$("#div_email_contact").addClass("has-error");
			}else if(sujet == ""){
				$("#div_sujet_contact").addClass("has-error");
	        }else if(message == ""){
	        	$("#div_message_contact").addClass("has-error");
			}else{
				$(this).after('  <i id="chargement_contact" class="text-tweap fa fa-spinner fa-spin fa-2x"></i>');
				$.ajax({
				    type : "POST",
				    url: 'modele/contact.php',
				    data: 'pseudo=' + pseudo + '&email=' + email + '&sujet=' + sujet + '&message=' + message,
				    dataType: 'json',
				    success : function(json) {
				        if(json.reponse == 'ok'){
				    		$("#submit_contact").replaceWith('<h3 class="text-tweap">Votre message a bien été envoyé</h3>');
				        	$("#chargement_contact").remove();
				        }
				    },
				    error: function(json) {
				        alert('Le service est actuellement indisponible');
				        $("#chargement_contact").remove();
				    }
				});	
			}
		});
	});
</script>