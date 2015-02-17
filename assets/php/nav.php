<nav class="navbar navbar-inverse">
<div class="container">
<div class="navbar-header">
  <?php 
try {
	$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
	$sth = $db->prepare('CALL GetNav(?)');
	$navlevel = "t";
	$sth->bindparam(1, $navlevel, PDO::PARAM_STR);
	$sth->execute();

	while ($row = $sth->fetch()){
        if($row['tOrder'] == '1'){
			echo "<a class='navbar-brand' href='".$row['Target']."'>".$row['Title']."</a></div>";
		} elseif($row['tOrder'] == '2') {   
			echo "<div><ul class='nav navbar-nav'>";
			echo "<li><a href='".$row['Target']."'>".$row['Title']."</a></li>";
		} elseif($row['tOrder'] == '99') { ?>
</ul></div>
  <div class="pull-right">
    <ul class="nav navbar-nav" style="padding-top:5px">
    	<li><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon <?php echo $row['Icon']?> sm">&nbsp;</span><?php echo $row['Title']?></button></li>
    </ul>  
  </div>
  <?php
		} else {
			echo "<li><a href='".$row['Target']."'>".$row['Title']."</a></li>";
		}
	}
        
?>
</div>
</nav>


       

