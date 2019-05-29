<style>
#custom-search-input{
    padding: 3px;
    border: solid 1px #E4E4E4;
    border-radius: 6px;
    background-color: #fff;
}

#custom-search-input input{
    border: 0;
    box-shadow: none;
}

#custom-search-input button{
    margin: 2px 0 0 0;
    background: none;
    box-shadow: none;
    border: 0;
    color: #666666;
    padding: 0 8px 0 10px;
    border-left: solid 1px #ccc;
}

#custom-search-input button:hover{
    border: 0;
    box-shadow: none;
    border-left: solid 1px #ccc;
}

#custom-search-input .glyphicon-search{
    font-size: 23px;
}
</style>
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

 $checkproduct = $getdata->my_sql_select(NULL,"stock_tb_receive_master_sub","po = '".addslashes($_POST['po'])."' and ProductID='".addslashes($_POST['ProductID'])."' ");

if(mysql_num_rows($checkproduct) < 1){
  $getdata->my_sql_insert_New("stock_tb_receive_master_sub"
  ," po,ProductID,total "
  ," '".addslashes($_POST['po'])."'
  , '".addslashes($_POST['ProductID'])."'
  , '".addslashes($_POST['total'])."' ");

   $_SESSION['lang'] = addslashes($_REQUEST['mlanguage']);
	 $alert = '<div class="alert alert-block alert-success fade in"><button data-dismiss="alert" class="close" type="button">×</button>เพิ่มรายการสำเร็จ</div>';
 }else{
   $alert = '<div class="alert alert-danger alert-dismissable"><button data-dismiss="alert" class="close" type="button">×</button>ข้อมูลซ้ำ !</div>';
 }
}
if(isset($_POST['btn_delete'])){
  $getdata->my_sql_delete("stock_tb_receive_master_sub","no='".addslashes($_GET['key'])."'");
}

$getpo = $getdata->my_sql_query(NULL,"stock_tb_receive_master","po='".$_GET['d']."'");
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

                      <div class="panel panel-primary">

                        <div class="panel-heading">
                            วันที่ทำรายการ : <?= @$getpo->datedo?>
                        </div>
                        <div class="panel-body">

                          <div class="form-group row">

                          <div class="col-xs-4">
                               <label>เลขที่ PO อ้างอิง : </label> <label> &nbsp;<?php echo @$getpo->po;?> </label>
                          </div>
                          <div class="col-xs-4">
                           <label>วันที่รับวัสดุ : </label> <label> &nbsp;<?php echo @$getpo->datereceive;?> </label>
                         </div>
                          <div class="col-xs-4">
                           <label>ผู้รับวัสดุ : </label> <label> &nbsp;<?php echo @$getpo->iduser;?> </label>
                          </div>

                          </div>

                          <hr>
                          <form class="" role="search" method="get">
                              <div class="row">
                                    <div class="col-md-4">
                                      <div id="custom-search-input">
                                            <div class="input-group col-md-12">
                                               <input type="hidden" name="p" id="p" value="receiveaddstock" >
                                               <input type="hidden" name="d" id="d" value="<?= $_GET['d']?>" >
                                                <input type="text" class="form-control" name="q" placeholder="รหัสสินค้า เพื่อค้นหา" value="<?php echo @htmlentities($_GET['q']);?>" />
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-info btn-lg">
                                                        <i class="glyphicon glyphicon-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </form>

                            <br>
                            <?php

                             if(htmlentities($_GET['q']) != ""){
                                $getproduct = $getdata->my_sql_query(NULL," product_N "," ProductID = '".htmlentities($_GET['d'])."' ");

                          ?>
                          <form method="post" enctype="multipart/form-data" name="form1" id="form1">
                            <div class="form-group row">
                              <div class="col-xs-3">
                                <input type="hidden" name="po" id="po" value="<?php echo @$getpo->po;?>" >
                                <input type="hidden" name="ProductID" id="ProductID" value="<?php echo @$getproduct->ProductID;?>" >
                                 <label>รหัสสินค้า : </label> <label> &nbsp;<?php echo @$getproduct->ProductID;?> </label>
                            </div>
                            <div class="col-xs-4">
                             <label>ประเภทสินค้า : </label> <label> &nbsp;<?if(@$getproduct->TypeID == '1'){ echo 'ล้อแม็ก';}else{echo 'ยาง';}?> </label>
                           </div>
                         </div>

                          <div class="form-group row">
                              <div class="col-xs-3">
                                <label for="mname">จำนวน :</label>
                               <input type="number" name="total" id="total" class="form-control number" size="4">
                              </div>
                              <div class="col-xs-3">
                                <br>
                              <button type="submit" name="info_save" class="btn btn-primary"><i class="fa fa-plus-square"></i> เพิ่มรายการ</button>
                              </div>
                          </div>
                        </form>
                          <? } ?>
                          <hr>

                          <table width="50%" border="0" class="table-bordered">
                          <thead>
                        <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
                          <td width="12%">รหัสสินค้า</td>
                          <td width="15%">จำนวน</td>
                          <td width="10%">ปรับปรุง</td>
                        </tr>
                        </thead>
                          <tbody>
                          <?
                           $getproduct = $getdata->my_sql_select(NULL,"stock_tb_receive_master_sub","po='".$_GET['d']."'");
                           if(mysql_num_rows($getproduct) > 0){
                          while($showproduct = mysql_fetch_object($getproduct)){
                            ?>
                          <tr>
                            <td align="center"><?php echo @$showproduct->ProductID;?></td>
                            <td align="right" valign="middle"><strong><?php echo @$showproduct->total;?></strong>&nbsp;</td>
                            <td align="center"><button type="submit" name="btn_delete" onClick="javascript:deleteProduct('<?php echo @$showproduct->no;?>');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> <?php echo @LA_BTN_DELETE;?></button></td>

                         </tr>
                       <? }
                     }else{ ?>
                       <tr>
                         <td colspan="3">
                           <?
                        echo '<div class="alert alert-danger alert-dismissable">ไม่พบข้อมูล !</div>';
                          ?>
                        </td>
                      </tr>
                    <?  }?>
                        </tbody>
                      </table>


                        </div>

                      </div>
                                </div>


                            </div>
<script type="text/javascript">
$( document ).ready(function() {

$(".number").bind('keyup mouseup', function () {
								if($(this).val() < 0) {
									alert("กรุณากรอกตัวเลขให้ถูกต้อง ! "); 
									$(this).val(0);
								}       
						});
          });
    $(".form_datetime").datepicker({
      format: 'yyyy-mm-dd',
      todayHighlight: true
    }).on('changeDate', function(e){
    $(this).datepicker('hide');
});

function deleteProduct(cardkey){
  if(!confirm('คุณต้องรายการนี้ใช่หรือไม่ ?')){
    return;
	}else{
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
  	 	xmlhttp=new XMLHttpRequest();
  	}else{// code for IE6, IE5
    		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}

  	xmlhttp.onreadystatechange=function(){

      /*	if (xmlhttp.readyState==4 && xmlhttp.status==200){
  		document.getElementById(cardkey).innerHTML = '';
    }*/
  	}
  	xmlhttp.open("GET","function.php?type=delete_stock_tb_receive_master_sub&key="+cardkey,true);
  	xmlhttp.send();
  }
}

</script>
