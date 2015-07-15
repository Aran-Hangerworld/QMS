<?php 
session_start();
if($_SESSION['isadmin'] <> 1){
    header('Location: http://www.hangerworld.co.uk/qms/index.php?err=100');
}
include '../assets/php/PDO.php';
include '../assets/php/header.php'; 
include '../assets/php/nav.php';
include '../assets/php/functions.php';
include '../assets/php/reversedate.php';
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
    </div>  		
    <div class="row">
  <div class="col-md-12 col-sm-6">
      <div class="panel panel-info col-centered">
          <div class="panel-body col-centered">
      <div class="col-md-2 col-sm-4 col-centered"><a href="?m" data-toggle="tooltip" data-placement="bottom" title="Dashboard"><span class="glyphicon glyphicon-cog adminicons"></span><br />
        <h5></h5></a>
      </div>    
      <div class="col-md-2 col-sm-4 col-centered"><a href="?m=docs" data-toggle="tooltip" data-placement="bottom" title="Manage Documents"><span class="glyphicon glyphicon-file adminicons"></span></a>
      </div>
      <div class="col-md-2 col-sm-4 col-centered"><a href="?m=users" data-toggle="tooltip" data-placement="bottom" title="Manage Users"><span class="glyphicon glyphicon-user adminicons"></span></a>
      </div>
      <div class="col-md-2 col-sm-4 col-centered"><a href="?m=pages" data-toggle="tooltip" data-placement="bottom" title="Manage Page Content"><span class="glyphicon glyphicon-th-list adminicons"></span></a>
      </div>
      <div class="col-md-2 col-sm-4 col-centered"><a href="?m=menus" data-toggle="tooltip" data-placement="bottom" title="Manage Menus / Categories"><span class="glyphicon glyphicon-list-alt adminicons"></span></a>
      </div>
      </div>  
        </div>
    </div>
    </div>
