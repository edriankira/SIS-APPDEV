<?php

include "../connection/config.php";


	if(isset($_POST['aYear'])){
		$getyear = $_POST['aYear'];
		$sql = mysqli_query($db,"SELECT section_name from section where section_year = '$getyear'");
			
		while($row_section = mysqli_fetch_assoc($sql)){
			
			echo "<option value = ".$row_section['section_name'].">".$row_section['section_name']." </option>";
		}
	}else{
	}
?>