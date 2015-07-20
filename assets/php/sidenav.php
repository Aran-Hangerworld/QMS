<div class="btn-group-vertical"><b>System Navigation</b> 
<?php
try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }

	$sth = $db->prepare('CALL GetNav(?)');
	$navlevel = "s";
	$sth->bindparam(1, $navlevel, PDO::PARAM_STR);
	$sth->execute();
	
	
	
	while ($row = $sth->fetch()){
        if($_GET['type'] == $row['ID']){
        $pagetitle = $row['Title'];
        $pageicon = $row['Icon'];
        }
		if($row['tOrder'] == '15') {
			echo "<a href='".$row['Target']."' class='btn btn-success btn-block'><span class='glyphicon sm ".$row['Icon']."'></span>&nbsp;&nbsp;".$row['Title']."<br /><small>(To be used for reference only</small></a>";
		} else {
			if($row['Parent'] == ""){
					if($row['Target'] == "dd"){
						  echo "<div class='btn-group-vertical'> <a href='#' class='btn btn-default btn-block text-left' style='width:205px' data-toggle='dropdown'> <span class='glyphicon sm ". $row['Icon']."'></span>&nbsp;&nbsp; ".$row['Title']." <span class='caret'></span> </a> <ul class='dropdown-menu'>";
					} else {								
					echo "<a href='".$row['Target']."' class='btn btn-default btn-block text-left'><span class='glyphicon sm ".$row['Icon']."'></span>&nbsp;&nbsp; ".$row['Title']."</a>";				
					}
			} else	{
				echo  "<li><a href='".$row['Target']."'>".$row['Title']."</a></li>";
				if($row['ID'] == '14'){
					echo "</ul></div>";	
				}
			}
		}
	 }
?>
</div>
	
	