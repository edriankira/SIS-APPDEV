<!DOCTYPE HTML>
<html>
<head>  
    <?php include 'include/Session/session.php';?>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <link rel="stylesheet" href="alert/dist/sweetalert.css">
        
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
    <title>Student Lecture</title>
    <?php $subject =""; ?>
    <style>
        #mobile
        {
            background-color: transparent;
            height: 180px;
            width: 220px;
            border-radius: 30px;
            box-shadow: 5px 5px #ff9999;
            border: 2px solid #cccccc;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            color: black;
        }
        #mobile:hover
        {
            background-color: #ff9999;
            padding: 10px;
            height: 180px;
            width: 220px;
            border-radius: 30px;
            box-shadow: 5px 5px #cccccc;
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
									<a href="index.html" class="logo"><strong>Lecture</strong> Lists</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['std_name']."</li>"
									?></ul>
								</header>

							<!-- Content -->
								<section>
                                                                    <div class="container" style="padding-left: 100px;">
                                                                            <div class="row">  <?php
                                                                               require_once 'include/Connection/DBconnect.php';
                                                    //                            header("Refresh:5");
                                                                                $present = $absent = 0;
                                                                                  $sql = "SELECT Sub_code, Sub_title FROM `subjects` 
																				  INNER JOIN adm_studentUser ON
																				  adm_StudentUser.adm_stdYear = subjects.sub_year AND
																				  adm_StudentUser.adm_stdCourse = subjects.sub_course
																				  WHERE adm_studentuser.adm_stdUserNum = '".$_SESSION['stnID']."' ";
                                                                                $result = $connect->query($sql);

                                                                                if ($result->num_rows > 0) { 
                                                                                  // output data of each row
                                                                                  while($row = $result->fetch_assoc()){?>
                                                                                     
                                                                                    <div class="col-sm">
                                                                                        <a href="function.php?link=<?php echo $row["Sub_code"]?>">
                                                                                            <div id="mobile">
                                                                                                <i id="icon" class="fa fa-book" aria-hidden="true" style="font-size:100px; "></i><br>
                                                                                                <h4><?php echo $row["Sub_code"]?></h4>
                                                                                            </div>
                                                                                            </a>
                                                                                          </div>    <?php  }} ?>
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
                                                                            <li style="color:#ff6666;"><a href="Lecture.php">Lecture<i class="fa fa-caret-left" aria-hidden="true" style="margin-left: 190px; font-size: 20px;"></i></a></li>
                                                                            <li><a href="Attendance.php">Attendance Report</a></li>
                                                                            <li><a href="AcademicPerformance.php">Academic Performance Report </a></li>
                                                                            <li><a href="Extracuricular.php">Co/extracurricular Activities Report</a></li>
                                                                             <li><a href="Events/Event.php">Events</a></li>
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
								<section>
									
								</section>

							<!-- Section -->
								<section>
									
								</section>

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
								</footer>
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