<?php 
	session_start();
	if(!isset($_SESSION['FacultyName'])){
		session_destroy();
		header("location: ../../login.php");
		exit();
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
         padding: 8px;
         }
         tr:nth-child(even) {
         background-color: #fff;
         }
      </style>
   </head>
   <body class="is-preload">
      <!-- Wrapper -->
      <div id="wrapper">
         <!-- Main -->
         <div id="main">
            <div class="inner">
               <!-- Header -->
               <header id="header">
                  <a href="" class="logo"><strong>Faculty</strong> Module</a>
                  <ul class="icons"><?php
                     echo "<li>".$_SESSION['FacultyName']."</li>"
                     ?>
                     <li><a href="../../logout.php">Sign Out</a></li>
                     </ul>
               </header>
               <!-- Banner -->
               <section id="banner">
                  <div class="content">
                     <header>
                        <h2>Upload File</h2>
                     </header>
                     <div id="div">
                        <form action="fct_upload.php" method="post" enctype="multipart/form-data" > 
                           <div class="form-group">
                              <label>Subject</label>
                              <input type="text" name="subj" id ="subj" value="<?php include "getsubj.php"?>" readonly>
                            
                                 
                              </select><br>
                           </div>
                           <label>Description</label>
                           <textarea name="desc"></textarea><br><br>
                           <input type="file" name="myfile"> <br><br>
                           <button type="submit" name="save">upload</button>
                        </form>
                        </center>
                        <br>
                        </form> 
                     </div>
                     <?php
                        // connect to database
                        $conn = mysqli_connect('localhost', 'root', '', 'sisappdev');
                        // Uploads files
                        if (isset($_POST['save']))
                        { // if save button on the form is clicked
                            // name of the uploaded file
                            $filename = $_FILES['myfile']['name'];
                            $subj = $_POST['subj'];
                           
                            $desc = $_POST['desc'];
                            // destination of the file on the server
                            $destination = '../uploads/' . $filename;

                            // get the file extension
                            $extension = pathinfo($filename, PATHINFO_EXTENSION);

                            // the physical file on a temporary uploads directory on the server
                            $file = $_FILES['myfile']['tmp_name'];
                            $size = $_FILES['myfile']['size'];

                            if (!in_array($extension, ['zip', 'pdf', 'docx']))
                            {
                                echo "You file extension must be .zip, .pdf or .docx";
                            }
                            elseif ($_FILES['myfile']['size'] > 1000000)
                            { // file shouldn't be larger than 1Megabyte
                                echo "File too large!";
                            }
                            else
                            {
                                // move the uploaded (temporary) file to the specified destination
                                if (move_uploaded_file($file, $destination))
                                {
                                    $sql = "INSERT INTO lecture (Subject,name, description) VALUES ('$subj','$filename', '$desc')";
                                    if (mysqli_query($conn, $sql))
                                    {
                                        echo "File uploaded successfully";
                                    }
                                }
                                else
                                {
                                    echo "Failed to upload file.";
                                }
                            }
                        }
                        $sql = "SELECT * FROM lecture";
                        $result = mysqli_query($conn, $sql);

                        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        // Downloads files
                        if (isset($_GET['file_id']))
                        {
                            $id = $_GET['file_id'];

                            // fetch file to download from database
                            $sql = "SELECT * FROM lecture WHERE id=$id";
                            $result = mysqli_query($conn, $sql);

                            $file = mysqli_fetch_assoc($result);
                            $filepath = '../uploads/' . $file['name'];

                            if (file_exists($filepath))
                            {
                                header('Content-Description: File Transfer');
                                header('Content-Type: application/octet-stream');
                                header('Content-Disposition: attachment; filename=' . basename($filepath));
                                header('Expires: 0');
                                header('Cache-Control: must-revalidate');
                                header('Pragma: public');
                                header('Content-Length: ' . filesize('../uploads/' . $file['name']));
                                readfile('../uploads/' . $file['name']);

                                // Now update downloads count
                                $newCount = $file['downloads'] + 1;
                                $updateQuery = "UPDATE lecture SET link=$newCount WHERE id=$id";
                                mysqli_query($conn, $updateQuery);
                                exit;
                            }

                        }
                        ?>
                     <table>
                        <tr>
                           <th>Subject</th>
                           <th>Name</th>
                           <th>Description</th>
                           <th>ACTION</th>
                        </tr>
                        <?php foreach ($files as $file): ?>
                        <tr>
                           <td><?php echo $file['subject']; ?></td>
                           <td><?php echo $file['name']; ?></td>
                           <td><?php echo $file['description']; ?></td>
                           <td><a href="fct_download.php?file_id=<?php echo $file['id'] ?>">
                              <i class="fa fa-download" title="Download" aria-hidden="true"></i></a>
                           </td>
                        </tr>
                        <?php endforeach;?>	
                     </table>
                  </div>
               </section>
            </div>
         </div>
         <!-- Sidebar -->
         <div id="sidebar">
            <div class="inner">
               <!-- Search -->
               <section id="search" class="alt">
                  <form method="post" action="adminSearch.php">
                     <input type="text" name="query" id="query" placeholder="Search" />
                     <input type="submit" name="search" style="display: none">
                  </form>
               </section>
               <!-- Menu -->
               <nav id="menu">
                  <header class="major">
                     <h2>Menu</h2>
                  </header>
                  <ul>
                     <li><a href="fct_home.php">Home</a></li>
                     <li><a href="fct_upload.php">Upload</a></li>
                     <li><a href="fct_attendance.php">Attendance</a></li>
                     <li><a href="fct_grade.php">Grade</a></li>
                     <li><a href="Announcement/announcement.php">Announcement</a></li>
                  </ul>
               </nav>
            </div>
         </div>
      </div>
      <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/browser.min.js"></script>
      <script src="assets/js/breakpoints.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>
   </body>
</html>
