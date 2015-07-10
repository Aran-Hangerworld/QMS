<?php 
session_start();
print_r($_POST);
if(isset($_POST['id'])){
    /* Sanitize Vars */
    $id = strip_tags($_POST['id']);
    $title = strip_tags($_POST['title']);
    $category = strip_tags($_POST['category']);
    $version = strip_tags($_POST['version']);
    $isactive = strip_tags($_POST['isactive']);
    if($isactive){
        $isactive = 1;
    }else{
        $isactive = 0;   
    }
    include 'PDO.php';
	try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
		} catch(Exception $e)  {
		    print "Error!: " . $e->getMessage();
	    }
	$sth = $db->prepare('CALL QMS_editdoc(?,?,?,?,?)');
	$sth->bindparam(1, $title, PDO::PARAM_STR);
    $sth->bindparam(2, $category, PDO::PARAM_INT);
    $sth->bindparam(3, $version, PDO::PARAM_STR);
    $sth->bindparam(4, $isactive, PDO::PARAM_INT);
    $sth->bindparam(5, $id, PDO::PARAM_INT);
    $sth->execute();
    echo "Document Updated" . $title ." ". $category ." ". $version;
    
} else {
    echo "No data sent";
}
?>
