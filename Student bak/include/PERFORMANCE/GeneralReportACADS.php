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
                            $FinalAVE = 0;
                            $sql = "SELECT * FROM fct_prelim
                                    UNION ALL
                                    SELECT * FROM fct_midterm 
                                    UNION ALL
                                    SELECT * FROM fct_final 
                                    ORDER BY id";
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
                                    echo '<td class="p-3 mb-2  ">'.$row["pa"].'</td>'; 
                                        echo '<td class="p-3 mb-2 ">'.$row["gen"].'</td>'; 
                                        echo '<td class="p-3 mb-2 ">'.$row["aae"].'</td>'; 
                                        echo '<td class="p-3 mb-2 ">'.$row["eval"].'</td>'; 
                                        echo '<td class="p-3 mb-2 ">'.$row["ass"].'</td>'; 
                                        echo '<td class="p-3 mb-2 ">'.$row["exam"].'</td>';
                                        $FinalAVE = $row["pa"] + $row["gen"] + $row["aae"] + $row["eval"] + $row["ass"] + $row["exam"];
                                    
                            echo '<tr>'; 
                              }?>
                        
                            <?php }    ?>
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
