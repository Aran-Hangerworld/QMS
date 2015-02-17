<?php
	function scanforfiles($tmpdir){
	$myDirectory = $tmpdir;
	while($entryName = readdir($myDirectory)) {
		$dirArray[] = $entryName;
	}
	
	closedir($myDirectory);
	$indexCount	= count($dirArray);
	
	print ($_SERVER['REQUEST_URI'] . "<br>");
	// -1 because we don't what the .php file to count
	print (" files: " . ($indexCount - 1) . "<br>\n");

	// print 'em
	print("<TABLE border=1 cellpadding=5 cellspacing=0 class=whitelinks id=\"maintable\">\n");
	print("<TR><th> - # - </th><th>Filename</th><th>Filesize (In Bytes)</th><th>DateTime Uploaded</th></TR>\n");
	// loop through the array of files and print them all
	$j = 1;
  
  if (count($dirArray) == 0) {
  		print("<TR>");
  			print("<td><center><b>" . $j++ . "</b></center></td>");
        		print("<td>There were no files found in the specified directory!!!</td>");
  			print("<td> 0kb </td>");									
  			print("<td> now </td>");
  		print("</TR>\n");
  } else {
  	for ($i = 0; $i < $indexCount; $i++) { 
  		if (substr($dirArray[$i], 0, 1) != "." && $dirArray[$i] != "index.php" && $dirArray[$i] != "hitcounter.txt") { 
  			if (substr($dirArray[$i], -3) == "jpg") {
  				$picArray[$picCntr++];
  				print("</TR>");
  					print("<td><center>" . $j++ . "</center></td>");
  					print("<td><center><img src=\"" . $dirArray[$i] . "\" width=\"400\"></center></td>");
  					print("<td>" . filesize($dirArray[$i]) . "</td>");
  					print("<td>");
  						print(date("m/d/Y h:ia", filemtime($dirArray[$i])));
  					print("</td>");
  				print("</TR>\n");
  			} else {
  				print("<TR>");
  					print("<td><center><b>" . $j++ . "</b></center></td>");
  	        		print("<td><a href=" . $dirArray[$i] . ">" . $dirArray[$i] . "</a></td>");
  					print("<td>" . filesize($dirArray[$i]) . "</td>");									
  					print("<td>" . date("m/d/Y h:ia", filemtime($dirArray[$i])) . "</td>");
  				print("</TR>\n");
  			}
  		}
  	}
  }
	print("</TABLE>\n");
}
?>