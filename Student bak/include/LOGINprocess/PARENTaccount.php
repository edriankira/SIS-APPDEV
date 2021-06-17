<?php
                                        require_once 'include/Connection/DBconnect.php';
                                        $SQLparent = "SELECT adm_prtId, adm_prtfname, adm_prtusername, adm_prtpassword FROM adm_parentuser WHERE adm_prtusername =? AND adm_prtpassword =?";
                  
                                        if($stmtParent = mysqli_prepare($connect, $SQLparent))
                                        {

                                            mysqli_stmt_bind_param($stmtParent, "ss", $param_user, $param_pass);

                                            $param_user = $USER;
                                            $param_pass = $PASS;

                                            if(mysqli_stmt_execute($stmtParent))
                                            {
                                                $result = mysqli_stmt_get_result($stmtParent);

                                                if(mysqli_num_rows($result) == 1 &&  $_POST['account'] == "Parent_account"){

                                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                                    $std_ID = $row["adm_prtId"];
                                                    $std_FNAME = $row["adm_prtfname"];
                                                    $std_USER = $row["adm_prtusername"];
                                                    $std_PASS = $row["adm_prtpassword"];

                                                    //for correct credential of a users
                                                    echo '<script type="text/javascript">
                                                          swal("'.$std_FNAME.'!", "You are logged in sucessfully for faculty", "success").then(function() {
                                                          window.location = "redirectURL.php";});
                                                          </script>';
                                                          exit();
                                                }         else {include 'include/LOGINprocess/FACULTYaccount.php';   }
                                            } 
                                            else
                                            {
                                                //for bad query 
                                                echo '<script type="text/javascript">
                                                                   swal("OOPS!", "Something went wrong. Please try again later", "error");
                                                </script>';
                                            }
                                        }