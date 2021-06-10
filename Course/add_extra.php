<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>
<?php

$Ecode = $Ename = $Edesc= $Egrade= "";
$Ecode_err = $Ename_err = $Edesc_err = $Egrade_err = "";


function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if(isset($_POST['goAdd'])){
	require_once "../connection/config.php";


//co/extracurricular code
	$input_Ecode = trim($_POST["ecode"]);
	if(empty($input_Ecode)){
		$Ecode_err = "Please enter co/extracurricular code."; 
		$Ecode = $input_Ecode;
	}else{
		$downsql = 'SELECT 	extra_code  from extracur where extra_code  = "'.trim($_POST["ecode"]).'" ';
		$downresult = mysqli_query($db, $downsql);
		if(mysqli_num_rows($downresult) == 0){
			$Ecode = $input_Ecode;
		}else{
			$Ecode_err = "Code Already Exist"; 
			$Ecode = $input_Ecode;
		}
		
	}

	//co/extracurricular name
	$input_Ename = trim($_POST["ename"]);
	if(empty($input_Ename)){
		$Ename_err = "Please enter co/extracurricular title."; 
		$Ename = $input_Ename;
	}else{
		$downsql = 'SELECT extra_name from extracur where extra_name = "'.trim($_POST["ename"]).'" ';
		$downresult = mysqli_query($db, $downsql);
		if(mysqli_num_rows($downresult) == 0){
			$Ename = $input_Ename;
		}else{
			$Ename_err = "Title Already Exist"; 
			$Ename = $input_Ename;
		}
		
	}
	
	//co/extracurricular desc
	$input_Edesc = trim($_POST["edesc"]);
	if(empty($input_Edesc)){
		$Edesc_err = "Please enter a Desctiption."; 
		$Edesc = $input_Edesc;
	} else{
		$Edesc = $input_Edesc;
	}

	//co/extracurricular grade
	$input_Egrade = trim($_POST["egrade"]);
	if(empty($input_Egrade)){
		$Egrade = $input_Egrade;
	}else{
		$Egrade = $input_Egrade;
	}

	

	if(empty($Ecode_err) && empty($Ename_err) &&empty($Edesc_err)&&empty($Egrade_err)){

		$sql = "INSERT INTO `extracur`(extra_code, extra_name, extra_description, extra_grade)
		VALUES (?, ?, ?, ?);";
		
		if($stmt = mysqli_prepare($db, $sql)){
			mysqli_stmt_bind_param($stmt, "ssss", $param_code,
			$param_name, $param_desc, $param_grade);

			$param_code = $Ecode;  
			$param_name = $Ename;  
			$param_desc = $Edesc;
			$param_grade = $Egrade;
					
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
		<title>Activity Saving</title>
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
									<a href="" class="logo"><strong>Activity </strong>Saving</a>
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
										<h2 id="titleAdd">Add Co/extracurricular Activity</h2>
										<form method="post" id="adduserform" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
										<table>
											<tr id ="nodborder">
												<td>Activity Information<br><br>
													<div class="form-group">

														<label>Co/extracurricular Code <span class="text-danger"></span></label>

														<input type="text" name="ecode" id="username" class="form-control <?php echo (!empty($Ecode_err)) ? 'is-invalid': ''; ?>" value="<?php echo $Ecode; ?>" placeholder="Enter Code">
														<span class="invalid-feedback"><?php echo $Ecode_err;?></span>
													</div>

												</td>
												<td><br><br>
													<div class="form-group">

														<label>Co/extracurricular Name<span class="text-danger"></span></label>

														<input type="text" name="ename" id="useremail"class="form-control <?php echo (!empty($Ename_err)) ? 'is-invalid': ''; ?>" value="<?php echo $Ename; ?>" placeholder="Enter Name">
														<span class="invalid-feedback"><?php echo $Ename_err;?></span>
													</div><br>

												</td>

												<td><br><br>
													<div class="form-group">

														<label>Co/extracurricular Grade<span class="text-danger"></span></label>

														<input type="text" name="egrade" id="useremail"class="form-control <?php echo (!empty($Egrade_err)) ? 'is-invalid': ''; ?>" value="<?php echo $Egrade; ?>" placeholder="Enter Grade(Optional)">
														<span class="invalid-feedback"><?php echo $Egrade_err;?></span>
													</div>
												</td>
											</tr>
												<td colspan = 3>
													<div class="form-group">

														<label>Description<span class="text-danger"></span></label>
														<input type="text" name="edesc" id="useremail" class="form-control <?php echo (!empty($Edesc_err)) ? 'is-invalid': ''; ?>" value="<?php echo $Edesc; ?>" placeholder="Enter Description" >
														<span class="invalid-feedback"><?php echo $Edesc_err;?></span>
													</div>
												</td>									
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