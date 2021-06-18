<!DOCTYPE HTML>
<html>
<head>  
    <?php include 'include/Session/session.php';?>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/main.css" />
    <title>Co/extracurricular</title>
    <style>
        #event
        {
            height: auto;
            width: 100%;
            margin: 0px;
            border-bottom: 5px solid black;
            border-top: 5px solid black;
            border-radius: 90px;
            margin-bottom: 100px;
            
            
        }
        #picture
        {
            text-align: center;
            padding: 10px;
        }
    </style>
	</head>
  <style>
  .carousel-inner img {
    width: 100%;
    height: 400px;
    border-top: 2px solid #ff9999;
    border-right: 3px solid #ff9999;
    box-shadow: 5px 5px #f6c6f3;
  }
  </style>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.html" class="logo"><strong>Co/extracurricular</strong> Activities</a>
									<ul class="icons"><?php
									echo "<li>".$_SESSION['std_name']."</li>"
									?></ul>
								</header>

<!-- Content -->
<section>
        <div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
            
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
                                                                            <li><a href="Lecture.php">Lecture</a></li>
                                                                            <li><a href="Attendance.php">Attendance Report </a></li>
                                                                            <li><a href="AcademicPerformance.php">Academic Performance Report</a></li>
                                                                            <li style="color:#ff6666;"><a href="Extracuricular.php">Co/extracurricular Activities Report
                                                                            <i class="fa fa-caret-left" aria-hidden="true" style="margin-left: 200px; font-size: 20px;"></i></a></li>
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