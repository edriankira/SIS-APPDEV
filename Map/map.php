<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>
<?php
include 'functions.php';
// Connect to MySQL
$pdo = pdo_connect_mysql();
// MySQL query that selects all the images
$stmt = $pdo->query('SELECT * FROM images ORDER BY uploaded_date DESC');
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>BCP Campus</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/mainnancy.css" />
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
									<a href="index.php" class="logo"><strong>Campus Map</strong></a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['AdminName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Bestlink College Of The Philippines</h1>
										<br /><br />
										<p align="center">Campuses</p>
										</header>
										<h5>Millionaire’s Village Campus</h5>
										<p>Lot 762 cor. Topaz St. and Sapphire St., Millionaire’s Village, Novaliches Quezon City, Philippines
										<b>Contact #: 463-8787, 799-6617</b></p>
										<h5>Main Campus</h5>
										<p>#1071 Brgy. Kaligayahan, Quirino Highway Novaliches Quezon City, Philippines 1123
										<b>Contact #: 417-4355</b></p>
										<h5>Bulacan Campus</h5>
										<p>IPO Road, Barangay Minuyan Proper City of San Jose Del Monte, Bulacan
										<br><b>Contact #: (044)797-2949</b></p>
									</div>

									<span class="image object">
										<br><br><br><br><br>
										<h2>Introduction</h2>
										    <video controls class="featurette-image img-responsive center-block" alt="Generic placeholder image" <source src="videos/Bcp.mp4" type="video/mp4"> </video>
									</span>
									
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Campus Map</h2>
									</header>
									<div class="posts">
									<article>
									<span class="image object"><br><br>
										  <a class="image"><img src="images/hakdog1.png" alt="" /></a>
									</span>
									</article>
									<article>
									<span class="image object">
										<h3>Ground Floor</h3>
										  <a class="image"><img src="images/1stfloor.png" alt="" /></a>
									</span>
									</article>
								</div>
								</section>
							<!-- Section -->

							<!-- Gallery -->
								<section>
									<header class="major">
									<h2>Facilities</h2>
									</header>
										<article>
										<div class="content home">
												<ul class="actions">
												<li><a href="upload.php" class="button big">Upload Image</a></li>
											</ul>
											<div class="images">
												<?php foreach ($images as $image): ?>
												<?php if (file_exists($image['path'])): ?>
												<a href="#">
													<img src="<?=$image['path']?>" alt="<?=$image['description']?>" data-id="<?=$image['id']?>" data-title="<?=$image['title']?>" width="300" height="200">
													<span><?=$image['description']?></span>
												</a>
												<?php endif; ?>
												<?php endforeach; ?>
											</div>
										</div>
										<div class="image-popup"></div>

										<!-- --> 
										<script>
										// Container we'll use to show an image
										let image_popup = document.querySelector('.image-popup');
										// Loop each image so we can add the on click event
										document.querySelectorAll('.images a').forEach(img_link => {
											img_link.onclick = e => {
												e.preventDefault();
												let img_meta = img_link.querySelector('img');
												let img = new Image();
												img.onload = () => {
													// Create the pop out image
													image_popup.innerHTML = `
														<div class="con">
															<h3>${img_meta.dataset.title}</h3>
															<p>${img_meta.alt}</p>
															<img src="${img.src}" width="500" height="400">
															<a href="delete.php?id=${img_meta.dataset.id}" class="trash" title="Delete Image"><i class="fas fa-trash fa-xs"></i></a>
														</div>
													`;
													image_popup.style.display = 'flex';
												};
												img.src = img_meta.src;
											};
										});
										// Hide the image popup container if user clicks outside the image
										image_popup.onclick = e => {
											if (e.target.className == 'image-popup') {
												image_popup.style.display = "none";
											}
										};
										</script>

								</section>
							<!-- Gallery -->

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
											<span class="opener">Account Creation</span>
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
										<li><a href="#">Campus Map</a></li>
										<li><a href="../Announcement/announcement.php">Announcement</a></li>
									</ul>
								</nav>

							<!-- Section -->

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
								</footer>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="js/jquery.min.js"></script>
			<script src="js/browser.min.js"></script>
			<script src="js/breakpoints.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>

	</body>
</html>