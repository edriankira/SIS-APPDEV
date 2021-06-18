<?php
    include "../connection/config.php";

    $sql ="select extra_name from extracur";
    $result =  mysqli_query($db, $sql);
   echo "<option selected value = 'none'></option>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<option value = ".$row['extra_name'].">".$row['extra_name']."</option>";
        
    }
?>