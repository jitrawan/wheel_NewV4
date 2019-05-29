<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-search fa-fw"></i> ค้นหาสินค้า</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">ค้นหาสินค้า</li>
</ol>
<?php

if(isset($_POST['save_new_status'])){
	$getdata->my_sql_update("card_info","card_status='".htmlentities($_POST['card_status'])."'","card_key='".htmlentities($_POST['card_key'])."'");
	$cstatus_key=md5(htmlentities($_POST['card_status']).time("now"));
	$getdata->my_sql_insert("card_status","cstatus_key='".$cstatus_key."',card_key='".htmlentities($_POST['card_key'])."',card_status='".htmlentities($_POST['card_status'])."',card_status_note='".htmlentities($_POST['card_status_note'])."',user_key='".$userdata->user_key."'");
	$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>บันทึกข้อมูลสถานะ สำเร็จ</div>';
}
?>


   <?php
   echo @$alert;?>

 <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-search"></i></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <form class="navbar-form navbar-left" role="search" method="get">
        <div class="form-group">
        <input type="hidden" name="p" id="p" value="productInshelf" >
        <input type="text" class="form-control" name="q" placeholder="รหัสสินค้า เพื่อค้นหา" value="<?php echo @htmlentities($_GET['q']);?>" size="100">
        </div>
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> <?php echo @LA_BTN_SEARCH;?></button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<nav class="navbar navbar-default" role="navigation">
  <div class="row">
      <div class="col-xs-2" style="padding-top: 15px; padding-left: 20px;">
        <a id="addsearch" name="addsearch" style="cursor: pointer">  <i class="fa fa-search fa-fw"></i> ค้นหาเพิ่มเติม</a>
     </div>
  </div>

  <div id="searchOther" name="searchOther" style="display: none">
 <form method="post" enctype="multipart/form-data" name="frmSearch" id="frmSearch">
   <div style="margin: 10px;">
     <div class="form-group row">
         <div class="col-md-6">
           <div class="radio">
             <label ><b>ค้นหาจาก ประเภทสินค้า :    </b></label>
            <label style="font-size: 1em">
               <input type="radio" id="search_wheel" name="search_type" value="1" checked>
                <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                ล้อแม๊ก
            </label>
            <label style="font-size: 1em">
               <input type="radio" id="search_rubber" name="search_type" value="2">
                <span class="cr"><i class="cr-icon fa fa-circle"></i></span>
                ยาง
            </label>
          </div>
         </div>
     </div>
     <div class="form-group row">
       <div class="col-md-2">
       <label for="search_hand">มือ</label>
       <select name="search_hand" id="search_hand" class="form-control">
         <option value="" selected="selected">--เลือก--</option>
         <option value="1" >1</option>
          <option value="2" >2</option>
      </select>
     </div>
     </div>

     <!--ล้อ-->
