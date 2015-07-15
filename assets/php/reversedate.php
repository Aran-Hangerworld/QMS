<?php
function reverse_date($mydate){
	$date_created = explode("-", $mydate);
	$date_reversed = array_reverse($date_created);
	$i = 0; 
	foreach($date_reversed as &$value) {
		echo $value;
		if($i == 0 || $i == 1){
			echo "-";	
		}
		$i++;
	}
}

?>