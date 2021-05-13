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
// require_once "connection/config.php";
 

// $pfname = $pmname = $plname = $pbday = $gender = $pemail= $pmobile= $address = "";
// $pfnameerr = $pmnameerr = $plnameerr = $pbdayerr = $gendererr = $pemailerr= $pmobileerr= $addresserr = "";

// if(isset($_POST["id"]) && !empty($_POST["id"])){

//     $id = $_POST["id"];
   
//     //first name
//     $input_fname = trim($_POST["fname"]); 
//     if(empty($input_fname)){
//         $name_err = "Please enter a first name."; 
//     } elseif(!filter_var($input_fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
//         $name_err = "Please enter a valid first name.";
//     } else{
//         $pfname = $input_fname;
//     }
//     //middle name
//     $input_mname = trim($_POST["mname"]); 
//     if(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
//         $name_err = "Please enter a valid first name.";
//     } else{
//         $pmname = $input_mname;
//     }

//     //last name
//     $input_name = trim($_POST["lname"]); 
//     if(empty($input_name)){
//         $name_err = "Please enter a first name."; 
//     } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
//         $name_err = "Please enter a valid first name.";
//     } else{
//         $name = $input_name;
//     }
    

//     $input_address = trim($_POST["address"]);
//     if(empty($input_address)){
//         $address_err = "Please enter an address.";     
//     } else{
//         $address = $input_address;
//     }
    
//     $input_salary = trim($_POST["salary"]);
//     if(empty($input_salary)){
//         $salary_err = "Please enter the salary amount.";     
//     } elseif(!ctype_digit($input_salary)){
//         $salary_err = "Please enter a positive integer value.";
//     } else{
//         $salary = $input_salary;
//     }
    
//     if(empty($name_err) && empty($address_err) && empty($salary_err)){
//         $sql = "UPDATE employees SET name=?, address=?, salary=? WHERE id=?";
         
//         if($stmt = mysqli_prepare($db, $sql)){
//             mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
            
//             $param_name = $name;
//             $param_address = $address;
//             $param_salary = $salary;
//             $param_id = $id;
            
//             if(mysqli_stmt_execute($stmt)){
//                 header("location: home.php");
//                 exit();
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }
//         }
         
//         mysqli_stmt_close($stmt);
//     }
    
//     mysqli_close($db);
// } else{
//     if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
//         $id =  trim($_GET["id"]);
        
//         $sql = "SELECT * FROM employees WHERE id = ?";
//         if($stmt = mysqli_prepare($db, $sql)){
//             mysqli_stmt_bind_param($stmt, "i", $param_id);
            
//             $param_id = $id;
            
//             if(mysqli_stmt_execute($stmt)){
//                 $result = mysqli_stmt_get_result($stmt);
    
//                 if(mysqli_num_rows($result) == 1){
//                     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
//                     $name = $row["name"];
//                     $address = $row["address"];
//                     $salary = $row["salary"];
//                 } else{
//                     header("location: error.php");
//                     exit();
//                 }
                
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }
//         }
//         mysqli_stmt_close($stmt);
//         mysqli_close($$db);
//     }  else{
//         header("location: error.php");
//         exit();
//     }
// }
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
input[type="text"]:focus{
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
                <td> <input type ="text" id="mobileText" value='. $row["adm_mobile"].' ><br><b>Mobile<b></td>
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
        <input type="submit" id="back" value="Back" onClick="location.href='read.php?id='<?php echo $row['adm_AdminId'];?> '" />
</body>
</html>
