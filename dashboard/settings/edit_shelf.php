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
$getctype_detail =$getdata->my_sql_query(NULL,"shelf","shelf_id='".addslashes($_GET['key'])."'");
?>

<script>
    $(function() {
        $('#edit_shelf_color').colorpicker();
    });
</script>
 <div class="modal-body">
	 <div class="form-group row">
		 <div class="col-md-6">
			 <label for="edit_shelf_detail">shelf สินค้า</label>
			 <input type="hidden" name="edit_shelf_id" id="edit_shelf_id" class="form-control" value="<?php echo @$getctype_detail->shelf_id;?>">
			 <input type="text" name="edit_shelf_detail" id="edit_shelf_detail" class="form-control" value="<?php echo @$getctype_detail->shelf_detail;?>" autofocus required readonly>
		 </div>
		 <div class="col-md-6">
			 <label for="edit_shelf_detail">ชั้น สินค้า</label>
			 <input type="number" name="edit_shelf_class" id="edit_shelf_class" class="form-control number" value="<?php echo @$getctype_detail->shelf_class;?>" required readonly>
		 </div>
	 </div>

                                          <div class="form-group row">
                                            <div class="col-md-6">
											<label for="shelf_status">บรรจุ</label>
                                              <input type="number" name="edit_shelf_amt" id="edit_shelf_amt" value="<?php echo @$getctype_detail->amt;?>" class="form-control number" require >
                                              <!--label for="edit_shelf_color">แทบสี</label>
                                              <input type="text" name="edit_shelf_color" id="edit_shelf_color" class="form-control cp1" autocomplete="off" value="<?php echo @$getctype_detail->shelf_color;?>"-->
                                            </div>
 <div class="form-group">

                                              <!--label for="edit_ctype_color">แทบสี</label>
                                              <input type="text" name="edit_ctype_color" id="edit_ctype_color" class="form-control" value="<--?php echo @$getctype_detail->ctype_color;?>"-->
                                            </div></div>
                                         <div class="modal-footer">
                                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_card" id="save_edit_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
<script language="javascript">
 $(document).ready(function(){

   $(".number").bind('keyup mouseup', function () {
 								if($(this).val() < 0) {
 									alert("กรุณากรอกตัวเลขให้ถูกต้อง ! ");
 									$(this).val(0);
 								}
 						});

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
