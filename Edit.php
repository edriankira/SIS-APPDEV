<?php
require_once "connection/config.php";
 

$pfname = $pmname = $plname = $pbday = $gender = $pemail= $pmobile= $paddress= $pid= $pusername = "";
$pfname_err = $pmname_err = $plname_err = $pusername =$pbday_err = $gender_err = $pemail_err= $pmobile_err= $address_err= $pid_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
   
    //first name
    $input_fname = trim($_POST["fname"]); 
    if(empty($input_fname)){
        $pfname_err = "Please enter a first name."; 
    } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $pfname_err = "Please enter a valid first name.";
    } else{
        $pfname = $input_fname;
    }

    //middle name
    if(!filter_var($input_mname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $pmname_err = "Please enter a valid middle name.";
    } else{
        $pmname = $input_mname;
    }

    //last name
    $input_lname = trim($_POST["lname"]);
    if(empty($input_lname)){
        $name_err = "Please enter a last name."; 
    } elseif(!filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid last name.";
    } else{
        $plname = $input_lname;
    }
    
    //email
    $input_email = trim($_POST["email"]);
    if (filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
        $pemail = $input_email;
    } else {
    $pemail_err = "$email is not a valid email address";
    }

    $input_bday = trim($_POST["bday"]);
    if(empty($input_lname)){
        $pbday_err = "Please enter a birthday."; 
    }
    else{
        $pbday = date('Y-m-d', strtotime($_POST['dateFrom']));
    }

    $input_mobile = trim($_POST["mobile"]);
    if(empty($input_mobile)){
        $pmobile_err = "Please enter a mobile number.";
    }else if(!is_numeric($input_mobile)){
        $pmobile = $input_mobile;
    }
    else{
        $pmobile_err = "Please enter a valid number";
    }

    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $paddress_err = "Please enter an address."; 
    }else{
        $paddress = $input_address;
    }

    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Please enter a username."; 
    } else{
        $pusername = $input_username;
    }

    if(empty($pfname_err) && empty($pmname_err) &&empty($plname_err) && 
    empty($pbday_err) && empty($pemail_err) && empty($address_err) &&
    empty($pusername_err) &&empty($pgender_err)){
        $sql = "UPDATE adm_adminUser SET adm_username=?, adm_bday=?,  adm_fname = ?,adm_mname = ?, 
        adm_lname = ?,adm_email = ?, adm_mobile = ?, adm_address = ?, adm_gender =?
         WHERE adm_adminUserNum = ?";
         
        if($stmt = mysqli_prepare($db, $sql)){
            mysqli_stmt_bind_param($stmt, "sssssssssi",
            $param_username, $paam_bday,$param_fname,$param_mname,$param_lname,
            $param_email,$param_mobile,$param_address,$param_gender, $param_id);
            
              
            $param_username = $pusername;
            $param_bday = $pbday;
            $param_fname = $pfname;
            $param_mname = $pmname ;
            $param_lname = $plname ;
            $param_email = $pemail;
            $param_mobile = $pmobile;
            $param_address = $paddress;
            $param_gender = $gender ;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                header("location: read.php?id=$id");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($db);
    
}else{
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
                    $pfname = $row['adm_fname'];
                    $pmname = $row['adm_mname'];
                    $plname = $row['adm_lname'];
                    $pbirthday = $row['adm_bday'];
                    $pgender = $row['adm_gender'];
                    $pmobile = $row['adm_mobile'];
                    $pemail = $row['adm_email'];
                    $paddress = $row['adm_address'];
                    $pusername = $row['adm_username'];


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
    }
}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" href="CSS/GeneralCSS.css" />
    <link rel="stylesheet" href="CSS/crud.css" />
    <title>Edit Data</title>
    <style>

body{
    font-family: "Open Sans", sans-serif;
    overflow:visible;
}
input[type="text"], input[type="email"]{
    margin-bottom: 3px;
    font-family: "Open Sans", sans-serif;
    font-weight: bold;
    text-align: center;
    border-radius: 10px;
    text-decoration: none;
}
input[type="text"]:focus,input[type="email"]:focus{
    outline: none;
    border: 2px solid #f56a6a;
}
input[type="date"]{
    width: 110px;
}
td, th{ 
    text-align: center;
    line-height: 18px;
    /* border: 1px solid black; */
    
}

    </style>
</head>
<body>
    <div id="container">
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <table id="crudtable">
            <tr>
                <th colspan = 3 id="detailst"><h3>Edit Details</h3></td>
            </tr>
            <tr>
                <td id="nameY">Name:
                <td colspan = 2 id="namet"><b><?php 
                     echo '<input type ="text" name="fname" value='. $row["adm_fname"].' > <br>';
                     echo '<input type ="text" name="mname" placeholder="Middle Name" value='. $row["adm_mname"].' ><br>';
                     echo '<input type ="text" name="lname" value='. $row["adm_lname"].' > <br>';
                    ?>
                    <b></td>
            </tr>
            <tr>
                <td>Username</td>
                <td colspan=2 id="usert"><b><?php 
                    echo '<input type ="text" name="username" value='. $row["adm_username"].' > <br>';
                ?><b></td>
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td><?php 
                echo '<input type ="date" name="bday" value='. $row["adm_bday"].' > <br><b>Birthdate<b></td>';
                if($row['adm_gender'] == "male" || $row['adm_gender'] == "Male"){
                    echo '<td> <select name="gender">
                                    <option selected value="male">male</option>
                                    <option value="female">female</option>
                                </select><br><b>Gender</b></td>';
                }else{
                    echo '<td> <select name="gender">
                                    <option  value="male">male</option>
                                    <option selected value="female">female</option>
                                </select><br><b>Gender</b></td>';
                }
               
                echo '<td>'.$row["adm_adminUserNum"].'<br><b>ID</b></td>';
                ?>
                
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td colspan = 2 id="emailt"><?php echo '<input name ="email" id="emailText" type ="email" value='. $row["adm_email"].' ><br><b>Email</b></td>
                <td> <input type ="text" name="mobile" id="mobileText" value='. $row["adm_mobile"].' ><br><b>Mobile<b></td>
            </tr>'; ?>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td colspan = 3 id="emailt"><?php 
                echo '<input id="addressText" name ="address" type ="text" value='. $row["adm_address"].' >'; 
                ?><br><b>Address</b></td>
            </tr>
        </table>
        <input type="submit" id="back" value="Save"/><br> 
        </form>
        <input type="button" class="backread" value="Back" onClick="location.href='AdminRegistration.php'">
</body>
</html>
