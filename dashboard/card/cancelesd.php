<?php
session_start();
error_reporting(0);
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
  $getnow_reserve = $getdata->my_sql_query(NULL,"reserve_info","reserve_key = '".addslashes($_GET['key'])."' ");
?>

<div class="modal-body">
	<div class="form-group">
	 <label for="card_status">ยกเลิกใบเสร็จเลขที่ : <?echo @$getnow_reserve->reserve_code;?></label>
</div>
									<div class="form-group">
									 <label for="card_status">ผู้มีสิทธิ์ยกเลิก</label>
									 <input type="hidden" name="cancelesd_reserve_key" id="cancelesd_reserve_key" value="<?echo @$getnow_reserve->reserve_key;?>" class="form-control">
									 <input type="hidden" name="cancelesd_reserve_code" id="cancelesd_reserve_code" value="<?echo @$getnow_reserve->reserve_code;?>" class="form-control">
									 <input type="text" name="userCancelesd" id="userCancelesd" class="form-control" autofocus>
									</div>

										<div class="form-group">
                     <label for="card_status">รหัสผู้มีสิทธิ์ยกเลิก</label>
										 <input type="password" name="passCancelesd" id="passCancelesd" class="form-control">
                   </div>



 </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_cancelesd" id="save_cancelesd" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
