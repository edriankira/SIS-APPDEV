<!-- <?php 
	session_start();
	if(!isset($_SESSION['ParentName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?> -->
<!DOCTYPE HTML>

<html>
	<head>
		<title>Midterm Attendace</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/mainAdmin.css" />
		

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		
		

	<style>
		#addbtn{
			text-align: center;
			width: 60px;
			height: 35px;
			font-size: 12px;
			float: right;
			margin: 0;
			text-decoration: none;
		}
		a{
			text-decoration: none;	
		}
		#titleview{
			display:block;
		}
		#viewAdmin{
			display:block;
		}
		#modify{
			width:65px;
			height: 30px;
			outline: none;
		}
		table th,td{
			text-align: center;
		}
		table{
			border-right:solid 1px rgba(210, 215, 217, 0.75);
			border-left: solid 1px rgba(210, 215, 217, 0.75);;
		}
		/* #viewScreen{
			width: 500px;
			height: 500px;
			display: block;
			background-color: black;
			z-index: 1;
			border: 1px solid black;

			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		} */
	</style>

	</head>
	<body class="is-preload">
		<!-- <div id="viewScreen">
			aaaaaaaaaaaa
		</div> -->
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="" class="logo"><strong>Attendace </strong></a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['ParentName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h2 id="titleview">Midterm Attendace</h2>
										</header>

                                        
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                            
                                                            <a href="Attendance.php"><input type="submit"  value="Prelim"></a>
                                                            <a href="Attendance1.php"><input type="submit"  value="Midterm"></a>
                                                            <a href="Attendance2.php"><input type="submit"  value="Finals"></a>
                                                    <div class="mt-5 mb-3 clearfix">

                                                        <p  class="pull-top
                                                        ">Please provide a following student details</p>
                                                        <form action="Attendance2.php" class="src" method="POST" > 
                                                        <input type="text" name="search" placeholder="student number ">
                                                        <input type="text" name="searchi" placeholder="section">
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
                                                                        echo "<th>SUBJECT</th>";
                                                                        echo "<th>Attendance</th>";
                                                                        echo "<th>Remarks</th>";
                                                                        
                                                                    echo "</tr>";
                                                                echo "</thead>";
                                                                echo "<tbody>";
                                                                while($row = mysqli_fetch_array($result)){
                                                                        echo "<tr>";
                                                                        echo "<td>" . $row['name'] . "</td>";
                                                                        echo "<td>" . $row['course'] . "</td>";
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
                                                                        if($d2 == 'P' || $d2 == 'P')
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
                                                                            $remarks="";
                                                                        if ( $total_count>=75) {
                                                                        $remarks="Passed";
                                                                        }
                                                                        else{
                                                                            $remarks="Failed";
                                                                        }
                                                                    
                                                                    
                                                                    
                                                                        echo "<td>" .  $total_count ."%"."</td>";

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
                                                        echo "Oops! Please Enter the Details Above";
                                                    }
                                                    // Close connection
                                                    mysqli_close($link);
                                                    ?>
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
							<!-- Footer -->
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
