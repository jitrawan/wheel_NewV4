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
$getctype_detail =$getdata->my_sql_query(NULL,"DiameterRubble","id='".addslashes($_GET['key'])."'");
?>

 <div class="modal-body">
 <div class="form-group">
                                            <label for="edit_shelf_detail">รายละเอียด</label>
                                            <input type="hidden" name="edit_shelf_id" id="edit_shelf_id" class="form-control" value="<?php echo @$getctype_detail->id;?>">
                                            <input type="number" name="edit_shelf_detail" id="edit_shelf_detail"
																						oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
																						maxlength="2"
																						class="form-control" value="<?php echo @$getctype_detail->Description;?>" autofocus>
                                          </div>
																					<!--div class="form-group row">
																						<div class="col-md-6">
																								<label for="edit_shelf_WidthRubble">ความกว้าง</label>
																								<select name="edit_shelf_WidthRubble" id="edit_shelf_WidthRubble" class="form-control">
																									<option value="" selected="selected">--เลือก--</option>
																									<? $getWidtRubble = $getdata->my_sql_select(NULL,"WidthRubble","status = '1' ORDER BY id ");
																										while($showWidtRubble = mysql_fetch_object($getWidtRubble)){?>
																									<option value="<?= $showWidtRubble->id?>" ><?= $showWidtRubble->Description?></option>
																									<?}?>
																							 </select>
																						</div>
																						</div>
																						<div class="form-group row">
                                              <div class="col-md-6">
                                                  <label for="edit_shelf_SeriesRubbleRubble">ซี่รี่</label>
                                                  <select name="edit_shelf_SeriesRubbleRubble" id="edit_shelf_SeriesRubbleRubble" class="form-control">
                                                    <option value="" selected="selected">--เลือก--</option>
                                                    <? $getSeriesRubble = $getdata->my_sql_select(NULL,"SeriesRubble","status = '1' ORDER BY Description ");
                                                      while($showSeriesRubble = mysql_fetch_object($getSeriesRubble)){?>
                                                    <option value="<?= $showSeriesRubble->id?>" ><?= $showSeriesRubble->Description?></option>
                                                    <?}?>
                                                 </select>
                                                </div>
                                              </div-->
                                          </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_card" id="save_edit_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
   <script>
	 $(document).ready(function(){
		$("#edit_shelf_WidthRubble").val('<?echo @$getctype_detail->WidthRubble;?>');
	 	$("#edit_shelf_SeriesRubbleRubble").val('<?echo @$getctype_detail->SeriesRubble;?>');
 			$('#save_edit_card').click(function(){
 					var r = confirm("ต้องการแก้ไขข้อมูล ?");
 					if (r == true) {
 						return true;
 					}else{
 						return false;
 					}
 				});
 			});
</script>
