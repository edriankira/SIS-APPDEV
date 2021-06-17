<!-- <?php 
	session_start();
	if(!isset($_SESSION['ParentName'])){
		session_destroy();
		header("location: login.php");
		exit();
	}
?> -->
<!DOCTYPE HTML>

<html>
	<head>
		<title>Event</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
	
	<style>
		button, a{
			text-decoration: none;
		}
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
									<a href="#" class="logo"><strong>Event</strong> </a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['ParentName']."</li>"
									?>
										<li><a href="../../logout.php">Sign Out</a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
                                    <br><br>
									<?php
                                        // Include config file
                                        require_once "Event_config.php";
                                        
                                    
                                        $sql = "SELECT * FROM adm_events WHERE `adm_evtRole` = 'Students'";
                                        if($result = mysqli_query($link, $sql)){
                                            if(mysqli_num_rows($result) > 0){
                                                echo '<table class="table table-bordered table-striped">';
                                                    echo "<thead>";
                                                        echo "<tr>";
                                                        
                                                        echo "<th>Creator</th>";
                                                            echo "<th>Title</th>";
                                                            echo "<th>Description</th>";
															echo "<th>Role</th>";
                                                            echo "<th>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                    echo "<tbody>";
                                                    while($row = mysqli_fetch_array($result)){
                                                        echo "<tr>";
                                                        echo "<td>" . $row['adm_evtCreator'] . "</td>";
                                                        echo "<td>" . $row['adm_evtTitle'] . "</td>";
                                                        echo "<td>" . $row['adm_evtDescription'] . "</td>";
														echo "<td>" . $row['adm_evtRole'] . "</td>";
                                                        echo "<td>";
                                                                echo '<a href="Event_read.php?id='. $row['adm_evtID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>&nbsp;  '; 
                                                            echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "</tbody>";                            
                                                echo "</table>";
                                                // Free result set
                                                mysqli_free_result($result);
                                            } else{
                                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                            }
                                        } else{
                                            echo "Oops! Something went wrong. Please try again later.";
                                        }
                                        // Close connection
                                        mysqli_close($link);
                                        
                                        ?>

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
									<li><a href="../index.php">Home</a></li>
										<li><a href="../ATTendance.php">Attendance</a></li>
										<li><a href="../grades.php">Academic Perforamance</a></li>
										<li><a href="../extracuricular.php">Extracuricular Activities</a></li>
										<li><a href="Event.php">Events</a></li>
										
										<li>
											<span class="opener">General Reports</span>
											<ul>
												<li><a href="../Attendance1.php">Attendance Report</a></li>
												<li><a href="../general.php">Academic Report </a></li>
									</ul>
								</nav>
						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>