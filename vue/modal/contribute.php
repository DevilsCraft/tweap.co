<?php session_start(); ?>
<!-- TACHE A FAIRE : Design JQUERY pour MOBILE -->
<meta charset="UTF-8">
<!-- FENETRE MODAL Tweap -->
<div class="modal-header">
	<button  type="button" class="close" data-dismiss="modal">X</button>
	<h4 class="modal-title text-gray-dark">Contribute</h4>
</div>

<div class="modal-body">
	<div class="notification" id="oups_url">Please enter a valid tweet link</div>
	<div class="notification" id="oups_pseudo_twitter">Merci de rentrer un pseudo valide</div>
	<div id="div_contribute">
		<?php if(isset($_SESSION['id_membre'])){ ?>

			<h4 class="text-tweap">Contribute to Tweap.co by using one of these two methods:</h4>
				<div class="well">
				Use the link of a particular tweet. Paste the link below:
				<br /><br />

				<div class="input-group">
					 <input name="url"  id="url" type="text" placeholder="Please enter a valid tweet link" class="form-control" /> 
					<span class="input-group-btn">
					<button type="submit" id="submit_contribute_url" class="btn btn-warning" type="button"><span class="glyphicon glyphicon-plus" style="color:white;"></span></button>
				</div><!-- /input-group -->

				<br />
				<img class="img-responsive img-thumbnail" src="tools/img/contribute.svg" alt="Tuto Contribute" />
				<b class="text-tweap">*</b><small> When accessing a tweet on Twitter, you can copy the link of this tweet by clicking on the ellipsis at the bottom of the box.</small>
			</div>
				<div class="well">
					Use the functionality <span data-toggle="tooltip" data-placement="top" title="Targeted search functionality" class="text-tweap glyphicon glyphicon-record"></span> to search for tweets relating to a specific Twitter account.
					<br />
					Enter the Twitter screen name below:
					<br /><br />

					<div class="input-group">
						 <input name="search_contribute"  id="search_contribute" type="text" placeholder="Tweapnws" class="form-control" /> 
						<span class="input-group-btn">
						<button type="submit" id="submit_contribute_search" class="btn btn-warning" type="button"><span class="glyphicon glyphicon-record"></span></button>
					</div><!-- /input-group -->

					<br />
					<ol>
						<li>Enter a Twitter screen name in the search bar, and then click submit to search.</li>
						<li>See tweets resulting from this research.</li>
						<li>Quickly add the tweet you want within our Boards.</li>
					</ol>

				</div>
			</div>
			<div id="div_search_contribute"></div>
	<?php }else{
		echo 'To contribute, you must first <a href="inscription" class="text-tweap"><b>Sign In</b></a>.'; // A Traduire
	} ?>
</div>
<div class="modal-footer">
	<b>By contributing, you accept the <a href="cgu" target="_blank" class="text-tweap">Terms & Conditions</a></b>
</div>
<script>
	$(function(){
		$("#contribute_success").hide();

		$('[data-toggle="tooltip"]').tooltip()

		$("#div_search_contribute").hide();

		$("#submit_contribute_url").click(function(e){

			var url = $("#url").val();
			$.ajax({
			    type : "POST",
			    url: 'modele/recuperation_tweet.php',
			    data: 'url=' + url,
			    dataType: 'json',
			    success : function(json) {
			    	if(json.reponse == "ok"){
			    		$('#modal_contribute').modal('hide');
			    	}else if(json.reponse == "oups_twitter.com"){
			    		$("#oups_url").each(function(){
							$(this).css('top', '94px');
			        		$("#oups_url").animate({'left':'183'});
			        		$("#oups_url").delay(10000).animate({'left': '-2000px'});
						});
			    	}
			    },
			    error: function(json) {
			        alert('Le service est actuellement indisponible');
			    }

			});	
		});

		$("#submit_contribute_search").click(function(e){
			 var pseudo_twitter = $("#search_contribute");

			$.ajax({
			    type : "POST",
			    url: 'modele/search_contribute.php',
			    data: 'pseudo_twitter=' + pseudo_twitter,
			    dataType: 'json',
			    success : function(json) {
			    	if(json.status == "ok"){
			    		$("#div_contribute").hide();
			    		
			    		$("#div_search_contribute").append('pseudo twitter : ' + json.pseudo_twitter);
			    		$("#div_search_contribute").fadeIn();
			    	}else{
			    		$("#oups_pseudo_twitter").each(function(){
							$(this).css('top', '94px');
			        		$("#oups_pseudo_twitter").animate({'left':'183'});
			        		$("#oups_pseudo_twitter").delay(10000).animate({'left': '-2000px'});
						});
			    	}
			    },
			    error: function(json) {
			        alert('Le service est actuellement indisponible');
			    }
			});	
		});
	});
</script>