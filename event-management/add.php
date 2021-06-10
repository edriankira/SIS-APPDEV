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
    <title>Create Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/mainAdmin.css" />
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
<body class="is-preload">
        <!-- <div id="viewScreen">
            aaaaaaaaaaaa
        </div> -->
        <!-- Wrapper -->
            <div id="wrapper">

                <!-- Main -->
                    <div id="main">
                        <div class="inner">

                            <!-- Header -->
                                <header id="header">
                                    <a href="" class="logo"><strong>Events </strong>Creation</a>
                                    <ul class="icons">
                                        <li><a href="../logout.php">Sign Out</a></li>
                                </header>
                            <!-- Banner -->
                                <section id="banner">
                                    <div class="content">
                                        <div id ="viewAdmin">
                                            <table>
                                                <tr>
                                            </table>
                                        </div>
                                        <h2 id="titleAdd">Creating Events</h2>
                                        <form method="post" id="adduserform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                                        <table>
                                            <tr id ="nodborder">
                                                <td>Events Information<br><br>
                                                    <div class="form-group">
                                                        <label>Creator</label>
                                                        <input type="text" name="creator" class="form-control <?php echo (!empty($creator_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $creator; ?>">
                                                        <span class="invalid-feedback"><?php echo $creator_err;?></span>
                                                    </div>

                                                </td>
                                                <td><br><br>
                                                    <div class="form-group">
                                                       <label>Title</label>
                                                        <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                                                        <span class="invalid-feedback"><?php echo $title_err;?></span>
                                                    </div><br>

                                                </td>

                                                <td><br><br>
                                                    <div class="form-group">
                                                        <label>Role<span class="text-danger"></span></label>
                                                        <select name ="role">
                                                            <option selected>Admin</option>
                                                            <option>Faculty</option>
                                                            <option>Students</option>
                                                            <option>Parent</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                                <td colspan = 3>
                                                    <div class="form-group">
                                                         <label>Description</label>
                                                        <input type="text" name="desc" class="form-control <?php echo (!empty($desc_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $desc; ?>">
                                                        <span class="invalid-feedback"><?php echo $desc_err;?></span>
                                                    </div>
                                                </td>                                   
                                            <tr>
                                                <td colspan = 3>                                                
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary" value="Submit">
                                                        <a href="event.php" class="btn btn-secondary ml-2">Cancel</a>
                                                    </div>

                                                </td>
                                            </tr>
                                            
                                        </form>
                                        </table>    
                                    </div>
                                    
                                </section>
                        </div>
                    </div>

                <!-- Sidebar -->
                    <div id="sidebar">
                        <div class="inner">

                            <!-- Search -->
                                <section id="search" class="alt">
                                    <form method="post" action="#">
                                        <input type="text" name="query" id="query" placeholder="Search" />
                                    </form>
                                </section>

                        <!-- Menu -->
                                <nav id="menu">
                                    <header class="major">
                                        <h2>Menu</h2>
                                    </header>
                                    <ul>
                                        <li><a href="../homepage.php">Homepage</a></li>
                                        <li>
                                            <span class="opener">Registration</span>
                                            <ul>
                                                <li><a href="../Account_creation/AdminAddUser.php">Admin Registration</a></li>
                                                <li><a href="../Account_creation/FacultyAddUser.php">Faculty Registration</a></li>
                                                <li><a href="../Account_creation/ParentAddUser.php">Parent Registration</a></li>
                                                <li><a href="../Account_creation/StudentAddUser.php">Student Registration</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                        <span class="opener">Account Management</span>
                                            <ul>
                                                <li><a href="../Account_Management/AdminManagement.php">Admin Management</a></li>
                                                <li><a href="../Account_Management/FacultyManagement.php">Faculty Management</a></li>
                                                <li><a href="../Account_Management/ParentManagement.php">Parent Management</a></li>
                                                <li><a href="../Account_Management/StudentManagement.php">Student Management</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../event-management/Event.php">Event Notification</a></li> 
                                        <li>
                                        <span class="opener">Course Management</span>
                                            <ul>
                                               <li><a href="../Course/course_list.php">List of Courses</a></li>
                                                <li><a href="../Course/section_list.php">List of Section</a></li>
                                                <li><a href="../Course/subject_list.php">List of Subject</a></li>
                                                <li><a href="../Course/extra_list.php">List of Co/Extracurricular</a></li>
                                            </ul>
                                        </li>                           
                                        <li><a href="../Map/map.php">Campus Map</a></li>
                                        <li><a href="../Announcement/announcement.php">Announcement</a></li>
                                    </ul>
                                </nav>
                            <!-- Footer -->
                                <footer id="footer">
                                    <p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
                                </footer>
                        </div>
                    </div>

            </div>
        
            

        <!-- Scripts -->
            <script src="../assets/js/jquery.min.js"></script>
            <script src="../assets/js/browser.min.js"></script>
            <script src="../assets/js/breakpoints.min.js"></script>
            <script src="../assets/js/util.js"></script>
            <script src="../assets/js/main.js"></script>


    </body>
</html>