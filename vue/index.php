<article>
  <center><a href="/"><img src="tools/img/logo.svg" class="img-responsive" alt="Tweap.co"/></a></center>

  <br/>

   <div class="row">

     <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
      <form action="index" method="get">
         <div class="input-group">
           <input name="search" type="text" value="" placeholder="Search" value="<?php echo $_SESSION['search_url']; ?>" class="form-control" /> 
          <span class="input-group-btn">
          <button type="submit" class="btn btn-warning" type="button"><span class="glyphicon glyphicon-send" style="color:white;"></span></button>
        </div><!-- /input-group -->
      </form>
      <br />
      <center>
        <ul class="nav nav-pills nav-justified">
          <li role="presentation" class="active"><a style="width: 100px;"  id="button_pills_all" href="#pills_all" data-toggle="tab">ALL</a></li>
          <li role="presentation"><a href="#pills_popular" style="width: 100px;" data-toggle="tab">POPULAR</a></li>
          <li role="presentation"><a href="#pills_recent" style="width: 100px;" data-toggle="tab">RECENT</a></li>
        </ul>
      </center>
    </div><!-- /.col-lg-4 -->
  </div><!-- /.row -->

</article>
<br />
<br />
<div class="tab-content">
  <div class="tab-pane fade in active" id="pills_all"><?php include('vue/all_tweet.php'); ?></div>
  <div class="tab-pane fade" id="pills_popular"></div>
  <div class="tab-pane fade" id="pills_recent"><?php include('vue/recent_tweet.php'); ?></div>
</div>