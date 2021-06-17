<?php

$connect = new mysqli("localhost", "root", "", "sisappdev");
if ($connect->connect_error) { die("Connection failed: " . $conn->connect_error);}
