<?php
    include "../connection/config.php";

    $sql ="select adm_fctSubjHandle from adm_facultyUser where adm_fctUserNum = '".$_SESSION["FacultyId"]."'";
    $result =  mysqli_query($db, $sql);
    if($row = mysqli_fetch_assoc($result)){
        echo $row["adm_fctSubjHandle"];
        
    }
?>