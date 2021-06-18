<?php

include "../connection/config.php";


		$sql = mysqli_query($db,"SELECT adm_lcCourseT from adm_listcourse ");
			
		while($row_cour = mysqli_fetch_assoc($sql)){
			
			echo "<option value = ".$row_cour['adm_lcCourseT'].">".$row_cour['adm_lcCourseT']." </option>";
		}

?>