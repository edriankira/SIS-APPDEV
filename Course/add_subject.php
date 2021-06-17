<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>
<?php

$SubjCode = $SubTitle = $SubjDesc= $SubjYear = $SubjCourse = "";
$Scode_err = $Stitle_err = $Sdesc_err = $Syear_err = $Scourse_err = "";


function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}


if(isset($_POST['goAdd'])){

	require_once "../connection/config.php";
//verifictaion
	//subject code
	$input_Scode = trim($_POST["subjcode"]);
	if(empty($input_Scode)){
		$Scode_err = "Please enter subject code."; 
		$SubjCode = $input_Scode;
	}else{
		$downsql = 'SELECT Sub_code from subjects where Sub_code = "'.trim($_POST["subjcode"]).'" ';
		$downresult = mysqli_query($db, $downsql);
		if(mysqli_num_rows($downresult) == 0){
			$SubjCode = $input_Scode;
		}else{
			$Scode_err = "Subject Code Already Exist"; 
			$SubjCode = $input_Scode;
		}
		
	}
	
	//subject title
	$input_Stitle = trim($_POST["subjtitle"]);
	if(empty($input_Stitle)){
		$Stitle_err = "Please enter subject name."; 
		$SubTitle = $input_Stitle;
	}else{
		$downsql = 'SELECT Sub_title from subjects where Sub_title = "'.trim($_POST["subjtitle"]).'" ';
		$downresult = mysqli_query($db, $downsql);
		if(mysqli_num_rows($downresult) == 0){
			$SubTitle = $input_Stitle;
		}else{
			$Stitle_err = "Subject Already Exist"; 
			$SubTitle = $input_Stitle;
		}
		
	}

	//subject desc
	$input_Sdesc = trim($_POST["sdesc"]);
	if(empty($input_Sdesc)){
		$Sdesc_err = "Please enter subject description."; 
		$SubjDesc = $input_Sdesc;
	}else{
		$SubjDesc = $input_Sdesc;
	}

	//subject year
	$input_Syear = trim($_POST["syear"]);
	if(empty($input_Syear)){
		$Syear_err = "Please enter subject year level."; 
		$SubjYear = $input_Syear;
	}else{
		$SubjYear = $input_Syear;
	}

	//subject course
	$input_Scourse = trim($_POST["scourse"]);
	if(empty($input_Scourse)){
		$Scourse_err = "Please enter subject course."; 
		$SubjCourse = $input_Scourse;
	}else{
		$SubjCourse = $input_Scourse;
	}
	//end of verifictaion

	if(empty($Scode_err) && empty($Stitle_err) &&empty($Sdesc_err)&& empty($Syear_err) &&empty($Scourse_err)){

		$sql = "INSERT INTO `subjects`(Sub_code, Sub_title, Sub_desc, sub_year, sub_course)
		VALUES (?, ?, ?, ?, ?);";
		
		if($stmt = mysqli_prepare($db, $sql)){
			mysqli_stmt_bind_param($stmt, "sssss", $param_code,
			$param_title, $param_desc,$param_year, $param_course);
			
			$param_code = $SubjCode;  
			$param_title = $SubTitle;
			$param_desc = $SubjDesc;
			$param_year = $SubjYear;
			$param_course = $SubjCourse;
					
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
		<title>Subject Saving</title>
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
									<a href="" class="logo"><strong>Subject </strong>Saving</a>
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
										<h2 id="titleAdd">Add Subject</h2>
										<form method="post" id="adduserform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
										<table>
											<tr id ="nodborder">
												<td>Subject Information<br><br>
													<div class="form-group">

														<label>Subject Code <span class="text-danger"></span></label>

														<input type="text" name="subjcode" id="username" class="form-control <?php echo (!empty($Scode_err)) ? 'is-invalid': ''; ?>" value="<?php echo $SubjCode; ?>" placeholder="Enter Code">
														<span class="invalid-feedback"><?php echo $Scode_err;?></span>
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
													</div><br>

												</td>

												<td><br><br>
													<div class="form-group">

														<label>Course<span class="text-danger"></span></label>

														<select name ="scourse">
                                                            <?php include "../Account_creation/coursestd.php" ?>
                                                        </select>
													</div>
												</td>
											</tr>
												<td colspan = 3>
													<div class="form-group">

														<label>Subject name <span class="text-danger"></span></label>
														<input type="text" name="subjtitle" id="useremail" class="form-control <?php echo (!empty($Stitle_err)) ? 'is-invalid': ''; ?>" value="<?php echo $SubTitle; ?>" placeholder="Enter Name" >
														<span class="invalid-feedback"><?php echo $Stitle_err;?></span>
													</div>

													<div class="form-group">

														<label>Subject Description <span class="text-danger"></span></label>

														<input type="text" name="sdesc" id="useremail" class="form-control <?php echo (!empty($Sdesc_err)) ? 'is-invalid': ''; ?>" value="<?php echo $SubjDesc; ?>"placeholder="Enter Description" >
														<span class="invalid-feedback"><?php echo $Sdesc_err;?></span>
													</div>
												</td>
																
											<tr>
												<td colspan = 3>												
													<div class="form-group">
														<input type="submit" name="goAdd" value="Save Subject" id="submit">
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

