<!DOCTYPE HTML>
<html>
<head>  
    <?php include 'include/Session/session.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="include/CSS/attendanceLayout.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <title><?php echo $_SESSION["subject"] ;?> Lecture</title>
    <style>
        #mobile
        {
            background-color: transparent;
            height: 180px;
            width: 220px;
            border-radius: 30px;
            box-shadow: 5px 5px #ff9999;
            border: 2px solid #cccccc;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            color: black;
        }
        #mobile:hover
        {
            background-color: #ff9999;
            padding: 10px;
            height: 180px;
            width: 220px;
            border-radius: 30px;
            box-shadow: 5px 5px #cccccc;
        }

        .container th 
        {
            background-color: #ffcccc;
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
									<a href="index.html" class="logo"><strong><?php echo $_SESSION["subject"] ;?></strong> Lecture</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['std_name']."</li>"
									?></ul>
								</header>

							<!-- Content -->
								<section>
                                                                    <div class="container" >
                                                                            <nav aria-label="breadcrumb">
                                                                                <ol class="breadcrumb">
                                                                                    <li class="breadcrumb-item"><a href="Lecture.php">Lecture</a></li>
                                                                                  <li class="breadcrumb-item active" aria-current="page"><?php echo $_SESSION["subject"] ;?></li>
                                                                                </ol>
                                                                            </nav>
                                                                            <?php
                                                                            require_once 'include/Connection/DBconnect.php';
                                                                            $sql = "SELECT * FROM lecture WHERE subject ='".$_SESSION["subject"]."'";
                                                                               if($result = mysqli_query($connect, $sql)){
                                                                                   if(mysqli_num_rows($result) > 0){
                                                                                       
                                                                                       echo '<table class="container">';
                                                                                           echo "<thead>";
                                                                                               echo "<tr>";
                                                                                                   echo '<th><h1>Name</h1></th>
                                                                                                        <th><h1>Description</h1></th>
                                                                                                        <th><h1>Subjects</h1></th>
                                                                                                        <th><h1>Copy</h1></th>
                                                                                                        <th><h1>View</h1></th>';
                                                                                               echo "</tr>";
                                                                                           echo "</thead>";
                                                                                           echo "<tbody>";
                                                                                           
                                                                                           
                                                                                           while($row = mysqli_fetch_array($result))
                                                                                           {
                                                                                               echo "<tr>";                                        
                                                                                                   echo "<td>" . $row['name'] . "</td>";
                                                                                                   echo "<td>" . $row['description'] . "</td>";
                                                                                                   echo "<td>" . $row['subject'] . "</td>";
                                                                                                   echo '<td>'
                                                                                                   . ' <a href="download.php?link='. $row['name'] .'"><li  style="text-decoration: none;" class="fa fa-download"></li></a>'
                                                                                                   . '</td>'; 
                                                                                                   
                                                                                                   echo '<td>'
                                                                                                   . ' <a href="views.php?link='. $row['name'] .'"><li  style="text-decoration: none;" class="fa fa-eye"></li></a>'
                                                                                                   . '</td>'; 
                                                                                               
                                                                                                  echo "</tr></tbody>";
                                                                                           }?>
                                                                                            
                                                                                           <tfoot>
                                                                                                <th><h1>Name</h1></th>
                                                                                                <th><h1>Description</h1></th>
                                                                                                <th><h1>Subject</h1></th>
                                                                                                <th><h1>Copy</h1></th>
                                                                                                <th><h1>View</h1></th>
                                                                                            </tfoot>
                                                                        
                                                                                           <?php
                                                                                           echo "</table>";
                                                                                           mysqli_free_result($result);
                                                                                   }
                                                                                   else { ?>
                                                                                            <h1 style="font-family: 'Brush Script MT', cursive;
                                                                                                       font-size: 100px;
                                                                                                       text-align: center;
                                                                                                       margin-top: 10%;
                                                                                                       color: #cccccc;
                                                                                                ">No Lecture</h1>
                                                                                   <?php }
                                                                               }
                                                                            ?>
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
                                                                            <li><a href="Homepage.php">Homepage</a></li>
                                                                            <li style="color:#ff6666;"><a href="Lecture.php">Lecture<i class="fa fa-caret-left" aria-hidden="true" style="margin-left: 190px; font-size: 20px;"></i></a></li>
                                                                            <li><a href="Attendance.php">Attendance Report</a></li>
                                                                            <li><a href="AcademicPerformance.php">Academic Performance Report </a></li>
                                                                            <li><a href="Extracuricular.php">Co/extracurricular Activities Report</a></li>
                                                                             <li><a href="Events/Event.php">Events</a></li>
										<li>
											<span class="opener"">General Report</span>
											<ul>
                                                                                            <li><a href="GENERALattendance.php">Attendance</a></li>
                                                                                            <li><a href="GENERALacademics.php">Academic Performance</a></li>
                                                                                            <li><a href="GENERALextracuricular.php">Co/extracurricular Activities</a></li>
                                                                                                
                                                                                        </ul>
										</li>
<!--										<li><a href="#">Etiam Dolore</a></li>
										<li><a href="#">Adipiscing</a></li>-->
										<li>
											<span class="opener">Account Settings</span>
											<ul>
												<li><a href="#">View information</a></li>
                                                                                                <li><a href="Signout.php">Sign out</a></li>
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