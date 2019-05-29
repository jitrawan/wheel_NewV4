<?php
//--------------------------------------
// Clear@Core->connect
// Publicdate : Sep, 1 2013
// Programmer : khumphol tearmpin
// For : Filetopia
// Website : http://clearprojects.in.th
//--------------------------------------

class clear_db{
	function my_sql_connect($host,$username,$password,$dbname){
		$connect= mysql_connect($host, $username, $password,true) or die(mysql_error());
     	$db=mysql_select_db($dbname,$connect) or die(mysql_error());
		return $db;
	}
	function my_sql_query($field,$table,$event){
		if($field == NULL && $event == NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table);
		}else if($field == NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." WHERE ".$event);
		}else if($event == NULL){
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table);
		}else {
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table." WHERE ".$event);
		}
		$objShow=mysql_fetch_object($objQuery);
		return $objShow;
	}
	function my_sql_select($field,$table,$event){
		if($field == NULL && $event == NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table);
		}else if($field == NULL){

			$objQuery=mysql_query("SELECT * FROM ".$table." WHERE ".$event);
		}else if($event == NULL){
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table);
		}else {
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table." WHERE ".$event);
		}

		return $objQuery;
	}
	function my_sql_selectJoin($field,$table,$join,$event){
		if($field == NULL && $event == NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." p left join ".$join);
		}else if($field == NULL && $event != NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." p left join ".$join." WHERE ".$event);
		}else if($field != NULL && $event == NULL){
			$objQuery=mysql_query("SELECT ".$field." FROM ".$table." p left join ".$join);
		}else if($field != NULL && $event != NULL){
			if($event != ''){
				$objQuery=mysql_query("SELECT ".$field." FROM ".$table." p left join ".$join." ".$event);
			}else{
				$objQuery=mysql_query("SELECT ".$field." FROM ".$table." p left join ".$join);
			}

		}else{
			$objQuery=mysql_query("SELECT * FROM ".$table." p left join ".$join." ".$event);
		}

	return $objQuery;
	}
	function getMaxID($field,$table,$value){
		$objQuery=mysql_query("SELECT max(".$field.") as maxcode FROM ".$table);
		$objShow=mysql_fetch_object($objQuery);
		$getCode = "";
		if($objShow->maxcode != null){
			$setCode = substr($objShow->maxcode,1,4);
			$setCode = (int)$setCode + 1;
			if($setCode < 10){
				$getCode = $value."000".$setCode;
			}else if($setCode < 100){
				$getCode = $value."00".$setCode;
			}else if($setCode < 1000){
				$getCode = $value."0".$setCode;
			}else if($setCode > 1000){
				$getCode = $value.$setCode;
			}
		}else{
			$getCode = $value."0001";
		}
		return $getCode;
	}

	function convertint($number){
	$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
	$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
	$number = str_replace(",","",$number);
	$number = str_replace(" ","",$number);
	$number = str_replace("บาท","",$number);
	$number = explode(".",$number);
	if(sizeof($number)>2){
	return 'ทศนิยมหลายตัวนะจ๊ะ';
	exit;
	}
	$strlen = strlen($number[0]);
	$convert = '';
	for($i=0;$i<$strlen;$i++){
		$n = substr($number[0], $i,1);
		if($n!=0){
			if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
			elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; }
			elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
			else{ $convert .= $txtnum1[$n]; }
			$convert .= $txtnum2[$strlen-$i-1];
		}
	}

	$convert .= 'บาท';
	if($number[1]=='0' OR $number[1]=='00' OR
	$number[1]==''){
	$convert .= 'ถ้วน';
	}else{
	$strlen = strlen($number[1]);
	for($i=0;$i<$strlen;$i++){
	$n = substr($number[1], $i,1);
		if($n!=0){
		if($i==($strlen-1) AND $n==1){$convert
		.= 'เอ็ด';}
		elseif($i==($strlen-2) AND
		$n==2){$convert .= 'ยี่';}
		elseif($i==($strlen-2) AND
		$n==1){$convert .= '';}
		else{ $convert .= $txtnum1[$n];}
		$convert .= $txtnum2[$strlen-$i-1];
		}
	}
	$convert .= 'สตางค์';
	}
	return $convert;
	}

	function genreserv($field,$table,$value,$where){
		if($value != ""){
			if(strlen($value) > 1){
				$objQuery=mysql_query("SELECT  max(SUBSTRING(".$field.",11,6)) as maxcode FROM ".$table." where SUBSTRING(".$field.",3,8) = ".$where);
				$objShow=mysql_fetch_object($objQuery);
				$getDate = date("dmY");
				$getCode = "";
				if($objShow->maxcode != null){
					$setCode = substr($objShow->maxcode,1,4);
					$setCode = (int)$setCode + 1;
					if($setCode < 10){
						$getCode = $value.$getDate."000".$setCode;
					}else if($setCode < 100){
						$getCode = $value.$getDate."00".$setCode;
					}else if($setCode < 1000){
						$getCode = $value.$getDate."0".$setCode;
					}else if($setCode > 1000){
						$getCode = $value.$getDate.$setCode;
					}

				}else{
					$getCode = $value.$getDate."0001";
				}
			}else{
					$objQuery=mysql_query("SELECT  max(SUBSTRING(".$field.",10,5)) as maxcode FROM ".$table." where SUBSTRING(".$field.",2,8) = ".$where);
					$objShow=mysql_fetch_object($objQuery);
					$getDate = date("dmY");
					$getCode = "";
					if($objShow->maxcode != null){
						$setCode = substr($objShow->maxcode,1,4);
						$setCode = (int)$setCode + 1;
						if($setCode < 10){
							$getCode = $value.$getDate."000".$setCode;
						}else if($setCode < 100){
							$getCode = $value.$getDate."00".$setCode;
						}else if($setCode < 1000){
							$getCode = $value.$getDate."0".$setCode;
						}else if($setCode > 1000){
							$getCode = $value.$getDate.$setCode;
						}

					}else{
						$getCode = $value.$getDate."0001";
					}
			}
			
		}else{
			$objQuery=mysql_query("SELECT  max(SUBSTRING(".$field.",9,5)) as maxcode FROM ".$table." where SUBSTRING(".$field.",1,8) = ".$where);
			$objShow=mysql_fetch_object($objQuery);
			$getDate = date("dmY");
			$getCode = "";
			if($objShow->maxcode != null){
				$setCode = substr($objShow->maxcode,1,4);
				$setCode = (int)$setCode + 1;
				if($setCode < 10){
					$getCode = $value.$getDate."000".$setCode;
				}else if($setCode < 100){
					$getCode = $value.$getDate."00".$setCode;
				}else if($setCode < 1000){
					$getCode = $value.$getDate."0".$setCode;
				}else if($setCode > 1000){
					$getCode = $value.$getDate.$setCode;
				}

			}else{
				$getCode = $value.$getDate."0001";
			}
		}

		return $getCode;
	}


	function getMaxID_N($field,$table,$value){
		$objQuery=mysql_query("SELECT max(".$field.") as maxcode FROM ".$table);
		$objShow=mysql_fetch_object($objQuery);
		$getCode = "";
		if($objShow->maxcode != null){
			$setCode = substr($objShow->maxcode,2,5);
			$setCode = (int)$setCode + 1;
			if($setCode < 10){
				$getCode = $value."000".$setCode;
			}else if($setCode < 100){
				$getCode = $value."00".$setCode;
			}else if($setCode < 1000){
				$getCode = $value."0".$setCode;
			}else if($setCode > 1000){
				$getCode = $value.$setCode;
			}
		}else{
			$getCode = $value."0001";
		}
		return $getCode;
	}
	function my_sql_show_rows($table,$event){
		if($event != NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." WHERE ".$event);
		}else{
			$objQuery=mysql_query("SELECT * FROM ".$table);
		}
		$objShow=mysql_num_rows($objQuery);
		return $objShow;
	}
	function my_sql_show_field($table,$event){
		if($event != NULL){
			$objQuery=mysql_query("SELECT * FROM ".$table." WHERE ".$event);
		}else{
			$objQuery=mysql_query("SELECT * FROM ".$table);
		}
		$objShow=mysql_num_fields($objQuery);
		return $objShow;
	}
	function my_sql_update($table,$set,$event){
		if($event != NULL){

			return mysql_query("UPDATE ".$table." SET ".$set." WHERE ".$event);
		}else{
			return mysql_query("UPDATE ".$table." SET ".$set);
		}
	}
