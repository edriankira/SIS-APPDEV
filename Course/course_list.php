<?php include_once('include/config.php');?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Admin Creation</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/mainAdmin.css" />
		

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    	
    	

	<style>
		#addbtn{
			text-align: center;
			width: 60px;
			height: 35px;
			font-size: 12px;
			float: right;
			margin: 0;
			text-decoration: none;
		}
		a{
			text-decoration: none;	
		}
		#modify{
			width:65px;
			height: 30px;
			outline: none;
		}
	</style>

	</head>
	<body class="is-preload">
		<!-- <div id="viewScreen">
			aaaaaaaaaaaa
		</div> -->
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="" class="logo"><strong>Admin </strong>Course List</a>
								</header>

							<!-- Banner -->
								<section id="banner">
									<div class="content">
<?php
	$condition	=	'';
	if(isset($_REQUEST['adm_lcCourseT']) and $_REQUEST['adm_lcCourseT']!=""){
		$condition	.=	' AND adm_lcCourseT LIKE "%'.$_REQUEST['adm_lcCourseT'].'%" ';
	}
	if(isset($_REQUEST['adm_lcCourseD']) and $_REQUEST['adm_lcCourseD']!=""){
		$condition	.=	' AND adm_lcCourseD LIKE "%'.$_REQUEST['adm_lcCourseD'].'%" ';
	}
	if(isset($_REQUEST['adm_lcNum']) and $_REQUEST['adm_lcNum']!=""){
		$condition	.=	' AND adm_lcNum LIKE "%'.$_REQUEST['adm_lcNum'].'%" ';
	}
	if(isset($_REQUEST['df']) and $_REQUEST['df']!=""){

		$condition	.=	' AND DATE(adm_CourseTD)>="'.$_REQUEST['df'].'" ';

	}
	if(isset($_REQUEST['adm_CourseTD']) and $_REQUEST['adm_CourseTD']!=""){

		$condition	.=	' AND DATE(adm_CourseTD)<="'.$_REQUEST['adm_CourseTD'].'" ';

	}
	
	$userData	=	$db->getAllRecords('adm_listcourse','*',$condition,'ORDER BY adm_lcID DESC');
	?>
   	<div class="container">
		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-globe"></i> <strong>Course List</strong> <a href="add_Course.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Add Course</a></div>
			<div class="card-body">
				<?php
				if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record deleted successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record updated successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
					echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> You did not change any thing!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
					echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong <strong>Please try again!</strong></div>';
				}
				?>
				<div class="col-sm-12">
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Find Course</h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Course Name</label>
									<input type="text" name="adm_lcCourseT" id="adm_lcCourseT" class="form-control" value="<?php echo isset($_REQUEST['adm_lcCourseT'])?$_REQUEST['adm_lcCourseT']:''?>" placeholder="Enter Course name">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Description</label>
									<input type="text" name="adm_lcCourseD" id="adm_lcCourseD" class="form-control" value="<?php echo isset($_REQUEST['adm_lcCourseD'])?$_REQUEST['adm_lcCourseD']:''?>" placeholder="Enter Description">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Course Number</label>
									<input type="tel" name="adm_lcNum" id="adm_lcNum" class="form-control" value="<?php echo isset($_REQUEST['adm_lcNum'])?$_REQUEST['adm_lcNum']:''?>" placeholder="Enter Course Number">
								</div>
							</div>
							<div class="col-sm-4">

								<div class="form-group">

									<label>Date</label>
									<div class="input-group">
										<input type="text" class="fromDate form-control hasDatepicker" name="df" id="df" value="" placeholder="Enter from date">
										<div class="input-group-prepend"><span class="input-group-text">-</span></div>
										<input type="text" class="toDate form-control hasDatepicker" name="adm_CourseTD" id="adm_CourseTD" value="" placeholder="Enter to date">
										<div class="input-group-append"><span class="input-group-text"><a href="javascript:;" onclick="$('#df,#adm_CourseTD').val('');"><i class="fa fa-fw fa-sync"></i></a></span></div>
									</div>

								</div>

							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>&nbsp;</label>
									<div>
										<button type="submit" name="submit" value="search" ><i class="fa fa-fw fa-search"></i> Search</button>
										<br>
										<br>
										<a href="<?php echo $_SERVER['PHP_SELF'];?>" ><i class="fa fa-fw fa-sync"></i> Clear</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr>
		
		<div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<!-- <th>#</th> -->
						<th>Course Name</th>
						<th>Description</th>
						<th>Course Number</th>
						<th class="text-center">Record Date</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($userData)>0){
						$s	=	'';
						foreach($userData as $val){
							$s++;
					?>
					<tr>
						<!-- <td style="color: transparent;"><?php echo $s;?></td> -->
						<td><?php echo $val['adm_lcCourseT'];?></td>
						<td><?php echo $val['adm_lcCourseD'];?></td>
						<td><?php echo $val['adm_lcNum'];?></td>
						<td align="center"><?php echo date('Y-m-d',strtotime($val['adm_CourseTD']));?></td>
						<td align="center">
							<!-- <a href="edit-users.php?editId=<?php echo $val['adm_lcID'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> |  -->
							<a href="delete.php?delId=<?php echo $val['adm_lcID'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i> Delete</a>
						</td>

					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		
	</div>
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
										<li><a href="../homepage.php">Homepage</a></li>
										<li>
											<span class="opener">Account Creation</span>
											<ul>
												<li><a href="../AdminRegistration.php">Admin Registration</a></li>
												<li><a href="#">Faculty Registration</a></li>
												<li><a href="#">Parent Registration</a></li>
												<li><a href="#">User Registration</a></li>
											</ul>
										</li>
										<li><a href="generic.php">Event Notification</a></li>									
										<li><a href="#">List of Courses</a></li>									
										<li><a href="#">Campus Map</a></li>
										<li><a href="#">Announcement</a></li>
									</ul>
								</nav>							
						</div>
					</div>

			</div>
		
			

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
	<script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script>
	<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
    <script>
		$(document).ready(function() {			 
			 //From, To date range start
			var dateFormat	=	"yy-mm-dd";
			fromDate	=	$(".fromDate").datepicker({
				changeMonth: true,
				dateFormat:'yy-mm-dd',
				numberOfMonths:2
			})
			.on("change", function(){
				toDate.datepicker("option", "minDate", getDate(this));
			}),
			toDate	=	$(".toDate").datepicker({
				changeMonth: true,
				dateFormat:'yy-mm-dd',
				numberOfMonths:2
			})
			.on("change", function() {
				fromDate.datepicker("option", "maxDate", getDate(this));
			});
			
			
			function getDate(element){
				var date;
				try{
					date = $.datepicker.parseDate(dateFormat,element.value);
				}catch(error){
					date = null;
				}
				return date;
			}
			//From, To date range End here	
			
		});
	</script>

	</body>
</html>	
