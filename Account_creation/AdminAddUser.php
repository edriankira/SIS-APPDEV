<?php
$pfname = $pmname = $plname = $pbday = $pgender = $pemail= $pmobile = $paddress= $pid= $pusername = $puid = $ppass = $repassword= "";
$pfname_err = $pmname_err = $plname_err = $pusername_err = 
$ppass_err = $prepass =$pbday_err = $gender_err = $pemail_err= $pmobile_err=$repassword =$address_err= $pid_err = "";

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

$ppassfinal="";
if(isset($_POST['goAdd'])){
	require_once "../connection/config.php";


	$isExist = true;
        //checking if there's a duplicate number because we use random number for id numbers to prevent errors (NOTE PARTILLY TESTED)
        do{
            //generate 8 number value
            $AD_adminID = rand(10000000,99999999);
            $sql1 = "SELECT adm_adminUserNum from adm_adminUser where adm_adminUserNum = $AD_adminID";
            if($result = mysqli_query($db, $sql1)){
                if(mysqli_num_rows($result) > 0){
                    $isExist = true;
                }
                else{
                    $isExist = false;
                }
            } 
        }while($isExist == true);



	
	//first name
	$input_fname = trim($_POST["fname"]); 
	if(empty($input_fname)){
		$pfname_err = "Please enter a first name."; 
		alert("Please enter a first name.");
		$pfname = $input_fname;
	} elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		$pfname_err = "Please enter a valid first name."; 
		alert("Please enter a valid first name.");
		$pfname = $input_fname;
	} else{
		$pfname = $input_fname;
  
	}
	
	//middle name
	$input_mname = trim($_POST["mname"]);
	if(empty($input_mname)){
		$pmname = $input_mname;
	}
	else if(!filter_var($input_mname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		$pmname_err = "Please enter a valid middle name.";
		alert("Please enter a valid middle name.");
		$pmname = $input_mname;
	} else{
		$pmname = $input_mname;
	}

	//last name
	$input_lname = trim($_POST["lname"]);
	if(empty($input_lname)){
		$plname_err = "Please enter a last name."; 
		alert("Please enter a last name.");
		$plname = $input_lname;
	} elseif(!filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		$plname_err = "Please enter a valid last name.";
		alert("Please enter a valid last name.");
		$plname = $input_lname;
	} else{
		$plname = $input_lname;
	}

	//gender
	$input_gender= trim($_POST["gender"]);
	$pgender = $input_gender;
	
	//email
	$input_email = trim($_POST["email"]);
	if (filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
		$downsql1 = 'SELECT adm_email from adm_adminuser where adm_email = "'.trim($_POST["email"]).'" ';
		$downresult1 = mysqli_query($db, $downsql1);
		if(mysqli_num_rows($downresult1) == 0){
			$pemail = $input_email;
		}else{
			$email_err = "Email Already Exist"; 
			alert("Email Already Exist");
			$pemail = $input_email;
		}
	} else {
		$pemail_err = "please enter a valid email address";
		alert("please enter a valid email address");
		$pemail = $input_email;
	}
	//bday
	$input_bday = trim($_POST["bday"]);
	if(empty($input_bday)){
		$pbday_err = "Please enter a birthday."; 
	}
	else{
		$pbday = date('Y-m-d', strtotime($_POST['bday']));
	}
	//mobile
	$input_mobile = trim($_POST["mobile"]);
	if(empty($input_mobile)){
		$pmobile_err = "Please enter a mobile number.";
		alert("Please enter a mobile number.");
		$pmobile = $input_mobile;
	}else if(is_numeric($input_mobile)){
		$downsql2 = 'SELECT adm_mobile from adm_adminuser where adm_mobile = "'.trim($_POST["mobile"]).'" ';
		$downresult2 = mysqli_query($db, $downsql2);
		if(mysqli_num_rows($downresult2) == 0){
			$pmobile = $input_mobile;
		}else{
			$email_err = "number Already Exist"; 
			alert("number Already Exist");
			$pmobile = $input_mobile;
		}
	}
	else{
		$pmobile_err = "Please enter a valid number";
		alert("Please enter a valid number");
		$pmobile = $input_mobile;
	}

	$input_address = trim($_POST["address"]);
	if(empty($input_address)){
		$paddress_err = "Please enter an address."; 
		alert("Please enter an address.");
		$paddress = $input_address;
	}else{
		$paddress = $input_address;
	}

	$input_username = trim($_POST["username"]);
	if(empty($input_username)){
		$username_err = "Please enter a username."; 
		alert("Please enter a username.");
		$pusername = $input_username;
	}else{
		$downsql = 'SELECT adm_username from adm_adminuser where adm_username = "'.trim($_POST["username"]).'" ';
		$downresult = mysqli_query($db, $downsql);
		if(mysqli_num_rows($downresult) == 0){
			$pusername = $input_username;
		}else{
			$username_err = "Username Already Exist"; 
			alert("Username Already Exist");
			$pusername = $input_username;
		}
		
	}

	$input_password = trim($_POST["password"]);
	$input_repassword = trim($_POST["repassword"]);
	if(empty($input_password) || empty($input_repassword)){
		$ppass_err = "Please enter a password."; 
		alert("Please enter a password.");
		$pusername = $input_username;
	}
	else if($input_password != $input_repassword){
		$ppass_err = "Please enter a password."; 
		alert("Password and retype password isn't match try again.");
		$ppass = "";
		$prepass = "";
	}
	else{
        $ppass = $input_password;
		$ppassfinal = password_hash($ppass, PASSWORD_DEFAULT);
	}
	

	if(empty($pfname_err) && empty($pmname_err) &&empty($plname_err) && 
	empty($pbday_err) && empty($pemail_err) && empty($address_err) &&
	empty($pusername_err) &&empty($pgender_err)){


		$sql = "INSERT INTO `adm_adminuser`(adm_adminUserNum, adm_fname, adm_lname, adm_mname, adm_bday, adm_gender, adm_email, adm_mobile, adm_address, adm_username, adm_password, adm_status)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active');";
		
		if($stmt = mysqli_prepare($db, $sql)){
			mysqli_stmt_bind_param($stmt, "sssssssssss", $param_id,
			$param_fname, $param_lname, $param_mname,$param_bday,$param_gender, 
			$param_email, $param_mobile, $param_address, $param_username, $param_pass);
			
			$param_id = $AD_adminID;  
			$param_username = $pusername;
			$param_pass = $ppassfinal;
			$param_bday = $pbday;
			$param_fname = $pfname;
			$param_mname = $pmname ;
			$param_lname = $plname ;
			$param_email = $pemail;
			$param_mobile = $pmobile;
			$param_address = $paddress;
			$param_gender = $pgender;
			
			
			if(mysqli_stmt_execute($stmt)){
                alert("Adding Done");
				header("Refresh:0");
			}else{
                echo"error -1";
            }
			mysqli_stmt_close($stmt);
		}else echo"error 0";
		
	}else {
        echo"error 1";
    }
}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Admin Creation</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/mainAdmin.css" />
		

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<style>
		a{
			text-decoration: none;	
        }



		#viewUsers{
		width: 100px;
		height: 30px;;
		font-size: 12px;
		text-decoration: none;
		text-align: center;
		float:right;

		display: block;
		}
		#titleAdd{
			display: block;
		}
		#adduserform{
			display: block;
		}
		/* #viewScreen{
			width: 500px;
			height: 500px;
			display: block;
			background-color: black;
			z-index: 1;
			border: 1px solid black;

			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		} */
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
									<a href="" class="logo"><strong>Admin </strong>Creation</a>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<div id ="viewAdmin">
											<table>
												<tr>
											</table>
										</div>
										<h2 id="titleAdd">Admin Add User
											<button id="viewUsers" onclick="location.href='AdminRegistration.php'">View Users</button></h2>
										<form method="post" id="adduserform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
											
											<div class="form-group">

												<label>First Name <span class="text-danger"></span></label>

												<input type="text" name="fname" id="username" class="form-control" placeholder="Enter First name" required><br>

											</div>

											<div class="form-group">

												<label>Middle Name <span class="text-danger"></span></label>

												<input type="text" name="mname" id="useremail" class="form-control" placeholder="Enter Middle Name"><br>

											</div>

											<div class="form-group">

												<label>Last Name <span class="text-danger"></span></label>

												<input type="text" name="lname" id="useremail" class="form-control" placeholder="Enter Last Name" required><br>

											</div>

											<div class="form-group">

												<label>Birthday <span class="text-danger"></span></label>

												<input type="date" name="bday" id="useremail" class="form-control" required><br><br>
											</div>

											<div class="form-group">

												<label>Gender <span class="text-danger"></span></label>

												<select name="gender">
													<option value="male">male</option>
													<option value="female">female</option>
												</select><br>

											</div>

											<div class="form-group">

												<label>Email <span class="text-danger"></span></label>

												<input type="email" name="email" id="useremail" class="form-control" placeholder="Enter Email" required><br>
											</div>

											<div class="form-group">

												<label>Mobile <span class="text-danger"></span></label>

												<input type="text" name="mobile" id="useremail" class="form-control" placeholder="Enter Mobile" required><br>
											</div>

											<div class="form-group">

												<label>Address <span class="text-danger"></span></label>

												<input type="text" name="address" id="useremail" class="form-control"placeholder="Enter Address" required><br>
											</div>

											<div class="form-group">

												<label>Username <span class="text-danger"></span></label>

												<input type="text" name="username" id="useremail" class="form-control" placeholder="Enter Username" required><br><br>
											</div>

											<div class="form-group">

												<label>Password <span class="text-danger"></span></label>

												<input type="password" name="password" id="useremail" class="form-control" placeholder="Enter Password" required><br><br>
											</div>

											<div class="form-group">

												<label>Re-type Password <span class="text-danger"></span></label>

												<input type="password" name="repassword" id="useremail" class="form-control" placeholder="Re-type PAssword" required><br><br>
											</div>
											
											

											<div class="form-group">

												<button type="submit" name="goAdd" value="submit" id="submit" ><i class="fa fa-fw fa-plus-circle"></i> Add Admin User</button>
											</div>
										</form>
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
											<span class="opener">Account Creation</span>
											<ul>
												<li><a href="#">Admin Registration</a></li>
												<li><a href="#">Faculty Registration</a></li>
												<li><a href="#">Parent Registration</a></li>
												<li><a href="#">User Registration</a></li>
											</ul>
										</li>
										<li><a href="../event-management/index.php">Event Notification</a></li>									
										<li><a href="../Course/course_list.php">List of Courses</a></li>									
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script>
				function viewuser(){    
           			document.getElementById("titleAdd").style["display"] = "none";
					document.getElementById("adduserform").style["display"] = "none";
					document.getElementById("viewUsers").style["display"] = "none";

					document.getElementById("titleview").style["display"] = "block";
					document.getElementById("viewAdmin").style["display"] = "block";
					document.getElementById("addbtn").style["display"] = "block";
				}
				function showAdd(){
					document.getElementById("titleAdd").style["display"] = "block";
					document.getElementById("adduserform").style["display"] = "block";
					document.getElementById("viewUsers").style["display"] = "block";

					document.getElementById("titleview").style["display"] = "none";
					document.getElementById("viewAdmin").style["display"] = "none";
					document.getElementById("addbtn").style["display"] = "none";
				}
			</script>

	</body>
