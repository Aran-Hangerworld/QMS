<?php include 'assets/php/PDO.php'; ?>
<?php include 'assets/php/header.php'; ?>
<?php include 'assets/php/nav.php'; ?>
<?php include 'assets/php/loginbox.php'; ?>
<?php include 'assets/php/scanforfiles.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
    		<?php include 'assets/php/message.php'; ?>    
		</div>
  		<div class="col-md-3 col-sm-12">
			<?php include 'assets/php/sidenav.php'; ?>  
        </div>
  <div class="col-md-9 col-sm-12">
  <?php
  	$pt = htmlspecialchars($_GET['Type']);
try {
	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }

	$sth = $db->prepare('CALL GetContent(?)');
	$contenttype = $pt;
	$sth->bindparam(1, $contenttype, PDO::PARAM_STR);
	$sth->execute();
	?>
  
  
  <h4>Policies</h4>
	   <div class="table-responsive">
		  <table class="table table-striped table-hover">
    			<tr>
                	<th>Policy</th><th>Issue</th><th>Date</th><th>Location</th>
                </tr>
				<tr>
                	<td>Quality</td><td>2</td><td>1/11/2014</td><td>Everywhere!</td>                  
                </tr>
				<tr>
                	<td>IT</td><td>1</td><td>16/12/2014</td><td>Everywhere!</td>                  
                </tr>
				<tr>
                	<td>Car Parking</td><td>3</td><td>12/12/2014</td><td>Everywhere!</td>                  
                </tr>
				<tr>
                	<td>Other</td><td>1</td><td>18/12/2014</td><td>Everywhere!</td>                  
                </tr>
		  </table>
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
