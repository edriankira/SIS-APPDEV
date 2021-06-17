
<!DOCTYPE HTML>

<html>
	<head>
		<title>Announcement</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
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
									<a href="index.html" class="logo"><strong>Announcement</strong></a>
								
										<li><a href="../logout.php">Sign Out</a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										
                                    <br><br>
									<?php
                                        // Include config file
                                        require_once "config.php";
                                        
                                    
                                        $sql = "SELECT * FROM adm_announcement WHERE `adm_anRole` = 'Parent'";
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
                                                        echo "<td>" . $row['adm_anCreator'] . "</td>";
                                                        echo "<td>" . $row['adm_title'] . "</td>";
                                                        echo "<td>" . $row['adm_description'] . "</td>";
														echo "<td>" . $row['adm_anRole'] . "</td>";
                                                        echo "<td>";
                                                                echo '<a href="read.php?id='. $row['adm_anID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>&nbsp;  ';                                                
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
										<li><a href="fct_home.php">Home</a></li>
										<li><a href="fct_upload.php">Upload</a></li>
                                        <li><a href="fct_attendance.php">Attendance</a></li>
                                        <li><a href="fct_grade.php">Grade</a></li>
                                        <li><a href="Event.php">Events</a></li>
                                        <li><a href="fct_announcement.php">Announcement</a></li>
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