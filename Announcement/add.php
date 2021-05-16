<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$notice = "";
$username_err = $email_err = $date_err= $time_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_notice = trim($_POST["notice"]);
    if(empty($input_notice)){
        $notice_err = "Please enter a name.";
    } elseif(!filter_var($input_notice, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $notice_err = "Please enter a valid name.";
    } else{
        $notice = $input_notice;
    }

		
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err)){
        // Prepare an insert statement
         $sql = "INSERT INTO noun (notice) VALUES (?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_notice);
            
            // Set parameters
            $param_notice = $notice;
			 
            // Attempt to execute the prepared statementpv
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: announcement.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
         mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
		body{
	background-image:url("9.jpg	");
	background-size: cover;
	background-attachment: fixed;
}
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Notice</label>
                            <input type="text" name="notice" class="form-control <?php echo (!empty($notice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $notice; ?>">
                            <span class="invalid-feedback"><?php echo $notice_err;?></span>
                        </div>
						
				
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="announcement.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>