<div id="search_detailwheel" name="search_detailwheel" style="padding: 5px; border: 0px solid #4CAF50;">
   <div class="form-group row">
     <div class="col-md-2">
     <label for="search_rim">ขอบ(Inch)</label>
     <select name="search_diameterWheel" id="search_diameterWheel" class="form-control">
       <option value="" selected="selected">--เลือก--</option>
       <? $getDiameterWhee = $getdata->my_sql_select(NULL,"DiameterWhee","status = '1' ORDER BY id ");
         while($showDiameterWhee = mysql_fetch_object($getDiameterWhee)){?>
       <option value="<?= $showDiameterWhee->Description?>" ><?= $showDiameterWhee->Description?></option>
       <?}?>
     </select>
     </div>
       <div class="col-md-2">
       <label for="search_diameterWheel">ขนาด(Inch)</label>
       <select name="search_rim" id="search_rim" class="form-control">
           <option value="" selected="selected">--เลือก--</option>

       </select>

       </div>

       <div class="col-md-2">
       <label for="search_holeSize">รู</label>
         <select name="search_holeSize" id="search_holeSize" class="form-control">
           <option value="" selected="selected">--เลือก--</option>

         </select>
       </div>
       <div class="col-md-3">
       <label for="search_typeFormat">ประเภท</label>
         <select name="search_typeFormat" id="search_typeFormat" class="form-control">
           <option value="" selected="selected">--เลือก--</option>
           <? $getTypeFormatWheel = $getdata->my_sql_select(NULL,"TypeFormatWheel","status = '1' ORDER BY id ");
               while($showTypeFormatWheel = mysql_fetch_object($getTypeFormatWheel)){?>
             <option value="<?= $showTypeFormatWheel->Description?>" ><?= $showTypeFormatWheel->Description?></option>
             <?}?>
         </select>
       </div>
       <div class="col-md-3">
       <label for="search_holeSize">ยี่ห้อ</label>
         <select name="search_brand_Wheel" id="search_brand_Wheel" class="form-control">
             <option value="" selected="selected">--เลือก--</option>
               <? $getbranWheel = $getdata->my_sql_select(NULL,"BrandWhee","status = '1' ORDER BY id ");
                 while($showbrandWheel = mysql_fetch_object($getbranWheel)){?>
               <option value="<?= $showbrandWheel->id?>" ><?= $showbrandWheel->Description?></option>
               <?}?>
         </select>
       </div>
     </div>

     <div class="form-group row">
         <div class="col-md-2">
           <label for="search_offset">offset (mm.)</label>
           <select name="search_offset" id="search_offset" class="form-control">
             <option value="" selected="selected">--เลือก--</option>
             <? $getoffset = $getdata->my_sql_select("offset","productdetailwheel","offset != '' Group by offset ORDER BY offset ");
               while($showoffset = mysql_fetch_object($getoffset)){?>
             <option value="<?= $showoffset->offset?>" ><?= $showoffset->offset?></option>
             <?}?>
           </select>
         </div>
         <div class="col-md-9">
           <label for="search_offset">color : </label><br>
           <div class="checkbox">
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="black">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                Black
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="bronze">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                bronze
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="chrome">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                chrome
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="silver">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                silver
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="gray">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                gray
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="white">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                white
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="copper">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                copper
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="gold">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                gold
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" name="col[]" value="Blue">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                Blue
            </label>
            <label style="font-size: 1em">
                <input type="checkbox" value="col[]" name="other" id="other">
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                other
            </label>
        </div>
         </div>
      </div>
      <div class="form-group row">
         <div class="col-md-2">
           <label for="search_offset">รุ่น</label>
           <input type="text" name="search_gen_Wheel" id="search_gen_Wheel" class="form-control" value="" >

         </div>
         </div>
</div>
      <!--ยาง-->
