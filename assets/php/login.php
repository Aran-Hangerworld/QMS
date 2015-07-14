<?php
session_start();
if (isset($_POST['user']) && isset($_POST['pass'])) {
    $myusername=$_POST['user']; 
	$mypassword=$_POST['pass'];
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
/*	$myusername = mysql_real_escape_string($myusername);
    $mypassword = mysql_real_escape_string($mypassword); */
	$mypassword = md5($mypassword);
	include 'PDO.php';
	try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
		} catch(Exception $e)  {
		    print "Error!: " . $e->getMessage();
	    }
	$sth = $db->prepare('CALL CheckLoginQMS(?,?)');
	$sth->bindparam(1, $myusername, PDO::PARAM_STR);
	$sth->bindparam(2, $mypassword, PDO::PARAM_STR);
	$sth->execute();
	while ($row = $sth->fetch()){
		if($row['cnt'] == 1){
			echo "1";
			$_SESSION['user'] = $myusername;
            $_SESSION['isadmin'] = $row['QMS_isadmin'];  
            $_SESSION['lastlogin'] = $row['QMS_lastlogin'];
            $newlastlogin = date( 'Y-m-d', time());
            $sth = $db->prepare('Update QMS_users set LastLogin = ? where QMS_user = ?');
	        $sth->bindparam(1, $myusername, PDO::PARAM_STR);
            $sth->bindparam(2, $newlastlogin, PDO::PARAM_STR);
	        $sth->execute();
        } else {
            echo "0";
	    } 
    }
} else {
    echo "No Data Sent";
    }

?>