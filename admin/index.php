<?php 
session_start();
if($_SESSION['isadmin'] <> 1){
    header('Location: http://www.hangerworld.co.uk/qms/index.php?err=100');
}
include '../assets/php/PDO.php'; ?>
<?php include '../assets/php/header.php'; ?>
<?php include '../assets/php/nav.php'; ?>
<?php include '../assets/php/functions.php'; ?>
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
     try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth = $db->prepare('select * from QMS_Content');
	$sth->execute();
	?>
	   <div class="table-responsive">
       <a class="btn btn-default" data-toggle="modal" data-target="#upload-form" style="position: relative; top:25px; left:400px;"><span class="glyphicon glyphicon-plus" style="font-size:1em;"></span>Add a Document</a>
		<table width="100%" align="center" class="table" id="doctable">
        	<thead>
            	<tr><th>ID</th><th>Title</th><th>Version</th><th>Updated</th><th>Category</th><th>Edit</th></tr>
            </thead>
            <tbody>
            	<?php while ($row = $sth->fetch()){ ?>
<<<<<<< HEAD
                <tr><td><?=$row['id']?></td><td><?=$row['doc_title']?></td><td><?=$row['doc_version']?></td><td><?=$row['doc_uploadedon']?></td><td><?php $txtcat = parse_category($row['doc_category'], $db); ?><?=$txtcat['Title']?></td><td><a class="btn-sm btn-warning"><span class="glyphicon glyphicon-edit" style="font-size:1em"></span></a></td></tr>
=======
                 <div class="modal fade editdoc<?=$row['doc_id']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header ">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Edit Document</h4>
                </div>
                <div class="modal-body">
                  <div id="edit-user-form">
                    <form class="form-horizontal<?=$row['doc_id']?>" role="form" id="update<?=$row['doc_id']?>">
                      <input type="hidden" name="id" id="id" value="<?=$row['doc_id']?>">
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="username" class="control-label"> Title</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" value="<?=$row['doc_title']?>" class="form-control" name="title">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="name" class="control-label">Version</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" value="<?=$row['doc_version']?>" class="form-control" name="version">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="email" class="control-label">Updated</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" value="<?=$row['doc_uploadedby']?>" class="form-control" name="uploaded">
                        </div>
                      </div>
                      <?php    
			$sth = $db->prepare('select * from QMS where location = "s"'); 
			$sth->execute();  
			?>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="dept" class="control-label">Department</label>
                        </div>
                        <div class="col-sm-10">
                          <select class="form-control" id="category" name="category">
                            <?php  while ($catrow = $sth->fetch()){  ?>
                            <option value="<?=$catrow['id']?>" <?php if($row['doc_id'] == $catrow['id']){ echo "Selected";} ?>>
                            <?=$catrow['title']?>
                            </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="isadmin" class="control-label">Status (Active)</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="checkbox" class="checkbox" name="isactive" <?php if($row['doc_status'] == 1){echo "Checked";}?>  value="1" />
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <div id="success-buttons<?=$row['id']?>" style="display: none">
                    <div class="alert alert-dimissable alert-success" style="display: none;" id="update-success<?=$row['doc_id']?>">User Details Changed!</div>
                    <button type="button" class="btn btn-default refresh" data-dismiss="modal">Continue</button>
                  </div>
                  <div id="modal-buttons<?=$row['doc_id']?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edituser" id="<?=$row['doc_id']?>">Update</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
                <tr><td><?=$row['doc_id']?></td><td><?=$row['doc_title']?></td><td><?=$row['doc_version']?></td><td><?=$row['doc_uploadedon']?></td><td>
                      <?php
            $sth = $db->prepare('SELECT Title FROM QMS_nav where ID = '. $row['doc_category']);
	        $sth->execute();
	        while ($row = $sth->fetch()){
                $cattxt = $row['Title'];
            }
            echo $cattxt;
                    ?>
                    </td><td><button class="btn-sm btn-warning" data-target="#editdoc<?=$row['doc_id']?>"><span class="glyphicon glyphicon-edit" style="font-size:1em"></span></button></td></tr>
>>>>>>> Bens
				<?php } ?>
            </tbody>
        </table>


		</div>

<?php } elseif ($_GET['m'] == "users"){
    include '../assets/php/adduserform.php';
    try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
    $sth = $db->prepare('select * from QMS_users');
	$sth->execute();
	?>
    
    <div class="table-responsive">
       <a class="btn btn-default" data-toggle="modal" data-target="#adduserform" style="position: relative; top:25px; left:400px;"><span class="glyphicon glyphicon-plus" style="font-size:1em;"></span>Add a user</a>
		<table width="100%" align="center" class="table" id="usertable">
        	<thead>
            	<tr><th>ID</th><th>User</th><th>Name</th><th>Email Address</th><th>Last Login</th><th>Admin</th><th>Edit</th></tr>
            </thead>
            <tbody>
            	<?php while ($row = $sth->fetch()){ ?>
                <tr><td><?=$row['QMS_id']?></td><td><?=$row['QMS_user']?></td><td><?=$row['QMS_realname']?></td><td><?=$row['QMS_email']?></td><td><?=$row['QMS_lastlogin']?></td><td>
                    <?php if($row['QMS_isadmin'] =="1"){ ?><span class="glyphicon glyphicon-ok" style="font-size:1em"></span> 
                    <?php } else { ?>
                    <span class="glyphicon glyphicon-remove" style="font-size:1em"></span> 
                    <?php } ?>
                    </td><td><a class="btn-sm btn-warning" id="userbtn"><span class="glyphicon glyphicon-edit" style="font-size:1em"></span></a></td></tr>
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
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script> 
 
<script>
$(document).ready(function(){
    $('#usertable').DataTable();
});
    
    $(document).ready(function(){
    $('#doctable').DataTable();
});

</script>
</body>
</html>
