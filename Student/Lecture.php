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
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label" >Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
									</ul>
								</header>

							<!-- Content -->
								<section>
                                                                    <div class="container" style="padding-left: 100px;">
                                                                            <div class="row">
                                                                              <div class="col-sm">
                                                                                  <a href="function.php" id="click1">
                                                                                  <div id="mobile">
                                                                                      <i id="icon" class="fa fa-mobile" aria-hidden="true" style="font-size:100px; "></i><br>
                                                                                      <h4>Mobile Application</h4>
                                                                                  </div>
                                                                                  </a>
                                                                              </div>
                                                                              <div class="col-sm">
                                                                                  <a href="function1.php" id="click2">
                                                                                  <div id="mobile">
                                                                                      <i id="icon" class="fa fa-tasks" aria-hidden="true" style="font-size:80px; margin-bottom: 10px; "></i><br>
                                                                                      <h4>Valorant Management</h4>
                                                                                  </div>
                                                                                  </a>
                                                                              </div>
                                                                              <div class="col-sm">
                                                                                  <a href="function2.php">
                                                                                  <div id="mobile">
                                                                                      <i id="icon" class="fa fa-globe" aria-hidden="true" style="font-size:100px; "></i><br>
                                                                                      <h4>Web Development</h4>
                                                                                  </div>
                                                                                  </a>
                                                                              </div>
                                                                            </div>
                                                                            
                                                                        <div class="row" style="margin-left: 80px;">
                                                                            <div class="col-sm" style="">
                                                                                <a href="function3.php">
                                                                                  <div id="mobile">
                                                                                      <i id="icon" class="fa fa-desktop" aria-hidden="true" style="font-size:100px; "></i><br>
                                                                                      <h4>Computer Vulcanising</h4>
                                                                                  </div>
                                                                                  </a>
                                                                              </div>
                                                                            <div class="col-sm" style="margin-left: 40px;">
                                                                                <a href="function4.php">
                                                                                  <div id="mobile">
                                                                                      <i id="icon" class="fa fa-code" aria-hidden="true" style="font-size:100px; "></i><br>
                                                                                      <h4>Computer Programming 1</h4>
                                                                                  </div>
                                                                                  </a>
                                                                              </div>
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
                                                                            <li><a href="Homepage.php">Homepage</a></li>
                                                                            <li style="color:#ff6666;"><a href="Lecture.php">Lecture<i class="fa fa-caret-left" aria-hidden="true" style="margin-left: 190px; font-size: 20px;"></i></a></li>
                                                                            <li><a href="Attendance.php">Attendance Report</a></li>
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
								<section>
									<header class="major">
										<h2>Ante interdum</h2>
									</header>
									<div class="mini-posts">
										<article>
											<a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
									</div>
									<ul class="actions">
										<li><a href="#" class="button">More</a></li>
									</ul>
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Get in touch</h2>
									</header>
									<p>Sed varius enim lorem ullamcorper dolore aliquam aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin sed aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
									<ul class="contact">
										<li class="icon solid fa-envelope"><a href="#">information@untitled.tld</a></li>
										<li class="icon solid fa-phone">(000) 000-0000</li>
										<li class="icon solid fa-home">1234 Somewhere Road #8254<br />
										Nashville, TN 00000-0000</li>
									</ul>
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