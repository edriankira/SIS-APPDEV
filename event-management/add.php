<?php
// Include config file
require_once "../connection/config.php";
 
// Define variables and initialize with empty values
$creator = $title = $desc = $role = "";
$creator_err = $title_err = $desc_err = $role_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $isExist = true;
        //checking if there's a duplicate number because we use random number for id numbers to prevent errors (NOTE PARTILLY TESTED)
        do{
            //generate 8 number value
            $AD_adminID = rand(10000000,99999999);
            $sql1 = "SELECT adm_evtNum from adm_events where adm_evtNum = $AD_adminID";
            if($result = mysqli_query($db, $sql1)){
                if(mysqli_num_rows($result) > 0){
                    $isExist = true;
                }
                else{
                    $isExist = false;
                }
            } 
        }while($isExist == true);

    // Validate name
    $input_creator = trim($_POST["creator"]);
    if(empty($input_creator)){
        $creator_err = "Please enter a name.";
    } elseif(!filter_var($input_creator, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $creator_err = "Please enter a valid name.";
    } else{
        $creator = $input_creator;
    }

    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title.";
    }else{
        $title = $input_title;
    }

    $input_desc = trim($_POST["desc"]);
    if(empty($input_desc)){
        $desc_err = "Please put some description.";
    }else{
        $desc = $input_desc;
    }



    $input_role= trim($_POST["role"]);
	$role = $input_role;
    

		
    
    // Check input errors before inserting in database
    if(empty($creator_err) && empty($title_err) && empty($desc_err)){
        // Prepare an insert statement
         $sql = "INSERT INTO adm_events (adm_evtNum, adm_evtCreator, adm_evtTitle, adm_evtDescription,adm_evtRole) 
         VALUES (?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_num , $param_creator,$param_title,$param_desc,$param_role);
            
            // Set parameters
            $param_num = $AD_adminID;
            $param_creator = $creator;
            $param_title = $title;
            $param_desc = $desc;
            $param_role = $role;
			 
            // Attempt to execute the prepared statementpv
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: Event.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
         mysqli_stmt_close($stmt);
    }
    
    // Close dbection
    mysqli_close($db);
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
                    <p>Please fill this form and submit to add Event record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Creator</label>
                            <input type="text" name="creator" class="form-control <?php echo (!empty($creator_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $creator; ?>">
                            <span class="invalid-feedback"><?php echo $creator_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="desc" class="form-control <?php echo (!empty($desc_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $desc; ?>">
                            <span class="invalid-feedback"><?php echo $desc_err;?></span>
                        </div>
                        <div class="form-group">
                            <select name ="role">
                                <option selected>Admin</option>
                                <option>Faculty</option>
                                <option>Students</option>
                                <option>Parent</option>
                            </select>
                        </div>
						
				
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="event.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>