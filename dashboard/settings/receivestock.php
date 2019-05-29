<?
$userdata = $getdata->my_sql_query(NULL,"user","user_key='".$_SESSION['ukey']."'");
?>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-plus-square fa-fw"></i> เพิ่มรายการรับสินค้า</h1>
     </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">จัดการรายการรับสินค้า</li>
</ol>

 <?php
 if(isset($_POST['info_save'])){
   $checkproduct = $getdata->my_sql_select(NULL,"stock_tb_receive_master","po = '".addslashes($_POST['po'])."' ");

  if(mysql_num_rows($checkproduct) < 1){

	$getdata->my_sql_insert_New("stock_tb_receive_master"
  ," po,datedo,datereceive,iduser,referpo,dealer_code "
  ," '".addslashes($_POST['po'])."'
  , '".date("Y-m-d")."'
  , '".date("Y-m-d")."'
  , '".addslashes($_POST['iduser'])."'
  , '".addslashes($_POST['referpo'])."'
  , '".addslashes($_POST['dealer_code'])."'  ");

 echo "<script>window.location=\"../dashboard/index.php?p=receiveaddstock&d=".addslashes($_POST['po'])."\"</script>";
	$_SESSION['lang'] = addslashes($_REQUEST['mlanguage']);
	 $alert = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>'.LA_ALERT_EDIT_DATA_INFO_DONE.'</div>';
 }else{
   $alert = '<div class="alert alert-danger alert-dismissable"><button data-dismiss="alert" class="close" type="button">×</button>ข้อมูลซ้ำ !</div>';
 }
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
                               <?php
                              // @$getcode = $getdata->getMaxID_N("po","stock_tb_receive_master","PO");
                                @$getcode = $getdata->genreserv("PO","stock_tb_receive_master","po",date("dmY"));
                               ?>
                             <div class="col-xs-3">
                                            <label for="po">เลขที่ใบรับสินค้า :</label>
                                            <input class="form-control" type="text" name="po" id="po" value="<?= @$getcode;?>" readonly>
                              </div>
                              <div class="col-xs-3">
                                             <label for="po">เลขที่ อ้างอิง :</label>
                                             <input class="form-control" type="text" name="referpo" id="referpo" value="" required>
                               </div>
                           </div>

                           <div class="form-group row">
                             <div class="col-xs-2">
                               </div>
                             <div class="col-xs-4">
                               <label for="mname">ผู้จำหน่าย</label>
                               <select name="dealer_code" id="dealer_code" class="form-control" required>
                                               <option value="" selected="selected">--เลือกผู้จำหน่าย--</option>
                                               <?
                                                $getdealer = $getdata->my_sql_select(NULL,"dealer",NULL);
                                               while($showdealer = mysql_fetch_object($getdealer)){?>
                                               <option value="<?php echo @$showdealer->dealer_code;?>" ><?php echo @$showdealer->dealer_name;?></option>
                                               <?
                                               }
                                             ?>
                               </select>

                             </div>

                            </div>
                            <div class="form-group row">
                              <div class="col-xs-2">
                                </div>
                                <div class="col-xs-2">
                                   <label for="mname">วันที่รับวัสดุ :</label>
                                  <input type="text" name="datereceive" id="datereceive" value="<?= date("d-m-Y")?>" class="form-control form_datetime" readonly>
                                 </div>
                              	   <div class="col-xs-3">
                              	     <label for="mname">ผู้รับวัสดุ :</label>
                                    <input type="text" name="iduser" id="iduser" value="<?php echo @$userdata->name."&nbsp;&nbsp;&nbsp;".$userdata->lastname;?>" class="form-control form_datetime" readonly>
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
