	<?php
	session_start();
  $con=mysqli_connect("localhost:3306","root","","sisappdev");
  if (isset($_POST['submit'])) {
    $acc= $_SESSION['ChildStudID'];
   $term=$_POST['name'];
   $query="SELECT * FROM `fct_record` WHERE term LIKE '%$term%' AND userid LIKE '%$acc%'";
    $total_count="";
    $fi=mysqli_query($con,$query);
    while ($row=mysqli_fetch_assoc($fi)) {
          $d1 = $row['d1'] ;
          $d2 = $row['d2'] ;
          $d3 = $row['d3'] ;
          $d4 = $row['d4'] ;
          $d5 = $row['d5'] ;
          $count = 0;
          $status = '';
           $remarks="";
          if($d1 == 'p' || $d1 == 'P')
             {   
                  $count = (int)$count + 1;
              }
            if($d2 == 'p' || $d2 == 'P')
              {   
                $count = (int)$count + 1;
              }
               if($d3 == 'p' || $d3 == 'P')
               {   
                 $count = (int)$count + 1;
                 }
               if($d4 == 'p' || $d4 == 'P')
                {   
                 $count = (int)$count + 1;
               }
                if($d5 == 'p' || $d5 == 'P')
                {   
                 $count = (int)$count + 1;
                }
                                            
                $total_count=$count*20;
    }
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
		<title>Generic - Editorial by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style >
				section are{
				height: 200px
				width 100px
			}
			body {
				align-self: center;
                width: 1500px;
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
								<section id="banner" >
									<div class="content">
									
									
                              <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
         <?php
                           
                             $fire=mysqli_query($con,$query);
                         while ($result=mysqli_fetch_assoc($fire)) {
                                       
                         echo "['Prelimary',".$result['pa']."],";
                           echo "['Generalization',".$result['gen']."],";
                             echo "['Analysis',".$result['aae']."],";
                              echo "['Assignment',".$result['ass']."],";
                              echo "['Examination',".$result['exam']."],";
                                echo "['Attendance',". $total_count."],";
                             }
                             ?>
        ]);
        var options = {
          title: 'Acdemic PerFormance'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>   
   <body>   
    <form action="general.php" method="POST">
      <select name="name"  style="width: 200px; height: 50px;">
        <option value="Prelim">Prelim</option>
         <option value="Midterm">Midterm</option>
          <option value="Finals">Finals</option>
     
      </select>
     
      <input type="submit" name="submit" value="find here!" width="100px">
    </form>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    </body>
</section>
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
										<li><a href="ATTendance.php?">ATTendance</a></li>
										<li><a href="grades.php?">Academic Perforamance</a></li>
										<li><a href="extracuricular.php?">Extracuricular Activities</a></li>
										<li>
											<span class="opener">General Reports</span>
											<ul>
												<li><a href="#">Attendance Report</a></li>
												<li><a href="general.php">Academic Report </a></li>
												<li><a href="#">Extracuricular Report</a></li>
											</ul>
										</li>
									</ul>
								</nav>

							
								

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