function my_sql_updateJoin($table,$set,$event){
	return mysql_query("UPDATE ".$table." SET " .$set. " WHERE ".$event);
}


	function my_sql_insert($table,$set){
			return mysql_query("INSERT INTO ".$table." SET ".$set);
	}
	function my_sql_insert_New($table,$field,$value){
		return mysql_query("INSERT INTO ".$table." ( ".$field." )VALUES( ".$value. ") ");
}
	function my_sql_delete($table,$event){
		if($event != NULL){
			return mysql_query("DELETE FROM ".$table." WHERE ".$event);
		}else{
			return mysql_query("DELETE FROM ".$table);
		}
	}
	function my_sql_string($string){
		return mysql_query($string);
	}
	function my_sql_set_utf8(){
		$cs1 = "SET character_set_results=utf8";
		mysql_query($cs1) or die('Error query: ' . mysql_error());
		$cs2 = "SET character_set_client = utf8";
		mysql_query($cs2) or die('Error query: ' . mysql_error());
		$cs3 = "SET character_set_connection = utf8";
		mysql_query($cs3) or die('Error query: ' . mysql_error());

		mysql_query("SET NAMES utf8");
		mysql_query("SET CHARACTER SET utf8");
		mysql_query("SET collation_connection='utf8_unicode_ci'");
		mysql_query("SET character_set_results=utf8");
		mysql_query("SET character_set_client='utf8'");
		mysql_query("SET character_set_connection='utf8'");
		mysql_query("collation_connection = utf8_unicode_ci");
		mysql_query("collation_database = utf8_unicode_ci");
		mysql_query("collation_server = utf8_unicode_ci");
	}
	function my_sql_set_tis620(){
		$cs1 = "SET character_set_results=tis620";
		mysql_query($cs1) or die('Error query: ' . mysql_error());
		$cs2 = "SET character_set_client = tis620";
		mysql_query($cs2) or die('Error query: ' . mysql_error());
		$cs3 = "SET character_set_connection = tis620";
		mysql_query($cs3) or die('Error query: ' . mysql_error());

		mysql_query("SET NAMES tis620");
		mysql_query("SET CHARACTER SET tis620");
		mysql_query("SET collation_connection='tis620_thai_ci'");
		mysql_query("SET character_set_results=tis620");
		mysql_query("SET character_set_client='tis620'");
		mysql_query("SET character_set_connection='tis620'");
		mysql_query("collation_connection = tis620_thai_ci");
		mysql_query("collation_database = tis620_thai_ci");
		mysql_query("collation_server = tis620_thai_ci");
	}
	function my_sql_close(){
		return mysql_close();
	}
	function convertjson(){
		$objQuery=mysql_query("SELECT * FROM type");
		$rows = array();
		while($objShow=mysql_fetch_object($objQuery)) {
			$rows[] = $r;
		}
		return json_encode($rows);
	}
}
?>
