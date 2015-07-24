<?php
$recherche = $_GET['search'];

$rq_select_tweet = $bdd->query("SELECT * FROM tweets WHERE message LIKE '%".$recherche."%' OR pseudo_twitter LIKE '%".$recherche."%' ORDER BY id_tweet_tweap DESC ") or die ('Fail INNNNNTTTTEEEERNNNAAAATIOOONAL');

$nb_res = $rq_select_tweet->rowCount();
if($nb_res == 0){
  echo "<div class='alert alert-danger'><h2>Nous somme désolé, votre recherche n'a retourné aucun resultat</h2></div>";
}else{ ?>
  <div id="recent_tweet">
    <?php
while ($data = $rq_select_tweet->fetch() ){
      $nom_twitter = $data['nom_twitter'];
      $pseudo_twitter = $data['pseudo_twitter'];
      $message = $data['message'];
      $id_tweet = $data['id_tweet'];
      $id_tweet_tweap = $data['id_tweet_tweap'];
      $id_ip = $_SESSION['id_ip'];
      $spread = $data['spread'];
      $view = $data['view'];

      $rq_verification_ip_outdated = $bdd->query("SELECT * FROM outdated WHERE id_tweet_tweap = '$id_tweet_tweap' AND id_ip = '$id_ip' ");
      $nb_ip_outdated = $rq_verification_ip_outdated->rowCount();

      $rq_verification_ip_spread = $bdd->query("SELECT * FROM spread WHERE id_tweet_tweap = '$id_tweet_tweap' AND id_ip = '$id_ip' ");
      $nb_ip_spread = $rq_verification_ip_spread->rowCount();

      ?>

      <div class="col-lg-3 col-md-6">

        <div class="panel panel-default">

          <div style="min-height: 180px; max-height: 180px;" class="panel-heading">
            <img src="<?php echo $data['img']; ?>" />
            <b class="text-tweap h3"><?php echo $data['pseudo_twitter']; ?></b>
            <br /><br />
            <p><?php echo parsecontent(substr($data['message'], 0, 200)); ?></p>
          </div>

          <div class="panel-footer">
            <center>
                <?php  if($nb_ip_outdated <> 0){ ?>
                  <a  id="recent_outdated_<?php echo $id_tweet_tweap; ?>" class="btn disabled"><span class="text-tweap glyphicon glyphicon-remove-circle"></span></a>
                <?php }else{ ?>
                  <a  id="recent_outdated_<?php echo $id_tweet_tweap; ?>" class="btn"><span class="text-tweap glyphicon glyphicon-remove-circle"></span></a>
                <?php } ?>

                <a data-toggle="modal" href="#" data-target="#recent_modal_vue_tweet_<?php echo $data['id_tweet']; ?>" id="recent_view_<?php echo $id_tweet_tweap; ?>" name="recent_view_<?php echo $id_tweet_tweap; ?>" class="btn"><span class="text-tweap glyphicon glyphicon-eye-open"></span></a>
                <!-- Modal Vue_Tweet-->
                <div id="recent_modal_vue_tweet_<?php echo $data['id_tweet']; ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">X</button>
                        <h4 class="modal-title text-info"><a href="http://twitter.com/<?php echo $nom_twitter; ?>/status/<?php echo $id_tweet; ?>">View on Twitter</a></h4>
                      </div>
                      <div class="modal-body">
                          <blockquote class="twitter-tweet" lang="fr"><p lang="fr" dir="ltr"><?php echo $message; ?></p>&mdash; <?php echo $pseudo_twitter; ?> (@<?php echo $nom_twitter; ?>) <a href="http://twitter.com/<?php echo $nom_twitter; ?>/status/<?php echo $id_tweet; ?>"><?php echo $data['data_twitter']; ?></a></blockquote>
                          <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

                          <center>
                            <a class="text-tweap btn"><b>Spread</b> <div class="badge"><?php echo $spread; ?></div></a>
                            <a class="text-tweap btn"><span class="glyphicon glyphicon-eye-open"></span> <div class="badge"><?php echo $view; ?></div></a>
                            <a class="text-tweap btn"><span class="glyphicon glyphicon-thumbs-up"></span> <div class="badge">1</div></a>
                            <a class="text-tweap btn"><span class="glyphicon glyphicon-thumbs-down"></span> <div class="badge">1</div></a>
                          </center>
                      </div>

                      <div class="modal-footer" style="height:100px;">
                        <center>
                          <div id="pub">
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
                        </center>
                      </div>
                    </div>

                  </div>
                </div> <!-- Fin de la modal vue_tweet --> 

               <?php  if($nb_ip_spread <> 0){ ?>
                  <button type="button" class="btn btn-warning disabled" style="width:82px;"><b style="color:white;"><?php echo $data['spread']; ?></b></button>
                <?php }else{ ?>
                    <button type="submit" name="recent_spread_<?php echo $id_tweet_tweap; ?>" id="recent_spread_<?php echo $id_tweet_tweap; ?>" class="btn btn-warning" style="width:82px;" ><b style="color:white;">SPREAD</b></button>
                <?php } ?>
                <input type="hidden" id="recent_id_tweet_tweap" name="recent_id_tweet_tweap" value="<?php echo $data['id_tweet_tweap']; ?>" />

                <a type="submit" class="btn"><span class="text-tweap glyphicon glyphicon-thumbs-up"></span></a>
                <a type="submit" class="btn"><span class="text-tweap glyphicon glyphicon-thumbs-down"></span></a>
            </center>
          </div>
        </div>
      </div>
      <script>
        $(function(){
          $('[data-toggle="tooltip"]').tooltip()

          $("#recent_spread_<?php echo $id_tweet_tweap; ?>").click(function(e){
                var id_tweet_<?php echo $id_tweet_tweap; ?> = <?php echo $id_tweet_tweap; ?>;

                $.ajax({
                  type : "POST",
                  url: 'modele/spread.php',
                  data: 'id_tweet_tweap=' + id_tweet_<?php echo $id_tweet_tweap; ?>,
                  dataType: 'json',
                  success : function(json) {
                      if(json.status == "ok"){
                        $("#recent_spread_<?php echo $id_tweet_tweap; ?>").replaceWith("<button type='button' class='btn btn-warning disabled' style='width:82px;'><b style='color:white;'>" + json.spread + "</b></button>")
                      }
                  },
                  error: function(json) {
                      alert('Le service est actuellement indisponible');
                  }
                }); 

          });
          $("#recent_view_<?php echo $id_tweet_tweap; ?>").click(function(e){
            var id_tweet_<?php echo $id_tweet_tweap; ?> = <?php echo $id_tweet_tweap; ?>;

                $.ajax({
                  type : "POST",
                  url: 'modele/view.php',
                  data: 'id_tweet_tweap=' + id_tweet_<?php echo $id_tweet_tweap; ?>,
                  dataType: 'json',
                  success : function(json) {
                      if(json.status == "ok"){

                      }
                  },
                  error: function(json) {
                      alert('Le service est actuellement indisponible');
                  }
                }); 
          });

          $("#recent_outdated_<?php echo $id_tweet_tweap; ?>").click(function(e){
            var id_tweet_<?php echo $id_tweet_tweap; ?> = <?php echo $id_tweet_tweap; ?>;

            $.ajax({
              type : "POST",
              url: 'modele/outdated.php',
              data: 'id_tweet_tweap=' + id_tweet_<?php echo $id_tweet_tweap; ?>,
              dataType: 'json',
              success : function(json) {
                  if(json.reponse == "ok"){
                    $("#recent_outdated_<?php echo $id_tweet_tweap; ?>").addClass('disabled');
                  }
              },
              error: function(json) {
                  alert('Le service est actuellement indisponible');
              }
            }); 

          });
        });
      </script>
    <?php } ?>
  </div>
<?php } ?>
