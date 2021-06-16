<?php

include "../connection/config.php";

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}


	if(isset($_POST['aYear']) && isset($_POST['aSection'])){
		$getyear = $_POST['aYear'];
		$getsection = $_POST['aSection'];

		$sqlquery = "SELECT sub_code FROM section
		JOIN subjects ON
		subjects.sub_course = section.Section_course
		AND subjects.sub_year = section.Section_year
		WHERE section.Section_name = '".$getsection."'";

		$sql = mysqli_query($db,$sqlquery);
		
		while($row_subj = mysqli_fetch_assoc($sql)){
			echo "<option value = ".$row_subj['sub_code'].">".$row_subj['sub_code']." </option>";
		}
	}else{
	}
?>