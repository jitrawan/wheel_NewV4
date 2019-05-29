<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-plus-square fa-fw"></i> เพิ่มรายการรับสินค้า</h1>
     </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active">จัดการรายการรับสินค้า</li>
</ol>

 <?php
 if(isset($_POST['info_save'])){

	$getdata->my_sql_insert_New("stock_tb_receive_master"
  ," po,datedo,datereceive,iduser "
  ," '".addslashes($_POST['po'])."'
  , '".date("Y-m-d")."'
  , '".addslashes($_POST['datereceive'])."'
  , '".$_SESSION['uname']."' ");

 echo "<script>window.location=\"../dashboard/index.php?p=receiveaddstock&d=".addslashes($_POST['po'])."\"</script>";
	$_SESSION['lang'] = addslashes($_REQUEST['mlanguage']);
	 $alert = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>'.LA_ALERT_EDIT_DATA_INFO_DONE.'</div>';
 }


  $getmember_info = $getdata->my_sql_query(NULL,"user","user_key='".$_SESSION['ukey']."'");
 echo @$alert;
 ?>
 <style>
	body{
		<?php echo @$userdata->font_size_text;?>
	}
	</style>


                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="info_data">
                                <br/>
                                  <form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div class="panel panel-primary">
                        <div class="panel-heading">
                            วันที่ทำรายการ : <?= thaidate(date("Y-m-d"))?>
                        </div>
                        <div class="panel-body">
                           <div class="form-group row">
                             <div class="col-xs-2">
                               </div>
                             <div class="col-xs-6">
                                            <label for="po">เลขที่ PO อ้างอิง :</label>
                                            <input class="form-control" type="text" name="po" id="po" value="">
                              </div>
                           </div>

                           <div class="form-group row">
                             <div class="col-xs-2">
                               </div>
                             	   <div class="col-xs-4">
                             	     <label for="mname">วันที่รับวัสดุ :</label>
                                   <input type="text" name="datereceive" id="datereceive" value="<?= date("Y-m-d")?>" class="form-control form_datetime" readonly>
                             	   </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-xs-2">
                                </div>
                              	   <div class="col-xs-4">
                              	     <label for="mname">ผู้รับวัสดุ :</label>
                                    <input type="text" name="iduser" id="iduser" value="<?php echo $_SESSION['uname'];?>" class="form-control form_datetime" readonly>
                              	   </div>
                             </div>
                        </div>
                        <div class="panel-footer">
                          <button type="submit" name="info_save" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
                        </div>
  </div>
</form>
                                </div>


                            </div>
<script type="text/javascript">
    $(".form_datetime").datepicker({
      format: 'yyyy-mm-dd',
      todayHighlight: true
    }).on('changeDate', function(e){
    $(this).datepicker('hide');
});
</script>
