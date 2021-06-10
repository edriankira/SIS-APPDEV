<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: login.php");
		exit();
	}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/fontawesome-all.min.css" />

	<style>
		li a{
			color: #000080;
			text-decoration: none;
			border-bottom: none;
		}
	</style>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.html" class="logo"><strong>Admin</strong> Module</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['AdminName']."</li>"
									?>
										<li><a href="logout.php">Sign Out</a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h2>Students Information System</h2>
											<p>Bestlink College of the Philippines</p>
										</header>
										<p>At Bestlink College of the Philippines, We provide and promote quality education with modern and unique techniques to able to enhance the skill and the knowledge of our dear students to make them globally competitive and productive citizens.</p>
										<ul class="actions">
											<li><a href="https://bcp.edu.ph/home" class="button big">Learn More</a></li>
										</ul>
									</div>
									<span class="image object">
										<img src="images/Backgroud.jpg" alt="" />
									</span>
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
											<span class="opener">Registration</span>
											<ul>
												<li><a href="Account_creation/AdminAddUser.php">Admin Registration</a></li>
												<li><a href="Account_creation/FacultyAddUser.php">Faculty Registration</a></li>
												<li><a href="Account_creation/ParentAddUser.php">Parent Registration</a></li>
												<li><a href="Account_creation/StudentAddUser.php">Student Registration</a></li>
											</ul>
										</li>
										<li>
										<span class="opener">Account Management</span>
											<ul>
												<li><a href="Account_Management/AdminManagement.php">Admin Management</a></li>
												<li><a href="Account_Management/FacultyManagement.php">Faculty Management</a></li>
												<li><a href="Account_Management/ParentManagement.php">Parent Management</a></li>
												<li><a href="Account_Management/StudentManagement.php">Student Management</a></li>
											</ul>
										</li>
										<li><a href="event-management/Event.php">Event Notification</a></li>									
										<li>
											<span class="opener">Course Management</span>
											<ul>
												<li><a href="Course/course_list.php">List of Courses</a></li>
                                                <li><a href="Course/section_list.php">List of Section</a></li>
                                                <li><a href="Course/subject_list.php">List of Subject</a></li>
                                                <li><a href="Course/extra_list.php">List of Co/Extracurricular</a></li>
											</ul>
										</li>									
										<li><a href="Map/map.php">Campus Map</a></li>
										<li><a href="Announcement/announcement.php">Announcement</a></li>
									</ul>
								</nav>
						
						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>