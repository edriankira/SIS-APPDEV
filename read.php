<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    require_once "connection/config.php";
    $sql = "SELECT * FROM adm_adminuser WHERE adm_adminId = ?";
    
    if($stmt = mysqli_prepare($db, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            } else{
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($db);

    // ." ".$row['adm_mname']." ".$row['adm_lname']
}   else{
    echo "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <link rel="stylesheet" href="CSS/GeneralCSS.css" />
    <link rel="stylesheet" href="CSS/crud.css" />

    <title>Document</title>
    <style>
        *{
            font-family: "Open Sans", sans-serif;
        }
        body{
            overflow:visible;
        }
        td, th{
            text-align: center;
        }
       
    </style>
</head>
<body>

    <div id="container">
        
        <table id="crudtable">
            <caption>
            <button id="modifyingbtn"><i class="fa fa-trash" style="color:white; font-size:20px;"></i></button>
           <?php echo '<a href="Edit.php?id='.$row['adm_AdminId'].'"><button id="modifyingbtn"><i class="fa fa-pencil" style="color:white; font-size:20px;"></i></button></caption></a>' ?>
            <tr>
                <th colspan = 3 id="detailst"><h3> Details</h3></td>
            </tr>
            <tr>
                <td id="nameY">Name:</td>
                <td colspan = 2 id="namet"><b><?php 
                    echo $row["adm_fname"]. " ". $row["adm_mname"]. " ". $row["adm_lname"];
                    if($row['adm_status'] == "Active"){
                        echo '<span style="color:green; font-size:18px;"> &bull;</span>';
                    }
                    else{
                        echo '<span style="color:red; font-size:18px;""> &bull;</span>';  
                    }; ?>
                    <b></td>
            </tr>
            <tr>
                <td>Username</td>
                <td colspan=2 id="usert"><b><?php echo $row["adm_username"]; ?><b></td>
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td><?php echo $row["adm_bday"]; ?><br><b>Birthdate<b></td>
                <td><?php echo $row["adm_gender"]; ?><br><b>Gender<b></td>
                <td><?php echo $row["adm_adminUserNum"]; ?><br><b>ID</b></td>
                
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td colspan = 2 id="emailt"><?php echo $row["adm_email"] ?><br><b>Email</b></td>
                <td><?php echo $row["adm_mobile"]; ?><br><b>Mobile<b></td>
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td colspan = 3 id="emailt"><?php echo $row["adm_address"] ?><br><b>Address</b></td>
            </tr>
        </table>
        <input type="submit" class="backread" value="Back" onClick="location.href='AdminRegistration.php'"/>
    </div>
</body>
</html>
