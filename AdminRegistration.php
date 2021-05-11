<!DOCTYPE HTML>

<html>
	<head>
		<title>Admin Creation</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<style>
		/* @media screen and (max-width: ) {
			
		} */
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
									<a href="index.html" class="logo"><strong>Admin </strong>Creation</a>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h2>Admin Users List</h2>
										</header>
										<table>
                                            <tr>
                                                <th>Admin ID</th>
                                                <th>Admin Name</th>
                                                <th>Admin Username</th>
                                                <th>Admin Status</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php Display(); ?>
                                        </table>
										<ul class="actions">
											<li><a href="https://bcp.edu.ph/home" class="button big">Learn More</a></li>
										</ul>
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
										<li><a href="homepage.php">Homepage</a></li>
										<li>
											<span class="opener">Account Creation</span>
											<ul>
												<li><a href="#">Admin Registration</a></li>
												<li><a href="#">Faculty Registration</a></li>
												<li><a href="#">Parent Registration</a></li>
												<li><a href="#">User Registration</a></li>
											</ul>
										</li>
										<li><a href="generic.php">Event Notification</a></li>									
										<li><a href="elements.php">List of Courses</a></li>									
										<li><a href="#">Campus Map</a></li>
										<li><a href="#">Announcement</a></li>
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


<?php    
function Display(){
    require_once "connection/config.php";

    $sql = "select * from adm_AdminUser";

    if($result = mysqli_query($db, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($row['adm_mname'] == ""){
                    $mnameholder = "";
                }
                else $mnameholder = ", ";
                echo "<tr>";
                    echo "<td>" . $row['adm_adminUserNum'] . "</td>";
                    echo "<td>" . $row['adm_lname'] ." " .$row['adm_fname'] ."$mnameholder" . $row['adm_mname']. "</td>";
                    echo "<td>" . $row['adm_username'] . "</td>";
                    echo "<td>" . $row['adm_status'] . "</td>";
                    echo "<td>";
                        echo '<a href="read.php?id='. $row['adm_AdminId'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                        echo '<a href="update.php?id='. $row['adm_AdminId'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                        echo '<a href="delete.php?id='. $row['adm_AdminId'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    echo "</td>";
                echo "</tr>";
            }
        }
    }
    mysqli_close($db);
}
    

    

?>