<div id="search_detailrubber" name="search_detailrubber" style="padding: 5px; border: 0px solid #4CAF50;">
   <div class="form-group row">
     <div class="col-md-2">
     <label for="wisearch_widthdth">ความกว้าง(mm)</label>
       <select name="search_width" id="search_width" class="form-control">
         <option value="" selected="selected">--เลือก--</option>
         <? $getWidthRubble = $getdata->my_sql_select(NULL,"WidthRubble","status = '1' ORDER BY id ");
             while($showWidthRubble = mysql_fetch_object($getWidthRubble)){?>
           <option value="<?= $showWidthRubble->Description?>" ><?= $showWidthRubble->Description?></option>
           <?}?>
       </select>
     </div>
     <div class="col-md-3">
     <label for="search_series">ซี่รี่/แก้มยาง(%)</label>
     <select name="search_series" id="search_series" class="form-control">
         <option value="" selected="selected">--เลือก--</option>

       </select>
     </div>
     <div class="col-md-3">
             <label for="search_diameterRubber">ขนาด(Inch)</label>
               <select name="search_diameterRubber" id="search_diameterRubber" class="form-control">
                 <option value="" selected="selected">--เลือก--</option>

               </select>
               </div>
         <div class="col-md-4">
             <label for="search_brand">ยี่ห้อ</label>
               <select name="search_brand" id="search_brand" class="form-control">
                 <option value="" selected="selected">--เลือก--</option>
                 <? $getbrandRubble = $getdata->my_sql_select(NULL,"brandRubble","status = '1' ORDER BY id ");
                     while($showbrandRubble = mysql_fetch_object($getbrandRubble)){?>
                   <option value="<?= $showbrandRubble->Description?>" ><?= $showbrandRubble->Description?></option>
                   <?}?>
               </select>
             </div>
     </div>

     <div class="form-group row">
       <div class="col-md-2 pr-2">
         <label for="code">กลุ่มยาง</label>
         <select name="search_groudRubber" id="search_groudRubber" class="form-control">
            <option value="" selected="selected">--เลือก--</option>
            <option value="NO" >ไม่มี</option>
            <option value="H/T" >H/T</option>
            <option value="A/T" >A/T</option>
            <option value="M/T">M/T</option>
          </select>
      </div>
      <div class="col-md-1 ">
        <label for="code">สัปดาห์ที่ผลิต</label>
        <select name="search_productionWeek" id="search_productionWeek" class="form-control">
           <option value="" selected="selected">--เลือก--</option>
           <? for ($x = 1; $x <= 52; $x++) {?>
            <option value="<?= $x?>" ><?= $x?></option>
            <?}?>
         </select>
     </div>
     <div class="col-md-1 pl-2">
       <label for="code">ปีที่ผลิต</label>
       <input type="text" name="search_productionYear" id="search_productionYear" class="form-control" value="" >
    </div>
    <div class="col-md-2 pl-2">
      <label for="code">รุ่นยาง</label>
      <input type="text" name="search_genRubber" id="search_genRubber" class="form-control" value="" >
   </div>
   <div class="col-md-2 pl-2">
     <label for="code">ดัชนีความเร็ว</label>
     <select name="search_speedIndex" id="search_speedIndex" class="form-control cb" >
       <option value="" selected="selected">--เลือก--</option>
       <?
       $speed = array("J","K","L","M","N","O","P","Q","R","S","T","H","V","W","VR","ZR");
       $speedtext = array(" = 100"," = 110"," = 120"," = 130"," = 140"," = 150"," = 160"," = 170"," = 180"," = 190"," = 210"," = 240"," = 270"," = 300"," > 210"," > 240");
       $arrlength = count($speed);
       for ($s = 1; $s < $arrlength; $s++) {
       ?>
       <option value="<?= $speed[$s]?>"><?= $speed[$s]?> <?= $speedtext[$s]?></option>

       <? } ?>
     </select>
  </div>
  <div class="col-md-2 pl-2">
    <label for="code">ดัชนีรับน้ำหนัก</label>
    <select name="search_weightIndex" id="search_weightIndex" class="form-control cb">
       <option value="" selected="selected">--เลือก--</option>
       <? $i = 1;
       $cars = array("250", "275", "265", "272", "280", "290","300","307","315","325","335","345","355","365","375"
                    ,"387","400","412","425","237","450","462","475","487","500","515","530","545","560","580","600","615","630","650","670","690"
                    ,"710","730","750","775","800","825","850","875","900","925","950","975","1000","1030","1060","","1090","1120","1150","1180"
                    ,"1215","1250","1285","1320","1360");
       for ($z = 60; $z <= 119; $z++) {?>
        <option value="<?= $z?>" ><?= $z?> = <?= $cars[$i]?></option>
      <?
      $i++;
      }
      ?>
     </select>
 </div>
    </div>
</div>

     </div>
     <div style="text-align: center;margin-bottom: 10px;">

         <button type="submit" name="search_product" id="search_product" class="btn btn-default"><i class="fa fa-search"></i> ค้นหา</button>
     </div>

   </div>

   </form>
   </div>
