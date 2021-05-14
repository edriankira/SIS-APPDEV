<?php


$pfname = $pmname = $plname = $pbday = $pgender = $pemail= $pmobile = $paddress= $pid= $pusername = "";
$pfname_err = $pmname_err = $plname_err = $pusername =$pbday_err = $gender_err = $pemail_err= $pmobile_err= $address_err= $pid_err = "";

if(isset($_POST['goAdd'])){
	require_once "connection/config.php";
	$id = $_GET["id"];
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
	if(empty($input_username)){
		$username_err = "Please enter a username."; 
		alert("Please enter a username.");
		$pusername = $input_username;
	}else if($input_username == $row['adm_username']){
		$pusername = $input_username;
	} else{
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
		$sql = "UPDATE adm_adminUser SET adm_username=?, adm_bday=?,  adm_fname = ?,adm_mname = ?, 
		adm_lname = ?,adm_email = ?, adm_mobile = ?, adm_address = ?, adm_gender =?
		 WHERE adm_adminId = ?";
		
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
				header("location: read.php?id=$id");
				exit();
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
		<title>Admin Creation</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/mainAdmin.css" />
		

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<style>
		#addbtn{
			text-align: center;
			width: 60px;
			height: 35px;
			font-size: 12px;
			float: right;
			margin: 0;
			text-decoration: none;
		}
		a{
			text-decoration: none;	
		}
		#titleview{
			display:block;
		}
		#viewAdmin{
			display:block;
		}
		#modify{
			width:65px;
			height: 30px;
			outline: none;
		}

		

		#viewUsers{
		width: 100px;
		height: 30px;;
		font-size: 12px;
		text-decoration: none;
		text-align: center;
		float:right;

		display: none;
		}
		#titleAdd{
			display: none;
		}
		#adduserform{
			display: none;
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
										<header>
											<h2 id="titleview">Admin Users List<button id="addbtn" onclick="showAdd()">add</button></h2>
										</header>
										<div id ="viewAdmin">
											<table>
												<tr>
												<?php
												include "connection/mobilecheck.php";
												if(isMobileDevice()){
													echo "<th>Admin Name</th>";
													echo "<th>Admin Status</th>";
													echo "<th>Action</th>";
												}else{
													echo "<th>Admin ID</th>";
													echo "<th>Admin Name</th>";
													echo "<th>Admin Username</th>";
													echo "<th>Admin Status</th>";
													echo "<th>Action</th>";
												}
													
												echo "</tr>";

												Display(); 
												?>
											</table>
										</div>
										<h2 id="titleAdd">Admin Add User
											<button id="viewUsers" onclick="viewuser()">View Users</button></h2>
										<form method="post" id="adduserform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
											
											<div class="form-group">

												<label>First Name <span class="text-danger"></span></label>

												<input type="text" name="username" id="username" class="form-control" placeholder="Enter First name" required><br>

											</div>

											<div class="form-group">

												<label>Middle Name <span class="text-danger"></span></label>

												<input type="text" name="useremail" id="useremail" class="form-control" placeholder="Enter Middle Name"><br>

											</div>

											<div class="form-group">

												<label>Last Name <span class="text-danger"></span></label>

												<input type="text" name="useremail" id="useremail" class="form-control" placeholder="Enter Last Name" required><br>

											</div>

											<div class="form-group">

												<label>Birthday <span class="text-danger"></span></label>

												<input type="date" name="useremail" id="useremail" class="form-control" required><br><br>
											</div>

											<div class="form-group">

												<label>Gender <span class="text-danger"></span></label>

												<select name="gender">
													<option selected value="male">male</option>
													<option value="female">female</option>
												</select><br>

											</div>

											<div class="form-group">

												<label>Email <span class="text-danger"></span></label>

												<input type="email" name="useremail" id="useremail" class="form-control" placeholder="Enter Email" required><br>
											</div>

											<div class="form-group">

												<label>Mobile <span class="text-danger"></span></label>

												<input type="text" name="useremail" id="useremail" class="form-control" placeholder="Enter Mobile" required><br>
											</div>

											<div class="form-group">

												<label>Address <span class="text-danger"></span></label>

												<input type="text" name="useremail" id="useremail" class="form-control"placeholder="Enter Address" required><br>
											</div>

											<div class="form-group">

												<label>Username <span class="text-danger"></span></label>

												<input type="text" name="useremail" id="useremail" class="form-control" placeholder="Enter Username" required><br><br>
											</div>

											<div class="form-group">

												<label>Password <span class="text-danger"></span></label>

												<input type="password" name="useremail" id="useremail" class="form-control" placeholder="Enter Password" required><br><br>
											</div>

											<div class="form-group">

												<label>Re-type Password <span class="text-danger"></span></label>

												<input type="password" name="useremail" id="useremail" class="form-control" placeholder="Re-type PAssword" required><br><br>
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
										<li><a href="homepage.php">Homepage</a></li>
										<li>
											<span class="opener">Account Creation</span>
											<ul>
												<li><a href="#">Admin Registration</a></li>
												<li><a href="#">Faculty Registration</a></li>
												<li><a href="#">Parent Registration</a></li>
												<li><a href="#">User Registration</a></li>
											</ul>
										</li>
										<li><a href="generic.php">Event Notification</a></li>									
										<li><a href="Course/course_list.php">List of Courses</a></li>									
										<li><a href="#">Campus Map</a></li>
										<li><a href="#">Announcement</a></li>
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