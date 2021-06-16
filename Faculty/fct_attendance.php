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

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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
    <br>
    <br>
    <br>
    <center>
    <h2>Attendance </h2>

    <?php
        $mysqli = NEW mysqli('localhost', 'root', '', 'sisdb');
        $resultSet = $mysqli->query("SELECT Section_name  FROM section");
    ?>

    <select name="sect">
        <?php 
            while ($rows =$resultSet->fetch_assoc()) {
                $Section_name = $rows['Section_name'];
                echo "<option value='$Section_name'> $Section_name </option>";
            }
        ?>
    </select>


    <select name="term">
        <option value="" >---Select Term---</option>
        <option value="fct_prelim" > PRELIM </option>
        <option value="fct_midterm" > MIDTERM </option><br>
        <option value="fct_final" > FINALS </option><br>
    </select>
    <br>
    <input type="submit" class = "btn" name="submit" id="submit" value="Confirm" />
    <br><br>
    <?php 
    if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

		    <table>
		  		<tr>
		    		<th rowspan='2'>ID #</th>
                    <th rowspan='2'>USERID</th>
                    <th rowspan='2'>Fullname</th>
                    <th rowspan='2'>Section </th>
                    <th rowspan='2'>COURSE</th>
                    <th colspan='5'>ATTENDANCE </th>
                    <th rowspan='2'>STATUS </th>
                    <th rowspan='2'>Actions </th>
		  		</tr>
		  		<tr>
                    <td>D1 </td>
                    <td>D2 </td>
                    <td>D3 </td>
                    <td>D4 </td>
                    <td>D5 </td>
                </tr>

                 <?php
    if(isset($_POST['submit']))
    {
        $_SESSION["term"] = $_POST['term'];
        $getSection = $_POST['sect'];
        $getTerm = $_POST['term'];
        require_once "db_conn.php";
        $sql = "SELECT * from ".$_POST['term']." where section='$getSection'; ";
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){

                                     
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['userid'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['section'] . "</td>";
                        echo "<td>" . $row['course'] . "</td>";
                        echo "<td>" . $row['d1'] . "</td>";
                        echo "<td>" . $row['d2'] . "</td>";
                        echo "<td>" . $row['d3'] . "</td>";
                        echo "<td>" . $row['d4'] . "</td>";
                        echo "<td>" . $row['d5'] . "</td>";

                        //checking the status of student
                        $attendance = 0;
                        $status = '';
                        $at1 = $row['d1'] ;
                        $at2 = $row['d2'] ;
                        $at3 = $row['d3'] ;
                        $at4 = $row['d4'] ;
                        $at5 = $row['d5'] ;
                        if($at1 == 'p' || $at1 == 'P')
                        {   
                            $attendance = (int)$attendance + 1;
                        }
                        if($at2 == 'p' || $at2 == 'P')
                        {   
                            $attendance = (int)$attendance + 1;
                        }
                        if($at3 == 'p' || $at3 == 'P')
                        {   
                            $attendance = (int)$attendance + 1;
                        }
                        if($at4 == 'p' || $at4 == 'P')
                        {   
                            $attendance = (int)$attendance + 1;
                        }
                        if($at5 == 'p' || $at5 == 'P')
                        {   
                            $attendance = (int)$attendance + 1;
                        }

                        if($attendance < 3)
                        {
                            $status = "INACTIVE";
                            echo "<td>$status</td>";
                        }
                        else if ($attendance == 0) {
                            $status = " ";
                            echo "<td>$status</td>";
                        }
                        else{
                            $status = "ACTIVE";
                            echo "<td>$status</td>";
                        }
                        echo "<td>"; echo '<a href="fct_insertrecord.php?id='. $row['id'] .'" class="mr-3" title="Insert Record" data-toggle="tooltip"><span class="fa fa-pencil">Insert</span></a>';
                        echo "</td>";
                        echo "</tr>";
                        }
                    mysqli_free_result($result);
                    } else{
                     echo "No records found!";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
        }
    }
?>
			</table>

	</form>	

    			
    						
										
										
										
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
                                        <li><a href="fct_announcement.php">Announcement</a></li>
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