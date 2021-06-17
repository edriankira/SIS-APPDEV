<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <link rel="stylesheet" href="alert/dist/sweetalert.css">
    </head>
    <body>
        
<?php
   session_start(); 
   
   if(session_destroy()) 
   { 
         echo '<script type="text/javascript">
                                  swal("Signed out!", "Thank you!", "success").then(function() {
                                  window.location = "../login.php";});
                                  </script>';  
         die();
   }

        ?>
    </body>
</html>
