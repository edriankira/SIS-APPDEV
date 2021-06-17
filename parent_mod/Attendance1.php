	<?php
	session_start();
    $ac= $_SESSION['ChildStudID'];
  $con=mysqli_connect("localhost:3306","root","","sisappdev");
   $count = "";
   $absent="";
     $query1="SELECT Sub_code FROM subjects 
JOIN adm_studentUser ON
adm_StudentUser.adm_stdYear = subjects.sub_year AND
adm_StudentUser.adm_stdCourse = subjects.sub_course
 WHERE adm_studentuser.adm_stdUserNum LIKE '%$ac%'";
$result1=mysqli_query($con,$query1);
  if (isset($_POST['submit'])) {
    $acc= $_SESSION['ChildStudID'];
   $term=$_POST['name'];
   $sub=$_POST['subject'];
   $query="SELECT * FROM `fct_record` WHERE term LIKE '%$term%' AND userid LIKE '%$acc%' AND Subject_code LIKE '%$sub%'";
    $total_count="";
    $fi=mysqli_query($con,$query);
    while ($row=mysqli_fetch_assoc($fi)) {
          $d1 = $row['d1'] ;
          $d2 = $row['d2'] ;
          $d3 = $row['d3'] ;
          $d4 = $row['d4'] ;
          $d5 = $row['d5'] ;
         
           if (empty($d1) || empty($d2) || empty($d3)||empty($d4)||empty($d5)) {
             $count=0; $absent=0;
             }
            else{
             if($d1 == 'p' || $d1 == 'P')
             {   
                  $count = (int)$count + 1;
              }
              else{
              	  $absent = (int)$absent + 1;
                 }
            if($d2 == 'p' || $d2 == 'P')
              {   
                $count = (int)$count + 1;
              }
               else{
              	  $absent = (int)$absent + 1;
              }
               if($d3 == 'p' || $d3 == 'P')
               {   
                 $count = (int)$count + 1;
                 }
                  else{
              	  $absent = (int)$absent + 1;
                }
               if($d4 == 'p' || $d4 == 'P')
                {   
                 $count = (int)$count + 1;
               }
                else{
              	  $absent = (int)$absent + 1;
                   }
                if($d5 == 'p' || $d5 == 'P')
                {   
                 $count = (int)$count + 1;
                }
                 else{
              	   $absent = (int)$absent + 1;
                   }
                                            
                
                }
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
								  <ul class="icons"><?php
                  echo "<li>".$_SESSION['ParentName']."</li>"
                  ?>
                    <li><a href="../logout.php">Sign Out</a></li>
                  
                  </ul>
								</header>
								<br>
								<br>
								<section id="banner" >
									<div class="content">
									
									
                              <head>
                                  <h3 id="titleview">Student Name:
                        <?php 
                          $res="";
                           $student= $_SESSION['ChildStudID'];  
                          $sq="SELECT *FROM adm_studentuser WHERE adm_stdUserNum LIKE '%$student%' ";
                          $res = mysqli_query($con, $sq);
                            while($row = mysqli_fetch_array($res)){
                             echo $row['adm_stdfname']." ".$row['adm_stdlname'];
                            }
                         ?>  
                         </h3>
                           <h5 id="titleview">Please select a term to display the student attendance chart</h5>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
                          <?php
                                if (empty($count)) {
                                	 echo "['Absent',". $absent."],";
                                }
                                elseif (empty($absent)) {
                                	 echo "['Present',". $count."],";
                                }
                                else{
                                echo "['Present',". $count."],";
                                 echo "['Absent',". $absent."],";
                                }
                             ?>
        ]);
        var options = {
          title: 'Attendance Performance '
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>   
   <body>   
    <form action="Attendance1.php" method="POST">
       <label>Term</label>
      <select name="name"  style="width: 200px; height: 50px;">
        <option value="Prelim">Prelim</option>
         <option value="Midterm">Midterm</option>
          <option value="Finals">Finals</option>
     
      </select>
       <label>Subject</label>
        <select name="subject"  style="width: 200px; height: 50px;">
                         <?php while ($row1=mysqli_fetch_array($result1)) :;?>
                        <option><?php echo $row1['Sub_code'];  ?>  </option>
                        <?php endwhile;?>
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