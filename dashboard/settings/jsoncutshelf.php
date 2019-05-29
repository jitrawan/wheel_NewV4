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

$getvale = $getdata->my_sql_select("s.*
,s.shelf_code,(select sum(ss.amt_rimit) from shelf_detail ss where ss.shelf_code = s.shelf_code) as rimit "
,"shelf s"
,"s.shelf_header_code = '".addslashes($_GET['key'])."'  and (select sum(ss.amt_rimit) from shelf_detail ss where ss.shelf_code = s.shelf_code)  > 0 ");

echo "<option value='' selected='selected'>--เลือกชั้นวางสินค้า--</option>";
while($row = mysql_fetch_array($getvale)) {
	$gettimt = $row['rimit'];
	echo "<option value=" . $row['shelf_code']  .">ชั้น" . $row['shelf_class'] . " เหลือ " .$gettimt. " ชิ้น</option>";
}

?>

