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
<form method="POST">
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

if(isset($_GET['docTitle'])){
    $docTitle = $_GET['docTitle'];
    $docCategory = $_GET['docCat'];
    $docVersion = $_GET['docVersion'];
    $docFilename = $mainFile;
    $docFilePath = $targetPath;
    $docFileSize = "0";
    $docUploadedBy = $_SESSION['User'];
    $docUploadedOn = date("Y-m-d H:i:s");
    $docStatus = 1;
    
    $sth = $db->prepare('CALL QMS_AddDoc(?,?,?,?,?,?,?,?,?)');
	$sth->bindparam(1, $docTitle, PDO::PARAM_STR);
    $sth->bindparam(2, $docFilename,    PDO::PARAM_STR);
	$sth->bindparam(3, $docFilePath, PDO::PARAM_STR);
    $sth->bindparam(4, $docFileSize,  PDO::PARAM_STR);
    $sth->bindparam(5, $docCategory,  PDO::PARAM_STR);
    $sth->bindparam(6, $docVersion,  PDO::PARAM_STR);
    $sth->bindparam(7, $docUploadedBy,  PDO::PARAM_STR);
    $sth->bindparam(8, $docUploadedOn,  PDO::PARAM_STR);
    $sth->bindparam(9, $docStatus,  PDO::PARAM_INT);
	$sth->execute();
} ?>
<div class="container">
    <div class="panel">
        <h1>Document Uploaded </h1>
        <?php header('Location: http://www.hangerworld.co.uk/QMS/admin/index.php?m=docs'); ?>
    </div>
    
<?php    } ?>
    
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
