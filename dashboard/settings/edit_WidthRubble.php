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
$getctype_detail =$getdata->my_sql_query(NULL,"WidthRubble","id='".addslashes($_GET['key'])."'");
?>

 <div class="modal-body">
 <div class="form-group">
                                            <input type="hidden" name="edit_shelf_id" id="edit_shelf_id" class="form-control" value="<?php echo @$getctype_detail->id;?>">

                                          </div>

																					<div class="form-group row">
																						<div class="col-md-6">
																								<label for="edit_shelf_detail">รายละเอียด</label>
																								<input type="number" name="edit_shelf_detail" id="edit_shelf_detail"
																								oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
																								maxlength="3"
																								class="form-control" value="<?php echo @$getctype_detail->Description;?>" autofocus>
                                              </div>
                                            </div>
																							<!--div class="form-group row">
																								<div class="col-md-6">
																										<label for="edit_shelf_detail">ขนาด</label>
																										<select name="edit_shelf_DiameterRubble" id="edit_shelf_DiameterRubble" class="form-control">
																											<option value="" selected="selected">--เลือก--</option>
																											<? $getDiameterRubble = $getdata->my_sql_select(NULL,"DiameterRubble","status = '1' ORDER BY Description ");
																												while($showDiameterRubble = mysql_fetch_object($getDiameterRubble)){?>
																											<option value="<?= $showDiameterRubble->id?>" ><?= $showDiameterRubble->Description?></option>
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
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_card" id="save_edit_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
   <script>
    $(function() {
			$("#edit_shelf_DiameterRubble").val('<?echo @$getctype_detail->DiameterRubble;?>');
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
