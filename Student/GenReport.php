<?php
 
$dataPoints = array(
	array("label"=> "Student", "y"=> 390),
	array("label"=> "Academics", "y"=> 261),
	array("label"=> "Registration", "y"=> 158),
	array("label"=> "Attendance", "y"=> 72),
	array("label"=> "Enrolled", "y"=> 126)
);
	
?>
<!DOCTYPE HTML>
<html>
<head>  
    <?php include 'include/Session/session.php';?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Student General Report"
	},
	subtitles: [{
		text: "Student Records"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
    #attendance
    {
        background-color: #cccccc;
        width: 100%;
        height: 100px;
        text-align: center;
        padding: 10px;
        border-left: 4px solid green;
    }
</style>
</head>
<body>
    
    <div class="container"><br>
    <div class="row">
        <div class="col">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-sm-3">
            <div id="attendance">
                <h5>Enrolled Student</h5>
                <i class="far fa-users-class" style="
                   font-size:
                   35px; margin-left: -60px;
                   "></i>
                   <h3 
                       style="margin-top: -16%;
                              margin-left: 70px;
                       ">10+</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="attendance">
                <h5>Student took the exams</h5>
                <i class="fa fa-calculator" aria-hidden="true" style="
                   font-size:
                   35px; margin-left: -60px;
                   "></i>
                   <h3 
                       style="margin-top: -16%;
                              margin-left: 70px;
                       ">30+</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="attendance">
                <h5>Current Event</h5>
                <i class="fa fa-calendar" aria-hidden="true" style="
                   font-size:
                   35px; margin-left: -60px;
                   "></i>
                   <h3 
                       style="margin-top: -16%;
                              margin-left: 70px;
                              
                       ">3+</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="attendance">
                <h5>Most difficult Subject</h5>
                <i class="fa fa-file" aria-hidden="true" style="
                   font-size:
                   35px; margin-left: -60px;
                   "></i>
                   <h4 
                       style="margin-top: -16%;
                              margin-left: 70px;
                              
                       ">Science</h4>
            </div>
        </div>
    </div>
</div>
</div> 
</body>
</html>             