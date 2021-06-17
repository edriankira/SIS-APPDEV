<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <?php include 'include/Headerfiles/HEADER1.php';?>
       <?php include 'include/LOGINprocess/STUDENTaccount.php';?>
	<style type="text/css">
             #sacc
               {
                   width: 300px;
                   border: none;
                   border-bottom: 2px solid black;
                   border-radius: 50px 50px 50px 50px;
                   height: 40px;
                   text-align-last:center; 
               }
               i.img-logo img
               {
                   border: none;
                   border-radius: 0px;
               }

	</style>
</head>
<body>
    <div class="container">
        
             <form action="" method="POST">
               <i class="img-logo"> <img src="Image/logo.png"></i>
               <br><h4 class="label"><b>Enter your Account</b></h4>
               
               <div class="form-group">
                   <select id="sacc" class="form-select form-select-sm" aria-label=".form-select-sm example" name="roles">
                    <option selected>Select your accout</option>
                    <option value="Admin_account">Admin account</option>
                    <option value="Faculty_account">Faculty account</option>
                    <option value="Parent_account">Parent account</option>
                    <option value="Student_account">Student account</option>
                </select>
                </div>
               
	 	<div class="form-group">
                    <input required type="text" name="User" placeholder="Username">
	 	</div>
               
	 	<div class="form-group">
	 		<input required type="Password" name="Pass" placeholder="Password">
	 	</div>
               

	 	<div class="form-group">
                    <button type="submit" name="LOGIN" id="sub"> <i class="img-login"></i> Login</button>
	 	</div>
               
               
                </form>
	 	 <p class="fs">Forgot <a href="">Username</a> / <a href="#">Password</a> ?</p>
                 <p class="acc"> Don't have an account ? <a href="#" target="_SELF"
                                                 > Sign up </a></p>             
    </div>
</body>
</html>