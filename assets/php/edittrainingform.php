<div class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="edittrainingform<?=$row['ID']?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Modal title</h4>
          </div>
                 <div class="modal-body">
                  <div id="trainingform" class="row">
                    <form class="form-horizontal<?=$row['ID']?>" role="form" id="edittrainingform<?=$row['ID']?>">
                      <input type="hidden" name="id" value="<?=$row['ID']?>">
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="username" class="control-label">Username</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" value="<?=$row['Employee']?>" class="form-control" name="username">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="name" class="control-label">Date Planned</label>
                        </div>
                        <div class="col-sm-10">
                          <input class="form-control" name="DatePlanned">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="email" class="control-label">Date Completed</label>
                        </div>
                        <div class="col-sm-10">
                          <input  class="form-control" id="Date Completed" name="DateCompleted">
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="col-sm-2">
                          <label for="email" class="control-label">Review Date</label>
                        </div>
                        <div class="col-sm-10">
                          <input  class="form-control" id="Review Date" name="ReviewDate">
                        </div>
                      </div> 
                    </form>
                  </div>
                </div>
          <div class="modal-footer">
            <a class="btn btn-default" data-dismiss="modal">Close</a>
            <a class="btn btn-primary" id="savebtn">Save changes</a>
          </div>
        </div>
      </div>
    </div>
<script>
$(document).ready(function(){
       $("#savebtn").click(function(){
             var x = this.id
             $.ajax({
    		 type: "POST",
			 url: "../assets/php/editittraining.php",
			 data: $(".form-horizontal"+x).serialize(),	
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