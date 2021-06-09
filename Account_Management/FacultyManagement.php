<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Faculty Management</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/mainAdmin.css" />
		

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
		table th,td{
			text-align: center;
		}
		table{
			border-right:solid 1px rgba(210, 215, 217, 0.75);
			border-left: solid 1px rgba(210, 215, 217, 0.75);
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
									<a href="" class="logo"><strong>Faculty </strong>Management</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['AdminName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h2 id="titleview">Faculty Users List</h2>
										</header>
										<div id ="viewAdmin">
											<table> 
												<tr>
												<?php
												include "../connection/mobilecheck.php";
												if(isMobileDevice()){
													echo "<th>Faculty Name</th>";
													echo "<th>Faculty Status</th>";
													echo "<th>Action</th>";
												}else{
													echo "<th>Faculty ID</th>";
													echo "<th>Faculty Name</th>";
													echo "<th>Faculty Username</th>";
													echo "<th>Faculty Status</th>";
													echo "<th>Action</th>";
												}
													
												echo "</tr>";

												Display(); 
												?>
											</table>
										</div>
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
												<li><a href="../Account_creation/StudentAddUser.php">User Registration</a></li>
											</ul>
										</li>
										<li>
										<span class="opener">Account Management</span>
											<ul>
												<li><a href="AdminManagement.php">Admin Management</a></li>
												<li><a href="FacultyManagement.php">Faculty Management</a></li>
												<li><a href="ParentManagement.php">Parent Management</a></li>
												<li><a href="StudentManagement.php">Student Management</a></li>
											</ul>
										</li>
										<li><a href="../event-management/Event.php">Event Notification</a></li>								
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
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/browser.min.js"></script>
		<script src="../assets/js/breakpoints.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<script src="../assets/js/main.js"></script>


	</body>
</html>


<?php  

function Display(){
    require_once "../connection/config.php";

    $sql = "select * from adm_FacultyUser";

    if($result = mysqli_query($db, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($row['adm_fctmname'] == ""){
                    $mnameholder = "";
                }
                else $mnameholder = ", ";
				
				if(isMobileDevice()){
					echo "<tr>";
						echo "<td>" . $row['adm_fctlname'] ." " .$row['adm_fctfname'] ."$mnameholder" . $row['adm_fctmname']. "</td>";
						echo "<td>" . $row['adm_fctstatus'] . "</td>";
						echo "<td>";
						echo '<a href="FacultyView.php?id='. $row['adm_fctAdminId'] .'"><button id="modify">View</button></a>';
							// echo '<a href="update.php?id='. $row['adm_AdminId'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
							// echo '<a href="delete.php?id='. $row['adm_AdminId'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
						echo "</td>";
					echo "</tr>";
				}
				else{
					echo "<td>" . $row['adm_fctUserNum'] . "</td>";
						echo "<td>" . $row['adm_fctlname'] ." " .$row['adm_fctfname'] ."$mnameholder" . $row['adm_fctmname']. "</td>";
						echo "<td>" . $row['adm_fctusername'] . "</td>";
						echo "<td>" . $row['adm_fctstatus'] . "</td>";
						echo "<td>";
							echo '<a href="FacultyView.php?id='. $row['adm_fctId'] .'"><button id="modify">View</button></a>';
							// echo '<a href="update.php?id='. $row['adm_fctAdminId'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
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