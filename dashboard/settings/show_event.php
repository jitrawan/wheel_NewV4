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
?>

<div class="table-responsive">
<table id="" class="" cellspacing="0" style="width:100%">
  <tr style="font-weight:bold; color:#FFF; text-align:center;">
		<th width="7%" bgcolor="#5fb760">Code</th>
		<th width="25%" bgcolor="#5fb760">Name</th>
		<th width="10%" bgcolor="#5fb760">วันเริ่ม</th>
		<th width="10%" bgcolor="#5fb760">วันหมดอายุ</th>
		<th width="5%" bgcolor="#5fb760">สถานะ</th>
    </tr>
<tbody>
	<?
$getEvetnInfo = $getdata->my_sql_select(NULL,"Event_Info","Event_Status = '1' and (CURDATE() >= DATE(eff_date) and CURDATE() <= DATE(exp_date)) ");
	while($showitem = mysql_fetch_object($getEvetnInfo)){
	?>
	<tr id="<?php echo @$showitem->id;?>">
		<td class="center"><a style="cursor: pointer;" onclick="selectproducid('<?php echo @$showitem->Event_Code;?>')"><?php echo @$showitem->Event_Code;?></a></td>
		<td class="left"><?php echo @$showitem->Event_Name;?></td>
		<td class="left"><?php echo @$showitem->eff_date;?></td>
		<td class="left"><?php echo @$showitem->exp_date;?></td>
		<td class="center">เปิดใช้งาน</td>

	</tr>
	<?}?>
</tbody>
</table>
<input class="form-control" type="hidden" name="setProductIDEvetn" id="setProductIDEvetn">
<input class="form-control" type="hidden" name="setreserve_key" id="setreserve_key" value="<?= addslashes($_GET['key'])?>">

<button type="submit" name="save_itemEvent"  style="display:none;" id="save_itemEvent" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
</div>
          <script language="javascript">
          $( document ).ready(function() {


						});

						function selectproducid(prokey){
									$('#setProductIDEvetn').val(prokey);
									$('#save_itemEvent').click();
						}

          </script>
