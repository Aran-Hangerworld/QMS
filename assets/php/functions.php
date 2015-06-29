<?php 
function parse_category($input, $db1){	
	$msth = $db1->prepare('SELECT Title FROM QMS_nav where ID = $input');
	$msth->execute();
	while ($row = $msth->fetch()){
        $cattxt = $row['Title'];
    
    }
	return array($cattxt);
}
?>
