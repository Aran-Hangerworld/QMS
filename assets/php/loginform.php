<div class="modal fade" id="login-form">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
			
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Log In</h4>
          </div>
          <div class="modal-body">
              <form class="form-signin" method="POST">

        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="user" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="pass">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="loginbtn">Sign in</button>
      </form>
        </div>  
      </div>
    </div>
</div>
<script>
	 $(document).ready(function(){

		 $("#loginbtn").click(function(){
 	         $.ajax({
    		 type: "POST",
			 url: "assets/php/login.php",
			 data: $('form.form-signin').serialize(),	
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