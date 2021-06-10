<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>

<?php

$Sname = $Syear = $Scourse= "";
$Sname_err = $Syear_err = $Scourse_err = "";


function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}


if(isset($_POST['goAdd'])){
	require_once "../connection/config.php";

	//section name
	$input_Sname = trim($_POST["sname"]);
	if(empty($input_Sname)){
		$Sname_err = "Please enter name of section."; 
		$Sname = $input_Sname;
	}else{
		$downsql = 'SELECT Section_name from section where Section_name = "'.trim($_POST["sname"]).'" ';
		$downresult = mysqli_query($db, $downsql);
		if(mysqli_num_rows($downresult) == 0){
			$Sname = $input_Sname;
		}else{
			$Sname_err = "Section Already Exist"; 
			$Sname = $input_Sname;
		}
		
	}
	
	//section year
	$input_Syear = trim($_POST["syear"]);
	if(empty($input_Syear)){
		$Syear_err = "Please enter a Year."; 
		$Syear = $input_Syear;
	} else{
		$Syear = $input_Syear;
	}

	//section course
	$input_Scourse = trim($_POST["scourse"]);
	if(empty($input_Scourse)){
		$Scourse_err = "Please enter section course."; 
		$Scourse = $input_Scourse;
	}else{
		$Scourse = $input_Scourse;
	}

	

	if(empty($Sname_err) && empty($Syear_err) &&empty($Scourse_err)){

		$sql = "INSERT INTO `section`(Section_name, Section_year, Section_course)
		VALUES (?, ?, ?);";
		
		if($stmt = mysqli_prepare($db, $sql)){
			mysqli_stmt_bind_param($stmt, "sss", $param_name,
			$param_year, $param_course);
			
			$param_name = $Sname;  
			$param_year = $Syear;
			$param_course = $Scourse;
					
			if(mysqli_stmt_execute($stmt)){
                alert("Adding Done");
				header("Refresh:0");
			}else{
                echo"error -1";
            }
			mysqli_stmt_close($stmt);
		}else echo"error 0";
		
	}else {
       // echo"error 1";
    }
}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Section Saving</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
									<a href="" class="logo"><strong>Section </strong>Saving</a>
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
										<h2 id="titleAdd">Add Section</h2>
										<form method="post" id="adduserform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
										<table>
											<tr id ="nodborder">
												<td>Section Information<br><br>
													<div class="form-group">

														<label>Section name <span class="text-danger"></span></label>

														<input type="text" name="sname" id="username" class="form-control <?php echo (!empty($Sname_err)) ? 'is-invalid': ''; ?>" value="<?php echo $Sname; ?>" placeholder="Enter Section">
														<span class="invalid-feedback"><?php echo $Sname_err;?></span>
													</div>

												</td>
												<td><br><br>
													<div class="form-group">
														<label>Year Level<span class="text-danger"></span></label>
 														<select name ="syear">
                                                            <option selected>1st Year</option>
                                                            <option>2nd Year</option>
                                                            <option>3rd Year</option>
                                                            <option>4th Year</option>
                                                        </select>
														<span class="invalid-feedback"><?php echo $Syear_err;?></span>
													</div><br>

												</td>

												<td><br><br>
													<div class="form-group">

														<label>Course<span class="text-danger"></span></label>

														<input type="text" name="scourse" id="useremail"class="form-control <?php echo (!empty($Scourse_err)) ? 'is-invalid': ''; ?>" value="<?php echo $Scourse; ?>" placeholder="Enter Last Name">
														<span class="invalid-feedback"><?php echo $Scourse_err;?></span>
													</div>
												</td>
											</tr>
																					
											<tr>
												<td colspan = 3>												
													<div class="form-group">
														<input type="submit" name="goAdd" value="Save Section" id="submit">
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
												<li><a href="StudentAddUser.php">User Registration</a></li>
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
												<li><a href="../Course/course_list.php">List of Section</a></li>
												<li><a href="../Course/course_list.php">List of Subject</a></li>
												<li><a href="../Course/course_list.php">List of Co/Extracurricular</a></li>
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

