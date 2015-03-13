<?php include '../assets/php/PDO.php'; ?>
<?php include '../assets/php/header.php'; ?>
<?php include '../assets/php/loginbox.php'; ?>
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputEmail3" class="control-label">Email</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="inputPassword3" class="control-label">Password</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                               
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Close</a>
                        <a class="btn btn-primary">Save changes</a>
                    </div>
                </div>
            </div>
        </div>

<div class="container">

	<div class="row">
		<div class="col-md-12">
    		<?php include '../assets/php/message.php'; ?>    
		</div>
  		<div class="col-md-3 col-sm-12">

        </div>
  <div class="col-md-9 col-sm-12">
<?php 
	$sth = $db->prepare('select * from QMS_Content');
	$sth->execute();
	?>
  
  <h4>Administration</h4>
	   <div class="table-responsive">
       <a class="btn btn-default" data-toggle="modal" data-target="#adddoc">Add a Document</a>
		<table>
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
