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
$getctype_detail =$getdata->my_sql_query(NULL,"HoleSizeWhee","id='".addslashes($_GET['key'])."'");
?>

 <div class="modal-body">
 <div class="form-group">
                                            <label for="edit_shelf_detail">รายละเอียด</label>
                                            <input type="hidden" name="edit_shelf_id" id="edit_shelf_id" class="form-control" value="<?php echo @$getctype_detail->id;?>">
                                            <input type="text" name="edit_shelf_detail" id="edit_shelf_detail"
																						oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
																						maxlength="7"
																						class="form-control" value="<?php echo @$getctype_detail->Description;?>" autofocus>
                                          </div>

                                          <div class="form-group row">

                                              <!--label for="edit_ctype_color">แทบสี</label>
                                              <input type="text" name="edit_ctype_color" id="edit_ctype_color" class="form-control" value="<--?php echo @$getctype_detail->ctype_color;?>"-->
                                            </div></div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_card" id="save_edit_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
   <script>
	 $(document).ready(function(){
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
