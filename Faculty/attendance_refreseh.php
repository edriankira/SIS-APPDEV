<?php 

    require "db_conn.php";

    if(isset($_POST['submit'])){
        
        $term = $_POST['term'];
        $sql = "SELECT id,userid, CONCAT(adm_studentuser.adm_stdfname, ' ', adm_studentuser.adm_stdlname) AS FullName, 
        adm_studentuser.adm_stdSection,
        d1,d2,d3,d4,d5, term
        FROM `fct_record` 
        JOIN adm_studentuser ON
        adm_studentuser.adm_stdUserNum = fct_record.userid
        WHERE fct_record.Subject_code = '".$_POST['subj']."' AND term LIKE '%$term%";

        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td> ".$row['userid']." </td>";
                echo "<td> ".$row['FullName']." </td>";
                echo "<td> ".$row['adm_stdSection']." </td>";
                echo "<td> ".$row['d1']." </td>";
                echo "<td> ".$row['d2']." </td>";
                echo "<td> ".$row['d3']." </td>";
                echo "<td> ".$row['d4']." </td>";
                echo "<td> ".$row['d5']." </td>";
                echo "<td> ".$row['term']." </td>";
                echo "<td>"; echo '<a href="fct_insertrecord.php?id='. $row['id'] .'" class="mr-3" title="Insert Record" data-toggle="tooltip"><span class="fa fa-pencil">Insert</span></a>';
                echo "</tr>";

            }
        }

       }
?>