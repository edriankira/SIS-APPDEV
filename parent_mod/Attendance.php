<!-- <?php 
	session_start();
	require_once "config.php"; 
	if(!isset($_SESSION['ParentName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?> -->
<!DOCTYPE HTML>

<html>
	<head>
		<title>Prelim Attendance</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/mainAdmin.css" />
		

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		
		

	<style>
		.wrapper{
			width: 700px;
		}
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
		.scr{
			width: 200px;
		}
		.btn{
			width: 100px;
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
									<a href="" class="logo"><strong>Attendance </strong></a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['ParentName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
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
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-12">
													          <h5 id="titleview">Please select a term to display the student Attendance</h5>
													          <form action="Attendance.php"class="src" method="POST">
													          	<select name="term" >
													          		
													          		<option value="Prelim">Prelim</option>
													          		<option value="Midterm">Midterm</option>
													          		<option value="Finals">Finals</option>	
													          	</select>
													          	<input type="submit" class="btn" name="submit" value="Find">
													          </form>
                               
													<?php
													// Include config file
													
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
																		echo "<th>SUBJECT</th>";
																	
																		echo "<th>Day 1</th>";
																		echo "<th>Day 2</th>";
																		echo "<th>Day 3</th>";
																		echo "<th>Day 4</th>";
																		echo "<th>Day 5</th>";
																	    echo "<th>Attendance</th>";
																		echo "<th>Remarks</th>";
																		
																	echo "</tr>";
																echo "</thead>";
																echo "<tbody>";
																while($row = mysqli_fetch_array($result)){
																		echo "<tr>";
																		echo "<td>" . $row['term'] . "</td>";
																		echo "<td>" . $row['Subject_code'] . "</td>";
																		echo "<td>" . $row['d1'] . "</td>";
																		echo "<td>" . $row['d2'] . "</td>";
																		echo "<td>" . $row['d3'] . "</td>";
																		echo "<td>" . $row['d4'] . "</td>";
																		echo "<td>" . $row['d5'] . "</td>";

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
                                                   }
														 else{
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
