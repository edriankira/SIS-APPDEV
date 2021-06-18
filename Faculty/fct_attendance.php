<?php 
	session_start();
	if(!isset($_SESSION['FacultyName'])){
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
		<title> Records </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style type="text/css">
    table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
}

table th, td {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #fff;
}
    </style>
		
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->

					<div id="main">

						<div class="inner">
                            <header id="header">
                            <a href="index.html" class="logo"><strong>Faculty</strong> Module</a>
                    <ul class="icons"><?php
                            echo "<li>".$_SESSION['FacultyName']."</li>"
                            ?>
                        <li><a href="../logout.php">Sign Out</a></li>
					</ul>
				</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">

                                        <form method="post" action="">
                                            <center>
                                            <h2>Attendance </h2>
                                            <input type="text" name="subj" id ="subj" value="<?php include "getsubj.php"?>" readonly>
                                            <br>
                                            <select name="term">
                                                <option value="" >General</option>
                                                <option value="PRELIM" > PRELIM </option>
                                                <option value="MIDTERM" > MIDTERM </option><br>
                                                <option value="FINALS" > FINALS </option><br>
                                            </select>
                                            <br>
                                            <input type="submit" class = "btn" name="submit" id="submit" value="Confirm" />
                                            <br><br>
                                            <?php 
                                            if (isset($_GET['error'])) { ?>
                                                <p class="error"><?php echo $_GET['error']; ?></p>
                                            <?php } ?>

                                            
                                        </form>	

                                        <table>
                                            <tr>
                                                <th rowspan='2'><br>USERID</th>
                                                <th rowspan='2'><br>Fullname</th>
                                                <th rowspan='2'><br>Section</th>
                                                <th colspan='5'>ATTENDANCE </th>
                                                <th rowspan='2'><br>Term</th>
												<!-- <th rowspan='2'><br>Action</th> -->
                                            </tr>
                                            <tr>
                                                <td>D1 </td>
                                                <td>D2 </td>
                                                <td>D3 </td>
                                                <td>D4 </td>
                                                <td>D5 </td>
                                            </tr>

                                            <?php include "attendance_refreseh.php" ?>
                                                

                                        </table>

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
										<li><a href="fct_home.php">Home</a></li>
                                        <li><a href="fct_upload.php">Upload</a></li>
                                        <li><a href="fct_attendance.php">Attendance</a></li>
                                        <li><a href="fct_grade.php">Grade</a></li>
                                        <li><a href="Announcement/announcement.php">Announcement</a></li>
									</ul>
								</nav>

							
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