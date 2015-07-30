<?php
session_start();
if (isset($_POST['username'])) {
    include 'PDO.php';
    include 'functions.php';
    $id =    strip_tags($_POST['id']);
    $lusername = strip_tags($_POST['username']);
    $DatePlanned =     strip_tags($_POST['DatePlanned']);
    $DateCompleted =     strip_tags($_POST['DateCompleted']);
    $ReviewDate =   strip_tags($_POST['ReviewDate']);
 	try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth = $db->prepare('CALL TP_edittraining(?,?,?,?,?,)');
    $sth->bindparam(1, $id, PDO::PARAM_INT);
	$sth->bindparam(2, $lusername, PDO::PARAM_STR);
    $sth->bindparam(3, $DatePlanned,    PDO::PARAM_STR);
    $sth->bindparam(4, $DateCompleted,  PDO::PARAM_INT);
    $sth->bindparam(5, $ReviewDate, PDO::PARAM_STR);
	$sth->execute();
}
?>