<?php
    // if(isset($_POST['submit']))
    // {
    //     $_SESSION["term"] = $_POST['term'];
    //     $getSection = $_POST['sect'];
    //     $getTerm = $_POST['term'];
    //     require_once "db_conn.php";
    //     $sql = "SELECT * from fct_prelim where section=''; ";
    //         if($result = mysqli_query($conn, $sql)){
    //             if(mysqli_num_rows($result) > 0){

                                     
    //                 while($row = mysqli_fetch_array($result)){
    //                     echo "<tr>";
    //                     echo "<td>" . $row['userid'] . "</td>";
    //                     echo "<td>" . $row['name'] . "</td>";
    //                     echo "<td>" . $row['section'] . "</td>";
    //                     echo "<td>" . $row['course'] . "</td>";
    //                     echo "<td>" . $row['d1'] . "</td>";
    //                     echo "<td>" . $row['d2'] . "</td>";
    //                     echo "<td>" . $row['d3'] . "</td>";
    //                     echo "<td>" . $row['d4'] . "</td>";
    //                     echo "<td>" . $row['d5'] . "</td>";

    //                     //checking the status of student
    //                     $attendance = 0;
    //                     $status = '';
    //                     $at1 = $row['d1'] ;
    //                     $at2 = $row['d2'] ;
    //                     $at3 = $row['d3'] ;
    //                     $at4 = $row['d4'] ;
    //                     $at5 = $row['d5'] ;
    //                     if($at1 == 'p' || $at1 == 'P')
    //                     {   
    //                         $attendance = (int)$attendance + 1;
    //                     }
    //                     if($at2 == 'p' || $at2 == 'P')
    //                     {   
    //                         $attendance = (int)$attendance + 1;
    //                     }
    //                     if($at3 == 'p' || $at3 == 'P')
    //                     {   
    //                         $attendance = (int)$attendance + 1;
    //                     }
    //                     if($at4 == 'p' || $at4 == 'P')
    //                     {   
    //                         $attendance = (int)$attendance + 1;
    //                     }
    //                     if($at5 == 'p' || $at5 == 'P')
    //                     {   
    //                         $attendance = (int)$attendance + 1;
    //                     }

    //                     if($attendance < 3)
    //                     {
    //                         $status = "INACTIVE";
    //                         echo "<td>$status</td>";
    //                     }
    //                     else if ($attendance == 0) {
    //                         $status = " ";
    //                         echo "<td>$status</td>";
    //                     }
    //                     else{
    //                         $status = "ACTIVE";
    //                         echo "<td>$status</td>";
    //                     }
    //                     echo "<td>"; echo '<a href="fct_insertrecord.php?id='. $row['id'] .'" class="mr-3" title="Insert Record" data-toggle="tooltip"><span class="fa fa-pencil">Insert</span></a>';
    //                     echo "</td>";
    //                     echo "</tr>";
    //                     }
    //                 mysqli_free_result($result);
    //                 } else{
    //                  echo "No records found!";
    //             }
    //         } else{
    //             echo "Oops! Something went wrong. Please try again later.";
    //     }
    // }
    // //attendance

    include "../connection/config.php";

    $sql_subj = "SELECT sub_code FROM section
					JOIN subjects ON
					subjects.sub_course = section.Section_course
					AND subjects.sub_year = section.Section_year
					WHERE section.Section_name = 'BSIT-1101'";
				$sectionresult = mysqli_query($db, $sql_subj);
				if (mysqli_num_rows($sectionresult) > 0){
					while($row = mysqli_fetch_assoc($sectionresult)){
						$sqladding = "INSERT INTO fct_record(userid, Subject_code,term)
						VALUES('AD_adminID', '".$row["sub_code"]."', 'Prelim'),
						('AD_adminID', '".$row["sub_code"]."', 'Midterm'),
						('AD_adminID', '".$row["sub_code"]."', 'Finals')";
					}
                    
					echo "done";
				}
                else {
					echo mysqli_error($db);
				}
?> 