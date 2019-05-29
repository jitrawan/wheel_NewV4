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

$id = $_POST['id'];
$getShelfDetail = $getdata->my_sql_select(null,"shelf","shelf_header_id ='".$id."' ");

//$getShelf = $getdata->my_sql_select(NULL,"product_n","shelf_id ='".$id."' ");
if(mysql_num_rows($getShelfDetail) < 1){
   $getdata->my_sql_delete("shelf_header","shelf_header_id='".$id."'");
  $results = 1;
 }else{
   $results = 0;
 }
 echo $results;
?>
