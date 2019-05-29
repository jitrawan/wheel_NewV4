<?php

date_default_timezone_set('Asia/Bangkok');
require("../core/connect.core.php");
require("../core/config.core.php");
$getdata=new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();



  $getproduct_info = $getdata->my_sql_select(NULL,"product_N",NULL);
	while($objShow = mysql_fetch_object($getproduct_info)){
	            $data[] = $objShow;
	        }

	        $results = ["sEcho" => 1,
	        	"iTotalRecords" => count($data),
	        	"iTotalDisplayRecords" => count($data),
	        	"aaData" => $data ];
	        echo json_encode($results);

					//echo "5555";


?>
