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
$getitem = $getdata->my_sql_select(NULL,"shelf_detail","ProductID='".addslashes($_GET['key'])."' and amt_rimit >=  '".addslashes($_GET['amt'])."' ");

?>
                                         <div class="modal-body">
                                         <div class="form-group row">
                                         <div class="col-md-6">
											<input type="hidden" name="getamt" id="getamt" value="<?= addslashes($_GET['amt'])?>" class="form-control"  >
												<input type="hidden" name="getproid" id="getproid" value="<?= addslashes($_GET['key'])?>" class="form-control" >
												<input type="hidden" name="getreserveNo" id="getreserveNo" value="<?= addslashes($_GET['reserveNo'])?>" class="form-control"  >
											<label for="edit_ProductID">shelf </label>
											<select name="shelf_id" id="shelf_id" class="form-control"  onchange="showUser(this.value)" required>
													<option value="" selected="selected">--เลือกshelf--</option>
													<?
											$getheader = $getdata->my_sql_select("shelf_header_code,shelf_header_detail","shelf_header",null);
												while($showshelf = mysql_fetch_object($getheader)){
													?>
												<option value="<?php echo @$showshelf->shelf_header_code;?>"><?php echo @$showshelf->shelf_header_detail;?></option>
												<?
													}
												?>
												</select>
											</div>

											<div class="col-md-6">
											<label for="edit_ProductID">ชั้น </label>
											<select name="shelf_class" id="shelf_class" class="form-control"  required>
													<option value="" selected="selected">--เลือกชั้นวางสินค้า--</option>
											</select>
											</div>


                                        </div>
										<div class="form-group row">
                                         <div class="col-md-6">
										 <label for="mname">จำนวน (ชิ้น)</label>				
										<input type="number" name="total" id="total" onblur="setchekc_total(this.value)" class="form-control number" size="4" required>
											<input type="number" name="chekc_total" id="chekc_total" style="display:none;">
										</div>
										<div class="col-md-6">
												<label for="mname">จำนวน ที่รับ (ชิ้น)</label>
												<input type="number" name="gettotal" id="gettotal" class="form-control number" size="4" readonly>
										</div>

                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_shelf" id="save_shelf" onclick="test()" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>


	<script language="javascript">
	$( document ).ready(function() {
		var gettotal = 0;
		gettotal = '<?= addslashes($_GET['amt'])?>'
			$('#gettotal').val(gettotal);
	});
function setchekc_total(isvalue){
	if($('#shelf_class').val() == ""){
        alert("กรุณาเลือกชั้นวางก่อน !!");
        $('#total').val(0);
    }else{
		if(isvalue > $('#gettotal').val()){
			alert("กรุณากรุณาจำนวนให้ถูกต้อง !!");
			$('#total').val(0);
		}
	}
}

function showUser(str) {
  if (str=="") {
    document.getElementById("shelf_class").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("shelf_class").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","settings/jsoncutshelf.php?key="+str,true);
  xmlhttp.send();
}
	</script>
