        <div class="modal fade in" id="edituserform">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Edit User</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" id="adduserform">
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="text" class="control-label">Username</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="text" class="control-label">Name</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Name" id="rname" name="rname">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="text" class="control-label">Email</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email address" id="email" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="isadmin">Admin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="btn-sm btn-primary">
                                        <label>
                                            <input type="" name="password generate">Generate new password</label>
                                    </div>
                                </div>    
                            </div>  
                        </form>
                    </div>
                    <div class="modal-footer">
                  <div id="success-buttons<?=$row['id']?>" style="display: none">
                    <div class="alert alert-dimissable alert-success" style="display: none;" id="update-success<?=$row['QMS_id']?>">User Details Changed!</div>
                    <button type="button" class="btn btn-default refresh" data-dismiss="modal">Continue</button>
                  </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Close</a>
                        <a class="btn btn-primary" id="edituserbtn">Save changes</a>
                    </div>
                </div>
            </div>
        </div>

<script>
	 $(document).ready(function(){

		 $("#edituserbtn").click(function(){
 	         $.ajax({
    		 type: "POST",
			 url: "assets/php/edituser.php",
			 data: $('.form-horizontal').serialize(),	
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