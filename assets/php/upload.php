<?php 
session_start();
include 'PDO.php';
include 'header.php';
include 'nav.php';
$pageid = 'upload';

if(isset($_FILES) && !isset($_POST['docTitle'])){
    $targetfolder = '../../docs/';
    $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {
        echo "The file ". basename( $_FILES['file']['name']). " is uploaded";  ?>
    <form method="POST" action="upload.php">
    <input type="hidden" name="filename" value="<?=$_FILES['file']['name']?>" />
    <input type="hidden" name="filesize" value="<?=$_FILES['file']['size']?>" />
    <input type="hidden" name="filepath" value="http://www.hangerworld.co.uk/qms/docs/" />    
    <label for="title" class="sr-only">Title</label>
    <input type="text" id="title" class="form-control" placeholder="Doc Title" name="docTitle" required autofocus>
    <label for="category" class="sr-only">Category</label>
    <select class="form-control" name="docCat" id="category">
<?php 
	try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
		} catch(Exception $e)  {
		    print "Error!: " . $e->getMessage();
	    }
	$sth = $db->prepare('select * from QMS_nav where location = "s" and tOrder < 15');
	$sth->execute();
    while ($row = $sth->fetch()){ ?>
        <option value="<?=$row['ID']?>"><?=$row['Title']?></option>
    <?php } ?>
        </select>
        <label for="version" class="sr-only">Doc Version No.</label>
        <input type="text" id="version" class="form-control" placeholder="Doc Version" required name="docVersion">   
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="adddocbtn">Add Document</button>
    </form>

<?php

} else { ?>
<div class="container">
    <div class="panel">
<?php echo "<h1>Problem uploading file</h1>"; ?>
    </div>
       
       <?php }
} elseif(isset($_POST['docTitle'])){  
    
try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    } 

   
    $docTitle = $_POST['docTitle'];
    $docCategory = $_POST['docCat'];
    $docVersion = $_POST['docVersion'];
    $docFilename = $_POST['filename'];
    $docFilePath = $_POST['filepath'];
    $docFileSize = $_POST['filesize'];
    $docUploadedBy = $_SESSION['user'];
    $docUploadedOn = date("Y-m-d H:i:s");
    $docStatus = 1;
    
    $sth = $db->prepare('CALL QMS_AddDoc(?,?,?,?,?,?,?,?,?)');
	$sth->bindparam(1, $docTitle, PDO::PARAM_STR);
    $sth->bindparam(2, $docFilename,    PDO::PARAM_STR);
	$sth->bindparam(3, $docFilePath, PDO::PARAM_STR);
    $sth->bindparam(4, $docFileSize,  PDO::PARAM_STR);
    $sth->bindparam(5, $docCategory,  PDO::PARAM_INT);
    $sth->bindparam(6, $docVersion,  PDO::PARAM_STR);
    $sth->bindparam(7, $docUploadedBy,  PDO::PARAM_STR);
    $sth->bindparam(8, $docUploadedOn,  PDO::PARAM_STR);
    $sth->bindparam(9, $docStatus,  PDO::PARAM_INT);
	$sth->execute();
 ?>
<div class="container">
    <div class="panel">
        <h1>Document Uploaded <span class="glyphicon glyphicon-ok" style="font-size: 1em; color: green"></span></h1>
        
        <p>Document Title: <?=$docTitle?><br />
            Document Category: <?=$docCategory?><br />
            File Name: <?=$docFilePath?><?=$docFilename?><br />
            File Size: <?=number_format($docFileSize/1000, 2)?>kB<br />
            Uploaded By: <?=$docUpoadedBy?><br />
            Uploaded On: <?=$docUploadedOn?><br />
            Doc Status: <?=($docStatus == 1)? "Active" : "Retired"?><br /><br />
            <a href="http://www.hangerworld.co.uk/qms/admin/index.php?m=docs" role="button" class="btn btn-primary">Back to Document Admin</a>
            
            
        </p>
            
    </div>
    
    
<?php    } ?>
    
</div>
<?php 
	$db = null;  
?> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!-- Latest compiled and minified JavaScript --> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>

