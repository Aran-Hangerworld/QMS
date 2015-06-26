<?php 
session_start();
include 'PDO.php';
include 'header.php';
include 'nav.php';
$pageid = 'upload';
$upload_dir = 'docs';
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = dirname( __FILE__ ) . "/" . $upload_dir . DIRECTORY_SEPARATOR;
    $mainFile = $targetPath.time().'-'. $_FILES['file']['name'];
    move_uploaded_file($tempFile,$mainFile);
}


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
    
}
?>

<div class="container">
    <div class="panel">
        <h1>Document Uploaded</h1>
        <?php header('Location: http://www.hangerworld.co.uk/QMS/admin/index.php?m=docs'); ?>
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
