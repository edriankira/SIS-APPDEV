<?php

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    require_once "../connection/config.php";
    
    $sql = "SELECT * FROM adm_FacultyUser WHERE adm_fctId = ?";
    
    if($stmt = mysqli_prepare($db, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                include "Facultydelete.php";
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
    <link rel="stylesheet" href="../CSS/GeneralCSS.css" />
    <link rel="stylesheet" href="../CSS/crud.css" />

    <title>Document</title>
    <style>
        *{
            font-family: "Open Sans", sans-serif;
        }
        body{
            overflow:visible;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        td, th{
            text-align: center;
        }

        .confirmation{
            width: 200%;
            height: 200%;
            margin-left:0px;
            padding: 0px;
            z-index: 3;
            background-color: grey;
            opacity: 0.7;
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);

            display: none;
        }
        #delcontainer{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width:22%;
            height:22%;
            border: 1px solid white;
            background-color: white;
            opacity:1;
            z-index: 6;
            border-radius: 15px;

            display: none;
        }
        #delbtn{
            position: fixed;
            top: 70%;
            left: 30%;
            transform: translate(-50%, -50%);
            z-index:6;
            width:40%;
            height:20%;
            cursor: pointer;
            outline: none;
            background-color: red;
            color: white;
            border: none;
            border-radius: 15px;
            font-weight: bold !important;
        }
        #backtoread{
            position: fixed;
            top: 70%;
            left: 70%;
            transform: translate(-50%, -50%);
            z-index:6; 
            width:40%;
            height:20%;
            cursor: pointer;
            outline: none;
            background-color: white;
            color: black;
            border: none;
            border-radius: 15px;
            font-weight: bold !important;
            transition: border 0.2s ease-in-out, border 0.2s ease-in-out;
        }
        #backtoread:hover{
            border: 1px solid black;
            
        }
       
    </style>
</head>
<body>

    <div class="confirmation">
   
    </div>
        <div id="delcontainer"><?php
            if($row['adm_fctstatus'] == "Active"){
                echo'
                <h3 align="center">Are you sure you want to deactivate this user?<h3>
                <form method="post">
                    <input type="submit" id="delbtn" Value="Delete" name="delete"> &nbsp; &nbsp; &nbsp; 
                    <input type="button" id="backtoread" Value="Cancel" onclick="hideContainer()">';
            }else{
                echo'
                <h3 align="center">Are you sure you want to reactivate this user?<h3>
                <form method="post">
                    <input type="submit" id="delbtn" style="background-color: green;" Value="reactivate" name="reactivate">
                    <input type="button" id="backtoread" Value="Cancel" onclick="hideContainer()">';
                }
            
            ?>
            </form>

        </div>
    

    <div id="container">
        
        <table id="crudtable">
            <caption><?php 
            if($row['adm_fctstatus'] == "Active"){
                echo '<button id="modifyingbtn" onclick="showContainer()"><i class="fa fa-trash" style="color:white; font-size:20px;"></i></button>';
            }else  echo '<button id="modifyingbtn" onclick="showContainer()"><i class="fa fa-key" style="color:white; font-size:20px;"></i></button>';
           
           echo '<a href="Edit.php?id='.$row['adm_fctId'].'"><button id="modifyingbtn"><i class="fa fa-pencil" style="color:white; font-size:20px;"></i></button></caption></a>' ?>
            <tr>
                <th colspan = 3 id="detailst"><?php  
                    if($row['adm_fctstatus'] == "Active"){
                        echo '<span style="color:green;float:right; line-height: 10px;font-size:18px;"> &bull; active</span>';
                    }
                    else{
                        echo '<span style="color:red;float:right; line-height: 10px;font-size:18px;""> &bull; Inactive</span>';  
                    }; ?><br>

                    <h3> Details</h3></td>
            </tr>
            <tr>
                <td id="nameY">Name:</td>
                <td colspan = 2 id="namet"><b><?php 
                    echo $row["adm_fctfname"]. " ". $row["adm_fctmname"]. " ". $row["adm_fctlname"];
                    ?>
                    <b></td>
            </tr>
            <tr>
                <td>Username</td>
                <td colspan=2 id="usert"><b><?php echo $row["adm_fctusername"]; ?><b></td>
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td><?php echo $row["adm_fctbday"]; ?><br><b>Birthdate<b></td>
                <td><?php echo $row["adm_fctgender"]; ?><br><b>Gender<b></td>
                <td><?php echo $row["adm_fctUserNum"]; ?><br><b>ID</b></td>
                
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td colspan = 2 id="emailt"><?php echo $row["adm_fctemail"] ?><br><b>Email</b></td>
                <td><?php echo $row["adm_fctmobile"]; ?><br><b>Mobile<b></td>
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td colspan = 3 id="emailt"><?php echo $row["adm_fctaddress"] ?><br><b>Address</b></td>
            </tr>
        </table>
        <input type="submit" class="backread" value="Back" onClick="location.href='FacultyManagement.php'"/>
    </div>

    <script>

        function hideContainer(){
            
            document.getElementsByClassName("confirmation")[0].style["display"] = "none";
            document.getElementById("delcontainer").style["display"] = "none";
        }
        function showContainer(){
            
            document.getElementsByClassName("confirmation")[0].style["display"] = "block";
            document.getElementById("delcontainer").style["display"] = "block";
        }

    </script>
</body>
</html>
