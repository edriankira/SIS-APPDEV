<?php

include "../connection/config.php";

	if(isset($_POST['aYear']) && isset($_POST['aCourse'])){
		$getyear = $_POST['aYear'];
		$getCourse = $_POST['aCourse'];

		$sqlquery =  "SELECT Section_name from section 
        JOIN adm_listCourse
        ON section.Section_course = adm_listCourse.adm_lcCourseT
        where adm_listCourse.adm_lcCourseT = '".$getCourse."' AND Section_year = '".$getyear."' ";


		$sql = mysqli_query($db,$sqlquery);
		
		while($row_sect = mysqli_fetch_assoc($sql)){
			echo "<option value = ".$row_sect['Section_name'].">".$row_sect['Section_name']." </option>";
		}
	}else{
	}
?>