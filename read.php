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
} else{
    echo "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/GeneralCSS.css" />
    <title>Document</title>
    <style>

body{
    font-family: "Open Sans", sans-serif;
}
@media screen and (max-width: 600px){
    table{
            width: 90%;
            height: 400px;
            border: 1px solid black;

            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: "Open Sans", sans-serif;
            background-color:white;
            table-layout: fixed;
        }
        td, th{ 
            text-align: center;
            line-height: 18px;
            /* border: 1px solid black; */
            
        }
        #usert{
            height:10px;
        }
        #detailst{
            border-top: none;
            border-bottom: 3px solid grey;
            border-left: none;
            border-right: none;
            height: 30px;
        }
        #nameY{
            width:120px;
        }
        table #emailt{
            word-wrap: break-word;         /* All browsers since IE 5.5+ */
            overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
        }
        #firstline{
            border-top: none;
            border-bottom: 3px solid grey;
            border-left: none;
            border-right: none;
            height:3px;
            
            margin:0;
            opacity: 0.3;
            
        }
}
@media screen and (min-width: 601px){
    table{
            width: 500px;
            height: 400px;
            border: 1px solid black;

            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: "Open Sans", sans-serif;
            background-color:white;
            table-layout: fixed;
        }
        td, th{ 
            text-align: center;
            line-height: 18px;
            /* border: 1px solid black; */
            
        }
        #detailst{
            border-top: none;
            border-bottom: 3px solid grey;
            border-left: none;
            border-right: none;
            height: 30px;
        }
        #nameY{
            width:120px;
        }
        #usert{
            height:10px;
        }
        table #emailt{
            word-wrap: break-word;         /* All browsers since IE 5.5+ */
            overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
        }
        #firstline{
            border-top: none;
            border-bottom: 3px solid grey;
            border-left: none;
            border-right: none;
            height:3px;
            
            margin:0;
            opacity: 0.3;
            
        }
 
}

#loginbtn{
    width: 200px;
    height:40px;
    box-shadow: black;
    color: black;
    background-color: transparent;
    border: 2px solid #f56a6a;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
    position: fixed;
            top: 86%;
            left: 50%;
            transform: translate(-50%, -50%);
}
#loginbtn:hover{
    background-color: #f56a6a;
    color: white;
}


       
    </style>
</head>
<body>
    <div>
    <table>
        <tr>
        
            <th colspan = 3 id="detailst"><h3>Details</h3></td>
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
            <td>Birthdate<br><b><?php echo $row["adm_bday"]; ?><b></td>
            <td>Gender<br><b><?php echo $row["adm_gender"]; ?><b></td>
            <td>ID<br><b><?php echo $row["adm_adminUserNum"]; ?><b></td>
            
        </tr>
        <tr>
            <td colspan=3 id="firstline"></td>
        </tr>
        <tr>
            <td colspan = 2 id="emailt">Email<br><b><?php echo $row["adm_email"] ?></b></td>
            <td>Mobile<br><b><?php echo $row["adm_mobile"]; ?><b></td>
        </tr>
        <tr>
            <td colspan=3 id="firstline"></td>
        </tr>
        <tr>
            <td colspan = 3 id="emailt">Address<br><b><?php echo $row["adm_address"] ?></b></td>
        </tr>
        
    </table>
    <input type="submit" id="loginbtn" value="Back" onClick="location.href='AdminRegistration.php'" />
</body>
</html>
