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
<?php include 'assets/php/reversedate.php';?>
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
<h3> <span class='glyphicon sm <?=$pageicon?>'></span>&nbsp;&nbsp;<?=$pagetitle?></h3>
	<div class="table-responsive col-md-12">
		<table  width="100%" align="center" class="table hover" id="PageTable">
			<thead>
            	<tr >
                    <th>Title</th><th>Version</th><th>Updated</th><th>Author</th>
                </tr>
			</thead>
			<tbody>
            	<?php while ($row = $sth->fetch()){ ?>
                <tr id="tablerow">
                	<td><a href="http://<?=$row['doc_filepath']?><?=$row['doc_filename']?>" target="_blank"><?=$row['doc_title']?></a></td>
                    <td><?=$row['doc_version']?></td>
                    <td><?reverse_date($row['doc_uploadedon'])?></td>
                    <td><?=$row['doc_uploadedby']?></td>
               </tr>
				<?php } ?>
                <div class="alert aler-dismissable alert-warning" style="display:none" id="tablemsg"><span class="glyphicon sm glyphicon-warning-sign"></span>&nbsp;&nbsp;Sorry there is currently no policies to view in <?=$pagetitle?></div>
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
<script src="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script> 
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#PageTable').DataTable({idisplay:length
    
    });
    $('#PageTable').set('strings.emptyMessage', "$('#tablemsg')" );
    
    
    
 });

</script>
</body>
</html>
