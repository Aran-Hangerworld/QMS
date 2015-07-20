<?php
session_start();
if (isset($_POST['pagetitle'])) {
    include 'PDO.php';
    include 'functions.php';
    $pagetitle = strip_tags($_POST['pagetitle']);
    $pagemsg =     strip_tags($_POST['pagemsg']);
    $pagesubtitle =     strip_tags($_POST['pagesubtitle']);
    $pagecontent =   strip_tags($_POST['pagecontent']);
    $refid = "0";

    try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth = $db->prepare('CALL QMS_editcontent(?,?,?,?,?)');
	$sth->bindparam(1, $pagetitle, PDO::PARAM_STR);
    $sth->bindparam(2, $pagemsg, PDO::PARAM_STR);
    $sth->bindparam(3, $pagesubtitle, PDO::PARAM_STR);
    $sth->bindparam(4, $pagecontent, PDO::PARAM_STR);
    $sth->bindparam(5, $idref, PDO::PARAM_INT);
    $sth->execute();
	
    echo $_POST;
}  
?>