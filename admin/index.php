<?php 
session_start();
include '../assets/php/PDO.php'; ?>
<?php include '../assets/php/header.php'; ?>
<?php include '../assets/php/nav.php'; ?>
<?php 
$pageid = 'admin';
try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    } ?>

<div class="container">

	<div class="row">
		<div class="col-md-12">
    		<?php include '../assets/php/message.php'; ?>    
		</div>
  		
  <div class="col-md-12 col-sm-12">
<div class="panel panel-info">
<div class="panel-heading">
  <h4>Administration</h4></div>  
      
      <div class="panel-body">
      <div class="col-md-3 col-sm-6 col-centered"><a href="?m=docs"><span class="glyphicon glyphicon-file adminicons"></span><br />
        <h5>Manage Documents</h5></a>
      </div>
      <div class="col-md-3 col-sm-6 col-centered"><a href="?m=users"><span class="glyphicon glyphicon-user adminicons"></span><br />
        <h5>Manage Users</h5></a>
      </div>
      <div class="col-md-3 col-sm-6 col-centered"><a href="?m=pages"><span class="glyphicon glyphicon-th-list adminicons"></span><br />
        <h5>Manage Page Content</h5></a>
      </div>
      <div class="col-md-3 col-sm-6 col-centered"><a href="?m=menus"><span class="glyphicon glyphicon-list-alt adminicons"></span><br />
        <h5>Manage Menus / Categories</h5></a>
      </div>
      </div></div>

  
  
  
<?php 

if($_GET['m'] == "docs"){

	$sth = $db->prepare('select * from QMS_Content');
	$sth->execute();
	?>
  

	   <div class="table-responsive">
       <a class="btn btn-default" data-toggle="modal" data-target="#adddoc">Add a Document</a>
		<table width="100%" align="center">
        	<thead>
            	<tr><th>ID</th><th>Title</th><th>Version</th><th>Updated</th><th>Category</th><th>Edit</th></tr>
            </thead>
            <tbody>
            	<?php while ($row = $sth->fetch()){ ?>
                <tr><td><?=$row['id']?></td><td><?=$row['doc-title']?></td><td><?=$row['doc-version']?></td><td><?=$row['doc-uploadedon']?></td><td><?=$row['doc-category']?></td><td><a class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
				<?php } ?>
            </tbody>
        </table>


		</div>

<?php }elseif ($_GET['m'] == "users") {
    
    
  
} elseif ($_GET['m'] == "pages") {
  
} elseif ($_GET['m'] == "menus"){

} else {
    echo "Dashboard";
    
}?>

   </div>
</div>
</div>
<?php 
	include '../assets/php/footer.php';
	$db = null;  
?> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!-- Latest compiled and minified JavaScript --> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
