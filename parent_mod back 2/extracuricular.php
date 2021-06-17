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
		<title>Extra curricular </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
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
									<a href="#" class="logo"><strong>Extracuricular </strong>Parent View</a>

									<ul class="icons"><?php
									echo "<li>".$_SESSION['ParentName']."</li>"
									?>
										<li><a href="../logout.php">Sign Out</a></li>
									
									

									</ul>
								</header>

							<!-- Content -->
								<section>
									
                                <style>
 .banner{
 	margin-top: 10vh;
 }
 body{
		background: url('bg.jpg');
			background-size: cover;
		background-attachment: fixed;

		  background-repeat: no-repeat;
		  width: 100%;
		  
	}

</style>
<body>
<header class="banner">
     <div class="container">
     	<div class="container-fluid padding">
     		<h2>Extracuricular Activities </h2>
               <p> </p>
     	</div>
     </div>
</header>
<div class="container">
	<div class="table-responsive">
		<div class="card-body">
		
		
				
		
		<?php
			$connection= mysqli_connect("localhost","root","");
			$db= mysqli_select_db($connection,'sisappdev');

			$query="SELECT *FROM extracur";
			$query_run=mysqli_query($connection,$query);
			$count=0;
		?>

			<table class="table">
			<br><br>
				  <thead>
				    <tr>
				      <th scope="col">EVENT NAME </th>
				      <th scope="col">SUBJECT</th>
				      <th scope="col">GRADE</th>
				      
				    </tr>
				</thead>

		 <?php
			if($query_run)
			{
				foreach($query_run as $row)
			{
			
		 ?>
				  <tbody>
				    <tr>
				     
				      <td> <?php echo $row['extra_code'];?></td>
				      <td> <?php echo $row['extra_name']; ?></td>
				      <td> <?php echo "+".$row['extra_grade']; ?></td>
				    
				      
				    </tr>
				  </tbody>
				  <?php
				}
		
			}
			else{
				echo "No Data Found!";
			}
		?>
				</table>
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
										<li><a href="ATTendance.php">ATTendance</a></li>
										<li><a href="grades.php">Academic Perforamance</a></li>
										<li><a href="extracuricular.php">Extracuricular Activities</a></li>
										<li>
											<span class="opener">General Reports</span>
											<ul>
												<li><a href="Attendance1.php">Attendance Report</a></li>
												<li><a href="general.php">Academic Report </a></li>
												
											</ul>
										</li>
									</ul>
								</nav>

							<!-- Section -->
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