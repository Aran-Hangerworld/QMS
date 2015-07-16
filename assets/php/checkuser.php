<?php
include 'PDO.php';

try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
    
if (isset($_POST['username'])){
	$lusername = strip_tags($_POST['username']);	
};
$sth = $db->prepare('Select COUNT(QMS_user) AS cnt FROM QMS_users WHERE QMS_user = "'.$lusername.'"');
$sth->execute();
while ($row = $sth->fetch()){
echo $row['cnt'];	
};
?>	