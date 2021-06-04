<?php

 if(isset($_POST['delete'])){
    $downsql = 'UPDATE adm_FacultyUser SET adm_fctstatus ="Inactive" WHERE adm_fctId = '.$row['adm_fctId'].' ';
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
    $downsql = 'UPDATE adm_FacultyUser SET adm_fctstatus ="Active" WHERE adm_fctId = '.$row['adm_fctId'].' ';
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