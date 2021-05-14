<?php
require_once "connection/config.php";
$pfname = $pmname = $plname = $pbday = $pgender = $pemail= $pmobile = $paddress= $pid= $pusername = "";
$pfname_err = $pmname_err = $plname_err = $pusername =$pbday_err = $gender_err = $pemail_err= $pmobile_err= $address_err= $pid_err = "";


    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
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
                    
                    $newdate = date('d-m-Y', strtotime($row['adm_bday']));
                    
                } else{
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
     
        mysqli_stmt_close($stmt);        
    }
    if(isset($_POST['goEdit'])){

        $id = $_GET["id"];
        //first name
        $input_fname = trim($_POST["fname"]); 
        if(empty($input_fname)){
            $pfname_err = "Please enter a first name."; 
            alert("Please enter a first name.");
            $pfname = $input_fname;
        } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $pfname_err = "Please enter a valid first name."; 
            alert("Please enter a valid first name.");
            $pfname = $input_fname;
        } else{
            $pfname = $input_fname;
      
        }
        
        //middle name
        $input_mname = trim($_POST["mname"]);
        if(empty($input_mname)){
            $pmname = $input_mname;
        }
        else if(!filter_var($input_mname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $pmname_err = "Please enter a valid middle name.";
            alert("Please enter a valid middle name.");
            $pmname = $input_mname;
        } else{
            $pmname = $input_mname;
        }
    
        //last name
        $input_lname = trim($_POST["lname"]);
        if(empty($input_lname)){
            $plname_err = "Please enter a last name."; 
            alert("Please enter a last name.");
            $plname = $input_lname;
        } elseif(!filter_var($input_lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $plname_err = "Please enter a valid last name.";
            alert("Please enter a valid last name.");
            $plname = $input_lname;
        } else{
            $plname = $input_lname;
        }

        $input_username = trim($_POST["username"]);
        if(empty($input_username)){
            $username_err = "Please enter a username."; 
            alert("Please enter a username.");
            $pusername = $input_username;
        }else if($input_username == $row['adm_username']){
            $pusername = $input_username;
        } else{
            $downsql = 'SELECT adm_username from adm_adminuser where adm_username = "'.trim($_POST["username"]).'" ';
            $downresult = mysqli_query($db, $downsql);
            if(mysqli_num_rows($downresult) == 0){
                $pusername = $input_username;
            }else{
                $username_err = "Username Already Exist"; 
                alert("Username Already Exist");
                $pusername = $input_username;
            }
            
        }

        //gender
        $input_gender= trim($_POST["gender"]);
        $pgender = $input_gender;
        
        //email
        $input_email = trim($_POST["email"]);
        if (filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
            $pemail = $input_email;
        } else {
            $pemail_err = "please enter a valid email address";
            alert("please enter a valid email address");
            $pemail = $input_email;
        }
    
        $input_bday = trim($_POST["bday"]);
        if(empty($input_bday)){
            $pbday_err = "Please enter a birthday."; 
        }
        else{
            $pbday = date('Y-m-d', strtotime($_POST['bday']));
        }
    
        $input_mobile = trim($_POST["mobile"]);
        if(empty($input_mobile)){
            $pmobile_err = "Please enter a mobile number.";
            alert("Please enter a mobile number.");
            $pmobile = $input_mobile;
        }else if(is_numeric($input_mobile)){
            $pmobile = $input_mobile;
        }
        else{
            $pmobile_err = "Please enter a valid number";
            alert("Please enter a valid number");
            $pmobile = $input_mobile;
        }
    
        $input_address = trim($_POST["address"]);
        if(empty($input_address)){
            $paddress_err = "Please enter an address."; 
            alert("Please enter an address.");
            $paddress = $input_address;
        }else{
            $paddress = $input_address;
        }
    
        
    
        if(empty($pfname_err) && empty($pmname_err) &&empty($plname_err) && 
        empty($pbday_err) && empty($pemail_err) && empty($address_err) &&
        empty($pusername_err) &&empty($pgender_err)){
            $sql = "UPDATE adm_adminUser SET adm_username=?, adm_bday=?,  adm_fname = ?,adm_mname = ?, 
            adm_lname = ?,adm_email = ?, adm_mobile = ?, adm_address = ?, adm_gender =?
             WHERE adm_adminId = ?";
            
            if($stmt = mysqli_prepare($db, $sql)){
                mysqli_stmt_bind_param($stmt, "sssssssssi",
                $param_username, $param_bday,$param_fname,$param_mname,$param_lname,
                $param_email,$param_mobile,$param_address,$param_gender, $param_id);
                
                  
                $param_username = $pusername;
                $param_bday = $pbday;
                $param_fname = $pfname;
                $param_mname = $pmname ;
                $param_lname = $plname ;
                $param_email = $pemail;
                $param_mobile = $pmobile;
                $param_address = $paddress;
                $param_gender = $pgender;
                $param_id = $id;
                
                
                if(mysqli_stmt_execute($stmt)){
                    header("location: read.php?id=$id");
                    exit();
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <title>Edit Data</title>
    <style>

body{
    font-family: "Open Sans", sans-serif;
    overflow:visible;
}

input[type="text"], input[type="email"]{
    font-family: "Open Sans", sans-serif;
    font-weight: bold;
    text-align: center;
    border-radius: 10px;
    border:2px solid black;
    margin-top: 3px;
    
}

#fnameE{
    border:2px solid black;
}
select{
    width: 80%;
    outline: none;
    text-align: center;
    border: 2px solid black;
    font-family: "Open Sans", sans-serif;
    text-decoration: none;
    background-color: transparent;
}
input[type="text"]:focus,input[type="email"]:focus{
    outline: none;
    border: 2px solid #f56a6a;
}

td, th{ 
    text-align: center;
    line-height: 18px;
    /* border: 1px solid black; */
    
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
    position: fixed;
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
#saveReal{
    position: fixed;
    top: 70%;
    left: 30%;
    transform: translate(-50%, -50%);
    z-index:6;
    width:100px;
    height:30px;
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
    width:100px;
    height:30px;
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
<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

<div class="confirmation">
   
    </div>
        <div id="delcontainer"><?php
            if($row['adm_status'] == "Active"){
                echo'
                <h3 align="center">Do you want to apple the changes?<h3>
                    <input type="submit"  name="goEdit" id="saveReal" value="Save"/>
                    <input type="button" id="backtoread" Value="Cancel" onclick="hideContainer()">';
            }          
            ?>

        </div>

    <div id="container">
        <table id="crudtable">
            <tr>
                <th colspan = 3 id="detailst"><h3>Edit Details</h3></td>
            </tr>
            <tr>
                <td id="nameY">Name:
                <td colspan = 2 id="namet"><b><?php 
                    echo '<input type ="text" id ="fnameE"name="fname" value="'.$pfname.'" ">
                        <br>';
                    echo '<input type ="text" name="mname" placeholder="Middle Name" value="'.$pmname.'">
                       <br>';
                    echo '<input type ="text" name="lname" value="'.$plname.'">
                      <br>';
                    ?>
                    <b></td>
            </tr>
            <tr>
                <td>Username</td>
                <td colspan=2 id="usert"><b><?php 
                    echo '<input type ="text" name="username" value="'.$pusername.'" >';
                ?><b></td>
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td><?php 
                echo '<input type ="date" name="bday" value='. $row["adm_bday"].'> <br><b>Birthdate<b></td>
                    ';
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
                <td colspan = 2 id="emailt"><?php echo '<input name ="email" id="emailText" type ="email" value="'.$pemail.'" >
                <br><b>Email</b></td>
                <td><input name="mobile" id="mobileText" type ="text" value="'.$pmobile.'" > <br><b>Mobile<b></td>
            </tr>'; ?>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td colspan = 3 id="emailt"><?php 
                echo '<input id="addressText" name ="address" type ="text" value="'.$paddress.'" >'; 
                ?><br><b>Address</b></td>
            </tr>
            <tr>
                <td colspan=3 id="firstline"></td>
            </tr>
            <tr>
                <td colspan = "3"><br><input type="button" id="save" value="Save" onclick="showContainer()"/> </td>
            </tr>
        </table>
        </form> 
        
        
        <input type="button" class="backread" value="Back" onClick="location.href='AdminRegistration.php'">
        
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
