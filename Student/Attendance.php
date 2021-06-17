<!DOCTYPE HTML>
<html>
<head> 
    
   <?php include 'include/Session/session.php';?>
    <?php $present = $absent = 0;?>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="include/CSS/attendanceLayout.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/main.css" />
	<title>Student Attendance</title>
    <style>
        .container th 
        {
            background-color: #ffcccc;
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
									<a href="index.html" class="logo"><strong>Student</strong> Attendance</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['std_name']."</li>"
									?></ul>
								</header>

<!-- Content -->
<section>
    
    <h1 style="color:black;"><span class="blue"></span>Student<span class="blue"></span> <span class="yellow">Personal Information</pan></h1>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" ){ include 'include/ATTENDANCE/tablecontentSELECTED.php';  }
        else    {  include 'include/ATTENDANCE/tablecontent.php';  }
    ?>
    <br>
    <div class="select_sub" style="
                            width: 300px;
                            margin-left: 380px;
         ">
        <form method="POST" action="">
            <select class="form-select"  name="optionTERM">
                <option selected>Select Term</option>
                <option value="Prelim">Prelim</option>
                <option value="Midterm">Midterm</option>
                <option value="Finals">Finals</option>
            </select>
            <input name="SUBsubmit" type="submit" value="Submit" style="position: absolute; margin-top: -45px; margin-left: 320px">
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
                                                                            <li><a href="Homepage.php">Homepage</a></li>
                                                                            <li><a href="Lecture.php">Lecture</a></li>
                                                                            <li style="color:#ff6666;"><a href="Attendance.php">Attendance Report<i class="fa fa-caret-left" aria-hidden="true" style="margin-left: 105px; font-size: 20px;"></i></a></li>
                                                                            <li><a href="AcademicPerformance.php">Academic Performance Report </a></li>
                                                                            <li><a href="Extracuricular.php">Co/extracurricular Activities Report</a></li>
										<li>
											<span class="opener"">General Report</span>
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