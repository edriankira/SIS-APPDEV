<?php
                                        require_once 'include/Connection/DBconnect.php';
                                        $SQLparent = "SELECT adm_fctId, adm_fctfname, adm_fctusername ,adm_fctpassword FROM adm_facultyuser WHERE adm_fctusername =? AND adm_fctpassword =?";
                                        if($stmtParent = mysqli_prepare($connect, $SQLparent))
                                        {

                                            mysqli_stmt_bind_param($stmtParent, "ss", $param_user, $param_pass);

                                            $param_user = $USER;
                                            $param_pass = $PASS;

                                            if(mysqli_stmt_execute($stmtParent))
                                            {
                                                $result = mysqli_stmt_get_result($stmtParent);

                                                if(mysqli_num_rows($result) == 1 &&  $_POST['account'] == "Faculty_account"){

                                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                                    $std_ID = $row["adm_fctId"];
                                                    $std_FNAME = $row["adm_fctfname"];
                                                    $std_USER = $row["adm_fctusername"];
                                                    $std_PASS = $row["adm_fctpassword"];

                                                    //for correct credential of a users
                                                    echo '<script type="text/javascript">
                                                          swal("'.$std_FNAME.'!", "You are logged in sucessfully for parent", "success").then(function() {
                                                          window.location = "redirectURL.php";});
                                                          </script>';
                                                          exit();
                                                }         else {include 'include/LOGINprocess/ADMINaccount.php';   }
                                            } 
                                            else
                                            {
                                                //for bad query 
                                                echo '<script type="text/javascript">
                                                                   swal("OOPS!", "Something went wrong. Please try again later", "error");
                                                </script>';
                                            }
                                        }