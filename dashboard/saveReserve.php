<?php
session_start();
require("../core/config.core.php");
require("../core/connect.core.php");
require("../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();

if(@addslashes($_GET['lang'])){
	$_SESSION['lang'] = addslashes($_GET['lang']);
}else{
	$_SESSION['lang'] = $_SESSION['lang'];
}
if(@$_SESSION['lang']!=NULL){
	require("../language/".@$_SESSION['lang']."/site.lang");
	require("../language/".@$_SESSION['lang']."/menu.lang");
}else{
	require("../language/th/site.lang");
	require("../language/th/menu.lang");
	$_SESSION['lang'] = 'th';

}
$myArray = addslashes($_POST['key']);
$pieces = explode(",", $myArray);
/*$ar = array($_POST['key']);
echo json_encode($ar, JSON_FORCE_OBJECT);*/
  //$getdata->my_sql_insert_New("viewTables","name, age, gender, action",":name, :age, :gender, :action");
	foreach ($pieces as $last) {
		?>
		<script>
		console.log('<?= array(':action'=>$last)?>');

	</script>
				<?
	}
	?>
