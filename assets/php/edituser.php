<?php
session_start();
if (isset($_POST['username'])) {
    include 'PDO.php';
    include 'functions.php';
    $id =    strip_tags($_POST['id']);
    $lusername = strip_tags($_POST['username']);
    $rname =     strip_tags($_POST['rname']);
    $email =     strip_tags($_POST['email']);
    $isadmin =   strip_tags($_POST['isadmin']);
    $isactive = strip_tags($_POST['isactive']);
    if($isadmin){ 
        $isadmin = 1;
    }else {
           $isadmin = 0;
    };
    
    $company = "Hangerworld";
    
    if($isactive){
        $isactive = 1;
    }else {
        $isactive = 0;
    };
  
	try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth = $db->prepare('CALL QMS_edituser(?,?,?,?,?,?,?)');
    $sth->bindparam(1, $id, PDO::PARAM_INT);
	$sth->bindparam(2, $lusername, PDO::PARAM_STR);
    $sth->bindparam(3, $rname,    PDO::PARAM_STR);
    $sth->bindparam(4, $isadmin,  PDO::PARAM_INT);
    $sth->bindparam(5, $company, PDO::PARAM_STR);
    $sth->bindparam(6, $isactive, PDO::PARAM_INT);
    $sth->bindparam(7, $email, PDO::PARAM_STR);
	$sth->execute();
    
	# Email confirm
	$sub = "User Update - Hangerworld Suppport";
	$msg = "Hi $rname,\r\n Your user account has been updated for you to use on the Hangerworld support site.\r\n Username: $lusername \r\n Password: $newpass \r\n Log in via http://www.hangerworld.co.uk/qms/ \r\n Regards \r\n IT Dept.";
	$headers = ""; 
#mail($email,$sub,$msg,$headers);
#echo $newpass;
}
?>