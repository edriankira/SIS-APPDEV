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
    <br>
    <br>
    <br>
    <center>
    <h2>Grades </h2>

    <?php
        $mysqli = NEW mysqli('localhost', 'root', '', 'sisappdev');
        $resultSet = $mysqli->query("SELECT Section_name  FROM section");
    ?>
    <input type="text" name="subj" id ="subj" value="<?php include "getsubj.php"?>" readonly>

    <br>


    <select name="term">
        <option value="" >All Term</option>
        <option value="Prelim" > PRELIM </option>
        <option value="Midterm" > MIDTERM </option><br>
        <option value="Final" > FINALS </option><br>
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
                    <th rowspan='2'><br>Student Number</th>
                    <th rowspan='2'><br>Full Name</th>
                    <th rowspan='2'><br>Section</th>
                    <th colspan='5'>ACTIVITY </th>
                    <th rowspan='2'><br>EXAM </th>
                    <th rowspan='2'><br>Coextra curricular</th>
                    <th rowspan='2'><br>Term </th>
                    <th rowspan='2'><br>Term Grade </th>
                    <th rowspan='2'><br>Actions </th>
		  		</tr>
		  		<tr>
                    <td>PA </td>
                    <td>GEN </td>
                    <td>AAE </td>
                    <td>EVAL </td>
                    <td>ASS </td>
                </tr>

                 <?php
    if(isset($_POST['submit']))
    {
        $term= $_POST['term'];
        $getSubj = $_POST['subj'];
        require_once "db_conn.php";
        $sql = "SELECT id,userid, CONCAT(adm_studentuser.adm_stdfname, ' ', adm_studentuser.adm_stdlname) AS FullName, 
        adm_studentuser.adm_stdSection,
        pa,gen,aae,eval,ass,exam,extracur,term, term_grade
        FROM `fct_record` 
        JOIN adm_studentuser ON
        adm_studentuser.adm_stdUserNum = fct_record.userid
        WHERE fct_record.Subject_code = '".$getSubj."' AND term LIKE '%$term%'";
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result) > 0){

                                     
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>" . $row['userid'] . "</td>";
                        echo "<td>" . $row['FullName'] . "</td>";
                        echo "<td>" . $row['adm_stdSection'] . "</td>";
                        echo "<td>" . $row['pa'] . "</td>";
                        echo "<td>" . $row['gen'] . "</td>";
                        echo "<td>" . $row['aae'] . "</td>";
                        echo "<td>" . $row['eval'] . "</td>";
                        echo "<td>" . $row['ass'] . "</td>";
                        echo "<td>" . $row['exam'] . "</td>";
                        echo "<td> " . $row['extracur'] . "</td>";
                        echo "<td> " . $row['term'] . "</td>";
                        echo "<td> " . $row['term_grade'] . "</td>";
                        echo "<td>"; echo '<a href="fct_insertrecord.php?id='. $row['id'] .'" class="mr-3" title="Insert Record" data-toggle="tooltip"><span class="fa fa-pencil">Insert</span></a>';
                                            



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