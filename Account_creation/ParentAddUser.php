<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>
<?php

$pfname = $pmname = $plname = $pbday = $pgender = $pemail= $pmobile = $paddress= $pid= $pusername = $puid = $ppass = $repassword= "";
$pfname_err = $pmname_err = $plname_err = $pusername_err = 
$ppass_err = $prepass =$pbday_err = $gender_err = $pemail_err= $pmobile_err=$repassword =$address_err= $pid_err = "";

$studentname = $studentname_err =  "";

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
            $sql1 = "SELECT adm_prtUserNum from adm_ParentUser where adm_prtUserNum = $AD_adminID";
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
		$pfname_err = "Please enter a First Name."; 
		$pfname = $input_fname;
	} elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		$pfname_err = "Please enter a valid First Name."; 
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
		$pmname_err = "Please enter a valid Middle Name.";
		$pmname = $input_mname;
	} else{
		$pmname = $input_mname;
	}

	//last name
	$input_lname = trim($_POST["lname"]);
	if(empty($input_lname)){
		$plname_err = "Please enter a Last Name."; 
		$plname = $input_lname;
	} elseif(!filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		$plname_err = "Please enter a valid Last Name.";
		$plname = $input_lname;
	} else{
		$plname = $input_lname;
	}

	//gender
	$input_gender= trim($_POST["gender"]);
	$pgender = $input_gender;
	
	//email
	$input_email = trim($_POST["email"]);
	if(empty($input_email)){
		$email_err = "Please enter an Email";
		$pemail = $input_email;
	}
	else if (filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
		$downsql1 = 'SELECT adm_prtemail from adm_ParentUser where adm_prtemail = "'.trim($_POST["email"]).'" ';
		$downresult1 = mysqli_query($db, $downsql1);
		if(mysqli_num_rows($downresult1) == 0){
			$pemail = $input_email;
		}else{
			$email_err = "Email Already Exist"; 
			$pemail = $input_email;
		}
	} else {
		$pemail_err = "please enter a valid email address";
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
		$pmobile = $input_mobile;
	}else if(is_numeric($input_mobile)){
		$downsql2 = 'SELECT adm_prtmobile from adm_ParentUser where adm_prtmobile = "'.trim($_POST["mobile"]).'" ';
		$downresult2 = mysqli_query($db, $downsql2);
		if(mysqli_num_rows($downresult2) == 0){
			$pmobile = $input_mobile;
		}else{
			$pmobile_err = "number Already Exist"; 
			$pmobile = $input_mobile;
		}
	}
	else{
		$pmobile_err = "Please enter a valid number";
		$pmobile = $input_mobile;
	}
	//address
	$input_address = trim($_POST["address"]);
	if(empty($input_address)){
		$address_err = "Please enter an address."; 
		$paddress = $input_address;
	}else{
		$paddress = $input_address;
	}

	$input_username = trim($_POST["username"]);
	if(empty($input_username)){
		$pusername_err = "Please enter a username."; 
		$pusername = $input_username;
	}else{
		$downsql = 'SELECT adm_prtusername from adm_ParentUser where adm_prtusername = "'.trim($_POST["username"]).'" ';
		$downresult = mysqli_query($db, $downsql);
		if(mysqli_num_rows($downresult) == 0){
			$pusername = $input_username;
		}else{
			$pusername_err = "Username Already Exist"; 
			$pusername = $input_username;
		}
		
	}

	$input_password = trim($_POST["password"]);
	$input_repassword = trim($_POST["repassword"]);
	if(empty($input_password) || empty($input_repassword)){
		$ppass_err = "Please enter a password."; 
	}
	else if($input_password != $input_repassword){
		$ppass_err = "The password didn't match."; 
		$ppass = "";
		$prepass = "";
	}
	else if($input_password == $input_repassword){
        $ppass = $input_password;
		$ppassfinal = password_hash($ppass, PASSWORD_DEFAULT);
	}

	$input_student = trim($_POST['studnumber']);
	$namehold = $_POST['nameholderH'];
	if(empty($input_student)  || $namehold == "Child ID already taken" || $namehold == "No records found"){
	$studentname_err = $namehold;
	}
	else{
		$studentname = $input_student;
	}
	
	

	if(empty($pfname_err) && empty($pmname_err) &&empty($plname_err) && 
	empty($pbday_err) && empty($pemail_err) && empty($address_err) &&
	empty($pusername_err) &&empty($pgender_err)&& empty($studentname_err) && empty($ppass_err) && !empty($input_password) && !empty($input_repassword)){


		$sql = "INSERT INTO `adm_ParentUser`(adm_prtUserNum, adm_prtfname, adm_prtlname, adm_prtmname, adm_prtbday, adm_prtgender, adm_prtemail, adm_prtmobile, adm_prtaddress, adm_prtusername, adm_prtpassword, adm_prtstatus, adm_prtchildId)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active', ?);";
		
		if($stmt = mysqli_prepare($db, $sql)){
			mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_id,
			$param_fname, $param_lname, $param_mname,$param_bday,$param_gender, 
			$param_email, $param_mobile, $param_address, $param_username, $param_pass, $param_studentname);
			
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
			$param_studentname = $studentname;
			
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
		<title>Parent Creation</title>
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
									<a href="" class="logo"><strong>Parent </strong>Registration</a>
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
										<h2 id="titleAdd">Parent Add User</h2>
										<form method="post" id="adduserform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
										<table>
											<tr id ="nodborder">
												<td>Personal Information<br><br>
													<div class="form-group">

														<label>First Name <span class="text-danger"></span></label>

														<input type="text" name="fname" id="username" class="form-control <?php echo (!empty($pfname_err)) ? 'is-invalid': ''; ?>" value="<?php echo $pfname; ?>" placeholder="Enter First name">
														<span class="invalid-feedback"><?php echo $pfname_err;?></span>
													</div>

												</td>
												<td><br><br>
													<div class="form-group">

														<label>Middle Name <span class="text-danger"></span></label>

														<input type="text" name="mname" id="useremail"  class="form-control <?php echo (!empty($pmname_err)) ? 'is-invalid': ''; ?>" placeholder="Enter Middle Name"value="<?php echo $pmname; ?>">
														<span class="invalid-feedback"><?php echo $pmname_err;?></span>
													</div><br>

												</td>

												<td><br><br>
													<div class="form-group">

														<label>Last Name <span class="text-danger"></span></label>

														<input type="text" name="lname" id="useremail"class="form-control <?php echo (!empty($plname_err)) ? 'is-invalid': ''; ?>" value="<?php echo $plname; ?>" placeholder="Enter Last Name">
														<span class="invalid-feedback"><?php echo $plname_err;?></span>
													</div>
												</td>
											</tr>
											<tr></tr>
											<tr>
												<td>
													<div class="form-group">		
														<label>Birthday <span class="text-danger"></span></label>

														<input type="date" name="bday" id="useremail" class="form-control  <?php echo (!empty($pbday_err)) ? 'is-invalid': ''; ?>" value="<?php echo $pbday; ?>" >
														<span class="invalid-feedback"><?php echo $pbday_err;?></span>
													</div>
												</td>
												<td>
												<div class="form-group">	
														<label>Gender <span class="text-danger"></span></label>
																			
														<select name="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid': ''; ?>">
															<option value="male">male</option>
															<option value="female">female</option>
														</select>
														<span class="invalid-feedback"><?php echo $gender_err;?></span>
														
													</div>
												</td>
												<td>
												<div class="form-group">		
														<label>Mobile <span class="text-danger"></span></label>
														<input type="text" name="mobile" id="useremail" class="form-control  <?php echo (!empty($pmobile_err)) ? 'is-invalid': ''; ?>" placeholder="Enter Mobile" value="<?php echo $pmobile; ?>">									
														<span class="invalid-feedback"><?php echo $pmobile_err;?></span>
													</div>
												</td>
											</tr>
											<tr></tr>
											<tr>
												<td colspan = 3>
													<div class="form-group">

														<label>Email <span class="text-danger"></span></label>
														<input type="email" name="email" id="useremail" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid': ''; ?>" value="<?php echo $pemail; ?>" placeholder="Enter Email" >
														<span class="invalid-feedback"><?php echo $pemail_err;?></span>
													</div>

													<div class="form-group">

														<label>Address <span class="text-danger"></span></label>

														<input type="text" name="address" id="useremail" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid': ''; ?>" value="<?php echo $paddress; ?>"placeholder="Enter Address" >
														<span class="invalid-feedback"><?php echo $address_err;?></span>
													</div>
												</td>
											</tr>
											<tr></tr>
											<tr>
												<td colspan = 3>Child Information<br><br>
													<label>Student Number <span class="text-danger"></span></label>
													<input type="text" name="studnumber" id="studnumber" class="form-control  <?php echo (!empty($studentname_err)) ? 'is-invalid': ''; ?>" placeholder="Enter Child ID" value="<?php echo $studentname; ?>">
													<label style="float:right" name ="nameholder" id="nameholder">No records found</label>
													<span class="invalid-feedback"><?php echo $studentname_err;?></span>
													<input type="hidden" name ="nameholderH" id= "nameholderH" value="No records found">
													<script>
													$(document).ready(function(){
															
														$("#studnumber").keyup(function(){
															var id = $("#studnumber").val();
															$.post("namequery.php",{
																getName: id
															},function(data, status){
															$("#nameholder").empty();
															$("#nameholder").html(data);
															$("#nameholderH").val(data);
															});			

														});	
													});
													</script>
												</td>
											</tr>
											<tr></tr>
											<tr>
												<td colspan = 3>Account Information<br><br>
													<div class="form-group">

														<label>Username <span class="text-danger"></span></label>

														<input type="text" name="username" id="useremail" class="form-control <?php echo (!empty($pusername_err)) ? 'is-invalid': ''; ?>" value="<?php echo $pusername; ?>" placeholder="Enter Username" >
														<span class="invalid-feedback"><?php echo $pusername_err;?></span>
													</div>

													<div class="form-group">

														<label>Password <span class="text-danger"></span></label>

														<input type="password" name="password" id="useremail" class="form-control" placeholder="Enter Password" ><br>
													</div>

													<div class="form-group">

														<label>Re-type Password <span class="text-danger"></span></label>

														<input type="password" name="repassword" id="useremail" class="form-control <?php echo (!empty($ppass_err)) ? 'is-invalid': ''; ?>" value="" placeholder="Re-type PAssword" >
														<span class="invalid-feedback"><?php echo $ppass_err;?></span>
													</div>

													<div class="form-group">

														<input type="submit" name="goAdd" value="Add Parent User" id="submit">
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
												<li><a href="AdminAddUser.php">Admin Registration</a></li>
												<li><a href="FacultyAddUser.php">Faculty Registration</a></li>
												<li><a href="#">Parent Registration</a></li>
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