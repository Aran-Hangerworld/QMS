<?php
if (isset($_POST['QMS_user']) && isset($_POST['QMS_pass'])) {
    include 'PDO.php';
    $myusername= strip_tags($_POST['QMS_user']);
    $rname =     strip_tags($_POST['QMS_realnamae']);
    $isadmin =   strip_tags($_POST['QMS_isadmin']);
    $company = "Hangerworld";
    # Get new password
	$response = CallAPI("GET","http://randomword.setgetgo.com/get.php");
	$num = rand(10,99);
	$newpasshash = md5(trim($response) . $num);
	$newpass = trim($response) . $num;
	# End of password

	try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
		} catch(Exception $e)  {
		    print "Error!: " . $e->getMessage();
	    }
	$sth = $db->prepare('CALL AdduserQMS(?,?,?,?,?)');
	$sth->bindparam(1, $myusername, PDO::PARAM_STR);
    $sth->bindparam(2, $rname,    PDO::PARAM_STR);
	$sth->bindparam(3, $newpasshash, PDO::PARAM_STR);
    $sth->bindparam(4, $isadmin,  PDO::PARAM_INT);
    $sth->bindparam(5, $company,  PDO::PARAM_STR);
	$sth->execute();
	
	# Email confirm
	$sub = "New User Created - Hangerworld Suppport";
	$msg = "Hi $rname,\r\n A new user has been created for you to use on the Hangerworld support site.\r\n Username: $lusername \r\n Password: $newpass \r\n Log in via http://www.hangerworld.co.uk/qms/ \r\n Regards \r\n IT Dept.";
	$headers = ""; 
	mail($email,$sub,$msg,$headers);
	 
	echo $newpass;
} else {
 echo "oops1";
}
    
?>


	try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
		} catch(Exception $e)  {
		    print "Error!: " . $e->getMessage();
	    }
	

	