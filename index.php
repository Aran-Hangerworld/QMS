<?php include 'assets/php/PDO.php'; ?>
<?php include 'assets/php/header.php'; ?>
<?php include 'assets/php/nav.php'; ?>
<?php include 'assets/php/loginbox.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
    		<?php 
			$pageid = 0;
			include 'assets/php/message.php'; ?>    
		</div>
  		<div class="col-md-3 col-sm-12">
			<?php include 'assets/php/sidenav.php'; ?>  
        </div>
  <div class="col-md-9 col-sm-12">
    <div class="jumbotron">
      <h1>Quality Management</h1>
      <p>Quality management ensures that an organization, product or service is consistent. It has four main components: quality planning, quality control, quality assurance and quality improvement.</p>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-6 col-centered"> <span class="glyphicon glyphicon-user test"></span><br />
        <h4>Customer Services</h4>
      </div>
      <div class="col-md-3 col-sm-6 col-centered"> <span class="glyphicon glyphicon-ok test"></span><br />
        <h4>QMS</h4>
      </div>
      <div class="col-md-3 col-sm-6 col-centered"> <span class="glyphicon glyphicon-th-large test"></span><br />
        <h4>Memos</h4>
      </div>
      <div class="col-md-3 col-sm-6 col-centered"> <span class="glyphicon glyphicon-link test"></span><br />
        <h4>Other?</h4>
      </div>
    </div>
 
    <div class="row">
      <div class="divider"></div>
      <div class="col-md-12 col-sm-12">
        <hr class="small">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi feugiat urna sit amet laoreet ultricies. Vivamus vel ornare lectus. Duis imperdiet neque a interdum interdum. Cras gravida, nibh vitae lacinia pharetra, enim tortor aliquet eros, id gravida ante mauris a arcu. Mauris fermentum tincidunt nisi, eget volutpat justo facilisis nec. Pellentesque volutpat ultrices ultrices. </p>
        <p>In non imperdiet turpis. Nam enim est, vulputate ut elit sed, bibendum vehicula orci. Nullam imperdiet ipsum euismod cursus malesuada. Sed lectus velit, convallis a justo vel, pulvinar vestibulum urna. Fusce vitae pretium leo, sed eleifend diam. Nulla semper eu quam ut sollicitudin. Curabitur dictum ante et ornare fermentum. Morbi eleifend placerat nisl, ut finibus nibh elementum eget. Ut quis dapibus urna. Cras a libero aliquam, maximus nibh nec, mattis leo.</p>
      </div>
    </div>
  </div>
</div>
</div>
<?php 
	include 'assets/php/footer.php'; 
	$db = null;  
?>  
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!-- Latest compiled and minified JavaScript --> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
