<?php

$notempty;
require "../connection/config.php";

$id = $_POST["getName"];

if($id != "" && strlen($id) == 8){
    
    $existquery = "SELECT * from adm_ParentUser where adm_prtchildId = '".$id."'";

    $coursequery = "SELECT 
    CONCAT(adm_stdlname, ', ', adm_stdfname,' ' ,adm_stdmname) AS 'Name' 
    FROM adm_StudentUser
    WHERE adm_stdUserNum = '".$id."'";
    
    
    $result = mysqli_query($db, $coursequery);
    $existresult = mysqli_query($db, $existquery);
    
    if(mysqli_num_rows($existresult) == 1){
        echo "Child ID already taken";
    }
    else if (mysqli_num_rows($result) == 1) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        echo $row["Name"];
      }
    } else {
        echo "No records found";
    }
} else echo "No records found"; 
