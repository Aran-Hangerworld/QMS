<?php
if (isset($_POST['username'])) {
    include 'PDO.php';
    $lusername = strip_tags($_POST['username']);
    $rname =     strip_tags($_POST['rname']);
    $email =     strip_tags($_POST['email']);
    $isadmin =   strip_tags($_POST['isadmin']);
    if($isadmin){ 
        $isadmin = 1;
    }else {
           $isadmin = 0;
    }
    $company = "Hangerworld";
    # Get new password
	$response = CallAPI("GET","http://randomword.setgetgo.com/get.php");
	$num = rand(10,99);
	$newpasshash = md5(trim($response) . $num);
	$lpass = trim($response) . $num;
	# End of password

	try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth = $db->prepare('CALL AdduserQMS(?,?,?,?,?)');
	$sth->bindparam(1, $lusername, PDO::PARAM_STR);
    $sth->bindparam(2, $rname,    PDO::PARAM_STR);
	$sth->bindparam(3, $newpasshash, PDO::PARAM_STR);
    $sth->bindparam(4, $isadmin,  PDO::PARAM_INT);
    $sth->bindparam(5, $email, PDO::PARAM_STR);
	$sth->execute();
	
	# Email confirm
	$sub = "New User Created - Hangerworld Suppport";
	$msg = "Hi $rname,\r\n A new user has been created for you to use on the Hangerworld support site.\r\n Username: $lusername \r\n Password: $lpass \r\n Log in via http://www.hangerworld.co.uk/qms/ \r\n Regards \r\n IT Dept.";
	$headers = ""; 
	mail($email,$sub,$msg,$headers);
	echo $newpass;
} else {
 echo "No Data Sent";
}
    
?>
	

	
