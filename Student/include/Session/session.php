<?php
   session_start();
   
   if(!isset($_SESSION['stnID']) && !isset($_SESSION['Fname']) && !isset($_SESSION['Lname'])){
      header("location: index.php");
      die();
   }
   
   
   
   $STD_ID = $_SESSION["stnID"];
   $STD_Fname = $_SESSION["Fname"];
   $STD_Lname = $_SESSION["Lname"];
   

   require_once 'include/Connection/DBconnect.php';
   $sql = "SELECT adm_stdfname, adm_stdlname FROM adm_studentuser WHERE adm_stdUserNum ='$STD_ID' AND adm_stdfname ='$STD_Fname' AND adm_stdlname ='$STD_Lname'";
   $result = $connect->query($sql);
   
   if ($result->num_rows > 0) { 
          // output data of each row
          while($row = $result->fetch_assoc()) 
          {
             $_SESSION['Fullname'] = $row["adm_stdlname"] .", ".$row["adm_stdfname"];
          }
        }
   if(!isset($_SESSION['Fullname'])){
      header("location: index.php");
      die();
   }
?>
