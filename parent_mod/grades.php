<?php 
	session_start();
   require_once "config.php";
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
		<title>Prelim Grade</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
									<a href="#" class="logo"><strong>Academic Performance</strong></a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['ParentName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
									
									</ul>
								</header>
							<!-- Content -->
								<section>
								
                              <head>
                               <style>
        .table{
            color: black;
             font: Century Gothic;
        }
        
        .wrapper{
            width: 800px;
            color: black;
            margin: 0 auto;
            font: Century Gothic;
            background-image: url("avengers.jpg");
            background-size:contain;
        }

        table tr td:last-child{
            width: 200px;
        }
        .src{
        	width: 200px;

        }
    

    </style>
   </head>
<body>
    <div class="wrapper">

        <div class="container-fluid">
                    <header>

                        <h3 id="titleview">Student Name:
                        <?php 
                          $res="";
                           $student= $_SESSION['ChildStudID'];  
                          $sq="SELECT *FROM adm_studentuser WHERE adm_stdUserNum LIKE '%$student%' ";
                          $res = mysqli_query($link, $sq);
                            while($row = mysqli_fetch_array($res)){
                             echo $row['adm_stdfname']." ".$row['adm_stdlname'];
                            }
                         ?>  
                         </h3>
                    </header>
            <div class="row">
                <div class="col-md-12">
                  <h5 id="titleview">Please select a term to display the student grades</h5>
                	       <form action="grades.php"class="src" method="POST">
                           <select name="term" >
                           <option value="Prelim">Prelim</option>
                           <option value="Midterm">Midterm</option>
                           <option value="Finals">Finals</option>  
                           </select>
                           <input type="submit" class="btn" name="submit" value="Find">
                           </form>
                  
                    <?php
                    // Include config file
                   
                     //this line of code create a search bar
                           if (isset($_POST['submit'])) {
                              $term=$_POST['term'];
                              $acc= $_SESSION['ChildStudID'];    
                              $sql="SELECT *FROM fct_record WHERE userid LIKE '%$acc%' AND term LIKE '%$term%'";
                
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){

                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Term</th>";
                                        echo "<th>Subject</th>";
                                        echo "<th>Grade</th>";
                                        echo "<th>Remarks</th>";
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['term'] . "</td>";
                                        echo "<td>" . $row['Subject_code'] . "</td>";
                                        //vclass
                                            $d1 = $row['d1'] ;
                                            $d2 = $row['d2'] ;
                                            $d3 = $row['d3'] ;
                                            $d4 = $row['d4'] ;
                                            $d5 = $row['d5'] ;
                                            $count = "";
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

                                                $att=$total_count*.05;

                                        $pa=$row['pa'];
                                        $pa_total=$pa*.05;

                                        $gen=$row['gen'];
                                        $gen_total=$gen*.05;

                                        $vclass=$pa_total+$gen_total+$att;
                                         
                                        
                                         //learning conpetency
                                         $aae=$row['aae'];
                                          $aae_total=$aae *.20;

                                        $eval=$row['eval'];
                                         $eval_total=$eval *.15;

                                         $ass=$row['ass'];
                                         $ass_total=$ass*.05;                                        
                                          $Lcom=$aae_total+$eval_total+$ass_total;

                                         //exam total
                                        $exam=$row['exam'];
                                         $exam_total=$exam *.35;


                                        $total_average=$vclass+$Lcom+$exam_total;
                                        $remarks="";
                                        if ( $total_average>=75) {
                                           $remarks="Passed";
                                        }
                                        else{
                                            $remarks="Failed";
                                        }
                                        echo "<td>" .  $total_average ."%". "</td>";
                                        echo "<td>" . $remarks . "</td>";
                                    echo "</tr>";
                                
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                           
                           }

                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    }
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>














                                      
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
                                                <li><a href="#">Attendance Report</a></li>
                                                <li><a href="general.php">Academic Report </a></li>
                                                <li><a href="#">Extracuricular Report</a></li>
                                            </ul>
                                        </li>
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>