</html>


<?php  

function Display(){
    require_once "connection/config.php";

    $sql = "select * from adm_AdminUser";

    if($result = mysqli_query($db, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($row['adm_mname'] == ""){
                    $mnameholder = "";
                }
                else $mnameholder = ", ";
				
				if(isMobileDevice()){
					echo "<tr>";
						echo "<td>" . $row['adm_lname'] ." " .$row['adm_fname'] ."$mnameholder" . $row['adm_mname']. "</td>";
						echo "<td>" . $row['adm_status'] . "</td>";
						echo "<td>";
						echo '<a href="read.php?id='. $row['adm_AdminId'] .'"><button id="modify">View</button></a>';
							// echo '<a href="update.php?id='. $row['adm_AdminId'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
							// echo '<a href="delete.php?id='. $row['adm_AdminId'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
						echo "</td>";
					echo "</tr>";
				}
				else{
					echo "<td>" . $row['adm_adminUserNum'] . "</td>";
						echo "<td>" . $row['adm_lname'] ." " .$row['adm_fname'] ."$mnameholder" . $row['adm_mname']. "</td>";
						echo "<td>" . $row['adm_username'] . "</td>";
						echo "<td>" . $row['adm_status'] . "</td>";
						echo "<td>";
							echo '<a href="read.php?id='. $row['adm_AdminId'] .'"><button id="modify">View</button></a>';
							// echo '<a href="update.php?id='. $row['adm_AdminId'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
							// echo '<a href="delete.php?id='. $row['adm_AdminId'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
						echo "</td>";
					echo "</tr>";
				}
					
            }
        }
    }
    mysqli_close($db);
}	

echo "<tr>";

?>