  
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
	$lastone = 0; 
	while ($row = $sth->fetch()){
      
        if($row['tOrder'] == '1'){
			echo "<a class='navbar-brand' href='".$row['Target']."'>".$row['Title']."</a></div>";
		} elseif($row['tOrder'] == '2') {   
			echo "<div><ul class='nav navbar-nav'>";
			echo "<li><a href='".$row['Target']."'>".$row['Title']."</a></li>";
		} elseif($row['tOrder'] > 2 && $row['tOrder'] < 99){
			echo "<li><a href='".$row['Target']."'>".$row['Title']."</a></li>";
            $lastone = 1;
		} elseif($row['tOrder'] == '99') {    ?>
    <?php if($lastone==1){?></ul></div> 
    <div class="pull-right">
    <ul class="nav navbar-nav" style="padding-top:5px">
        <?php } ?>
        <?php if(isset($_SESSION['isadmin'])){ 
        $lastone = 0;?>
    	<li><button class="btn-sm btn-primary" data-toggle="modal"  id="login-btn" data-target="#login-form"><span class="glyphicon  <?php echo $row['Icon']?> sm">&nbsp;</span><?php echo $row['Title']?></button></li> 

        <?php  } else { 	?>
       
		<li><button class="btn-sm btn-primary" id="logout" onclick="locaton.href='assets/php/logout.php'"><span class="glyphicon <?php echo $row['Icon']?> sm">&nbsp;</span><?php echo $row['Title']?></button></li>
        <?php } ?>
    </ul></div>
	<?php } ?>
    <?php } ?>
    <?php
    	if($_SESSION['isadmin']){ ?>
   
        <li><button class="btn-sm btn-warning" onclick="location.href='/qms/admin/index.php'"><span class="glyphicon glyphicon-user sm">&nbsp;</span>Admin</button></li>
		</ul></div>
<?php } ?>
</div>
</nav>
