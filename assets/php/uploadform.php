<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<div class="modal fade" id="upload-form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Upload a Document</h4>
          </div>
          <div class="modal-body">
        <form action="../assets/php/upload.php" class="dropzone" id="dz">  
        <label for="title" class="sr-only">Title</label>
        <input type="text" id="title" class="form-control" placeholder="Doc Title" name="docTitle" required autofocus>
        <label for="category" class="sr-only">Category</label>
        <select class="form-control" name="docCat" id="category">
<?php 
	try {
		$db = new PDO("mysql:host=$hostname;dbname=$username", $username, $password);	
		} catch(Exception $e)  {
		    print "Error!: " . $e->getMessage();
	    }
	$sth = $db->prepare('select * from QMS_nav where location = "s" and tOrder < 15');
	$sth->execute();
    while ($row = $sth->fetch()){ ?>
        <option value="<?=$row['ID']?>"><?=$row['Title']?></option>
    <?php } ?>
        </select>
        <label for="version" class="sr-only">Doc Version No.</label>
        <input type="text" id="version" class="form-control" placeholder="Doc Version" required name="docVersion">      
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="uploadbtn">Upload Doc</button>
      </form>
      </div>
    </div>
</div>
</div>