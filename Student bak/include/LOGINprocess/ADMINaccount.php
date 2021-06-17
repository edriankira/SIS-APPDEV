<?php
                                        require_once 'include/Connection/DBconnect.php';
                                        $SQLparent = "SELECT adm_AdminId, adm_fname, adm_username ,adm_password FROM adm_adminuser WHERE adm_username =? AND adm_password =?";
                                        if($stmtParent = mysqli_prepare($connect, $SQLparent))
                                        {

                                            mysqli_stmt_bind_param($stmtParent, "ss", $param_user, $param_pass);

                                            $param_user = $USER;
                                            $param_pass = $PASS;

                                            if(mysqli_stmt_execute($stmtParent))
                                            {
                                                $result = mysqli_stmt_get_result($stmtParent);

                                                if(mysqli_num_rows($result) == 1 &&  $_POST['account'] == "Admin_account"){

                                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                                    $std_ID = $row["adm_AdminId"];
                                                    $std_FNAME = $row["adm_fname"];
                                                    $std_USER = $row["adm_username"];
                                                    $std_PASS = $row["adm_password"];

                                                    //for correct credential of a users
                                                    echo '<script type="text/javascript">
                                                          swal("'.$std_FNAME.'!", "You are logged in sucessfully for administrator", "success").then(function() {
                                                          window.location = "redirectURL.php";});
                                                          </script>';
                                                          exit();
                                                } 
                                                else
                                                {    
                                                      //for invalid credential of a users
                                                      echo '<script type="text/javascript">
                                                                           swal("INVALID!", "Username or Password is incorrect!", "error");
                                                      </script>';
                                                }
                                            } 
                                            else
                                            {
                                                //for bad query 
                                                echo '<script type="text/javascript">
                                                                   swal("OOPS!", "Something went wrong. Please try again later", "error");
                                                </script>';
                                            }
                                        }