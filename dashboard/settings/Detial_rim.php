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

 <div class="modal-body">
	 <nav class="navbar navbar-default" role="navigation">
	   <div class="row">
	       <div class="col-xs-4" style="padding-top: 15px; padding-left: 20px;">
	         <a id="addsearch" name="addsearch" style="cursor: pointer">  <i class="fa fa-plus fa-fw"></i> เพิ่มข้อมูล</a>
	      </div>
	   </div>
<div style="margin: 10px;">
	   <div id="searchOther" name="searchOther" style="display: none">
			  <div class="form-group row">
					<div class="col-md-6">
							<input type="hidden" name="diaId" id="diaId" class="form-control" value="<?php echo @$_GET['key'];?>">
							<label for="detail_rim">ความกว้าง</label>
	            <select name="detail_rim" id="detail_rim" class="form-control">
	                <option value="" selected="selected">--เลือก--</option>
	                <? $getRimWheel = $getdata->my_sql_select(NULL,"RimWheel","status = '1' ORDER BY id ");
	                    while($showRimWheel = mysql_fetch_object($getRimWheel)){?>
	                  <option value="<?= $showRimWheel->id?>" ><?= $showRimWheel->Description?></option>
	                  <?}?>
	            </select>
						</div>
						</div>
						<button type="submit" name="save_Rim" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
			</div>
	    </div>


	 </nav>
	 <table width="70%" class="table table-striped table-bordered table-hover">
   <thead>
   <tr style="color:#FFF;">
     <th width="3%" bgcolor="#5fb760">#</th>
     <th width="20%" bgcolor="#5fb760">รหัส</th>
     <th width="34%" bgcolor="#5fb760">รายละเอียด</th>
		 <th width="10%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
   </tr>
   </thead>
   <tbody>
   <?php
   $x=0;
$getcat = $getdata->my_sql_select(" s.id as id, s.RimWheel as RimWheel"," DiameterWhee w
left join relationRim s on w.id = s.RimId "
," w.id = '".addslashes($_GET['key'])."' ");

   while($showcat = mysql_fetch_object($getcat)){
 	  $x++;
   ?>
   <tr id="<?php echo @$showcat->id;?>">
     <td align="center"><?php echo @$x;?></td>
     <td>&nbsp;<?php $getWidth =$getdata->my_sql_query(NULL,"RimWheel","id='".@$showcat->RimWheel."'"); echo $getWidth->code ?></td>
     <td>&nbsp;<?php $getWidth =$getdata->my_sql_query(NULL,"RimWheel","id='".@$showcat->RimWheel."'"); echo $getWidth->Description ?></td>
		 <td><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deletecat('<?php echo @$showcat->id;?>');"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button></td>
  </tr>
   <?php
   }
   ?>
   </tbody>
 </table>
                                        </div>
		<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>

		</div>
   <script>
$( document ).ready(function() {
	$("#addsearch").click(function(){
			$("#searchOther").toggle();
	});
	$("#edit_shelf_WidthRubble").val('<?echo @$getctype_detail->WidthRubble;?>');
	$("#edit_shelf_DiameterRubble").val('<?echo @$getctype_detail->DiameterRubble;?>');

	$('#save_edit_card').click(function(){
			var r = confirm("ต้องการแก้ไขข้อมูล ?");
			if (r == true) {
				return true;
			}else{
				return false;
			}
		});
});
function deletecat(catkey){
	var r = confirm("ต้องการลบข้อมูล ?");
	if (r == true) {
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(catkey).innerHTML = '';
			}
	}
	xmlhttp.open("GET","function.php?type=delete_detailRimwheel&key="+catkey,true);
	xmlhttp.send();
	}
}



</script>
