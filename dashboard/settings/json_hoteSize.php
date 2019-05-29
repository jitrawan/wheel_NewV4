<?php
session_start();
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();

if(@addslashes($_GET['lang'])){
	$_SESSION['lang'] = addslashes($_GET['lang']);
}else{
	$_SESSION['lang'] = $_SESSION['lang'];
}
if(@$_SESSION['lang']!=NULL){
	require("../../language/".@$_SESSION['lang']."/site.lang");
	require("../../language/".@$_SESSION['lang']."/menu.lang");
}else{
	require("../../language/th/site.lang");
	require("../../language/th/menu.lang");
	$_SESSION['lang'] = 'th';

}
$getvale = $getdata->my_sql_query("id","DiameterWhee","Description = '".addslashes($_GET['key'])."'");

$result = $getdata->my_sql_select(NULL,"HoleSizeWhee"," id  in (select HoleSizeWhee FROM relationHoleSize where HoleSizeId = '".$getvale->id."') ");
$desc = array();
while($row = mysql_fetch_array($result)) {
	$desc[]=$row;

}


echo json_encode($desc, true);
?>
