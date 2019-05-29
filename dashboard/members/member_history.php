<?php
$getmember_detail = $getdata->my_sql_query(NULL,"dealer","dealer_id='".addslashes($_GET['key'])."'");
?>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-list fa-fw"></i> <?php echo @LA_LB_DETAIL_PRODUCT;?></h1>
     </div>
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li><a href="?p=member"><?php echo @LA_LB_SUPPLIER;?></a></li>
  <li class="active"><?php echo @LA_LB_DETAIL_PRODUCT;?></li>
</ol>
<div class="panel panel-primary">
                        <div class="panel-heading">
                           <?php echo @LA_LB_SUPPLIER_DETAIL;?>
                        </div>
                        <div class="table-responsive">
                        <table width="100%" border="0" class="table">
  <tr>
    <td width="38%"><strong><?php echo @LA_LB_NAME_CHECKIN;?></strong></td>
    <td width="41%">&nbsp;<?php echo @$getmember_detail->dealer_name;?></td>

  </tr>
  <tr>
    <td><strong><?php echo @LA_LB_NO;?></strong></td>
    <td>&nbsp;<?php echo @$getmember_detail->dealer_code;?></td>
    </tr>
  <tr>
    <td><strong><?php echo @LA_LB_ADDRESS;?></strong></td>
    <td>&nbsp;<?php echo @$getmember_detail->address;?></td>
    </tr>
  <tr>
    <td><strong><?php echo @LA_LB_PHONE;?></strong></td>
    <td colspan="2">&nbsp;<?php echo @$getmember_detail->mobile;?></td>
  </tr>
  <tr>
    <td><strong><?php echo @LA_LB_EMAIL;?></strong></td>
    <td colspan="2">&nbsp;<?php echo @$getmember_detail->email;?></td>
  </tr>

</table>

                        </div>

</div>
 <div class="panel panel-green">
                        <div class="panel-heading">
                            <?php echo @LA_LB_HISTORY_CHECKIN_OF;?> <?php echo @$getmember_detail->member_name.'&nbsp;&nbsp;&nbsp;'.$getmember_detail->member_lastname;?>
                        </div>
                        <div class="table-responsive">
                            <table width="100%" border="0" class="table table-hover table-bordered">
                      <thead>
  <tr>
    <td width="3%" align="center" bgcolor="#CCCCCC"><strong>รหัสสินค้า</strong></td>
    <td width="32%" align="center" bgcolor="#CCCCCC"><strong>รายละเอียดสินค้า</strong></td>
    </tr>
  </thead>
  <tbody>
  <?php
  $i=0;
$getdelor = $getdata->my_sql_select(" ProductID,dealer_code "
," stock_tb_receive_master_sub "
," dealer_code ='".@$getmember_detail->dealer_code."'
GROUP by ProductID,dealer_code");


  while($showneed_checkin_today = mysql_fetch_object($getdelor)){

  $getneed = $getdata->my_sql_query("p.*, r.*, w.* ,p.ProductID as ProductID, p.Quantity as Quantity,r.diameter as rubdiameter ,w.diameter as whediameter,w.gen as genWheel
    ,case
      when p.TypeID = '2'
      then (select b.Description from brandRubble b where r.brand = b.id)
      when p.TypeID = '1'
      then (select b.Description from BrandWhee b where b.id = w.brand)
      end BrandName
      , case
      when p.TypeID = '2'
      then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
      when p.TypeID = '1'
      then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
      end code
      "," product_N p
      left join productdetailrubber r on p.ProductID = r.ProductID
      left join productdetailwheel w on p.ProductID = w.ProductID
      "," p.ProductID='".@$showneed_checkin_today->ProductID."' ");


    $i++;
    if($getneed->TypeID == '1'){
      $gettype = "ล้อแม๊ก ".$getneed->BrandName." รุ่น:".$getneed->gen." ขนาด:".$getneed->diameterWheel." ขอบ:".$getneed->whediameter." รู:".$getneed->holeSize." ประเภท:".$getneed->typeFormat." ยี่ห้อ:".$getneed->BrandName." offset:".$getneed->offset." สี: ".$getneed->color." รุ่น: ".$getneed->gen ;
    }else if($getneed->TypeID == '2'){
      $gettype = "ยาง ".$getneed->BrandName." ขนาด:".$getneed->diameterRubber." ขอบ:".$getneed->rubdiameter." ซี่รี่:".$getneed->series." ความกว้าง:".$getneed->width." ยี่ห้อ:".$getneed->BrandName." กลุ่มยาง: ".$getneed->groudRubber
      ." สัปดาห์: ".$getneed->productionWeek." ปี: ".$getneed->productionYear." รุ่น: ".$getneed->genRubber." ดัชนีความเร็ว: ".$getneed->speedIndex." ดัชนีน้ำหนัก: ".$getneed->weightIndex;
    }else{
      $gettype = "";
    }
  ?>
  <tr>
    <td align="center"><?php echo $getneed->code ?></td>
    <td align=""><strong><?php echo @$gettype;?></strong></td>
    </tr>

  <?php
  }
  ?>
  </tbody>
</table>
                        </div>
                        <!--div class="panel-footer">
                            <a href="members/print_member_history.php?key=<?php echo @$getmember_detail->member_key;?>&lang=en" class="btn btn-sm btn-warning" target="_blank" style="color:#FFF;"><i class="fa fa-print"></i> <?php echo @LA_BTN_PRINT_EN;?></a><a href="members/print_member_history.php?key=<?php echo @$getmember_detail->member_key;?>&lang=th" class="btn btn-sm btn-warning" target="_blank" style="color:#FFF;"><i class="fa fa-print"></i> <?php echo @LA_BTN_PRINT_TH;?></a>
                        </div-->
</div>
