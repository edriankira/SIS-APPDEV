<?php

 if(isset($_POST['delete'])){
    $downsql = 'UPDATE adm_ParentUser SET adm_prtstatus ="Inactive" WHERE adm_prtId = '.$row['adm_prtId'].' ';
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
    $downsql = 'UPDATE adm_ParentUser SET adm_prtstatus ="Active" WHERE adm_prtId = '.$row['adm_prtId'].' ';
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