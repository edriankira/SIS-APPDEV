

<?php
 
$dataPoints = array(
	array("label"=> "Student", "y"=> 390),
	array("label"=> "Academics", "y"=> 261),
	array("label"=> "Registration", "y"=> 158),
	array("label"=> "Attendance", "y"=> 72),
	array("label"=> "Enrolled", "y"=> 126)
);
	
?>
<!DOCTYPE HTML>
<html>
<head>  
    <?php include 'include/Session/session.php';?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Student General Report"
	},
	subtitles: [{
		text: "Student Records"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
    #attendance
    {
        background-color: #cccccc;
        width: 100%;
        height: 100px;
        text-align: center;
        padding: 10px;
        border-left: 4px solid green;
    }
</style>



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
									<a href="index.html" class="logo"><strong>Editorial</strong> by HTML5 UP</a>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
									</ul>
								</header>

							<!-- Content -->
								<section>
                                                                    <div class="container"><br>
    <div class="row">
        <div class="col">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-3">
            <div id="attendance">
                <h5>Enrolled Student</h5>
                <i class="far fa-users-class" style="
                   font-size:
                   35px; margin-left: -60px;
                   "></i>
                   <h3 
                       style="margin-top: -16%;
                              margin-left: 70px;
                       ">10+</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="attendance">
                <h5>Student took the exams</h5>
                <i class="fa fa-calculator" aria-hidden="true" style="
                   font-size:
                   35px; margin-left: -60px;
                   "></i>
                   <h3 
                       style="margin-top: -16%;
                              margin-left: 70px;
                       ">30+</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="attendance">
                <h5>Current Event</h5>
                <i class="fa fa-calendar" aria-hidden="true" style="
                   font-size:
                   35px; margin-left: -60px;
                   "></i>
                   <h3 
                       style="margin-top: -16%;
                              margin-left: 70px;
                              
                       ">3+</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="attendance">
                <h5>Most difficult Subject</h5>
                <i class="fa fa-file" aria-hidden="true" style="
                   font-size:
                   35px; margin-left: -60px;
                   "></i>
                   <h4 
                       style="margin-top: -16%;
                              margin-left: 70px;
                              
                       ">Science</h4>
            </div>
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
                                                                            <li><a href="Lecture.php">Lecture</a></li>
                                                                            <li><a href="Attendance.php">Attendance Report</a></li>
                                                                            <li><a href="AcademicPerformance.php">Academic Performance Report </a></li>
                                                                            <li><a href="Extracuricular.php">Co/extracurricular Activities Report</a></li>
										<li>
											<span class="opener" style="color:#ff6666;">General Report</span>
											<ul>
                                                                                            <li><a href="GENERALattendance.php">Attendance</a></li>
                                                                                                <li><a href="GENERALacademics.php">Academic Performance</a></li>
                                                                                                <li style="color:#ff6666;"><a href="GENERALextracuricular.php">Co/extracurricular Activities<i class="fa fa-caret-left" aria-hidden="true" style="margin-left: 10px; font-size: 20px;"></i></a></li>
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