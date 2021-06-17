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
                            <th><h1>DAY 1</h1></th>
                            <th><h1>DAY 2</h1></th>
                            <th><h1>DAY 3</h1></th>
                            <th><h1>DAY 4</h1></th>
                            <th><h1>DAY 5</h1></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                             
                            require_once 'include/Connection/DBconnect.php';
//                            header("Refresh:5");
                            $present = $absent = 0;
                            $sql = "SELECT * FROM ".$_POST["optionTERM"]." WHERE  userid ='".$_SESSION["stnID"]."'";
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
                                    if ($row["d1"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["d1"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["d1"].'</td>'; $absent++;  }
                                    if ($row["d2"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["d2"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["d2"].'</td>'; $absent++;  }
                                    if ($row["d3"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["d3"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["d3"].'</td>'; $absent++;  }
                                    if ($row["d4"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["d4"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["d4"].'</td>'; $absent++;  }
                                    if ($row["d5"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["d5"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["d5"].'</td>'; $absent++;  } 
                            echo '<tr>';        
                              }?>
                        
                         <?php
                              $TERMS = "";
                              if ($_POST["optionTERM"] == "fct_prelim") { $TERMS = "Prelim"; }
                              if ($_POST["optionTERM"] == "fct_midterm") {$TERMS = "Midterm";}
                              if ($_POST["optionTERM"] == "fct_final") {$TERMS = "Finals";}
                         
                              $dataPoints = array(
                              array("label"=> "PRESENT", "y"=> $present),
                              array("label"=> "ABSENT", "y"=> $absent));
                              $subTitle = "";
                          ?>
                        <script>
                            window.onload = function () {

                            var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    exportEnabled: true,
                                    title:{
                                            text: "<?php echo $TERMS; ?>"
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
                        </script> <?php }    ?>
                    </tbody>
                    <tfoot>
                            <th><h1>ID</h1></th>
                            <th><h1>Student ID</h1></th>
                            <th><h1>Full Name</h1></th>
                            <th><h1>SECTION</h1></th>
                            <th><h1>COURSE</h1></th>
                            <th><h1>SUBJECT</h1></th>
                            <th><h1>DAY 1</h1></th>
                            <th><h1>DAY 2</h1></th>
                            <th><h1>DAY 3</h1></th>
                            <th><h1>DAY 4</h1></th>
                            <th><h1>DAY 5</h1></th>
                    </tfoot>
</table>
    </body>
</html>
