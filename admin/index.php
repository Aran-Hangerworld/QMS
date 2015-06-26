<?php 
session_start();
if($_SESSION['isadmin'] <> 1){
    header('Location: http://www.hangerworld.co.uk/qms/index.php?err=100');
}
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
    include '../assets/php/uploadform.php';
	$sth = $db->prepare('select * from QMS_Content');
	$sth->execute();
	?>
  

	   <div class="table-responsive">
       <a class="btn btn-default" data-toggle="modal" data-target="#upload-form">Add a Document</a>
		<table width="100%" align="center" class="table">
        	<thead>
            	<tr><th>ID</th><th>Title</th><th>Version</th><th>Updated</th><th>Category</th><th>Edit</th></tr>
            </thead>
            <tbody>
            	<?php while ($row = $sth->fetch()){ ?>
                <tr><td><?=$row['id']?></td><td><?=$row['doc_title']?></td><td><?=$row['doc_version']?></td><td><?=$row['doc_uploadedon']?></td><td><?=$row['doc_category']?></td><td><a class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
				<?php } ?>
            </tbody>
        </table>


		</div>

<?php }elseif ($_GET['m'] == "users") {
    $sth = $db->prepare('select * from QMS_users');
	$sth->execute();
	?>
    <?php include'../assets/php/adduser.php'?>  
    <div class="table-responsive">
       <a class="btn btn-default" data-toggle="modal" data-target="#adduser">Add a user</a>
		<table width="100%" align="center" class="table">
        	<thead>
            	<tr><th>ID</th><th>Name</th><th>User</th><th>Last Login</th><th>Is Admin</th><th>Edit</th></tr>
            </thead>
            <tbody>
            	<?php while ($row = $sth->fetch()){ ?>
                <tr><td><?=$row['id']?></td><td><?=$row['QMS_RealName']?></td><td><?=$row['QMS_User']?></td><td><?=$row['QMS_lastlogin']?></td><td><?=$row['QMS_isadmin']?></td><td><a class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
				<?php } ?>
            </tbody>
        </table>


		</div>
    
 <?php
} elseif ($_GET['m'] == "pages") {
  
} elseif ($_GET['m'] == "menus"){

} elseif ($_GET['m'] == "mess"){
    
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
