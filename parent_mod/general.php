<?php
   session_start();
     $ac= $_SESSION['ChildStudID'];
    $con=mysqli_connect("localhost:3306","root","","sisappdev");
     $query1="SELECT Sub_code FROM subjects 
   JOIN adm_studentUser ON
   adm_StudentUser.adm_stdYear = subjects.sub_year AND
   adm_StudentUser.adm_stdCourse = subjects.sub_course
   WHERE adm_studentuser.adm_stdUserNum LIKE '%$ac%'";
   
   $result1=mysqli_query($con,$query1);
    if (isset($_POST['submit'])) {
      $acc= $_SESSION['ChildStudID'];
      $sub=$_POST['subject'];
     $term=$_POST['name'];
     $query="SELECT * FROM `fct_record` WHERE term LIKE '%$term%' AND userid LIKE '%$acc%' AND Subject_code LIKE '%$sub%'";
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
              if (empty($d1) || empty($d2) || empty($d3)||empty($d4)||empty($d5)) {
               $total_count=0;
              }
              else{
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
    }
    ?>			
    
<!DOCTYPE HTML>

<html>
	<head>
		<title>General</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/fontawesome-all.min.css" />

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
									<a href="index.html" class="logo"><strong>Parent</strong> Module</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['ParentName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										
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
                    <h5 id="titleview">Please select a term to display the student grades chart</h5>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart);
                      
                      function drawChart() {
                      
                        var data = google.visualization.arrayToDataTable([
                          ['Task', 'Hours per Day'],
                          <?php
                          $query="SELECT * FROM `fct_record` WHERE term LIKE '%$term%' AND userid LIKE '%$acc%' AND Subject_code LIKE '%$sub%'";
                                    
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
                    <form action="general.php" method="POST">
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
                      <div id="piechart" style="width: 700px; height: 500px;"></div>

									</div>
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
									<form method="post" action="adminSearch.php">
										<input type="text" name="query" id="query" placeholder="Search" />
										<input type="submit" name="search" style="display: none">
									</form>
								</section>

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.php">Home</a></li>
										<li><a href="ATTendance.php">Attendance</a></li>
                    <li><a href="Prt_ann/announcement.php">Announcements</a></li>
										<li><a href="grades.php">Academic Perforamance</a></li>
										<li><a href="extracuricular.php">Extracuricular Activities</a></li>
                       <li><a href="Events/Event.php">Events</a></li>
										
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
