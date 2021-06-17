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
                            <th><h1>Code</h1></th>
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
                              $sql = "SELECT FAC.id AS ID, FAC.userid AS UID, FAC.Subject_code AS Scode, SUB.Sub_title AS ST, FAC.d1 AS D1, FAC.d2 AS D2, FAC.d3 AS D3, FAC.d4 AS D4, FAC.d5 AS D5
                                        FROM fct_record AS FAC
                                        INNER JOIN subjects AS SUB
                                        ON FAC.Subject_code = SUB.Sub_code WHERE userid = '".$_SESSION["stnID"]."'";
                            
                            $result = $connect->query($sql);
                            
                            if ($result->num_rows > 0) { 
                              // output data of each row
                              while($row = $result->fetch_assoc()) 
                              {
                           echo '<tr>
                                    <td >'.$row["ID"].'</td>
                                    <td>'.$row["UID"].'</td>
                                    <td>'.$_SESSION["std_name"].'</td>
                                    <td>'.$row["Scode"].'</td>
                                    <td>'.$row["ST"].'</td>';
//                                    <td>'.$row["subjects"].'</td>';
                                    if ($row["D1"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["D1"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["D1"].'</td>'; $absent++;  }
                                    if ($row["D2"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["D2"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["D2"].'</td>'; $absent++;  }
                                    if ($row["D3"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["D3"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["D3"].'</td>'; $absent++;  }
                                    if ($row["D4"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["D4"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["D4"].'</td>'; $absent++;  }
                                    if ($row["D5"] == "P" ) { echo '<td class="p-3 mb-2 bg-primary text-white">'.$row["D5"].'</td>'; $present++;} else { echo '<td class="p-3 mb-2 bg-danger text-white">'.$row["D5"].'</td>'; $absent++;  } 
                            echo '<tr>'; 
                              }?>
                        
                         <?php
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
                                            text: "Student Subjects"
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
                            <th><h1>Code</h1></th>
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
