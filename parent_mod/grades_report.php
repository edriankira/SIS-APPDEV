				

<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Generic - Editorial by HTML5 UP</title>
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
									<a href="#" class="logo"><strong>Parent View</strong> information of student</a>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-medium-m"><span class="label">Medium</span></a></li>
										 <img src="img/bcp.png" alt="Trulli" align="right" width="50" height="50" margin-right="100px">
									</ul>
								</header>
								<br>
								<br>
								<section id="banner">
                               
                                  <?php
  $con=mysqli_connect("localhost:3306","root","","tuklas_db");
  if ($con) {

    echo "connected";
  }
  ?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Grades', 'Total Grades'],
         <?php

         $sql="SELECT SUBJECT_CODE,FINAL FROM `aca_report`";
         $fire=mysqli_query($con,$sql);

         while ($result=mysqli_fetch_assoc($fire)) {
          echo "['".$result['SUBJECT_CODE']."',".$result['FINAL']."],";
          
         }
         ?>
        ]);

        var options = {
          title: 'Student  Grades'
          
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>


								</section>
							<!-- Content -->
						</div>
					</div>
                  </section>
                  

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">
                                  
							<!-- Search -->
								<section id="search" class="alt">
									<form method="post" action="#">
										<img src="img/bcp.png" alt="Trulli" align="center" width="50" height="50" margin-right="100px">
										<input type="text" name="query" id="query" placeholder="Search" />

									</form>
								</section>

							<!-- Menu -->
								<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.php?">Home</a></li>
										<li><a href="ATTendance.php?">Attendance</a></li>
										<li><a href="Prt_ann/announcement.php">Announcements</a></li>
										<li><a href="grades.php?">Academic Perforamance</a></li>
										<li><a href="extracuricular.php?">Extracuricular Activities</a></li>
										 <li><a href="Events/Event.php">Events</a></li>
										<li>
											<span class="opener">General Reports</span>
											<ul>
												<li><a href="#">Attendance Report</a></li>
												<li><a href="#">Academic Report </a></li>
												<li><a href="#">Extracuricular Report</a></li>
											</ul>
										</li>
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