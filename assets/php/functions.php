<?php 
function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function SENDSMTP($to,$sub,$msg,$headers){
$msg = wordwrap($msg,70);
mail($to,$sub,$msg,$headers);
}

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