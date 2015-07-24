<div class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="edituserdiv<?=$row['QMS_id']?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header ">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                  <div id="edit-user-form" class="row">
                    <form class="form-horizontal<?=$row['QMS_id']?>" role="form" id="edituserform<?=$row['QMS_id']?>">
                      <input type="hidden" name="id" id="id" value="<?=$row['QMS_id']?>">
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="username" class="control-label">Username</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" value="<?=$row['QMS_user']?>" class="form-control" name="username">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="name" class="control-label">Name</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" value="<?=$row['QMS_realname']?>" class="form-control" name="rname">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-2">
                          <label for="email" class="control-label">Email</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="email" value="<?=$row['QMS_email']?>" class="form-control" id="email" name="email">
                        </div>
                      </div>
                          <div class="form-group">
                        <div class="col-sm-2">
                          <label for="isactive" class="control-label">Active</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="checkbox" class="checkbox" id="isactive" name="isactive" <?php if($row['QMS_isactive'] == 1){echo "Checked";}?>  value="1" />
                        </div>
                        </div>
                        <div class="col-md-12">&nbsp;</div>
                        <div class="form-group">
                        <div class="col-sm-2">
                          <label for="name" class="control-label">Admin</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="checkbox" class="checkbox" value="<?=$row['QMS_isadmin']?>" <?php if($row['QMS_isadmin'] == 1){echo "Checked";}?>  value="1" >
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal-footer" >
                    <div class="changepass-success" id="changepass-success-msg" style="display:none">
                            <div class=" alert alert-success">
                            <h3>Password Updated!</h3>
                            Password is set to:
                                <span id="passresponse1"></span>
                            </div>
                        <a class="btn btn-default" data-dismiss="modal" id="changepassclosebtn" >Close</a>
                        </div>
                  <div id="modal-buttons">
                      <button type="button" class="btn btn-danger changepass" id="resetpass <?=$row['QMS_id']?>">Reset Password</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edituser" id="<?=$row['QMS_id']?>">Update</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
<script>
    $(".edituser").click(function(){
             var x = this.id
             $.ajax({
    		 type: "POST",
			 url: "../assets/php/edituser.php",
			 data: $(".form-horizontal"+x).serialize(),	
    	     success: function(response){
                location.reload(); 
                $('#user-success'+x).show();
                 },
			 error: function(){	
				alert("An error occurred: " & result.errorMessage);
			}
    	 	}); 
		 });
    
$(".changepass").click(function(){
         var y = this.id
         $.ajax({
		 type: "POST",
         url: "../assets/php/changepass.php",
		 data: $(".form-horizontal"+y).serialize(),	
    	 success: function(response){
             location.reload(); 
             alert(response);
              $('#changepass-success-msg'+y).show();
              $("#passresponse1").text(response);
                 $('#modal-buttons').hide();
                 },
			 error: function(){	
				alert("An error occurred: " & result.errorMessage);
			}
    	 	}); 
		 }); 
$("#changepassclosebtn").click(function(){
 location.reload();   
});


</script>