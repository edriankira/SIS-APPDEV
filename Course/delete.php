<?php 
include_once('include/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('adm_listcourse',array('adm_lcID'=>$_REQUEST['delId']));
	header('location: course_List.php?msg=rds');
	exit;
}
?>