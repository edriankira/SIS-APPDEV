<?php

 if(isset($_POST['delete'])){
    $downsql = 'UPDATE adm_adminUser SET adm_status ="Inactive" WHERE adm_AdminId = '.$row['adm_AdminId'].' ';
    $downresult = mysqli_query($db, $downsql);
    if($downresult){
        alert("Deactivation Complete");
        header("Refresh:0");
    }
    else{
        alert("Deactivation Failed");
    }
}
else if(isset($_POST['reactivate'])){
    $downsql = 'UPDATE adm_adminUser SET adm_status ="Active" WHERE adm_AdminId = '.$row['adm_AdminId'].' ';
    $downresult = mysqli_query($db, $downsql);
    if($downresult){
        alert("Activation Complete");
        header("Refresh:0");
    }
    else{
        alert("Activation Failed");
    }
}

?>