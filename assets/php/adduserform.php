<div class="modal fade in" id="adduser">
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
                                    <label for="text" class="control-label">Username</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                                </div>
                                <div class="col-sm-1">
                                    <div id="user-success" style="display:none">
                                    <span class="glyphicon glyphicon-ok" style="width:50px; height:50px; color:green;">&nbsp;</span>
                                    </div>
                                    <div id="user-failure" style="display:none">
                                    <span class="glyphicon glyphicon-remove" style="width:50px; height:50px; color:red;">&nbsp;</span>
                                    </div>
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
                                            <input type="checkbox" id="isadmin" name="isadmin">Admin</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="adduser-success" id="adduser-success-msg" style="display:none">
                            <div class=" alert alert-success">
                            <h3>User Created!</h3>
                            Your password is set to:
                                <span id="passresponse"></span>
                            </div>
                        <a class="btn btn-default" data-dismiss="modal" id="adduser-submit">Add user</a>
                        </div>
                        <div id="modal-buttons">
                        <a class="btn btn-default" data-dismiss="modal">Close</a>
                        <a class="btn btn-primary" id="addusrbtn">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
	 $(document).ready(function(){
         
         $("#adduser-success-msg").hide();
         
         $("#username").blur(function(){
                $.ajax({
            type: "POST",
            url: "../assets/php/checkuser.php",
            data: $("#adduserform").serialize(),
            success: function(cnt){
                
                if(cnt == 0){
                    $('#user-success').show();
                    $('#user-failure').hide();   
                }else{
                    $('#user-success').hide();
                    $('#user-failure').show();     
                }
            },
                error: function(){	
				alert("An error occurred: " & result.errorMessage);
       
            }
            });
         
         });

		 $("#addusrbtn").click(function(){
             $.ajax({
    		 type: "POST",
			 url: "../assets/php/adduser.php",
			 data: $("#adduserform").serialize(),	
    	     success: function(response){ 
                 $("#passresponse").text(response);
                $('#adduser-success-msg').show();
                 $('#modal-buttons').hide();
         	},
			 error: function(){	
				alert("An error occurred: " & result.errorMessage);
			}
    	 	}); 
             
		 });   
         $("#adduser-submit").click(function(){
             
             location.reload();
         });
                                    
    });
    

</script>