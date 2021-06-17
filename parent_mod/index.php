<?php 
	session_start();
	if(!isset($_SESSION['ParentName'])){
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
		<title>Editorial by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
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
									<a href="#" class="logo"><strong>Student Information System</strong> </a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['ParentName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
									
									
									</ul>
								</header>
							<!-- Banner -->
								<section id="banner">
									
								</section>
								<style>
	body{
		 background-image: url("bg.jpg");
		 background-position: center;
  		 background-repeat: no-repeat;
 		 background-size: cover;
	}
	
	.card{
  			background: transparent;
  			border: none;
	}
	.card-title{
 			 font-size: 1.5em;
	}
	img.card-img-top{
  			width: 40;
	}
	.btn{
		width:100%;
	}
	.card h4,p{
		text-align: center;
	}
	.wrap{
		min-height: 100vh;
	}
	img.cardd{
		height:260px;
	}

	
</style>
<body>


<!--View-->
<section class="wrap">
	<div class="container-fluid padding">
	<div class="row padding">

		<div class="col-md-4">
			<div class="card">
			<img class="card-img-top" src="img/att.jpg">
				<div class="card-body">	
					<h4 class="card-title">Attendance</h4>
					<p class="card-text">Click the button below for more details</p>
					<a href="attendance.php" class="btn btn-outline-secondary">Access</a>
				</div>
			</div>
		</div>
	
		<div class="col-md-4">
			<div class="card">
			<img class="cardd" src="img/acad.jpg">
				<div class="card-body">
					<h4 class="card-title">Academic Performance</h4>
					<p class="card-text">Click the button below for more details</p>
					<a href="grades.php" class="btn btn-outline-secondary">Access</a>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card"s>
			<img class="cardd" src="img/CO.jpg">
				<div class="card-body">
					<h4 class="card-title">Co/Extracurricular</h4>
					<p class="card-text">Click the button below for more details</p>
					<a href="extracuricular.php" class="btn btn-outline-secondary">Access</a>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
</body>




							
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
										<li><a href="index.php">Home</a></li>
										<li><a href="ATTendance.php">ATTendance</a></li>
										<li><a href="grades.php">Academic Perforamance</a></li>
										<li><a href="extracuricular.php">Extracuricular Activities</a></li>
										
										<li>
											<span class="opener">General Reports</span>
											<ul>
												<li><a href="Attendance1.php">Attendance Report</a></li>
												<li><a href="general.php">Academic Report </a></li>
												
											</ul>
										</li>
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