<?php 
if($_GET['m'] == "docs"){
    include '../assets/php/uploadform.php';
     try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
    if(isset($_GET['catfilter']) && strlen($_GET['catfilter']) == 1){
        $c = strip_tags($_GET['catfilter']);
        $c = intval($c);
        $qstr = " AND doc_category = $c";
    }
    if(isset($_GET['f'])){
        $f = intval($_GET['f']);
        if($f == 0){
            $q = "select * from QMS_Content where doc_status = 0";    
        }
    } else {
        $q = "select * from QMS_Content where doc_status = 1"; 
    }
    if(isset($qstr)){
        $q .= $qstr;
    }
	$sth = $db->prepare($q);
    $sth->execute(); ?> <a class="btn btn-default" data-toggle="modal" data-target="#upload-form" style="margin:5px;"><span class="glyphicon glyphicon-plus" style="font-size:1em;"></span>Add a Document</a>
    <a href="?m=docs&f=1" class="btn btn-default">Active Docs</a><a href="?m=docs&f=0" class="btn btn-default">Inactive Docs</a>
    <div class="btn-group">
        <select class="form-control" id="catfilter">
            <option disabled selected> Filter By Category</option>
 <?php
            $sth2 = $db->prepare('SELECT ID, Title FROM QMS_nav where Location = "s"');
	        $sth2->execute();
	        while ($crow = $sth2->fetch()){
                echo "<option value='".$crow['ID']."'>".$crow['Title']."</option>";
            } ?>
        </select>
    </div>
   	<div class="table-responsive">      
      <table width="100%" align="center" class="table hover" id="doctable">
        	<thead>
            	<tr><th>ID</th><th>Title</th><th>Version</th><th>Updated</th><th>Category</th><th>Edit</th></tr>
            </thead>
            <tbody>
      
      <?php while ($row = $sth->fetch()){                ?>
                      <tr><td><?=$row['doc_id']?></td><td><?=trim($row['doc_title'])?></td><td><?=$row['doc_version']?></td><td><?=reverse_date($row['doc_uploadedon'])?></td><td><?php
            $sth1 = $db->prepare('SELECT Title FROM QMS_nav where ID = '. $row['doc_category']);
	        $sth1->execute();
	        while ($trow = $sth1->fetch()){
                $cattxt = $trow['Title'];
            }
            echo trim($cattxt);
                    ?>
            </td><td><button class="btn-sm btn-warning" data-toggle="modal" data-target=".editdoc<?=$row['doc_id']?>" id="<?=$row['doc_id']?>"><span class="glyphicon glyphicon-edit" style="font-size:1em"></span></button></td></tr>
                 <div class="modal fade editdoc<?=$row['doc_id']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header ">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Edit Document</h4>
                </div>
                <div class="modal-body row">
                  <div id="edit-doc-form">
                    <form class="form-horizontal<?=$row['doc_id']?>" role="form" id="updateDoc<?=$row['doc_id']?>">
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

                      <?php    
			$sth2 = $db->prepare('select * from QMS_nav where location = "s"'); 
			$sth2->execute();  
			?>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="dept" class="control-label">Department</label>
                        </div>
                        <div class="col-sm-10">
                          <select class="form-control" id="category" name="category">
                            <?php  while ($catrow = $sth2->fetch()){  ?>
                            
                              <option value="<?=$catrow['ID']?>" <?php if($row['doc_id'] == $catrow['ID']){ echo "Selected";} ?>>
                            <?=$catrow['Title']?>
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
                        <input type="hidden" name="filename" value="<?=$row['doc_filename']?>"/>
                        <input type="hidden" name="filepath" value="<?=$row['doc_filepath']?>"/>
                        <input type="hidden" name="filesize" value="<?=$row['doc_filesize']?>"/>
                        <input type="hidden" name="uploadedby" value="<?=$row['doc_uploadedby']?>"/>
                        <input type="hidden" name="uploadedon" value="<?=$row['doc_uploadedon']?>"/>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <div id="success-buttons<?=$row['doc_id']?>" style="display: none">
                    <div class="alert alert-dimissable alert-success" style="display: none;" id="update-success<?=$row['doc_id']?>">Document Details Changed!</div>
                    <button type="button" class="btn btn-default refresh" data-dismiss="modal" onclick="location.href='?m=docs'">Continue</button>
                  </div>
                  <div id="modal-buttons<?=$row['doc_id']?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary editdoc" id="<?=$row['doc_id']?>">Update</button>
                  </div>
                </div>
              </div>
            </div>
          </div>   
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
		<table width="100%" align="center" class="table hover" id="usertable">
        	<thead>
            	<tr><th>ID</th><th>User</th><th>Name</th><th>Email Address</th><th>Last Login</th><th>Admin</th><th>Edit</th></tr>
            </thead>
            <tbody>
            	<?php while ($row = $sth->fetch()){ ?>
                
                 <div class="modal fade editdoc<?=$row['doc_id']?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header ">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Edit Document</h4>
                </div>
                <div class="modal-body row">
                  <div id="edit-doc-form">
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

                      <?php    
			$catsth = $db->prepare('select * from QMS_nav where location = "s"'); 
			$catsth->execute();  
			?>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="dept" class="control-label">Department</label>
                        </div>
                        <div class="col-sm-10">
                          <select class="form-control" id="category" name="category">
                            <?php  while ($catrow = $catsth->fetch()){  ?>
                            
                              <option value="<?=$catrow['ID']?>" <?php if($row['doc_id'] == $catrow['ID']){ echo "Selected";} ?>>
                            <?=$catrow['Title']?>
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
                        <input type="hidden" name="filename" value="<?=$row['doc_filename']?>"/>
                        <input type="hidden" name="filepath" value="<?=$row['doc_filepath']?>"/>
                        <input type="hidden" name="filesize" value="<?=$row['doc_filesize']?>"/>
                        <input type="hidden" name="uploadedby" value="<?=$row['doc_uploadedby']?>"/>
                        <input type="hidden" name="uploadedon" value="<?=$row['doc_uploadedon']?>"/>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <div id="success-buttons<?=$row['doc_id']?>" style="display: none">
                    <div class="alert alert-dimissable alert-success" style="display: none;" id="update-success<?=$row['doc_id']?>">Document Details Changed!</div>
                    <button type="button" class="btn btn-default refresh" data-dismiss="modal">Continue</button>
                  </div>
                  <div id="modal-buttons<?=$row['doc_id']?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary editdoc" id="editdoc<?=$row['doc_id']?>">Update</button>
                  </div>
                </div>
              </div>
            </div>
          </div>   
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
  try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth = $db->prepare('select * from QMS_Content');
	$sth->execute();  
    $docarr = $sth->fetchAll();
    $doccnt = Count($docarr);  
      ?>
	       
    <h1>Dashboard</h1>
      <div class="col-md-3">
          <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="glyphicon glyphicon-file" style="font-size:5em;"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"> <span id="docnum" style="color: black;">0</span></p>
                    <p class="announcement-text"><a href="?m=docs">Active Docs</a></p>
                  </div>
                </div>
              </div>
            </div>
<script>
$(document).ready(function(){
    var percent_number_step = $.animateNumber.numberStepFactories.append('')
$('#docnum').animateNumber(
  {
    number: <?=$doccnt?>,
    color: 'Black',
    'font-size': '40px',
    easing: 'easeInQuad',
    numberStep: percent_number_step
  },
  3000
);    
});    
</script>      
      </div><?
      try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth1 = $db->prepare('select * from QMS_users');
	$sth1->execute();  
    $userarr = $sth1->fetchAll();
    $usercnt = Count($userarr);  
      ?>
      <div class="col-md-3">
                <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="glyphicon glyphicon-user" style="font-size:5em;"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"> <span id="usernum" style="color: black;">0</span></p>
                    <p class="announcement-text"><a href="?m=users" style="color: white">Active Users</a></p>
                  </div>
                </div>
              </div>
            </div>
<script>
$(document).ready(function(){
    var percent_number_step = $.animateNumber.numberStepFactories.append('')
$('#usernum').animateNumber(
  {
    number: <?=$usercnt?>,
    color: 'Black',
    'font-size': '40px',
    easing: 'easeInQuad',
    numberStep: percent_number_step
  },
  3000
);
});    
</script> 
      </div>
      <div class="col-md-3">
          <?
      try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth2 = $db->prepare('select * from QMS_nav where location = "s"');
	$sth2->execute();  
    $catarr = $sth2->fetchAll();
    $catcnt = Count($catarr);  
      ?>
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="glyphicon glyphicon-ok" style="font-size:5em;"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"> <span id="catnum" style="color: black;">0</span></p>
                    <p class="announcement-text"><a href="?m=cats">Active Cats</a></p>
                  </div>
                </div>
              </div>
            </div>
<script>
$(document).ready(function(){
     var percent_number_step = $.animateNumber.numberStepFactories.append('')
$('#catnum').animateNumber(
  {
    number: <?=$catcnt?>,
    color: 'Black',
    'font-size': '40px',
    easing: 'easeInQuad',
    numberStep: percent_number_step
  },
  3000
);
});    
</script> 
      </div>
          <div class="col-md-3">
          <?
      try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth2 = $db->prepare('select * from QMS_Content where doc_uploadedon between DATE_SUB(NOW(), INTERVAL 4 WEEK) AND NOW()');
	$sth2->execute();  
    $totarr = $sth2->fetchAll();
    $totcnt = Count($totarr);  
      ?>
            <div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="glyphicon glyphicon-refresh" style="font-size:5em;"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"> <span id="totnum" style="color: black;">0</span></p>
                    <p class="announcement-text">Updates</p>
                  </div>
                </div>
              </div>
            </div>
<script>
$(document).ready(function(){
   
    
    var percent_number_step = $.animateNumber.numberStepFactories.append('')
$('#totnum').animateNumber(
  {
    number: <?=$totcnt?>,
    color: 'Black',
    'font-size': '40px',

    easing: 'easeInQuad',

    numberStep: percent_number_step
  },
  3000
);

    
});    
</script> 
      </div>
      <?php } ?>
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
<script src="http://www.hangerworld.co.uk/qms/assets/js/jquery.animateNumber.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    $('#usertable').DataTable({"iDisplayLength": 20});
    $('#doctable').DataTable({"iDisplayLength": 20});
    $("#catfilter").change(function(){
        var id = $( "#catfilter" ).val();
        var fullUrl = window.location.href;
        var filter = "&catfilter="+id;
        var newURL = fullUrl.split("&",1) + filter;
        window.location = newURL;
    });
    $(".editdoc").click(function(){
		var x = this.id;
        $.ajax({            
        type: "POST",
        url: "../assets/php/editdoc.php",
        data: $(".form-horizontal"+x).serialize(),	
        success: function(response){
            $("#update-success"+x).show();
            $("#modal-buttons"+x).hide();
		    $("#edit-doc-form"+x).hide();
            $("#success-buttons"+x).show();
    },
        error: function(){
            alert("An error occurred: " & result.errorMessage);
        }
        });
    });			
});    
</script>
</body>
</html>

