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
																					   <input type="text" name="getamt" id="getamt" value="<?= addslashes($_GET['amt'])?>" class="form-control"  style="display:none;">
																						 <input type="text" name="getproid" id="getproid" value="<?= addslashes($_GET['key'])?>" class="form-control"  style="display:none;">
																						 <input type="text" name="getreserveNo" id="getreserveNo" value="<?= addslashes($_GET['reserveNo'])?>" class="form-control"  style="display:none;">
                                              <label for="edit_ProductID">shelf </label>
                                            <select name="shelf_id" id="shelf_id" class="form-control"  required>
																								<option value="" selected="selected">--เลือกชั้นวางสินค้า--</option>
																								<?
																							while($showshelf = mysql_fetch_object($getitem)){
																								$getshelf = $getdata->my_sql_query("s.*,s.shelf_code,(select sum(ss.amt_rimit) from shelf_detail ss where ss.shelf_code = s.shelf_code) as rimit ","shelf s","s.shelf_code ='".@$showshelf->shelf_code."' ");
																								?>
																							<option value="<?php echo @$showshelf->shelf_code;?>"><?php echo @$getshelf->shelf_detail;?> ชั้น <?php echo @$getshelf->shelf_class;?> เหลือ <?php echo $getshelf->rimit ?> ชิ้น</option>
																							<?
																							 }
																						 ?>
																							</select>
																						</div>


                                        </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_shelf" id="save_shelf" onclick="test()" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>


														<script language="javascript">
														function test(){
														/*	if($('#shelf_id').val() == ""){
																alert("กรุณาเลือกshelf !!");
															}else{
																$('#setshelf').val($('#shelf_id').val());
																$('#save_shelf').click();
															}*/

														}
														</script>
