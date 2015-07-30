<?php 
 session_start();
if(!isset($_SESSION['user'])){
    header('Location: http://www.hangerworld.co.uk/qms/index.php?err=102');
}
include '../assets/php/PDO.php'; 
include '../assets/php/header.php'; 
include '../assets/php/nav.php';
include '../assets/php/loginform.php';
include '../assets/php/functions.php';
include '../assets/php/reversedate.php';?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
    		<?php include '../assets/php/message.php'; ?>    
		</div>
  		<div class="col-md-3 col-sm-12">
			<?php include '../assets/php/sidenav.php'; ?>  
        </div>
  <div class="col-md-9 col-sm-12">
  <?php
  	$pt = htmlspecialchars($_GET['type']);
try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
	} catch(Exception $e)  {
	    print "Error!: " . $e->getMessage();
    }
    
	$sth = $db->prepare('select * from TP_users');
	$sth->execute();
include '../assets/php/edittrainingform.php';
		?>
<h3> <span class='glyphicon glyphicon-user sm'></span>&nbsp;&nbsp;IT Training</h3>
	<div class="table-responsive col-md-12">
		<table  width="100%" align="center" class="table hover" id="TP_table">
			<thead>
            	<tr >
                    <th>Username</th><th>Department</th><th>Date Planned</th><th>Date Completed</th><th>Review Date</th><th>Notes</th><th>Edit</th>
                </tr>
			</thead>
			<tbody>
            	<?php while ($row = $sth->fetch()){?>
                
                <tr id="tablerow" data-toggle="modal" data-target="edittrainingform.php">
                	<td><?=$row['Employee']?></td>
                    <td><?=$row['Department']?></td>
                    <td><?reverse_date($row['Dateplanned'])?></td>
                    <td><?=reverse_date($row['Datecompleted'])?></td>
                    <td><?=reverse_date($row['Datereview'])?></td>
                    <td><?=$row['Notes']?></td>
                    <td><button class="btn-sm btn-warning" data-toggle="modal" data-target="#edittrainingform<?=$row['ID']?>" id="<?=$row['ID']?>"><span class="glyphicon glyphicon-edit" style="font-size:1em"></span></button></td>
               </tr>
               <?php } ?>
            </tbody>
        </table>		
	</div>
   </div>  
    </div>
</div>
<?php 
	include '../assets/php/footer.php';
	$db = null;  
?> 
<script src="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script> 
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>   
</body>
<script>
$(document).ready(function(){
    $('#TP_table').DataTable({"iDisplayLength": 100});
});
</script>
</html>

