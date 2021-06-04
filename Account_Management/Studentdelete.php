<?php

 if(isset($_POST['delete'])){
    $downsql = 'UPDATE adm_StudentUser SET adm_stdstatus ="Inactive" WHERE adm_stdId = '.$row['adm_stdId'].' ';
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
    $downsql = 'UPDATE adm_StudentUser SET adm_stdstatus ="Active" WHERE adm_stdId = '.$row['adm_stdId'].' ';
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