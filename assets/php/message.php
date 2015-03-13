  <?php
	if($pageid <> 0){
  		$pt = htmlspecialchars($_GET['Type']);
	} else {
		$pt = htmlspecialchars($pageid);
	}
try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$msth = $db->prepare('CALL GetMessage(?)');
	$msth->bindparam(1, $pt, PDO::PARAM_STR);
	$msth->execute();
	while ($row = $msth->fetch()){
		?>
		<div class="<?php echo $row['type']?> <?php echo $row['type']?>-warning <?php echo $row['type']?>-dismissable text-center">
		<?php echo $row['message']?>
     		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		  </div>
<?php } ?>
	