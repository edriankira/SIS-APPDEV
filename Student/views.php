<?php
    if(isset($_GET['link']))
    {
        $VIEW = $_GET['link'];
        $filepath = '../uploads/'.$VIEW;
        header("Content-type: application/pdf");
        readfile($filepath);
    }
?>

