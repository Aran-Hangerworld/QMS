<?php 
 session_start();
if(!isset($_SESSION['user'])){
    header('Location: http://www.hangerworld.co.uk/qms/index.php?err=102');
}
include 'assets/php/PDO.php'; ?>
<?php include 'assets/php/header.php'; ?>
<?php include 'assets/php/nav.php'; ?>
<?php include 'assets/php/loginform.php'; ?>
<?php include 'assets/php/functions.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
    		<?php include 'assets/php/message.php'; ?>    
		</div>
  		<div class="col-md-3 col-sm-12">
			<?php include 'assets/php/sidenav.php'; ?>  
        </div>
  <div class="col-md-9 col-sm-12">
  <?php
  	$pt = htmlspecialchars($_GET['type']);
try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
    
	$sth = $db->prepare('select * from QMS_Content where doc_category = '. $pt);
	$sth->execute();


		?>
  
  
  <h3><?=$pagetitle?></h3>
	<div class="table-responsive col-md-12">
		<table  width="100%" align="center" class="table hover" id="Page_Table">
			<thead>
            	<tr>
                    <th >Title</th><th>Version</th><th>Updated</th><th>Author</th>
                </tr>
			</thead>
			<tbody>
            	<?php while ($row = $sth->fetch()){ ?>
                <tr>
                	<td><a href="http://<?=$row['doc_filepath']?><?=$row['doc_filename']?>" target="_blank"><?=$row['doc_title']?></a></td>
                    <td><?=$row['doc_version']?></td>
                    
                    <td><?reverse_date($row['doc_uploadedon'])?></td>
                    <td><?=$row['doc_uploadedby']?></td>
               </tr>
				<?php } ?>
            </tbody>
        </table>
	</div>
   </div>
</div>
</div>
<?php 

	include 'assets/php/footer.php';
	$db = null;  
?> 
<script>
$(document).ready(function(){
    $('#Page_Table').dataTable();
 });

</script>
</body>
</html>
