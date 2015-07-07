        <div class="modal fade in" id="adduserform">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Add User</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" id="adduserform">
                            <div class="form-group">
                                <div class="col-sm-2">   
                                    <label type="hidden" id="id" name="id"></label>  
                                </div>    
                            </div>
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Close</a>
                        <a class="btn btn-primary" id="add-user-btn">Add user</a>
                        
                        
                        <div id="adduser-successmsg" style="display: none"> 
                         <div class="alert alert-dimissable alert-success text-center"  >
                            <h4>User Added Successfully</h4>
                            <p>Password set to
                            <h3></h3>
                            </p>
                            </div>
                  <button type="button" class="btn btn-default" id="adduser-continue" data-dismiss="modal">Continue</button>
            
                            </div>
                            
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
	 $(document).ready(function(){
		 $("#add-user-btn").click(function(){
             $.ajax({
    		 type: "POST",
			 url: "assets/php/adduser.php",
			 data: $('#adduserform').serialize(),	
    	     success: function(response){
                 alert(response);
                location.reload();
                 $('#adduserform').hide();
         	},
			 error: function(){	
				alert("An error occurred: " & result.errorMessage);
			},
    	 	});
		 });
	 });
</script>