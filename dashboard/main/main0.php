<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-home fa-fw"></i> <?php echo @LA_MN_HOME;?></h1>
     </div>
</div>
<ol class="breadcrumb">
  <li class="active"><?php echo @LA_MN_HOME;?></li>
</ol>


   <div class="row">
                <!--div class="col-lg-3 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php @$getall = $getdata->my_sql_show_rows("card_info","card_status <> 'hidden'"); echo @number_format($getall);?></div>
                                    <div>ใบสั่งซ่อม/เคลมทั้งหมด</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div-->
                <!--div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php @$gettoday = $getdata->my_sql_show_rows("card_info","card_status <> 'hidden' AND (card_insert LIKE '%".date("Y-m-d")."%')"); echo @number_format($gettoday);?></div>
                                    <div>ใบสั่งซ่อม/เคลม วันนี้</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div-->
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            รายการสินค้าต่ำกว่า 10 อันดับล่าสุด
                        </div>


                     <div class="table-responsive">
  	<table width="100%" border="0" class="table table-bordered">
    <thead>
  <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
    <td width="18%">รหัส</td>
    <td width="47%">สินค้า</td>
     <td width="35%">คงเหลือ</td>
    </tr>
  </thead>
  <tbody>
  <?php
  $getcard = $getdata->my_sql_selectJoin("p.*,r.*,w.*,p.ProductID as productMain ","product_N","productDetailWheel w on p.ProductID = w.ProductID left join productDetailRubber r on p.ProductID = r.ProductID "," where p.ProductStatus in ('1') AND p.Quantity < 10  ORDER BY  p.ProductID LIMIT 10 ");


  while($showcard = mysql_fetch_object($getcard)){
  ?>
  <tr style="font-weight:bold;" id="<?php echo @$showcard->productMain;?>">
    <td align="center"><a href="?q=<?php echo @$showcard->productMain;?>&p=productInshelf"><?php echo @$showcard->productMain;?></a></td>

    <td><?if(@$showcard->TypeID == '1'){ echo 'ล้อแม็ก';}else{echo 'ยาง';}?></td>
     <td align="right">&nbsp;<?php echo @convertPoint2($showcard->Quantity,'0');?>&nbsp;</td>
    </tr>
  <?php
  }
  ?>
  </tbody>

</table>

</div>
</div>
                </div>

            </div>
