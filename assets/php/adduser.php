<?php
if (isset($_POST['QMS_user']) && isset($_POST['QMS_pass'])) {
    include 'PDO.php';
    $username= strip_tags($_POST['QMS_user']);
    $realname =     strip_tags($_POST['QMS_Realnamae']);
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
	$sth = $db->prepare('CALL AdduserQMS(?,?,?,?)');
	$sth->bindparam(1, $username, PDO::PARAM_STR);
    $sth->bindparam(2, $realnamename,    PDO::PARAM_STR);
	$sth->bindparam(3, $newpasshash, PDO::PARAM_STR);
    $sth->bindparam(4, $isadmin,  PDO::PARAM_INT);
	$sth->execute();
	
	# Email confirm
	$sub = "New User Created - Hangerworld Suppport";
	$msg = "Hi $realname,\r\n A new user has been created for you to use on the Hangerworld support site.\r\n Username: $username \r\n Password: $newpass \r\n Log in via http://www.hangerworld.co.uk/qms/ \r\n Regards \r\n IT Dept.";
	$headers = ""; 
	mail($email,$sub,$msg,$headers);
	 
	echo $newpass;
} else {
 echo "oops1";
}
    
?>
	

	
INSERT INTO QMS_users (QMS_user, QMS_realname, QMS_email, pass, dept, isadmin) VALUES (username, rname, email, pass, dept, isadmin);
