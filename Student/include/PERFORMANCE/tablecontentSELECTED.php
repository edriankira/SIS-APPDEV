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
    </head>
    <body>
       <div id="chartContainer" style="height: 370px; width: 100% ; "></div><br>
            <table class="container">
                <thead>
                        <tr>
                            <th><h1>ID</h1></th>
                            <th><h1>Student ID</h1></th>
                            <th><h1>Full Name</h1></th>
                            <th><h1>SECTION</h1></th>
                            <th><h1>COURSE</h1></th>
                            <th><h1>SUBJECT</h1></th>
                            <th><h1>Pre.</h1></th>
                            <th><h1>Gen.</h1></th>
                            <th><h1>AAE.</h1></th>
                            <th><h1>EVAL.</h1></th>
                            <th><h1>ASS.</h1></th>
                            <th><h1>EXAM</h1></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                             
                            require_once 'include/Connection/DBconnect.php';
//                            header("Refresh:5");
                            $present = $absent = 0;
                            $sql = "SELECT * FROM fct_record WHERE subjects ='".$_POST["optionSUB"]."' AND userid ='".$_SESSION["stnID"]."' AND course ='".$_SESSION["stdCourse"]."'";
                            $result = $connect->query($sql);

                            if ($result->num_rows > 0) { 
                              // output data of each row
                            while($row = $result->fetch_assoc()) 
                              {
                           echo '<tr>
                                    <td >'.$row["id"].'</td>
                                    <td>'.$row["userid"].'</td>
                                    <td>'.$row["name"].'</td>
                                    <td>'.$row["section"].'</td>
                                    <td>'.$row["course"].'</td>
                                    <td>'.$row["subjects"].'</td>';
                                    
                                        echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["pa"].'</td>'; 
                                        echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["gen"].'</td>'; 
                                        echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["aae"].'</td>'; 
                                        echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["eval"].'</td>'; 
                                        echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["ass"].'</td>'; 
                                        echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["exam"].'</td>';
                                        $FinalAVE = $row["pa"] + $row["gen"] + $row["aae"] + $row["eval"] + $row["ass"] + $row["exam"];
                                    
                            echo '<tr>'; 
                              } }else{
                                echo '<tr>
                                    <td >0</td>
                                    <td >0</td>
                                    <td >0</td>
                                    <td >0</td>
                                    <td >0</td>
                                    <td>0</td>';
                                    echo '
                                    <td >0</td>
                                    <td >0</td>
                                    <td >0</td>
                                    <td >0</td>
                                    <td >0</td>
                                    <td>0</td>';
                                    $FinalAVE = 0;
                            echo '<tr>'; 
                            } ?>
                        
                         <?php
                              $dataPoints = array(
                              array("label"=> "AVERAGE", "y"=> $FinalAVE/6),
                              array("label"=> "OTHER", "y"=> (600-$FinalAVE)/6));
                          ?>
                        <script>
                            window.onload = function () {

                            var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    exportEnabled: true,
                                    title:{
                                            text: "<?php echo $_POST["optionSUB"]; ?>"
                                    },
                                    subtitles: [{
                                            text: "Student Records"
                                    }],
                                    data: [{
                                            type: "pie",
                                            showInLegend: "true",
                                            legendText: "{label}",
                                            indexLabelFontSize: 16,
                                            indexLabel: "{label} - #percent%",
                                            
                                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                    }]
                            });
                            chart.render();   }
                        </script> 
                            
                        
                    </tbody>
                    <tfoot>
                           <th><h1>ID</h1></th>
                            <th><h1>Student ID</h1></th>
                            <th><h1>Full Name</h1></th>
                            <th><h1>SECTION</h1></th>
                            <th><h1>COURSE</h1></th>
                            <th><h1>SUBJECT</h1></th>
                            <th><h1>Pre.</h1></th>
                            <th><h1>Gen.</h1></th>
                            <th><h1>AAE.</h1></th>
                            <th><h1>EVAL.</h1></th>
                            <th><h1>ASS.</h1></th>
                            <th><h1>EXAM</h1></th>
                    </tfoot>
</table>
    </body>
</html>
