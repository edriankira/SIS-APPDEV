<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>
<?php
	require_once "../connection/config.php";
	$pfname = $pmname = $plname = $pbday = $pgender = $pemail= $pmobile = $paddress= $pid= $pusername = "";
	$pfname_err = $pmname_err = $plname_err = $pusername =$pbday_err = $gender_err = $pemail_err= $pmobile_err= $address_err= $pid_err = "";
	
	
		function alert($msg) {
			echo "<script type='text/javascript'>alert('$msg');</script>";
		}
	
		if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

			$sql = "SELECT * FROM adm_StudentUser WHERE adm_stdId = ?";
			
			if($stmt = mysqli_prepare($db, $sql)){
		
				mysqli_stmt_bind_param($stmt, "i", $param_id);
				
				$param_id = trim($_GET["id"]);
				
				if(mysqli_stmt_execute($stmt)){
					$result = mysqli_stmt_get_result($stmt);
			
					if(mysqli_num_rows($result) == 1){
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						$pfname = $row['adm_stdfname'];
						$pmname = $row['adm_stdmname'];
						$plname = $row['adm_stdlname'];
						$pbirthday = $row['adm_stdbday'];
						$pgender = $row['adm_stdgender'];
						$pmobile = $row['adm_stdmobile'];
						$pemail = $row['adm_stdemail'];
						$paddress = $row['adm_stdaddress'];
						$pusername = $row['adm_stdusername'];
						
						$newdate = date('d-m-Y', strtotime($row['adm_stdbday']));
						
						
					} else{
						header("location: error.php");
						exit();
					}
					
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
		 
			mysqli_stmt_close($stmt);        
		}
		if(isset($_POST['goEdit'])){
	
			$id = $_POST["id"];
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
	
			$input_username = trim($_POST["username"]);
			
			$firstsql = 'SELECT adm_stdId from adm_StudentUser where adm_stdusername = "'.trim($_POST["username"]).'" ';
			$firstresult = mysqli_query($db, $firstsql);
	
			if(empty($input_username)){
				$username_err = "Please enter a username."; 
				alert("Please enter a username.");
				$pusername = $input_username;
			}else if(mysqli_num_rows($firstresult) == 1){
				$pusername = $input_username;
			} 
			else{
				$downsql = 'SELECT adm_stdusername from adm_StudentUser where adm_stdusername = "'.trim($_POST["username"]).'" ';
				$downresult = mysqli_query($db, $downsql);
				if(mysqli_num_rows($downresult) == 0){
					$pusername = $input_username;
				}else{
					$username_err = "Username Already Exist"; 
					alert("Username Already Exist");
					$pusername = $input_username;
				}
				
			}
	
			//gender
			$input_gender= trim($_POST["gender"]);
			$pgender = $input_gender;
			
			//email
			$input_email = trim($_POST["email"]);
			if (filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
				$pemail = $input_email;
			} else {
				$pemail_err = "please enter a valid email address";
				alert("please enter a valid email address");
				$pemail = $input_email;
			}
		
			$input_bday = trim($_POST["bday"]);
			if(empty($input_bday)){
				$pbday_err = "Please enter a birthday."; 
			}
			else{
				$pbday = date('Y-m-d', strtotime($_POST['bday']));
			}
		
			$input_mobile = trim($_POST["mobile"]);
			if(empty($input_mobile)){
				$pmobile_err = "Please enter a mobile number.";
				alert("Please enter a mobile number.");
				$pmobile = $input_mobile;
			}else if(is_numeric($input_mobile)){
				$pmobile = $input_mobile;
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
		
			
		
			if(empty($pfname_err) && empty($pmname_err) &&empty($plname_err) && 
			empty($pbday_err) && empty($pemail_err) && empty($address_err) &&
			empty($pusername_err) &&empty($pgender_err)){
				$sql = "UPDATE adm_StudentUser SET adm_stdusername=?, adm_stdbday=?,  adm_stdfname = ?,adm_stdmname = ?, 
				adm_stdlname = ?,adm_stdemail = ?, adm_stdmobile = ?, adm_stdaddress = ?, adm_stdgender =?
				 WHERE adm_stdId = ?";
				
				if($stmt = mysqli_prepare($db, $sql)){
					mysqli_stmt_bind_param($stmt, "sssssssssi",
					$param_username, $param_bday,$param_fname,$param_mname,$param_lname,
					$param_email,$param_mobile,$param_address,$param_gender, $param_id);
					
					  
					$param_username = $pusername;
					$param_bday = $pbday;
					$param_fname = $pfname;
					$param_mname = $pmname ;
					$param_lname = $plname ;
					$param_email = $pemail;
					$param_mobile = $pmobile;
					$param_address = $paddress;
					$param_gender = $pgender;
					$param_id = $id;
					
					
					if(mysqli_stmt_execute($stmt)){
						header("location: StudentView.php?id=$id");
						exit();
					} else {
						alert("Can't be done");
					}
				}
				 
				mysqli_stmt_close($stmt);
				mysqli_close($db);
			}
		}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Student Update</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/mainAdmin.css" />

	<style>
		a{
			text-decoration: none;	
        }

		input[type="date"]{
			width: 100%;
			height: 2.75em;
			border-radius: 0.375em;
			border: solid 1px rgba(210, 215, 217, 0.75);
			box-shadow: none;
			display: block;
			outline: 0;
			padding: 0 1em;
			background: #ffffff;
		}
		input[type="date"]:focus{
			border-color: #f56a6a;
			box-shadow: 0 0 0 1px #f56a6a;
		}
		table tbody tr {
		border: none
		}

		table{
			border: solid 1px rgba(210, 215, 217, 0.75);;
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
									<a href="" class="logo"><strong>Student </strong>Update User</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['AdminName']."</li>"
									?>
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
										<h2 id="titleAdd">Update User</h2>
										<form method="post" id="adduserform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
										<table>
											<tr id ="nodborder">
												<td>Personal Information<br><br>
													<div class="form-group">

														<label>First Name <span class="text-danger"></span></label>

														<input type="text" name="fname" id="username" class="form-control <?php echo (!empty($pfname_err)) ? 'is-invalid': ''; ?>" value="<?php echo $row["adm_stdfname"];; ?>" placeholder="Enter First name">
														<span class="invalid-feedback"><?php echo $pfname_err;?></span>
													</div>

												</td>
												<td><br><br>
													<div class="form-group">

														<label>Middle Name <span class="text-danger"></span></label>

														<input type="text" name="mname" id="useremail"  class="form-control <?php echo (!empty($pmname_err)) ? 'is-invalid': ''; ?>" placeholder="Enter Middle Name"value="<?php echo $row["adm_stdmname"]; ?>">
														<span class="invalid-feedback"><?php echo $pmname_err;?></span>
													</div><br>

												</td>

												<td><br><br>
													<div class="form-group">

														<label>Last Name <span class="text-danger"></span></label>

														<input type="text" name="lname" id="useremail"class="form-control <?php echo (!empty($plname_err)) ? 'is-invalid': ''; ?>" value="<?php echo $row["adm_stdlname"]; ?>" placeholder="Enter Last Name">
														<span class="invalid-feedback"><?php echo $plname_err;?></span>
													</div>
												</td>
											</tr>
											<tr></tr>
											<tr>
												<td>
													<div class="form-group">		
														<label>Birthday <span class="text-danger"></span></label>

														<input type="date" name="bday" id="useremail" class="form-control  <?php echo (!empty($pbday_err)) ? 'is-invalid': ''; ?>" value="<?php echo $row["adm_stdbday"]; ?>" >
														<span class="invalid-feedback"><?php echo $pbday_err;?></span>
													</div>
												</td>
												<td>
													<div class="form-group">	
															<label>Gender <span class="text-danger"></span></label>					
															<?php
																if($row['adm_stdgender'] == "male" || $row['adm_stdgender'] == "Male"){
																	echo ' <select name="gender">
																					<option selected value="Male">Male</option>
																					<option value="Female">Female</option>
																				</select>';
																}else{
																	echo '<select name="gender">
																					<option  value="Male">Male</option>
																					<option selected value="Female">Female</option>
																				</select>';
																}
																?>
														<span class="invalid-feedback"><?php echo $pgender_err;?></span>
															
													</div>
												</td>
												<td>
												<div class="form-group">		
														<label>Mobile <span class="text-danger"></span></label>
														<input type="text" name="mobile" id="useremail" class="form-control  <?php echo (!empty($pmobile_err)) ? 'is-invalid': ''; ?>" placeholder="Enter Mobile" value="<?php echo $row["adm_stdmobile"];; ?>">									
														<span class="invalid-feedback"><?php echo $pmobile_err;?></span>
													</div>
												</td>
											</tr>
											<tr></tr>
											<tr>
												<td colspan = 3>
													<div class="form-group">

														<label>Email <span class="text-danger"></span></label>
														<input type="email" name="email" id="useremail" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid': ''; ?>" value="<?php echo $row["adm_stdemail"]; ?>" placeholder="Enter Email" >
														<span class="invalid-feedback"><?php echo $email_err;?></span>
													</div>

													<div class="form-group">

														<label>Address <span class="text-danger"></span></label>

														<input type="text" name="address" id="useremail" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid': ''; ?>" value="<?php echo $row["adm_stdaddress"]; ?>"placeholder="Enter Address" >
														<span class="invalid-feedback"><?php echo $address_err;?></span>
													</div>
												</td>
											</tr>
											<tr></tr>
											<tr>
												<td colspan = 3>Account Information<br><br>
													<div class="form-group">

														<label>Username <span class="text-danger"></span></label>

														<input type="text" name="username" id="useremail" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid': ''; ?>" value="<?php echo $row["adm_stdusername"]; ?>" placeholder="Enter Username" >
														<span class="invalid-feedback"><?php echo $username_err;?></span>
													</div>

													<!-- <div class="form-group">

														<label>Password <span class="text-danger"></span></label>

														<input type="password" name="password" id="useremail" class="form-control" placeholder="Enter Password" ><br>
													</div> -->

													<div class="form-group">
														<input type="hidden" name="id" value="<?php echo $param_id; ?>"/>
														<input type="submit" name="goEdit" value="Update Student User" id="submit">
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
												<li><a href="#">Admin Registration</a></li>
												<li><a href="FacultyAddUser.php">Faculty Registration</a></li>
												<li><a href="ParentAddUser.php">Parent Registration</a></li>
												<li><a href="StudentAddUser.php">Student Registration</a></li>
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
										<li><a href="../Course/course_list.php">List of Courses</a></li>									
										<li><a href="../Map/map.php">Campus Map</a></li>
										<li><a href="../Announcement/announcement.php">Announcement</a></li>
									</ul>
								</nav>
							<!-- Footer -->
								
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
s