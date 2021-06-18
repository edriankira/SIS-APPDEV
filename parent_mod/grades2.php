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
		<title>Final Grade</title>
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
									<ul class="icons">
                                    <?php
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
                        <h2 id="titleview">Final Grade</h2>
                    </header>
            <div class="row">
                <div class="col-md-12">
                	        <a href="grades.php"><input type="submit"  value="Prelim"></a>
                            <a href="grades1.php"><input type="submit"  value="Midterm"></a>
                            <a href="grades2.php"><input type="submit"  value="Finals"></a>
                    <div class="mt-5 mb-3 clearfix">

                     
                        <p  class="pull-top
                        ">Please provide student details</p>
                        <form action="grades2.php"  class="src" method="POST"> 
                         <input type="text" name="search" placeholder="id number ">
                         <input type="text" name="searchi" placeholder="id number ">
                         <br>
                          <input type="submit" value="search">


                        </form>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                     //this line of code create a search bar
                    if (isset($_POST['search']) && isset($_POST['searchi'])) {
                    $searching = $_POST['search'];
                    $searching=preg_replace("#[^0-9a-z]#i", "", $searching);
                     $lname = $_POST['searchi'];
                    $lname=preg_replace("#[^0-9a-z]#i", "", $lname);
                      //if the inputed number of the user is equal to usir_id and section
                    $sql="SELECT *FROM fct_final WHERE userid LIKE '%$searching%' AND section LIKE '%$lname%'";
                
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){

                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Name</th>";
                                        echo "<th>Subject</th>";
                                        echo "<th>Grade</th>";
                                        echo "<th>Remarks</th>";
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['course'] . "</td>";
                                        //vclass
                                        $pa=$row['pa'];
                                        $pa_total=$pa*.05;

                                        $gen=$row['gen'];
                                        $gen_total=$gen*.05;

                                        $vclass=$pa_total+$gen_total;
                                         
                                        
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
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
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
										<li><a href="ATTendance.php">Attendance</a></li>
                                        <li><a href="Prt_ann/announcement.php">Announcements</a></li>
										<li><a href="grades.php">Academic Perforamance</a></li>
										<li><a href="extracuricular.php">Extracuricular Activities</a></li>
                                         <li><a href="Events/Event.php">Events</a></li>
										
										<li>
                                            <span class="opener">General Reports</span>
                                            <ul>
                                                <li><a href="#">Attendance Report</a></li>
                                                <li><a href="#">Academic Report </a></li>
                                                <li><a href="#">Extracuricular Report</a></li>
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