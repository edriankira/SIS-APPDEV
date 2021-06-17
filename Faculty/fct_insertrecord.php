<?php
// Include config file
require_once "db_conn.php";
session_start();
// Define variables and initialize with empty values
$d1 = $d2 =  $d3 =  $d4 = $d5 = $pa = $gen = $aae = $eval = $ass = $exam  ="";
$d1_err = $d2_err = $d3_err =  $d4_err = $d5_err = $pa_err = $gen_err = $aae_err = $eval_err  = $ass_err=  $exam_err ="";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
   
        $input_d1 = trim($_POST["d1"]); 
        if(empty($input_d1)){
            $d1_err = "Please input data."; 
        } elseif(!filter_var($input_d1, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $d1_err = "Please input data";
        } else{
            $d1 = $input_d1;
        }
    
        $input_d2 = trim($_POST["d2"]);
        if(empty($input_d1)){
            $d2_err = "Please enter data.";     
        } else{
            $d2 = $input_d2;
        }

        $input_d3 = trim($_POST["d3"]);
        if(empty($input_d1)){
            $d3_err = "Please enter data.";     
        } else{
            $d3 = $input_d3;
        }

        $input_d4 = trim($_POST["d4"]);
        if(empty($input_d1)){
            $d4_err = "Please enter data.";     
        } else{
            $d4 = $input_d4;
        }
        
        $input_d5 = trim($_POST["d5"]);
        if(empty($input_d1)){
            $d5_err = "Please enter data.";     
        } else{
            $d5 = $input_d5;
        }

        $input_pa = trim($_POST["pa"]);
        if(empty($input_d1)){
            $pa_err = "Please enter data.";     
        } else{
            $pa = $input_pa;
        }

        $input_gen = trim($_POST["gen"]);
        if(empty($input_d1)){
            $gen_err = "Please enter data.";     
        } else{
            $gen = $input_gen;
        }

        $input_aae = trim($_POST["aae"]);
        if(empty($input_d1)){
            $aae_err = "Please enter data.";     
        } else{
            $aae = $input_aae;
        }

        $input_eval = trim($_POST["eval"]);
        if(empty($input_d1)){
            $eval_err = "Please enter data.";     
        } else{
            $eval = $input_eval;
        }

        $input_ass = trim($_POST["ass"]);
        if(empty($input_d1)){
            $ass_err = "Please enter data.";     
        } else{
            $ass = $input_ass;
        }

        $input_exam = trim($_POST["exam"]);
        if(empty($input_d1)){
            $exam_err = "Please enter data.";     
        } else{
            $exam = $input_exam;
        }
    // Check input errors before inserting in database

        // Prepare an update statement
        $sql = "UPDATE ".$_SESSION["term"]." SET d1=?, d2=?, d3=?, d4=?, d5=?, pa=?, gen=?, aae=?, eval=?, ass=?, exam=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssi", $param_d1, $param_d2, $param_d3, $param_d4, $param_d5, $param_pa,
                $param_gen, $param_aae, $param_eval, $param_ass, $param_exam, $param_id);
            
            // Set parameters
            $param_d1 = $d1;
            $param_d2 = $d2;
            $param_d3 = $d3;
            $param_d4 = $d4;
            $param_d5 = $d5;
            $param_pa = $pa;
            $param_aae = $aae;
            $param_gen = $gen;
            $param_eval = $eval;
            $param_ass = $ass;
            $param_exam = $exam;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: fct_grade.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT id, userid, 
		CONCAT(adm_studentuser.adm_stdfname, ' ', adm_studentuser.adm_stdlname) AS FullName, 
        adm_studentuser.adm_stdSection,
        d1,d2,d3,d4,d5,pa,gen,aae,eval,ass,extracur,exam, term_grade,term
        FROM `fct_record` 
        JOIN adm_studentuser ON
        adm_studentuser.adm_stdUserNum = fct_record.userid
        WHERE id =  ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $d1 = $row["d1"];
                    $d2 = $row["d2"];
                    $d3 = $row["d3"];
                    $d4 = $row["d4"];
                    $d5 = $row["d5"];
                    $d5 = $row["d5"];
                    $pa = $row["pa"];
                    $gen = $row["gen"];
                    $aae = $row["aae"];
                    $eval = $row["eval"];
                    $ass = $row["ass"];
                    $exam = $row["exam"];
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title> Records </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style type="text/css">
		    table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		}
		td, th {
		  border: 1px solid #dddddd;
		  text-align: center;
		}

		tr:nth-child(even) {
		  background-color: #dddddd;
		}
    </style>
		
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->

					<div id="main">

						<div class="inner">

							<!-- Banner -->
								<section id="banner">
									<div class="content">
									
								<table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                <!-- <th rowspan='2' style="text-align: center;padding: 10px;">Student Number</th>
                                <th rowspan='2' style="text-align: center;padding: 10px;">Full name</th>
                                <th rowspan='2' style="text-align: center;padding: 10px;">Section </th> -->
                                <th colspan='5' style="text-align: center;padding: 10px;">ATTENDANCE </th>
                                <th colspan='5' style="text-align: center;padding: 10px;">ACTIVITY </th>
                                <th rowspan='2' style="text-align: center;padding: 10px;">EXAM </th>
                                <th rowspan='2' style="text-align: center;padding: 10px;"> COEXTRA</th>
                                <th rowspan='2' style="text-align: center;padding: 10px;">Actions </th>
                                </tr>
                                <tr>
                                <td>D1 </td>
                                <td>D2 </td>
                                <td>D3 </td>
                                <td>D4 </td>
                                <td>D5 </td>
                                <td>PA </td>
                                <td>GEN </td>
                                <td>AAE </td>
                                <td>EVAL </td>
                                <td>ASS </td>
                                </tr> 
                                </thead>
                                <tbody>
                                <tr>
                    <h2 class="mt-5">Grading</h2>
                    <h2 class="mt-5"><?php echo $row['FullName'] ?></h2>
                    <h3 class="mt-5"><?php include "getsubj.php" ?></h2>
                    <h3 class="mt-5"><?php  ?></h2>
                    <br>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    
                    
                                        <?php
                                        // echo "<tr>";
                                        // echo "<td>" . $row['userid'] . "</td>";
                                        // echo "<td>" . $row['name'] . "</td>";
                                        // echo "<td>" . $row['section'] . "</td>";
                                        ?>
                                        <td>
                                        <input type="text" style="width: 50px;height: 35px;" name="d1" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $d1;?>">
                                        </td>

                                        <td>
                                        <input type="text" name="d2" style="width: 50px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value ="<?php echo $d2;?>">
                                        </td>

                                        <td>
                                        <input type="text" name="d3" style="width: 50px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value ="<?php echo $d3;?>">
                                        </td>

                                        <td>
                                        <input type="text" name="d4" style="width: 50px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $d4; ?>">
                                        </td>

                                        <td>
                                        <input type="text" name="d5" style="width: 50px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $d5; ?>">
                                        </td>

                                        <td>
                                        <input type="text" name="pa" style="width: 60px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $pa; ?>">
                                        </td>

                                        <td>
                                        <input type="text" name="gen" style="width: 60px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $gen; ?>">
                                        </td>

                                        <td>
                                        <input type="text" name="aae" style="width: 60px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $aae; ?>">
                                        </td>

                                        <td>
                                        <input type="text" name="eval" style="width: 60px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $eval; ?>">
                                        </td>

                                        <td>
                                        <input type="text" name="ass" style="width: 60px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $ass; ?>">
                                        </td>

                                        <td>
                                        <input type="text" name="exam" style="width: 60px;height: 35px;" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $exam; ?>">
                                        </td>

                                        <td>
                                            <select name="coextra">
                                                <option value="" ></option>
                                                <option value="fct_prelim" > Sportsfest </option>
                                                <option value="fct_midterm" > Programming Contest </option><br>
                                                <option value="fct_final" > Science Fair </option><br>
                                            </select>
                                        </td>   

                                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                        <td>
                                        <input type="submit" id="submit" value="Submit">

                                        <br><br>
                                        <a href="fct_grade.php">Cancel</a>
                                        </td>
                                        <?php
                                        echo "</tr>";
                                        echo "</tbody>";                            
                                        echo "</table>";
                                        ?>
										</form>

										
										
								</section>

						</div>
					</div>

				<!-- Sidebar -->

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>