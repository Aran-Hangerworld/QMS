  <?php
	if($pageid <> 0){
  		$pt = htmlspecialchars($_GET['Type']);
	} else {
		$pt = htmlspecialchars($pageid);
	}
if(isset($_GET['err'])){
    $errcode = $_GET['err'];
    if($errcode=="100"){
        $errmsg = "YOU ARE NOT AUTHORISED TO VIEW THE ADMIN PAGE";   
    } elseif($errcode=="101"){
        $errmsg = "LOGIN FAILED. CHECK YOUR CREDENTIALS AND TRY AGAIN";   
    } elseif($errcode="102"){
        $errmsg = "YOU MUST BE LOGGED IN TO ACCESS THIS SECTION";   
                            }?>
    <div class="alert alert-danger alert-dismissable text-center">
		<?php echo $errmsg; ?>
     		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  		  </div>
<?php } else {

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
<?php } ?>
	