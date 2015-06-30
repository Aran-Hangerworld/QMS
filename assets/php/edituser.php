<?php
if (isset($_POST['username'])) {
    include 'PDO.php';
    $id = strip_tags($_POST['id']);
    $lusername =    ($_POST['username']);
    $rname =        ($_POST['rname']);
    $email =        ($_POST['email']);
    $isadmin =      ($_POST['isadmin']);
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
	$sth = $db->prepare('CALL QMS_edituser(?,?,?,?,?,?,?)');
	$sth->bindparam(1, $id, PDO::PARAM_STR);
    $sth->bindparam(2, $lusername, PDO::PARAM_STR);
    $sth->bindparam(3, $rname,    PDO::PARAM_STR);
    $sth->bindparam(4, $email, PDO::PARAM_STR);
    $sth->bindparam(5, $isadmin,  PDO::PARAM_INT);
    $sth->bindparam(6, $company,  PDO::PARAM_INT);
	$sth->bindparam(7, $newpasshash, PDO::PARAM_STR);
    
    
	$sth->execute();

	

	
