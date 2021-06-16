<?php 
	session_start();
	if(!isset($_SESSION['FacultyName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>

<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title> Records </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
		<div id="wrapper">

<!-- Main -->
	<div id="main">
		<div class="inner">

			<!-- Header -->
				<header id="header">
					<a href="index.html" class="logo"><strong>Faculty</strong> Module</a>
					<ul class="icons"><?php
					echo "<li>".$_SESSION['FacultyName']."</li>"
					?>
						<li><a href="../logout.php">Sign Out</a></li>
					</ul>
				</header>

			<!-- Banner -->
				<section id="banner">
					<div class="content">
						<header>
							<h2>Welcome to Faculty Module</h2>
							
					</div>
				</section>
		</div>
	</div>

<!-- Sidebar -->
	<div id="sidebar">
		<div class="inner">

			<!-- Search -->
				<section id="search" class="alt">
					<form method="post" action="adminSearch.php">
						<input type="text" name="query" id="query" placeholder="Search" />
						<input type="submit" name="search" style="display: none">
					</form>
				</section>

			<!-- Menu -->
				<nav id="menu">
					<header class="major">
						<h2>Menu</h2>
					</header>
					<ul>
						<li><a href="fct_home.php">Home</a></li>
						<li><a href="fct_upload.php">Upload</a></li>
						<li><a href="fct_attendance.php">Attendance</a></li>
						<li><a href="fct_grade.php">Grade</a></li>
						<li><a href="fct_announcement.php">Announcement</a></li>
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