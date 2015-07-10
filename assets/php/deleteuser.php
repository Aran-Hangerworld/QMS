       
<?php
 if($_POST['username'] <> ""){
 $tmpid = strip_tags($_POST['username']);
 include 'PDO.php'; 
	try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$query= 'delete from QMS_users where QMS_user ='. $tmpid;
    $sth = $db->prepare($query);	
	$sth->execute(); 
 }
?>