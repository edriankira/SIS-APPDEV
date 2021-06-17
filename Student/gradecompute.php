<?php
$attendance = 0;
$vc = 0;
$at1 = $_POST['gd1'] ;
$at2 = $row['gd2'];
$at3 = $row['gd3'];
$at4 = $row['gd4'];
$at5 = $row['gd5'];
$pa = $row['gpa'];
$gen = $row['ggen'];
$aae = $row['gaae'];
$eval = $row['geval'];
$ass = $row['gass'];
$exam = $row['gexam'];

if($at1 == 'p' || $at1 == 'P')
{   
    $attendance = (int)$attendance + 1;
}
if($at2 == 'p' || $at2 == 'P')
{   
    $attendance = (int)$attendance + 1;
}
if($at3 == 'p' || $at3 == 'P')
{   
    $attendance = (int)$attendance + 1;
}
if($at4 == 'p' || $at4 == 'P')
{   
    $attendance = (int)$attendance + 1;
}
if($at5 == 'p' || $at5 == 'P')
{   
    $attendance = (int)$attendance + 1;
}
$getattendance = $attendance; //.05
$getpa = (float)0;
$getgen = (float)0;
$getaae = (float)0;
$geteval = (float)0;
$getass = (float)0;
$getexam = (float)0;

if($pa > 0) {
    $getpa = $pa * (float)0.10;
}

if($gen > 0) {
    $getgen = $gen * (float)0.10;
}

if($aae > 0) {
    $getaae = $aae * (float).20;
}

if($eval > 0) {
    $geteval = $eval * (float).15;
}

if($ass > 0) {
    $getass = $ass * (float).05;
}

if($exam > 0) {
    $getexam = $exam * (float).35;
}

$vc=  $getattendance + $getpa+ $getgen +$getaae + $geteval + $getass + $getexam;
echo $vc;
?>
