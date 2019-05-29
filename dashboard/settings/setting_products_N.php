
<style>
.fontawesome-select {
    font-family: 'FontAwesome', 'Helvetica';
}
</style>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa flaticon-bullet1 fa-fw"></i> <?php echo @LA_MN_PRODUCT;?></h1>
     </div>
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <!--li><a href="?p=setting"><--?php echo @LA_LB_SETTING;?></a></li-->
  <li class="active"><?php echo @LA_MN_PRODUCT;?></li>
</ol>
<?php
if(isset($_POST['save_product'])){

	if(addslashes($_POST['ProductID']) != NULL){
    $getproductID = $getdata->my_sql_select(NULL,"product_N","ProductID ='".addslashes($_POST['ProductID'])."' ");
    if(mysql_num_rows($getproductID) < 1){
        if($_POST['type'] == '1'){
            $getfont = $getdata->my_sql_selectJoin("p.*, r.*, w.* ,w.code as wcode, r.code as rcode ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
              end code "
            ,"product_N"
            ,"productDetailWheel w on p.ProductID = w.ProductID
            left join productdetailrubber r on p.ProductID = r.ProductID "
            ,"Where p.TypeID = '1'
             And p.hand = '".addslashes($_POST['hand'])."'
             And w.diameter = '".addslashes($_POST['diameterWheel'])."'
             And w.rim = '".addslashes($_POST['rim'])."'
             And w.holeSize = ".addslashes($_POST['holeSize'])."'
             And w.typeFormat = '".addslashes($_POST['typeFormat'])."'
             And w.brand = '".addslashes($_POST['brandWheel'])."'
             And w.color = '".addslashes($_POST['color'])."'
             And w.offset = '".addslashes($_POST['offset'])."'
             And w.gen = '".addslashes($_POST['genWheel'])."'
             And w.persentwheel = '".addslashes($_POST['persentwheel'])."' ");
        }else{
          $getfont = $getdata->my_sql_selectJoin("p.*, r.*, w.* ,w.code as wcode, r.code as rcode  ,w.diameter as diameterWheel ,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
            end code "
          ,"product_N"
          ,"productDetailWheel w on p.ProductID = w.ProductID
          left join productdetailrubber r on p.ProductID = r.ProductID "
          ,"Where p.TypeID = '2' And p.hand = '".addslashes($_POST['hand'])."'
          And r.diameter = '".addslashes($_POST['diameterRubber'])."'
          And r.series = '".addslashes($_POST['series'])."'
          And r.width = '".addslashes($_POST['width'])."'
          And r.brand = '".addslashes($_POST['brand'])."'
          And r.groudRubber = '".addslashes($_POST['groudRubber'])."'
          And r.productionWeek = '".addslashes($_POST['productionWeek'])."'
          And r.productionYear = '".addslashes($_POST['productionYear'])."'
          And r.genRubber = '".addslashes($_POST['genRubber'])."'
          And r.speedIndex = '".addslashes($_POST['speedIndex'])."'
          And r.weightIndex = '".addslashes($_POST['weightIndex'])."'
          And r.persentrubber = '".addslashes($_POST['persentrubber'])."' ");
        }
        if(mysql_num_rows($getfont) < 1){
            $getdata->my_sql_insert_New("product_N","ProductID
            , PriceSale, TypeID, ProductStatus, hand "
            ," '".addslashes($_POST['ProductID'])."'
            ,'".addslashes($_POST['PriceSale'])."'
            ,'".addslashes($_POST['type'])."'
            ,'".addslashes($_POST['pro_status'])."'
           , '".addslashes($_POST['hand'])."' ");

            if($_POST['type'] == '1'){
            $getdata->my_sql_insert_New("productDetailWheel","code, ProductID, diameter, rim, holeSize, typeFormat, brand, offset, color, gen, persentwheel "
            ," '".addslashes($_POST['code'])."'
            ,'".addslashes($_POST['ProductID'])."'
            , '".addslashes($_POST['diameterWheel'])."'
            , '".addslashes($_POST['rim'])."'
            , '".addslashes($_POST['holeSize'])."'
            , '".addslashes($_POST['typeFormat'])."'
            , '".addslashes($_POST['brandWheel'])."'
            , '".addslashes($_POST['offset'])."'
            , '".addslashes($_POST['color'])."'
            , '".addslashes($_POST['genWheel'])."'
            , '".addslashes($_POST['persentwheel'])."' ");
          }else if ($_POST['type'] == '2'){
              $getdata->my_sql_insert_New("productDetailRubber","code ,ProductID, width, series, diameter, brand , groudRubber, productionWeek, productionYear, genRubber, speedIndex, weightIndex, persentrubber "
              ,"  '".addslashes($_POST['coder'])."'
              ,'".addslashes($_POST['ProductID'])."'
              , '".addslashes($_POST['width'])."'
              , '".addslashes($_POST['series'])."'
              , '".addslashes($_POST['diameterRubber'])."'
              , '".addslashes($_POST['brand'])."'
              , '".addslashes($_POST['groudRubber'])."'
              , '".addslashes($_POST['productionWeek'])."'
              , '".addslashes($_POST['productionYear'])."'
              , '".addslashes($_POST['genRubber'])."'
              , '".addslashes($_POST['speedIndex'])."'
              , '".addslashes($_POST['weightIndex'])."'
              , '".addslashes($_POST['persentrubber'])."' ");
            }
            $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
          }else{
            $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
          }
}else{
  $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
}
  }else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
	}
}

if(isset($_POST['save_edit_item'])){
  if(addslashes($_POST['edit_ProductID']) != NULL){
    ?>
<script>
console.log('<?= $_POST['edit_genWheel']?>');
//console.log(<?= $_POST['gettype']?>+" :: "+'<?= addslashes($_POST['edit_hand'])?>'+" :: "+'<?= addslashes($_POST['edit_diameterWheel'])?>'+" :: "+ <?= addslashes($_POST['edit_rim'])?> +" :: "+ '<?= addslashes($_POST['edit_holeSize'])?>' +" :: "+'<?= addslashes($_POST['edit_typeFormat'])?>'+" :: "+'<?= addslashes($_POST['edit_brandWheel'])?>');
</script>
    <?
    if($_POST['gettype'] == '1'){
        $getfont = $getdata->my_sql_selectJoin("p.*, r.*, w.* ,w.code as wcode, r.code as rcode ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
          end code "
        ,"product_N "
        ,"productDetailWheel w on p.ProductID = w.ProductID
        left join productdetailrubber r on p.ProductID = r.ProductID "
        ,"Where p.TypeID = '1' And p.hand = '".addslashes($_POST['edit_hand'])."'
        And p.PriceSale = '".addslashes($_POST['edit_PriceSale'])."'
        And p.dealer_code = '".addslashes($_POST['edit_dealer_code'])."'
        And w.diameter = '".addslashes($_POST['edit_diameterWheel'])."'
         And w.rim = '".addslashes($_POST['edit_rim'])."'
         And w.holeSize = '".addslashes($_POST['edit_holeSize'])."'
         And w.typeFormat = '".addslashes($_POST['edit_typeFormat'])."'
         And w.brand = '".addslashes($_POST['edit_brandWheel'])."'
         And w.color = '".addslashes($_POST['edit_color'])."'
         And w.offset = '".addslashes($_POST['edit_offset'])."'
         And w.gen = '".addslashes($_POST['edit_genWheel'])."'
         And w.persentwheel = '".addslashes($_POST['edit_persentwheel'])."'  ");

    }else{
      $getfont = $getdata->my_sql_selectJoin("p.*, r.*, w.* ,w.code as wcode, r.code as rcode ,w.diameter as diameterWheel ,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
        end code "
      ,"product_N "
      ,"productDetailWheel w on p.ProductID = w.ProductID
      left join productdetailrubber r on p.ProductID = r.ProductID "
      ,"Where p.TypeID = '2' And p.hand = '".addslashes($_POST['edit_hand'])."'
      And p.PriceBuy = '".addslashes($_POST['edit_PriceBuy'])."'
      And p.dealer_code = '".addslashes($_POST['edit_dealer_code'])."'
      And r.diameter = '".addslashes($_POST['edit_diameterRubber'])."'
      And r.series = '".addslashes($_POST['edit_series'])."'
      And r.width = '".addslashes($_POST['edit_width'])."'
      And r.brand = '".addslashes($_POST['edit_brand'])."'
      And r.groudRubber = '".addslashes($_POST['edit_groudRubber'])."'
      And r.productionWeek = '".addslashes($_POST['edit_productionWeek'])."'
      And r.productionYear = '".addslashes($_POST['edit_productionYear'])."'
      And r.genRubber = '".addslashes($_POST['edit_genRubber'])."'
      And r.speedIndex = '".addslashes($_POST['edit_speedIndex'])."'
      And r.weightIndex = '".addslashes($_POST['edit_weightIndex'])."'
      And r.persentrubber = '".addslashes($_POST['edit_persentrubber'])."' ");


    }
    if(mysql_num_rows($getfont) < 1){
        $table = "product_N p ";
         $Strsql .= " , p.PriceSale= ".addslashes($_POST['edit_PriceSale'])." ";
        $Strsql .= " ,p.hand = '".addslashes($_POST['edit_hand'])."' ";
        if($_POST['gettype'] == '1'){
          $table .= " left join productDetailWheel w on p.ProductID = w.ProductID ";
          $Strsql .= " ,w.diameter = '".addslashes($_POST['edit_diameterWheel'])."' ,w.rim = '".addslashes($_POST['edit_rim'])."' ";
          $Strsql .= " ,w.holeSize = '".addslashes($_POST['edit_holeSize'])."' ,w.typeFormat = '".addslashes($_POST['edit_typeFormat'])."', w.brand =  '".addslashes($_POST['edit_brandWheel'])."' ";
          $Strsql .= " ,w.color = '".addslashes($_POST['edit_color'])."' ,w.offset = '".addslashes($_POST['edit_offset'])."', w.gen =  '".addslashes($_POST['edit_genWheel'])."' , w.persentwheel = '".addslashes($_POST['edit_persentwheel'])."' ";
        }else if($_POST['gettype'] == '2'){
          $table .= " left join productDetailRubber r on p.ProductID = r.ProductID ";
          $Strsql .= " ,r.width = '".addslashes($_POST['edit_width'])."' ,r.series = '".addslashes($_POST['edit_series'])."' ";
          $Strsql .= " ,r.diameter = '".addslashes($_POST['edit_diameterRubber'])."' ,r.brand = '".addslashes($_POST['edit_brand'])."' ";
          $Strsql .= " ,r.groudRubber = '".addslashes($_POST['edit_groudRubber'])."' ,r.productionWeek = '".addslashes($_POST['edit_productionWeek'])."' ";
          $Strsql .= " ,r.productionYear = '".addslashes($_POST['edit_productionYear'])."' ,r.genRubber = '".addslashes($_POST['edit_genRubber'])."' ";
          $Strsql .= " ,r.speedIndex = '".addslashes($_POST['edit_speedIndex'])."' ,r.weightIndex = '".addslashes($_POST['edit_weightIndex'])."' ,r.persentrubber = '".addslashes($_POST['edit_persentrubber'])."' ";
        }


	  $getdata->my_sql_updateJoin($table , $Strsql ," p.ProductID = '".addslashes($_POST['edit_ProductID'])."' ");

	$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_UPDATE_DATA_DONE.'</div>';
}else{
  $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
}
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
	}
}
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form2" id="form2">

     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">แก้ไขข้อมูลสินค้า</h4>
                </div>
                <div class="ct">

                </div>
            </div>
        </div>
  </form>
</div>

<div class="modal fade" id="model_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มรายการสินค้า</h4>
                                        </div>
                                        <?
                                                @$getMaxid = $getdata->getMaxID("ProductID","product_N","P");
                                                @$getMaxidR = $getdata->getMaxID("code","productdetailrubber","T");
                                                @$getMaxidW = $getdata->getMaxID("code","productdetailwheel","W");
                                                $getshelf = $getdata->my_sql_select(NULL,"shelf","shelf_status = '1'");
                                                $getdealer = $getdata->my_sql_select(NULL,"dealer",NULL);

                                        ?>
                                         <div class="modal-body">
                                        <div class="form-group row" style="display: none;">
                                            <div class="col-md-6">
                                              <label for="ProductID">รหัสสินค้า</label>
                                              <input type="text" name="ProductID" id="ProductID" value="<?php echo @$getMaxid;?>" class="form-control">
                                            </div>

                                         </div>

                                        <div class="form-group row">
                                          <div class="col-md-4">
                                          <label >ประเภทสินค้า :    </label>
                                          <input type="radio" id="wheel" name="type" value="1" checked>
                                          <label for="wheel">ล้อแม๊ก</label>
                                          </div>
                                          <div class="col-md-6">
                                          <input type="radio" id="rubber" name="type" value="2">
                                          <label for="rubber">ยาง</label>
                                          </div>
                                        </div>

                                        <!--ล้อ-->
                                        <div id="detailwheel" name="detailwheel" style="padding: 5px; border: 0px solid #4CAF50;">
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                               <label for="code">รหัส</label>
                                               <input type="text" name="code" id="code" class="form-control" value="<?= $getMaxidW?>" readonly>
                                            </div>
                                          </div>
                                        <div class="form-group row">
                                              <div class="col-md-2" style="padding-right: 2px;">
                                              <label for="diameterWheel">ขอบ(lnch)</label>
                                                <select name="diameterWheel" id="diameterWheel" class="form-control cw" required>
                                                  <option value="" selected="selected">--เลือก--</option>
                                                  <? $getDiameterWhee = $getdata->my_sql_select(NULL,"DiameterWhee","status = '1' ORDER BY id ");
                                                    while($showDiameterWhee = mysql_fetch_object($getDiameterWhee)){?>
                                                  <option value="<?= $showDiameterWhee->Description?>" ><?= $showDiameterWhee->Description?></option>
                                                  <?}?>
                                                </select>
                                              </div>
                                              <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                                              <label for="rim">ขนาด(lnch)</label>
                                              <select name="rim" id="rim" class="form-control cw" required>
                                                  <option value="" selected="selected">--เลือก--</option>

                                                </select>
                                              </div>
                                              <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                                              <label for="holeSize">รู</label>
                                               <select name="holeSize" id="holeSize" class="form-control cw" required>
                                                  <option value="" selected="selected">--เลือก--</option>

                                                </select>
                                              </div>
                                              <div class="col-md-3" style="padding-left: 2px; padding-right: 2px;">
                                              <label for="typeFormat">ประเภท</label>
                                               <select name="typeFormat" id="typeFormat" class="form-control cw" required>
                                                  <option value="" selected="selected">--เลือก--</option>
                                                  <? $getTypeFormatWheel = $getdata->my_sql_select(NULL,"TypeFormatWheel","status = '1' ORDER BY id ");
                                                    while($showTypeFormatWheel = mysql_fetch_object($getTypeFormatWheel)){?>
                                                  <option value="<?= $showTypeFormatWheel->Description?>" ><?= $showTypeFormatWheel->Description?></option>
                                                  <?}?>
                                                </select>
                                              </div>
                                              <div class="col-md-3" style="padding-left: 2px; padding-right: 2px;">
                                              <label for="brandWheel">ยี่ห้อ</label>
                                                <select name="brandWheel" id="brandWheel" class="form-control cw" required>
                                                  <option value="" selected="selected">--เลือก--</option>
                                                  <? $getbranWheel = $getdata->my_sql_select(NULL,"BrandWhee","status = '1' ORDER BY id ");
                                                     while($showbrandWheel = mysql_fetch_object($getbranWheel)){?>
                                                   <option value="<?= $showbrandWheel->id?>" ><?= $showbrandWheel->Description?></option>
                                                   <?}?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <div class="col-md-2 pr-2">
                                                <label for="genWheel">รุ่น</label>
                                                <input type="text" name="genWheel" id="genWheel" class="form-control cw" value="" required>
                                                </div>
                                                  <div class="col-md-2 pr-2">
                                                    <label for="brandWheel">offset(mm)</label>
                                                    <select name="offset" id="offset" class="form-control cw" required>
                                                      <option value="" selected="selected">--เลือก--</option>
                                                      <? $getoffset = $getdata->my_sql_select(NULL,"offset","Description IS NOT NULL order by Description ");
                                                         while($showoffset = mysql_fetch_object($getoffset)){?>
                                                       <option value="<?= $showoffset->Description?>" ><?= $showoffset->Description?></option>
                                                       <?}?>
                                                    </select>
                                                      <!--input type="text" name="offset" id="offset" class="form-control cw" value="-" required-->
                                                  </div>
                                                  <div class="col-md-3 pr-2 pl-2">
                                                    <label for="color">color</label>
                                                    <select name="color" id="color" class="form-control cw" >
                                                        <option value="" selected="selected">Other</option>
                                                        <option value="black">black</option> <option value="bronze">bronze</option> <option value="chrome">chrome</option> <option value="silver">silver</option>
                                                        <option value="gray">gray</option> <option value="white">white</option> <option value="copper">copper</option> <option value="gold">gold</option>
                                                        <option value="Midnight">Midnight</option> <option value="Blue">Blue</option>
                                                      </select>
                                                  </div>
                                            </div>

                                          </div>
                                         <!--ยาง-->
                                         <div id="detailrubber" name="detailrubber" style="padding: 5px; border: 0px solid #4CAF50;">
                                           <div class="form-group row">

                                              <div class="col-md-6">
                                                <label for="code">รหัส</label>
                                                <input type="text" name="coder" id="coder" class="form-control" value="<?= $getMaxidR?>" readonly>
                                             </div>

                                           </div>
                                         <div class="form-group row">
                                           <div class="col-md-2 pr-2">
                                           <label for="width">ความกว้าง(mm)</label>
                                             <select name="width" id="width" class="form-control cb" required>
                                               <option value="" selected="selected">--เลือก--</option>
                                               <? $getWidthRubble = $getdata->my_sql_select(NULL,"WidthRubble","status = '1' ORDER BY id ");
                                                  while($showWidthRubble = mysql_fetch_object($getWidthRubble)){?>
                                                <option value="<?= $showWidthRubble->Description?>" ><?= $showWidthRubble->Description?></option>
                                                <?}?>
                                             </select>
                                           </div>
                                              <div class="col-md-3 pr-2 pl-2">
                                              <label for="series">ซี่รี(%)</label>
                                              <select name="series" id="series" class="form-control cb" required>
                                                  <option value="" selected="selected">--เลือก--</option>

                                                </select>
                                              </div>
                                              <div class="col-md-3 pr-2 pl-2">
                                              <label for="diameterRubber">ขนาด(lnch)</label>
                                               <select name="diameterRubber" id="diameterRubber" class="form-control cb" required>
                                                  <option value="" selected="selected">--เลือก--</option>

                                                </select>
                                               </div>
                                              <div class="col-md-4 pr-2 pl-2">
                                              <label for="brand">ยี่ห้อ</label>
                                               <select name="brand" id="brand" class="form-control cb" required>
                                                  <option value="" selected="selected">--เลือก--</option>
                                                  <? $getbrandRubble = $getdata->my_sql_select(NULL,"brandRubble","status = '1' ORDER BY id ");
                                                     while($showbrandRubble = mysql_fetch_object($getbrandRubble)){?>
                                                   <option value="<?= $showbrandRubble->id?>" ><?= $showbrandRubble->Description?></option>
                                                   <?}?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="form-group row">
                                              <div class="col-md-4 pr-2">
                                                 <label for="code">กลุ่มยาง</label>
                                                 <select name="groudRubber" id="groudRubber" class="form-control cb" required>
                                                    <option value="" selected="selected">--เลือก--</option>
                                                    <option value="NO" >ไม่มี</option>
                                                    <option value="H/T" >H/T</option>
                                                    <option value="A/T" >A/T</option>
                                                    <option value="M/T">M/T</option>
                                                  </select>
                                              </div>
                                              <div class="col-md-3 pr-2 pl-2">
                                                <label for="code">สัปดาห์ที่ผลิต</label>
                                                <select name="productionWeek" id="productionWeek" class="form-control cb" required>
                                                   <option value="" selected="selected">--เลือก--</option>
                                                   <? for ($x = 1; $x <= 52; $x++) {?>
                                                    <option value="<?= $x?>" ><?= $x?></option>
                                                    <?}?>
                                                 </select>
                                             </div>
                                             <div class="col-md-2 pr-2 pl-2">
                                               <label for="code">ปีที่ผลิต(Ex.2019)</label>
                                               <input type="number" name="productionYear" id="productionYear"
                                               oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                               maxlength="4"
                                               class="form-control cb" value="" required>
                                            </div>
                                            <div class="col-md-3 pr-2 pl-2">
                                              <label for="code">รุ่นยาง</label>
                                              <input type="text" name="genRubber" id="genRubber" class="form-control cb" value="" required>
                                           </div>

                                            </div>
                                            <div class="form-group row">
                                              <div class="col-md-4 pr-2">
                                                 <label for="code">ดัชนีความเร็ว(Km/h)</label>
                                                  <select name="speedIndex" id="speedIndex" class="form-control cb" required>
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
                                              <div class="col-md-4 pr-2 pl-2">
                                                <label for="code">ดัชนีรับน้ำหนัก(Kg)</label>
                                                <select name="weightIndex" id="weightIndex" class="form-control cb" required>
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



                                           <div class="form-group row">
                                             <div class="col-md-3">
                                               <label for="hand">สืินค้ามือ</label>
                                              <select name="hand" id="hand" class="form-control" required>
                                                   <option value="1" selected="selected">1</option>
                                                   <option value="2">2</option>

                                                 </select>
                                             </div>
                                             <div id="div_persentrubber">
                                               <div class="col-md-3">
                                                 <label for="hand">เปอร์เซ็นยาง (%)</label>
                                                      <input type="number" name="persentrubber" id="persentrubber" class="form-control" onblur="checkpersenbubber(this.value)" value="">
                                               </div>

                                             </div>
                                             <div id="div_persentwheel">
                                               <div class="col-md-3">
                                                 <label for="hand">เปอร์เซ็นแม็ค (%)</label>
                                                      <input type="number" name="persentwheel" id="persentwheel" class="form-control" onblur="checkpersenwhell(this.value)" value="">
                                               </div>

                                             </div>
                                             <div class="col-md-4">
                                              <label for="PriceSale">ราคาขาย (บาท)</label>
                                              <input type="number"  name="PriceSale" id="PriceSale" class="form-control number" value="0" onblur="chkprice(this.value)" required style="text-align: right;">
                                            </div>

                                            <!--div class="col-md-6"-->
                                              <!--label for="shelf_id">shelf</label>
                                                <select name="shelf_id" id="shelf_id" class="form-control" required>
                                                  <option value="" selected="selected">--เลือกชั้นวางสินค้า--</option>
                                                  <?
                                                while($showshelf = mysql_fetch_object($getshelf)){?>
                                                <option value="<?php echo @$showshelf->shelf_id;?>"><?php echo @$showshelf->shelf_detail;?> ชั้น <?php echo @$showshelf->shelf_class;?></option>
                                                <?
                                                 }
                                               ?>
                                                </select-->
                                              <!--label for="dealer_code">ผู้จำหน่าย</label>
                                              <select name="dealer_code" id="dealer_code" class="form-control" required>
                                                <option value="" selected="selected">--เลือกผู้จำหน่าย--</option>
                                                <?
                                                while($showdealer = mysql_fetch_object($getdealer)){?>
                                                <option value="<?php echo @$showdealer->dealer_code;?>" ><?php echo @$showdealer->dealer_name;?></option>
                                                <?
                                                }
                                              ?>
                                            </select-->
                                            <!--/div-->
                                          </div>

                                        <div class="form-group row">

                                             <!--div class="col-md-4">
                                             <label for="PriceBuy">ราคาซื้อ (บาท)</label>
                                            <input type="number" name="PriceBuy" id="PriceBuy" class="form-control number" value="0" onblur="chkprice(this.value)" required style="text-align: right;">
                                             </div-->
                                             <!--div class="col-md-3">
                                               <label for="Quantity">คงเหลือ (ชิ้น)</label>
                                               <input type="number" name="Quantity" id="Quantity" class="form-control number" value="0" required style="text-align: right;">
                                             </div-->
                                          </div>

                                          <!--div class="form-group row">
                                            <div class="col-md-2">
                                              <label for="PriceSale">ลดราคา (%)</label>
                                              <input type="number"  name="discount" id="discount" class="form-control number" value="0"  style="text-align: right;">
                                            </div>
                                          </div-->


                                           <div class="form-group row">
                                            <div class="col-md-3">
                                              <label for="pro_status"><?php echo @LA_LB_STATUS;?></label>
                                              <select name="pro_status" id="pro_status" class="form-control">
                                                  <option value="1" selected="selected">เปิดใช้งาน</option>
                                                  <option value="0">ปิดใช้งาน</option>

                                                </select>
                                            </div>
                                            <div class="col-md-3">

                                            </div>
                                           </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> <?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_product" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
                                        </div>

                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
                            <!-- /.modal -->
  <?php
  echo @$alert;
  ?>

 <!--button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i><?php echo @LA_LB_ADD_NEW_CATEGORIES;?></button--><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#model_product"><i class="fa flaticon-bullet1 fa-fw"></i>เพิ่มรายการสินค้า</button>
 <br/><br/>

 <nav class="navbar navbar-default" role="navigation">
  <form method="post" enctype="multipart/form-data" name="frmSearch" id="frmSearch">
    <div style="margin: 10px;">
      <div class="form-group row">
          <div class="col-md-3">
            <label ><b>ค้นหาจาก ประเภทสินค้า :    </b></label>
            <input type="radio" id="search_wheel" name="search_type" value="1" checked>
            <label for="wheel">ล้อแม๊ก</label>
          </div>
          <div class="col-md-6">
            <input type="radio" id="search_rubber" name="search_type" value="2">
            <label for="rubber">ยาง</label>
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
            <label for="search_rim">รุ่น</label>
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
              <input type="text" name="search_groudRubber" id="search_groudRubber" class="form-control" value="" >
           </div>
           <div class="col-md-1 ">
             <label for="code">สัปดาห์ที่ผลิต</label>
             <input type="text" name="search_productionWeek" id="search_productionWeek" class="form-control" value="" >
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
          <input type="text" name="search_speedIndex" id="search_speedIndex" class="form-control" value="" >
       </div>
       <div class="col-md-2 pl-2">
         <label for="code">ดัชนีรับน้ำหนัก</label>
         <input type="text" name="search_weightIndex" id="search_weightIndex" class="form-control" value="" >
      </div>
         </div>
     </div>

      </div>
      <div style="text-align: center;margin-bottom: 10px;">

          <button type="submit" name="search_product" id="search_product" class="btn btn-default"><i class="fa fa-search"></i> ค้นหา</button>
      </div>

    </div>

    </form>
</nav>
 <div class="panel panel-default">
   <div class="table-responsive tooltipx">
  <!-- Table -->
  <?php
  $x=0;
  $str_sql = "";
  if(isset($_POST['search_product'])){
   if(addslashes($_POST['search_type']) == 1){
    if($_POST['search_diameterWheel'] != ""){
        $str_sql  .= " And w.diameter = '".$_POST['search_diameterWheel']."' ";
      }
      if($_POST['search_rim'] != ""){
        $str_sql  .= " And w.rim = '".$_POST['search_rim']."' ";
      }
      if($_POST['search_holeSize'] != ""){
        $str_sql  .= " And w.holeSize = ".$_POST['search_holeSize'];
      }
      if(addslashes($_POST['search_typeFormat']) != ""){
        $str_sql  .= " And w.typeFormat = '".addslashes($_POST['search_typeFormat'])."' ";
      }
      if(addslashes($_POST['search_brand_Wheel']) != ""){
        $str_sql  .= " And w.brand = '".addslashes($_POST['search_brand_Wheel'])."' ";
      }
      if(addslashes($_POST['search_gen_Wheel']) != ""){
        $str_sql  .= " And w.gen = '".addslashes($_POST['search_gen_Wheel'])."' ";
      }

      $getproduct = $getdata->my_sql_selectJoin("p.*, r.*, w.* ,w.code as wcode, r.code as rcode ,w.diameter as diameterWheel,w.gen as genWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
          end code "
        ,"product_N"
        ,"productDetailWheel w on p.ProductID = w.ProductID
        left join productdetailrubber r on p.ProductID = r.ProductID "
        ,"Where p.TypeID = '1' ".$str_sql);
    }else{
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

        if(addslashes($_POST['search_groudRubber']) != ""){
          $str_sql  .= " And r.groudRubber = '".addslashes($_POST['search_groudRubber'])."' ";
        }
        if(addslashes($_POST['search_productionWeek']) != ""){
          $str_sql  .= " And r.productionWeek = '".addslashes($_POST['search_productionWeek'])."' ";
        }
        if(addslashes($_POST['search_productionYear']) != ""){
          $str_sql  .= " And r.productionYear = '".addslashes($_POST['search_productionYear'])."' ";
        }
        if(addslashes($_POST['search_genRubber']) != ""){
          $str_sql  .= " And r.genRubber = '".addslashes($_POST['search_genRubber'])."' ";
        }
        if(addslashes($_POST['search_speedIndex']) != ""){
          $str_sql  .= " And r.speedIndex = '".addslashes($_POST['search_speedIndex'])."' ";
        }
        if(addslashes($_POST['search_weightIndex']) != ""){
          $str_sql  .= " And r.weightIndex = '".addslashes($_POST['search_weightIndex'])."' ";
        }
      $getproduct = $getdata->my_sql_selectJoin("p.*, r.*, w.* ,w.code as wcode, r.code as rcode ,w.diameter as diameterWheel,w.gen as genWheel ,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
          end code "
        ,"product_N"
        ,"productDetailWheel w on p.ProductID = w.ProductID
        left join productdetailrubber r on p.ProductID = r.ProductID "
        ,"Where p.TypeID = '2' ".$str_sql);
    }
  }else{
     $getproduct = $getdata->my_sql_selectJoin("p.*, r.*, w.* ,w.code as wcode, r.code as rcode ,w.diameter as diameterWheel,w.gen as genWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
         end code "
     ," product_N "
     ," productDetailWheel w on p.ProductID = w.ProductID
        left join productDetailRubber r on p.ProductID = r.ProductID "
    ," where p.ProductStatus in ('1','2','0')  ORDER BY  p.ProductID ");
  }



  if(mysql_num_rows($getproduct) > 0){
    ?>
    <table width="100%" class="table table-bordered ">
    <thead>
    <tr style="color:#FFF;">
      <th width="4%" bgcolor="#5fb760">ลำดับ</th>
      <th width="7%" bgcolor="#5fb760">รหัส</th>
      <th width="25%" bgcolor="#5fb760">สินค้า</th>
      <th width="5%" bgcolor="#5fb760">ชนิดสินค้า</th>
      <th width="5%" bgcolor="#5fb760">คงเหลือ</th>
      <th width="10%" bgcolor="#5fb760">ราคา</th>
      <th width="13%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
    </tr>
    </thead>
    <tbody>
    <?
    while($showproduct = mysql_fetch_object($getproduct)){
      $x++;
      if($showproduct->TypeID == '1'){
        $gettype = "ล้อแม๊ก ".$showproduct->BrandName." รุ่น:".$showproduct->genWheel." ขนาด:".$showproduct->diameterWheel." ขอบ:".$showproduct->whediameter." รู:".$showproduct->holeSize." ประเภท:".$showproduct->typeFormat;
      }else if($showproduct->TypeID == '2'){
        $gettype = "ยาง ".$showproduct->BrandName." ขนาด:".$showproduct->diameterRubber." ซี่รี่:".$showproduct->series." ความกว้าง:".$showproduct->width;
      }else{
        $gettype = "";
      }

    ?>
    <tr id="<?php echo @$showproduct->ProductID;?>">
      <td align="center" ><?php echo @$x;?></td>
      <td align="center"><?php echo @$showproduct->code;?></td>
      <td>&nbsp;<?php echo @$gettype;?></td>
      <td align="left">&nbsp;มือ : <?php echo @$showproduct->hand;?></td>
      <td align="right" valign="middle"><strong><?php echo @convertPoint2($showproduct->Quantity,'0');?></strong>&nbsp;</td>
      <td align="right" valign="middle"><strong><?php echo @convertPoint2($showproduct->PriceSale,'2');?></strong>&nbsp;</td>
      <td align="center" valign="middle">
        <?php
  	  if($showproduct->ProductStatus == '1'){
  		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showproduct->ProductID.'" onClick="javascript:changeproductsStatus(\''.@$showproduct->ProductID.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showproduct->ProductID.'"></i> <span id="text-'.@$showproduct->ProductID.'">'.LA_BTN_ON.'</span></button>';
  	  }else{
  		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showproduct->ProductID.'" onClick="javascript:changeproductsStatus(\''.@$showproduct->ProductID.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-lock" id="icon-'.@$showproduct->ProductID.'"></i> <span id="text-'.@$showproduct->ProductID.'">'.LA_BTN_OFF.'</span></button>';
  	  }
  	  ?><a data-toggle="modal" data-target="#edit_item" data-whatever="<?php echo @$showproduct->ProductID;?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> <?php echo @LA_BTN_EDIT;?></a><a onClick="javascript:deleteProduct('<?php echo @$showproduct->ProductID;?>');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> <?php echo @LA_BTN_DELETE;?></a></td>
    </tr>
  <? }?>
  </tbody>
</table>
    <?php
    }else{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ไม่พบข้อมูล !</div>';
  } ?>

</div>
</div>
<script language="javascript">
$( document ).ready(function() {
  $(".cw").prop('disabled', false);
  $(".cb").prop('disabled', true);

  $("#div_persentrubber").hide();
  $("#div_persentwheel").hide();

	$(".number").bind('keyup mouseup', function () {
								if($(this).val() < 0) {
									alert("กรุณากรอกตัวเลขให้ถูกต้อง ! ");
									$(this).val(0);
								}
						});


  $("#detailrubber").hide();
  $("#search_detailrubber").hide();

  $('input:radio[name="type"]').change(function() {
    if($(this).val() == 1){
      $("#detailwheel").show();
      $("#detailrubber").hide();
      $("#div_persentrubber").hide();
      $("#div_persentwheel").hide();
      $(".cw").prop('disabled', false);
      $(".cb").prop('disabled', true);
      if($("#hand").val() == '2'){
          $("#div_persentwheel").show();
      }else{
          $("#div_persentwheel").hide();
      }
    }else{ // ยาง
      $("#detailwheel").hide();
      $("#detailrubber").show();
      if($("#hand").val() == '2'){
          $("#div_persentrubber").show();
      }else{
          $("#div_persentrubber").hide();
      }
      $(".cw").prop('disabled', true);
      $(".cb").prop('disabled', false);


    }
  });

  $("#hand").change(function() {
    if($(this).val() == '2'){
      if($('input:radio[name="type"]:checked').val() == '2'){
        $("#div_persentrubber").show();
        $("#div_persentwheel").hide();
       }else{
        $("#div_persentrubber").hide();
        $("#div_persentwheel").show();
      }
    }else{
        $("#div_persentwheel").hide();
        $("#div_persentrubber").hide();
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

  $("#TypeID").change(function() {
    opctionBrand($(this).val(),"BrandID");
  });
  $("#BrandID").change(function() {
    opctionmodel($(this).val(),"ModelID");
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

$("#width").change(function() {


    $.ajax({
        type: "GET",
        url: "settings/json_Series.php",
        data: 'key=' + this.value,
        cache: false,
        success: function (data) {
            var JSONObject = JSON.parse(data);
            var $series = $("#series");
            $series.empty();
            $series.append("<option value='' selected='selected'>--เลือก--</option>");
            for(var i = 0; i < JSONObject.length; i++){
            $series.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
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
            var $diameterRubber = $("#diameterRubber");
            $diameterRubber.empty();
            $diameterRubber.append("<option value='' selected='selected'>--เลือก--</option>");
            for(var i = 0; i < JSONObject.length; i++){
            $diameterRubber.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
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

  $("#diameterWheel").change(function() {
    $.ajax({
        type: "GET",
        url: "settings/json_rim.php",
        data: 'key=' + this.value,
        cache: false,
        success: function (data) {
            var JSONObject = JSON.parse(data);
            var $rim = $("#rim");
            $rim.empty();
            $rim.append("<option value='' selected='selected'>--เลือก--</option>");
            for(var i = 0; i < JSONObject.length; i++){
            $rim.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
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
            var $holeSize = $("#holeSize");
            $holeSize.empty();
            $holeSize.append("<option value='' selected='selected'>--เลือก--</option>");
            for(var i = 0; i < JSONObject.length; i++){
            $holeSize.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
            }

        },
        error: function(err) {
            console.log(err);
        }
    });
  });



});

function changeproductsStatus(prokey,lang){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+prokey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){

			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+prokey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+prokey).className = 'fa fa-lock';
				if(lang == 'en'){
					document.getElementById('text-'+prokey).innerHTML = 'Hide';
				}else{
					document.getElementById('text-'+prokey).innerHTML = 'ไม่ใช้งาน';
				}

			}else{
				document.getElementById('btn-'+prokey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+prokey).className = 'fa fa-unlock-alt';
				if(lang == 'en'){
					document.getElementById('text-'+prokey).innerHTML = 'Show';
				}else{
					document.getElementById('text-'+prokey).innerHTML = 'เปิดใช้งาน';
				}

			}
  		}
	}

	xmlhttp.open("GET","function.php?type=change_products_status_N&key="+prokey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteProduct(prokey){
    var txt;
  var r = confirm("คุณต้องการลบข้อมูลสินค้า !");
  if (r == true) {

    	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
    	 	xmlhttp=new XMLHttpRequest();
    	}else{// code for IE6, IE5
      		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    	}

      xmlhttp.onreadystatechange=function(){
        console.log(xmlhttp.readyState+" : "+xmlhttp.status);
      		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    			document.getElementById(prokey).innerHTML = '';

      		}
    	}
      xmlhttp.open("GET","function.php?type=delete_products&key="+prokey,true);
    	xmlhttp.send();
  } else {
    return false;
  }

}

    $('#edit_item').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/edit_itemN.php",
                data: dataString,
                cache: false,
                success: function (data) {
                   // console.log(data);
                    modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })


     function checkpersenwhell(isvalue){
       console.log(isvalue)
      if(isvalue < 0 || isvalue > 100){
        alert("กรุณากรอกจำนวนภายใน 1 - 100");
        $('#persentwheel').val(0);
      }
    }

    function checkpersenbubber(isvalue){
      if(isvalue < 0 || isvalue > 100){
        alert("กรุณากรอกจำนวนภายใน 1 - 100");
        $('#persentrubber').val(0);
      }
    }

    function chkprice(price){
      /*var sale = $('#PriceSale').val();
      var Buy = $('#PriceBuy').val();
      if(sale > 0){
        if(Buy > sale){
          var txt;
          var r = confirm("ต้องการให้ราคาซื้อมากกว่าราคาขาย ?");
          if (r != true) {
            $('#PriceSale').val("");
            $('#PriceBuy').val("");
          }
        }
      }*/
    }


    </script>
