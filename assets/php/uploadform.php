<?php include 'PDO.php'; 
include 'header.php';
include 'nav.php'; ?>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<div class="container">
  <div class="row">
    <div class="col-md-12">

              
              <form action="/upload-target" class="dropzone">
  

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
<script>
	 $(document).ready(function(){
          
		 $("#uploadbtn").click(function(){
 	         $.ajax({
    		 type: "POST",
			 url: "assets/php/upload.php",
			 data: $('form.upload').serialize(),	
    	     success: function(response){
                location.reload(); 
 
         	},
			 error: function(){	
				alert("An error occurred: " & result.errorMessage);
			}
    	 	});
		 });
	 });
</script>