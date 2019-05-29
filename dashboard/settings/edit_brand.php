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
$getctype_detail =$getdata->my_sql_query(NULL,"brand","BrandID='".addslashes($_GET['key'])."'");
?>

<script>
    $(function() {
        $('#edit_ctype_color').colorpicker();
        $('#edit_TypeID').val('<?php echo @$getctype_detail->TypeID ?>');
    });
</script>
 <div class="modal-body">
          <div class="form-group">
          <label for="edit_BrandName">ชื่อยี่ห้อสินค้า</label>
          <input type="text" name="edit_BrandName" id="edit_BrandName" class="form-control" value="<?php echo @$getctype_detail->BrandName;?>" autofocus>
          <input type="hidden" name="edit_BrandID" id="edit_BrandID" value="<?php echo @addslashes($_GET['key']);?>">
  </div>
 <div class="form-group">

                                              <label for="edit_TypeID">ประเภทสินค้า</label>
                                              <select name="edit_TypeID" id="edit_TypeID" class="form-control">
                                              <option value="" selected="selected">--เลือกประเภทสินค้า--</option>
                                              <?
                                              $getselecttype = $getdata->my_sql_select("TypeID,TypeName","type",NULL);
                                              while($showtype = mysql_fetch_object($getselecttype)){
                                              ?>
                                                <option value="<?php echo @$showtype->TypeID;?>" ><?php echo @$showtype->TypeName;?></option>
                                                <? } ?>
                                              </select>
                                            </div></div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_card" id="save_edit_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>

<script language="javascript">
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