</nav>
 <div class="table-responsive">

  <?php

   if(htmlentities($_GET['q']) != ""){
     $getproduct = $getdata->my_sql_select(" s.shelf_code , s.ProductID , sum(s.amt_rimit) amtt "
     ,"shelf_detail s
     left join product_N p on p.ProductID = (select pp.ProductID from product_N pp
                                        left join productDetailWheel ww on pp.ProductID = ww.ProductID
                      left join productDetailRubber rr on pp.ProductID = rr.ProductID
                                        where (rr.code = s.ProductID or ww.code = s.ProductID ) )
     left join productDetailWheel w on p.ProductID = w.ProductID
     left join productDetailRubber r on p.ProductID = r.ProductID"
     ,"(r.code LIKE '%".htmlentities($_GET['q'])."%' or w.code LIKE '%".htmlentities($_GET['q'])."%') GROUP by s.shelf_code, s.ProductID ORDER BY p.ProductID");
     /*$getproduct = $getdata->my_sql_selectJoin(" p.*, r.*, w.*, s.*,p.ProductID as productMain, d.dealer_name as dealer_name, d.mobile as mobile
     ,case
       when p.TypeID = '2'
       then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
       when p.TypeID = '1'
       then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
       end code "
      ,"product_N"
     ," productDetailWheel w on p.ProductID = w.ProductID
     left join productDetailRubber r on p.ProductID = r.ProductID
     left join shelf s ON p.shelf_id = s.shelf_id
     left join dealer d ON p.dealer_code = d.dealer_code "
     ,"Where (r.code LIKE '%".htmlentities($_GET['q'])."%' or w.code LIKE '%".htmlentities($_GET['q'])."%') ");*/

  }else{
    $str_sql = "";
   if(isset($_POST['search_product'])){
    if(addslashes($_POST['search_type']) == 1){
      if(addslashes($_POST['search_hand']) != ""){
        $str_sql  .= "And p.hand = '".addslashes($_POST['search_hand'])."' ";
     }
     if($_POST['search_diameterWheel'] != ""){
         $str_sql  .= " And w.diameter = '".$_POST['search_diameterWheel']."' ";
       }
       if($_POST['search_rim'] != ""){
         $str_sql  .= " And w.rim = '".$_POST['search_rim']."' ";
       }
       if(addslashes($_POST['search_holeSize']) != ""){
         $str_sql  .= " And w.holeSize = '".addslashes($_POST['search_holeSize'])."' ";
       }
       if(addslashes($_POST['search_typeFormat']) != ""){
         $str_sql  .= " And w.typeFormat = '".addslashes($_POST['search_typeFormat'])."' ";
       }
       if(addslashes($_POST['search_brand_Wheel']) != ""){
         $str_sql  .= " And w.brand = '".addslashes($_POST['search_brand_Wheel'])."' ";
       }
       if(addslashes($_POST['search_offset']) != ""){
         $str_sql  .= " And w.offset = '".addslashes($_POST['search_offset'])."' ";
       }
       if(addslashes($_POST['search_gen_Wheel']) != ""){
        $str_sql  .= " And w.gen = '".addslashes($_POST['search_gen_Wheel'])."' ";
      }
       $checkbox1 = $_POST['col'] ;
      for ($i=0; $i<sizeof ($checkbox1);$i++) {
        if($i == sizeof ($checkbox1) - 1){
           $str = "";
         }else{
           $str = " , ";
         }
         $strcol = $strcol.sprintf("'%s'", $checkbox1[$i]).$str;
       }

        if($strcol != ""){
         $str_sql  .= " And w.color in (".$strcol.") ";
        }

        $getproduct = $getdata->my_sql_select(" s.shelf_code , s.ProductID , sum(s.amt_rimit) amtt "
        ,"shelf_detail s
        left join product_N p on p.ProductID = (select pp.ProductID from product_N pp
                                           left join productDetailWheel ww on pp.ProductID = ww.ProductID
                         left join productDetailRubber rr on pp.ProductID = rr.ProductID
                                           where (rr.code = s.ProductID or ww.code = s.ProductID ) )
        left join productDetailWheel w on p.ProductID = w.ProductID
        left join productDetailRubber r on p.ProductID = r.ProductID
        "
        ,"p.TypeID = '1' ".$str_sql." GROUP by s.shelf_code, s.ProductID ORDER BY p.ProductID");
      /* $getproduct = $getdata->my_sql_selectJoin("p.*, r.*, w.*, s.*,p.ProductID as productMain, d.dealer_name as dealer_name, d.mobile as mobile
       ,case
         when p.TypeID = '2'
         then (select b.Description from brandRubble b where r.brand = b.id)
         when p.TypeID = '1'
         then (select b.Description from BrandWhee b where b.id = w.brand)
         end BrandName
         ,case
           when p.TypeID = '2'
           then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
           when p.TypeID = '1'
           then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
           end code
       ","product_N","productDetailWheel w on p.ProductID = w.ProductID
       left join productDetailRubber r on p.ProductID = r.ProductID
       left join shelf s ON p.shelf_id = s.shelf_id
       left join dealer d ON p.dealer_code = d.dealer_code "
       ," Where p.TypeID = '1' ".$str_sql);*/

     }else{
       if(addslashes($_POST['search_hand']) != ""){
         $str_sql  .= "And p.hand = '".addslashes($_POST['search_hand'])."' ";
      }
       if($_POST['search_diameterRubber'] != ""){
           $str_sql  .= " And r.diameter = '".$_POST['search_diameterRubber']."' ";
         }
         if($_POST['search_series'] != ""){
           $str_sql  .= " And r.series = '".$_POST['search_series']."' ";
         }
         if($_POST['search_width'] != ""){
           $str_sql  .= " And r.width = ".$_POST['search_width'];
         }
         if(addslashes($_POST['search_brand']) != ""){
           $str_sql  .= " And r.brand = '".addslashes($_POST['search_brand'])."' ";
         }

         $getproduct = $getdata->my_sql_select(" s.shelf_code , s.ProductID , sum(s.amt_rimit) amtt "
         ,"shelf_detail s
         left join product_N p on p.ProductID = (select pp.ProductID from product_N pp
                                            left join productDetailWheel ww on pp.ProductID = ww.ProductID
         									left join productDetailRubber rr on pp.ProductID = rr.ProductID
                                            where (rr.code = s.ProductID or ww.code = s.ProductID ) )
         left join productDetailWheel w on p.ProductID = w.ProductID
         left join productDetailRubber r on p.ProductID = r.ProductID
         "
         ,"p.TypeID = '2' ".$str_sql." GROUP by s.shelf_code, s.ProductID ORDER BY p.ProductID");
         /*
       $getproduct = $getdata->my_sql_selectJoin("p.*, r.*, w.*, s.*,p.ProductID as productMain, d.dealer_name as dealer_name, d.mobile as mobile ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
       ,case
         when p.TypeID = '2'
         then (select b.Description from brandRubble b where r.brand = b.id)
         when p.TypeID = '1'
         then (select b.Description from BrandWhee b where b.id = w.brand)
         end BrandName
         ,case
           when p.TypeID = '2'
           then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
           when p.TypeID = '1'
           then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
           end code
       ","product_N","productDetailWheel w on p.ProductID = w.ProductID
       left join productDetailRubber r on p.ProductID = r.ProductID
        left join shelf s ON p.shelf_id = s.shelf_id
        left join dealer d ON p.dealer_code = d.dealer_code "
        ,"Where p.TypeID = '2' ".$str_sql." ORDER BY p.ProductID ");
        */
     }
   }else{
    ?>
    <script>console.log('1')</script>
    <?
     $getproduct = $getdata->my_sql_select(" s.shelf_code , s.ProductID , sum(s.amt_rimit) amtt "
     ,"shelf_detail s
     left join product_N p on p.ProductID = (select pp.ProductID from product_N pp
                                        left join productDetailWheel ww on pp.ProductID = ww.ProductID
     									left join productDetailRubber rr on pp.ProductID = rr.ProductID
                                        where (rr.code = s.ProductID or ww.code = s.ProductID ) )
     left join productDetailWheel w on p.ProductID = w.ProductID
     left join productDetailRubber r on p.ProductID = r.ProductID
     GROUP by s.shelf_code, s.ProductID ORDER BY p.ProductID
     ",Null);

?>
<script>console.log('<?= mysql_num_rows($getproduct)?>')</script>
<?
   }
 }


     if(mysql_num_rows($getproduct) > 0){
       ?>
       <table width="100%" border="0" class="table table-bordered">
       <thead>
     <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
      <td width="10%">shelf</td>
       <td width="5%">รหัสสินค้า</td>
      <!--td width="26%">ผู้จำหน่าย</td-->
       <td width="40%">รายละเอียด</td>
       <td width="5%">คงเหลือ</td>
       <td width="5%">ราคาต้นทุน</td>
       <td width="5%">ราคาขาย</td>
     </tr>
     </thead>
       <tbody>
       <?
       while($showtt = mysql_fetch_object($getproduct)){

$showshelf = $getdata->my_sql_query("shelf_detail,shelf_class,shelf_header_code","shelf","shelf_code = '".$showtt->shelf_code."' ");

$showshelfheader = $getdata->my_sql_query(NULL,"shelf_header","shelf_header_code = '".$showshelf->shelf_header_code."' ");

$showproduct = $getdata->my_sql_query("p.*, r.*, w.* ,p.ProductID as ProductID, p.Quantity as Quantity,r.diameter as rubdiameter ,w.diameter as whediameter,w.gen as genWheel,r.diameter as rubberdiameter
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
  "," (r.code = '".$showtt->ProductID."' or w.code = '".$showtt->ProductID."' ) ");

         $x++;

         if($showproduct->TypeID == '1'){
           $gettype = "ล้อแม๊ก ".$showproduct->BrandName." รุ่น:".$showproduct->gen." ขอบ:".$showproduct->whediameter." รู:".$showproduct->holeSize." ประเภท:".$showproduct->typeFormat." <br>ยี่ห้อ:".$showproduct->BrandName." offset:".$showproduct->offset." สี: ".$showproduct->color." รุ่น: ".$showproduct->gen." เปอร์เซ็น ".$showproduct->persentwheel ;
         }else if($showproduct->TypeID == '2'){
           $gettype = "ยาง ".$showproduct->BrandName." ขนาด:".$showproduct->rubberdiameter." ซี่รี่:".$showproduct->series." ความกว้าง:".$showproduct->width." ยี่ห้อ:".$showproduct->BrandName." กลุ่มยาง: ".$showproduct->groudRubber
           ." <br>สัปดาห์: ".$showproduct->productionWeek." ปี: ".$showproduct->productionYear." รุ่น: ".$showproduct->genRubber." ดัชนีความเร็วค่าเป็น=: ".$showproduct->speedIndex." ดัชนีน้ำหนัก: ".$showproduct->weightIndex." เปอร์เซ็น ".$showproduct->persentrubber;
         }else{
           $gettype = "";
         }
if($gettype != ""){
       ?>
       <tr>
         <td >&nbsp;shelf &nbsp;<?php echo @$showshelfheader->shelf_header_detail;?>&nbsp; ชั้น &nbsp;<?php echo @$showshelf->shelf_class;?></td>
         <td align="center">  <?php echo @$showproduct->code;?></td>
         <!--td valign="middle"><strong><?php echo @$showproduct->dealer_code;?> | <?php echo @$showproduct->dealer_name;?> | <?php echo @$showproduct->mobile;?></strong></td-->
         <td valign="middle"><? echo $gettype?></td>
         <td align="right" valign="middle"><strong><?php echo @convertPoint2(@$showtt->amtt,'0');?></strong>&nbsp;</td>
         <td align="right" valign="middle"><strong><?php echo @convertPoint2(@$showproduct->PriceBuy,'2');?></strong>&nbsp;</td>
         <td align="right" valign="middle"><strong><?php echo @convertPoint2(@$showproduct->PriceSale,'2');?></strong>&nbsp;</td>
      </tr>
    <?
  }
 } ?>
     </tbody>
   </table>
       <?php
     }else{
       echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ไม่พบข้อมูล !</div>';
     } ?>


  </tbody>

</table>

</div>
<script language="javascript">

$(document).ready(function(){

    $("#addsearch").click(function(){
        $("#searchOther").toggle();
    });

$("#detailrubber").hide();
      $("#search_detailrubber").hide();

      $('input:radio[name="type"]').change(function() {
        if($(this).val() == 1){
          $("#detailwheel").show();
          $("#detailrubber").hide();
        }else{
          $("#detailwheel").hide();
          $("#detailrubber").show();
        }
      });

      $('input:radio[name="search_type"]').change(function() {
        if($(this).val() == 1){
          $("#search_detailwheel").show();
          $("#search_detailrubber").hide();
        }else{
          $("#search_detailwheel").hide();
          $("#search_detailrubber").show();
        }
      });

      $("#search_width").change(function() {
        $.ajax({
            type: "GET",
            url: "settings/json_Series.php",
            data: 'key=' + this.value,
            cache: false,
            success: function (data) {
                var JSONObject = JSON.parse(data);
                var $search_series = $("#search_series");
                $search_series.empty();
                $search_series.append("<option value='' selected='selected'>--เลือก--</option>");
                for(var i = 0; i < JSONObject.length; i++){
                $search_series.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
                }

            },
            error: function(err) {
                console.log(err);
            }
        });

        $.ajax({
            type: "GET",
            url: "settings/json_Diameter.php",
            data: 'key=' + this.value,
            cache: false,
            success: function (data) {
              var JSONObject = JSON.parse(data);
                var $search_diameterRubber = $("#search_diameterRubber");
                $search_diameterRubber.empty();
                $search_diameterRubber.append("<option value='' selected='selected'>--เลือก--</option>");
                for(var i = 0; i < JSONObject.length; i++){
                $search_diameterRubber.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
                }

            },
            error: function(err) {
                console.log(err);
            }
        });
      });

      $("#search_diameterWheel").change(function() {
        $.ajax({
            type: "GET",
            url: "settings/json_rim.php",
            data: 'key=' + this.value,
            cache: false,
            success: function (data) {
                var JSONObject = JSON.parse(data);
                var $search_rim = $("#search_rim");
                $search_rim.empty();
                $search_rim.append("<option value='' selected='selected'>--เลือก--</option>");
                for(var i = 0; i < JSONObject.length; i++){
                $search_rim.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
              }
            },
            error: function(err) {
                console.log(err);
            }
        });

        $.ajax({
            type: "GET",
            url: "settings/json_hoteSize.php",
            data: 'key=' + this.value,
            cache: false,
            success: function (data) {
              var JSONObject = JSON.parse(data);
                var $search_holeSize = $("#search_holeSize");
                $search_holeSize.empty();
                $search_holeSize.append("<option value='' selected='selected'>--เลือก--</option>");
                for(var i = 0; i < JSONObject.length; i++){
                $search_holeSize.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
                }

            },
            error: function(err) {
                console.log(err);
            }
        });
      });


});

$('#edit_status').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "card/edit_status.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })

function deleteCard(cardkey){
	if(confirm('คุณต้องการลบใบสั่งซ่อม/เคลมนี้ใช่หรือไม่ ?')){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(cardkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_card&key="+cardkey,true);
	xmlhttp.send();
	}
}
function hideCard(cardkey){
	if(confirm('คุณต้องการซ่อนใบสั่งซ่อม/เคลมนี้ใช่หรือไม่ ?')){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(cardkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=hide_card&key="+cardkey,true);
	xmlhttp.send();
	}
}
</script>
