<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
                <?php include 'include/Session/session.php';?>
		<title>Student Homepage</title>
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
									<a href="index.html" class="logo"><strong>Student</strong> Homepage</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['std_name']."</li>"
									?>
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
                                                                            <img src="include/images/BCP.jpg" alt="" 
                                                                                 style="border-top: 2px solid #ff9999;
                                                                                 border-right: 3px solid #ff9999;
                                                                                 box-shadow: 5px 5px #f6c6f3;
                                                                                 "/>
									</span>
								</section>
							<!-- Section -->
				

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
                                                                            <li><a href="Homepage.php">Homepage</a></li>
                                                                            <li><a href="Lecture.php">Lecture</a></li>
                                                                            <li><a href="Attendance.php">Attendance Report</a></li>
                                                                            <li><a href="Stud_ann/announcement.php">Announcements</a></li>
                                                                            <li><a href="AcademicPerformance.php">Academic Performance Report </a></li>
                                                                            <li><a href="Extracuricular.php">Co/extracurricular Activities Report</a></li>
                                                                             <li><a href="Events/Event.php">Events</a></li>
										<li>
											<span class="opener">General Report</span>
											<ul>
                                                                                            <li><a href="GENERALattendance.php">Attendance</a></li>
                                                                                            <li><a href="GENERALacademics.php">Academic Performance</a></li>
                                                                                            <li><a href="GENERALextracuricular.php">Co/extracurricular Activities</a></li>
											</ul>
										</li>
<!--										<li><a href="#">Etiam Dolore</a></li>
										<li><a href="#">Adipiscing</a></li>-->
										<li>
											<span class="opener">Account Settings</span>
											<ul>
												<li><a href="#">View information</a></li>
												<li><a href="Signout.php">Sign out</a></li>
											</ul>
										</li>

									</ul>
								</nav>

							<!-- Section -->
								

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