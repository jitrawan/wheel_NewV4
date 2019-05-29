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
$getmember_detail = $getdata->my_sql_query(NULL,"dealer","dealer_id='".addslashes($_GET['key'])."'");
?>
 <div class="modal-body">
                                            <div class="form-group">
                                            <div class="row">

                                            <div class="col-md-6"> <label for="edit_dealer_code"><?php echo @LA_LB_CODE_COMPANY;?></label>
                                              <input type="text" name="edit_dealer_code" id="dealer_code" class="form-control" value="<?php echo @$getmember_detail->dealer_code;?>">
                                              <input type="hidden" name="edit_dealer_id" id="edit_dealer_id" value="<?php echo @$getmember_detail->dealer_id;?>">
                                            </div>
                                            <div class="col-md-6"><label for="edit_dealer_name"><?php echo @LA_LB_NAME_CHECKIN;?></label>
                                               <input type="text" name="edit_dealer_name" id="edit_dealer_name" class="form-control" value="<?php echo @$getmember_detail->dealer_name;?>"> </div>
                                            </div>
                                            </div>

                                             <div class="form-group">
                                               <label for="edit_address"><?php echo @LA_LB_ADDRESS;?></label>
                                               <textarea name="edit_address" id="edit_address" class="form-control"><?php echo @$getmember_detail->address;?></textarea>
                                            </div>

                                             <div class="form-group">
                                             <div class="row">
                                          <div class="col-md-6"><label for="edit_mobile"><?php echo @LA_LB_PHONE;?></label>
                                               <input type="text" name="edit_mobile" id="edit_mobile" class="form-control number" size="10" maxlen value="<?php echo @$getmember_detail->mobile;?>"></div>
                                            <div class="col-md-6"><label for="edit_email"><?php echo @LA_LB_EMAIL;?></label>
                                               <input type="text" name="edit_email" id="edit_email" class="form-control" value="<?php echo @$getmember_detail->email;?>"></div>
                                            </div>

                                            </div>

                                            <div class="form-group">
                                             <div class="row">
                                             <!--div class="col-md-6"><label for="edit_idline"><?php echo @LA_LB_IDLINE;?></label>
                                               <input type="text" name="edit_idline" id="edit_idline" class="form-control" value="<?php echo @$getmember_detail->idline;?>"></div-->
                                           </div>

                                            </div>


                        </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_member" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
<script language="javascript">
$( window ).load(function() {
  $(".number").bind('keyup mouseup', function () {
    if (/\D/g.test(this.value)){
           this.value = this.value.replace(/\D/g, '');
        }
						});
          });
 </script>
