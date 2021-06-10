<?php 
	session_start();
	if(!isset($_SESSION['AdminName'])){
		session_destroy();
		header("location: ../login.php");
		exit();
	}
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Activity Management</title>
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
									<a href="index.html" class="logo"><strong>Co/Extracurricular Management List</strong></a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['AdminName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
									</ul>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
									<button style="float:right;"><a href="add_extra.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Create New Activity</button></a>
                                    <br><br><br>
									<?php
                                        // Include config file
                                        require_once "include/configuration.php";
                                        
                                    
                                        $sql = "SELECT * FROM extracur";
                                        if($result = mysqli_query($link, $sql)){
                                            if(mysqli_num_rows($result) > 0){
                                                echo '<table class="table table-bordered table-striped">';
                                                    echo "<thead>";
                                                        echo "<tr>";
                                                        	echo "<th>Activity Code</th>";
                                                        	echo "<th>Activity Name</th>";
                                                            echo "<th>Grade Activity</th>";
                                                            echo "<th>Action</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                    echo "<tbody>";
                                                    while($row = mysqli_fetch_array($result)){
                                                        echo "<tr>";
                                                        echo "<td>" . $row['extra_code'] . "</td>";
                                                        echo "<td>" . $row['extra_name'] . "</td>";                                            
                                                        echo "<td>" . $row['extra_grade'] . "</td>";
                                                        echo "<td>";
                                                                echo '<a href="extra_read.php?id='. $row['extra_ID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span> View </a>&nbsp;  '; 
                                                                echo '<a href="extra_delete.php?id='. $row['extra_ID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span> Delete</a>';
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
                                        <li><a href="../homepage.php">Homepage</a></li>
                                        <li>
                                            <span class="opener">Registration</span>
                                            <ul>
                                               <li><a href="../Account_creation/AdminAddUser.php">Admin Registration</a></li>
												<li><a href="../Account_creation/FacultyAddUser.php">Faculty Registration</a></li>
												<li><a href="../Account_creation/ParentAddUser.php">Parent Registration</a></li>
												<li><a href="../Account_creation/StudentAddUser.php">Student Registration</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                        <span class="opener">Account Management</span>
                                            <ul>
                                                <li><a href="../Account_Management/AdminManagement.php">Admin Management</a></li>
                                                <li><a href="../Account_Management/FacultyManagement.php">Faculty Management</a></li>
                                                <li><a href="../Account_Management/ParentManagement.php">Parent Management</a></li>
                                                <li><a href="../Account_Management/StudentManagement.php">Student Management</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="../event-management/Event.php">Event Notification</a></li> 
                                        <li>
                                        <span class="opener">Course Management</span>
                                            <ul>
                                                <li><a href="../Course/course_list.php">List of Courses</a></li>
                                                <li><a href="../Course/section_list.php">List of Section</a></li>
                                                <li><a href="../Course/subject_list.php">List of Subject</a></li>
                                                <li><a href="../Course/extra_list.php">List of Co/Extracurricular</a></li>
                                            </ul>
                                        </li>                           
                                        <li><a href="../Map/map.php">Campus Map</a></li>
                                        <li><a href="../Announcement/announcement.php">Announcement</a></li>
                                    </ul>
                                </nav>
							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; All rights reserved. <a href="https://bcp.edu.ph/home">Bestlink College of The Philippines</a></p>
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