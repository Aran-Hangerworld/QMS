<?php
if(isset($_POST['id'])){
	include 'functions.php'; 
	include 'PDO.php'; 
	$response = CallAPI("GET","http://randomword.setgetgo.com/get.php");
	$num = rand(10,99);
	$newpasshash = md5(trim($response) . $num);
	$newpass = trim($response) . $num;
	$userid = $_POST['id'];
	try {
			$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
			} catch(Exception $e)  {
			    print "Error!: " . $e->getMessage();
		    }
		$sth = $db->prepare('CALL QMS_updatepass(?,?)');
		$sth->bindparam(1, $userid, PDO::PARAM_STR);
		$sth->bindParam(2, $newpasshash, PDO::PARAM_STR);
		$sth->execute(); 
    
    $sub = "New User Created - Hangerworld Suppport";
	$msg = "Hi $rname,\r\n Your password has successfully been reset for the Hangerworld Support website. Your new login details are below.\r\n Username: $lusername \r\n Password: $newpass \r\n Log in via http://www.hangerworld.co.uk/qms/ \r\n Regards \r\n IT Dept.";
	$headers = ""; 
#mail($email,$sub,$msg,$headers);

 
} else {
echo "Oops";
}
?>
