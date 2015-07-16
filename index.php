<?php
    session_start();
if(isset($_SESSION['isadmin'])){
    $isadmin = $_SESSION['isadmin'];
}
    include 'assets/php/PDO.php'; 
    include 'assets/php/header.php';
    include 'assets/php/loginform.php'; 
    include 'assets/php/nav.php'; 
?>
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
    <?php 
try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth = $db->prepare('select * from QMS_pagecontent where refid = 0');
	$sth->execute(); 
	while ($row = $sth->fetch()){
		?>
    <div class="col-md-9 col-sm-12">
      <div class="jumbotron">
        <h1>
          <?=$row['jumbotron_title']?>
            <?=$_Session['user']?>
        </h1>
        <p>
          <?=$row['jumbotron_content']?>
        </p>
      </div>
  <!--    <div class="row">
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
      </div> -->
      <div class="row">
        <div class="divider"><hr class="small"></div>
        <div class="col-md-12 col-sm-12">
            <?php if(!isset($_SESSION['lastlogin'])){
            echo "<h1>Please log in to see latest updates</h1>";
        } else { ?>
            <h1>Latest Updates</h1>
            <table class="table-hover" id="updatetable" style="width: 100%">
                <thead><th>Doc Title</th><th>Doc Category</th><th>Updated On</th><th>Updated By</th></thead><tbody>
          <?php 
	       try {
		      $db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
		   } catch(Exception $e)  {
		      print "Error!: " . $e->getMessage();
	       }
	       $sthUpdates = $db->prepare('CALL QMS_Updates(?,?)');
            echo "<h1>".$_SESSION['lastlogin']."</h1><h2>".date('Y-m-d', time())."</h2>";
	       $sthUpdates->bindparam(1, $_SESSION['lastlogin'], PDO::PARAM_STR);
	       $sthUpdates->bindparam(2, date( 'Y-m-d', time() ), PDO::PARAM_STR);    
	       $sthUpdates->execute();  
            while ($updaterow = $sthUpdates->fetch()){ ?>    
                <tr><td><?=$updaterow['doc_title']?></td><td><?=$updaterow['doc_category']?></td><td><?=$updaterow['doc_uploadedon']?></td><td><?=$updaterow['doc_uploadedby']?></</td></tr>    
            <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
      </div>
      <?php } ?>
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

