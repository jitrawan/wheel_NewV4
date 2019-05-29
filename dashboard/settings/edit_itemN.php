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
$getedit = $getdata->my_sql_selectJoin(" p.*,r.*,w.code as wcode ,r.code as rcode
,w.*,p.ProductID as productMain,w.diameter as diameterWheel , r.diameter as diameterRubber
, r.width as WidthRubble , r.brand as brandRubble
","product_N","productDetailWheel w on p.ProductID = w.ProductID left join productDetailRubber r on p.ProductID = r.ProductID "," where p.ProductID = '".addslashes($_GET['key'])."' ");
$getitem = mysql_fetch_object($getedit);


                                                $getshelf = $getdata->my_sql_select(NULL,"shelf","shelf_status = '1'");
																								$getdealer = $getdata->my_sql_select(NULL,"dealer",NULL);


                                        ?>
																				<div class="modal-body">
																					 <div class="form-group row" style="display: none;">
	                                             <div class="col-md-6">
	                                               <label for="edit_ProductID">รหัสสินค้า</label>
	                                               <input type="text" name="edit_ProductID" id="edit_ProductID" value="<?php echo @$getitem->productMain;?>" class="form-control" readonly>
	                                             </div>
	                                             <div class="col-md-6">

	                                              </div>
	                                          </div>

	                                         <div class="form-group row">
	                                           <div class="col-md-4">
																							 <input type="hidden" name="gettype" id="gettype"/>
	                                           <label >ประเภทสินค้า :    </label>
	                                           <input type="radio" id="wheel" name="edit_type" value="1" checked>
	                                           <label for="wheel">ล้อแม๊ก</label>
	                                           </div>
	                                           <div class="col-md-6">
	                                           <input type="radio" id="rubber" name="edit_type" value="2">
	                                           <label for="rubber">ยาง</label>
	                                           </div>
	                                         </div>

	                                         <!--ล้อ-->
	                                         <div id="edit_detailwheel" name="edit_detailwheel" style="padding: 5px; border: 0px solid #4CAF50;">
																						 <div class="form-group row">

																					 		 <div class="col-md-6">
																					 			 <label for="code">รหัส</label>
																					 			 <input type="text" name="code" id="code" class="form-control" value="<?= $getitem->wcode?>" readonly>
																					 		</div>

																					 	</div>
																					 <div class="form-group row">
	                                               <div class="col-md-2 pr-2">
	                                               <label for="edit_diameterWheel">ขอบ(lnch)</label>
	                                                 <select name="edit_diameterWheel" id="edit_diameterWheel" class="form-control">
	                                                   <option value="" selected="selected">--เลือก--</option>
																										 <? $getDiameterWhee = $getdata->my_sql_select(NULL,"DiameterWhee","status = '1' ORDER BY id ");
	                                                     while($showDiameterWhee = mysql_fetch_object($getDiameterWhee)){?>
	                                                   <option value="<?= $showDiameterWhee->Description?>" ><?= $showDiameterWhee->Description?></option>
	                                                   <?}?>
	                                                 </select>
	                                               </div>
	                                               <div class="col-md-2 pr-2 pl-2">
	                                               <label for="edit_rim">ขนาด(lnch)</label>
	                                               <select name="edit_rim" id="edit_rim" class="form-control">
	                                                   <option value="" selected="selected">--เลือก--</option>
																										 <? $getRimWheel = $getdata->my_sql_select(NULL,"RimWheel","status = '1' ORDER BY id ");
	                                                     while($showRimWheel = mysql_fetch_object($getRimWheel)){?>
	                                                   <option value="<?= $showRimWheel->Description?>" ><?= $showRimWheel->Description?></option>
	                                                   <?}?>
	                                                 </select>
	                                               </div>
	                                               <div class="col-md-2 pr-2 pl-2">
	                                               <label for="edit_holeSize">รู</label>
	                                                <select name="edit_holeSize" id="edit_holeSize" class="form-control">
	                                                   <option value="" selected="selected">--เลือก--</option>
																										 <? $getHoleSizeWhee = $getdata->my_sql_select(NULL,"HoleSizeWhee","status = '1' ORDER BY id ");
	                                                      while($showHoleSizeWhee = mysql_fetch_object($getHoleSizeWhee)){?>
	                                                    <option value="<?= $showHoleSizeWhee->Description?>" ><?= $showHoleSizeWhee->Description?></option>
	                                                    <?}?>
	                                                 </select>
	                                               </div>
	                                               <div class="col-md-3 pr-2 pl-2">
	                                               <label for="edit_typeFormat">ประเภท</label>
	                                                <select name="edit_typeFormat" id="edit_typeFormat" class="form-control">
	                                                   <option value="" selected="selected">--เลือก--</option>
																										 <? $getTypeFormatWheel = $getdata->my_sql_select(NULL,"TypeFormatWheel","status = '1' ORDER BY id ");
	                                                     while($showTypeFormatWheel = mysql_fetch_object($getTypeFormatWheel)){?>
	                                                   <option value="<?= $showTypeFormatWheel->Description?>" ><?= $showTypeFormatWheel->Description?></option>
	                                                   <?}?>
	                                                 </select>
	                                               </div>
																								 <div class="col-md-3 pr-2 pl-2">
	                                               <label for="edit_brandWheel">ยี่ห้อ</label>
	                                                 <select name="edit_brandWheel" id="edit_brandWheel" class="form-control">
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
																									 <label for="edit_genWheel">รุ่น</label>
																									 <input type="text" name="edit_genWheel" id="edit_genWheel" class="form-control">
																									 </div>
	                                                   <div class="col-md-2 pr-2">
	                                                     <label for="edit_offset">offset(mm)</label>
	                                                       <!--input type="text" name="edit_offset" id="edit_offset" class="form-control" value="<?php echo @$getitem->offset;?>" -->
																												 <select name="edit_offset" id="edit_offset" class="form-control">
																													 <option value="" selected="selected">--เลือก--</option>
																													 <? $getoffset = $getdata->my_sql_select(NULL,"offset","Description IS NOT NULL order by Description ");
																															while($showoffset = mysql_fetch_object($getoffset)){?>
																														<option value="<?= $showoffset->Description?>" ><?= $showoffset->Description?></option>
																														<?}?>
																												 </select>
	                                                   </div>
	                                                   <div class="col-md-3 pr-2 pl-2">
	                                                     <label for="edit_color">color</label>
	                                                     <select name="edit_color" id="edit_color" class="form-control">
	                                                         <option value="" selected="selected">--สีอื่น--</option>
	                                                         <option value="black">black</option> <option value="bronze">bronze</option> <option value="chrome">chrome</option> <option value="silver">silver</option>
	                                                         <option value="gray">gray</option> <option value="white">white</option> <option value="copper">copper</option> <option value="gold">gold</option>
	                                                         <option value="Midnight">Midnight</option> <option value="Blue">Blue</option>
	                                                       </select>
	                                                   </div>
	                                             </div>

	                                          </div>
	                                          <!--ยาง-->
	                                          <div id="edit_detailrubber" name="edit_detailrubber" style="padding: 5px; border: 0px solid #4CAF50;">
																							<div class="form-group row">

																								 <div class="col-md-6">
																									 <label for="code">รหัส</label>
																									 <input type="text" name="code" id="code" class="form-control" value="<?= $getitem->rcode?>" readonly>
																								</div>

																							</div>
																						<div class="form-group row">
																							<div class="col-md-2 pr-2">
																							<label for="edit_width">ความกว้าง(mm)</label>
																								<select name="edit_width" id="edit_width" class="form-control">
																									<option value="" selected="selected">--เลือก--</option>
																									<? $getWidthRubble = $getdata->my_sql_select(NULL,"WidthRubble","status = '1' ORDER BY id ");
																										 while($showWidthRubble = mysql_fetch_object($getWidthRubble)){?>
																									 <option value="<?= $showWidthRubble->Description?>" ><?= $showWidthRubble->Description?></option>
																									 <?}?>
																								</select>
																							</div>
	                                               <div class="col-md-3 pr-2 pl-2">
	                                               <label for="edit_series">ซี่รี่(%)</label>
	                                               <select name="edit_series" id="edit_series" class="form-control">
	                                                   <option value="" selected="selected">--เลือก--</option>
																										 <? $getSeriesRubble = $getdata->my_sql_select(NULL,"SeriesRubble","status = '1' ORDER BY id ");
	                                                      while($showSeriesRubble = mysql_fetch_object($getSeriesRubble)){?>
	                                                    <option value="<?= $showSeriesRubble->Description?>" ><?= $showSeriesRubble->Description?></option>
	                                                    <?}?>
	                                                 </select>
	                                               </div>

																								 <div class="col-md-3 pr-2  pl-2">
	                                               <label for="edit_diameterRubber">ขนาด(lnch)</label>
	                                                <select name="edit_diameterRubber" id="edit_diameterRubber" class="form-control">
	                                                   <option value="" selected="selected">--เลือก--</option>
																										 <? $getDiameterRubble = $getdata->my_sql_select(NULL,"DiameterRubble","status = '1' ORDER BY id ");
	                                                      while($showDiameterRubble = mysql_fetch_object($getDiameterRubble)){?>
	                                                    <option value="<?= $showDiameterRubble->Description?>" ><?= $showDiameterRubble->Description?></option>
	                                                    <?}?>
	                                                 </select>
	                                                </div>
	                                               <div class="col-md-4 pr-2 pl-2">
	                                               <label for="edit_brand">ยี่ห้อ</label>
	                                                <select name="edit_brand" id="edit_brand" class="form-control">
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
	                                                  <select name="edit_groudRubber" id="edit_groudRubber" class="form-control">
																									 		<option value="" selected="selected">--เลือก--</option>
																											<option value="NO" >ไม่มี</option>
																											<option value="H/T" >H/T</option>
																									 		<option value="A/T" >A/T</option>
																									 		<option value="M/T">M/T</option>
																									 	</select>
																								 </div>
	                                               <div class="col-md-3 pr-2 pl-2">
	                                                 <label for="code">สัปดาห์ที่ผลิต</label>
																									 <select name="edit_productionWeek" id="edit_productionWeek" class="form-control">
																											<option value="" selected="selected">--เลือก--</option>
																											<? for ($x = 1; $x <= 52; $x++) {?>
																											 <option value="<?= $x?>" ><?= $x?></option>
																											 <?}?>
																										</select>
	                                              </div>
	                                              <div class="col-md-2 pr-2 pl-2">
	                                                <label for="code">ปีที่ผลิต(Ex.2019)</label>
	                                                <input type="number" name="edit_productionYear" id="edit_productionYear" class="form-control" value="<?= $getitem->productionYear?>" >
	                                             </div>
	                                             <div class="col-md-3 pr-2 pl-2">
	                                               <label for="code">รุ่นยาง</label>
	                                               <input type="text" name="edit_genRubber" id="edit_genRubber" class="form-control" value="<?= $getitem->genRubber?>" >
	                                            </div>

	                                             </div>
	                                             <div class="form-group row">
	                                               <div class="col-md-4 pr-2">
	                                                  <label for="code">ดัชนีความเร็ว(Km/h)</label>
	                                                  <select name="edit_speedIndex" id="edit_speedIndex" class="form-control">
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
	                                                 <select name="edit_weightIndex" id="edit_weightIndex" class="form-control">
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
  	                                              <label for="edit_hand">สืินค้ามือ</label>
  	                                             <select name="edit_hand" id="edit_hand" class="form-control" required>
  	                                                  <option value="1" selected="selected">1</option>
  	                                                  <option value="2">2</option>

  	                                                </select>
  	                                            </div>
  	                                            <div id="div_persentrubber">
  	                                              <div class="col-md-3">
  	                                                <label for="edit_persentrubber">เปอร์เซ็นยาง (%)</label>
  	                                                     <input type="number" name="edit_persentrubber" id="edit_persentrubber" class="form-control" onblur="checkpersenwhell(this.value)" value="">
  	                                              </div>
  	                                            </div>
																								<div id="div_persentwheel">
                                               <div class="col-md-3">
                                                 <label for="hand">เปอร์เซ็นแม็ค (%)</label>
                                                      <input type="number" name="edit_persentwheel" id="edit_persentwheel" class="form-control" onblur="checkpersenwhell(this.value)" value="">
                                               </div>

																								<div class="col-md-4">
	                                               <label for="edit_PriceSale">ราคาขาย (บาท)</label>
	                                               <input type="number" name="edit_PriceSale" id="edit_PriceSale" class="form-control number" value="<?php echo @$getitem->PriceSale;?>" onblur="chkprice_edit(this.value)" style="text-align: right;">
	                                             </div>
																								<!--div class="col-md-6">
																									<label for="edit_shelf_id">shelf</label>
																										<select name="edit_shelf_id" id="edit_shelf_id" class="form-control">
																											<option value="" selected="selected">--เลือกชั้นวางสินค้า--</option>
																											<?
																										while($showshelf = mysql_fetch_object($getshelf)){?>
																										<option value="<?php echo @$showshelf->shelf_id;?>"><?php echo @$showshelf->shelf_detail;?></option>
																										<?
																										 }
																									 ?>
																										</select-->
 	                                               <!--label for="edit_dealer_code">ผู้จำหน่าย</label>
 	                                               <select name="edit_dealer_code" id="edit_dealer_code" class="form-control">
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
	                                              <label for="edit_PriceBuy">ราคาซื้อ (บาท)</label>
	                                             <input type="number" name="edit_PriceBuy" id="edit_PriceBuy" class="form-control number" value="<?php echo @$getitem->PriceBuy;?>" onblur="chkprice_edit(this.value)" style="text-align: right;">
	                                              </div-->
																								<!--div class="col-md-3">
																									<label for="edit_Quantity">คงเหลือ (ชิ้น)</label>
																									<input type="number" name="edit_Quantity" id="edit_Quantity" class="form-control number" value="<?php echo @$getitem->Quantity;?>" style="text-align: right;">
																								</div-->
	                                           </div>
																			<!--div class="form-group row">
																				<div class="col-md-2">
                                              <label for="PriceSale">ลดราคา (%)</label>
                                              <input type="number"  name="edit_discount" id="edit_discount" class="form-control number" value="<?php echo @$getitem->discount;?>"  style="text-align: right;">
                                            </div>
                                          </div>

                                        </div-->
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_item" id="save_edit_item" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>

          <script language="javascript">
          $( document ).ready(function() {
						$("#div_persentrubber").hide();
						$("#div_persentwheel").hide();
						$("#edit_hand").change(function() {
							if($(this).val() == '2'){
								if('<?echo @$getitem->TypeID;?>' == '2'){
									$("#div_persentrubber").show();
									$("#div_persentwheel").hide();
								}else{
									$("#div_persentrubber").hide();
									$("#div_persentwheel").show();
								}
							}else{
									$("#div_persentrubber").hide();
									$("#div_persentwheel").hide();
							}
						});

						$("#edit_diameterWheel").change(function() {
							$.ajax({
									type: "GET",
									url: "settings/json_rim.php",
									data: 'key=' + this.value,
									cache: false,
									success: function (data) {
											var JSONObject = JSON.parse(data);
											var $edit_rim = $("#edit_rim");
											$edit_rim.empty();
											$edit_rim.append("<option value='' selected='selected'>--เลือก--</option>");
											for(var i = 0; i < JSONObject.length; i++){
											$edit_rim.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
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
											var $edit_holeSize = $("#edit_holeSize");
											$edit_holeSize.empty();
											$edit_holeSize.append("<option value='' selected='selected'>--เลือก--</option>");
											for(var i = 0; i < JSONObject.length; i++){
											$edit_holeSize.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
											}

									},
									error: function(err) {
											console.log(err);
									}
							});
						});


						$("#edit_width").change(function() {
						    $.ajax({
						        type: "GET",
						        url: "settings/json_Series.php",
						        data: 'key=' + this.value,
						        cache: false,
						        success: function (data) {
						            var JSONObject = JSON.parse(data);
						            var $edit_series = $("#edit_series");
						            $edit_series.empty();
						            $edit_series.append("<option value='' selected='selected'>--เลือก--</option>");
						            for(var i = 0; i < JSONObject.length; i++){
						            $edit_series.append("<option value=" +  JSONObject[i].id + ">" + JSONObject[i].Description + "</option>");
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
						            var $edit_diameterRubber = $("#edit_diameterRubber");
						            $edit_diameterRubber.empty();
						            $edit_diameterRubber.append("<option value='' selected='selected'>--เลือก--</option>");
						            for(var i = 0; i < JSONObject.length; i++){
						            $edit_diameterRubber.append("<option value=" +  JSONObject[i].id + ">" + JSONObject[i].Description + "</option>");
						            }

						        },
						        error: function(err) {
						            console.log(err);
						        }
						    });
						  });

						$(".number").bind('keyup mouseup', function () {
								if($(this).val() < 0) {
									alert("กรุณากรอกตัวเลขให้ถูกต้อง ! ");
									$(this).val(0);
								}
						});

						$('#save_edit_item').click(function(){
		 					 var r = confirm("ต้องการแก้ไขข้อมูล ?");
		 					 if (r == true) {
		 						 return true;
		 					 }else{
		 						 return false;
		 					 }
		 				 });

						if('<?echo @$getitem->TypeID;?>' == '1'){
							$("#edit_detailwheel").show();
								$("#edit_detailrubber").hide();
								$('#edit_diameterWheel').val('<?php echo @$getitem->diameter;?>');
								/*$('#edit_rim').val('<?php echo @$getitem->rim;?>');
								$('#edit_holeSize').val('<?php echo @$getitem->holeSize;?>');*/
								$('#edit_typeFormat').val('<?php echo @$getitem->typeFormat;?>');
								$('#edit_brandWheel').val('<?php echo @$getitem->brand;?>');
								$('#edit_color').val('<?php echo @$getitem->color;?>');
								$('#edit_offset').val('<?php echo @$getitem->offset;?>');
								$('#edit_genWheel').val('<?php echo @$getitem->gen;?>');




								if('<?php echo @$getitem->diameter;?>' != ""){
									$.ajax({
											type: "GET",
											url: "settings/json_rim.php",
											data: 'key=' + '<?php echo @$getitem->diameter;?>',
											cache: false,
											success: function (data) {
													var JSONObject = JSON.parse(data);
													var $edit_rim = $("#edit_rim");
													$edit_rim.empty();
													$edit_rim.append("<option value='' selected='selected'>--เลือก--</option>");
													for(var i = 0; i < JSONObject.length; i++){
													$edit_rim.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
													}
													$('#edit_rim').val('<?php echo @$getitem->rim;?>');


											},
											error: function(err) {
													console.log(err);
											}
									});

									$.ajax({
											type: "GET",
											url: "settings/json_hoteSize.php",
											data: 'key=' + '<?php echo @$getitem->diameter;?>',
											cache: false,
											success: function (data) {
												var JSONObject = JSON.parse(data);
													var $edit_holeSize = $("#edit_holeSize");
													$edit_holeSize.empty();
													$edit_holeSize.append("<option value='' selected='selected'>--เลือก--</option>");
													for(var i = 0; i < JSONObject.length; i++){
													$edit_holeSize.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
													}
												$('#edit_holeSize').val('<?php echo @$getitem->holeSize;?>');
											},
											error: function(err) {
													console.log(err);
											}
									});
								}
								if('<?php echo @$getitem->hand;?>' == "2"){
									$("#div_persentwheel").show();
								}


							}else{
								$("#edit_detailwheel").hide();
								$("#edit_detailrubber").show();
								$('#edit_width').val('<?php echo @$getitem->WidthRubble;?>');

								$('#edit_groudRubber').val('<?php echo @$getitem->groudRubber;?>');
								$('#edit_productionWeek').val('<?php echo @$getitem->productionWeek;?>');
								$('#edit_speedIndex').val('<?php echo @$getitem->speedIndex;?>');
								$('#edit_weightIndex').val('<?php echo @$getitem->weightIndex;?>');

								if('<?php echo @$getitem->hand;?>' == "2"){
									$("#div_persentrubber").show();
								}

								if('<?php echo @$getitem->WidthRubble;?>' != ""){
									$.ajax({
											type: "GET",
											url: "settings/json_Series.php",
											data: 'key=' + '<?php echo @$getitem->WidthRubble;?>',
											cache: false,
											success: function (data) {
													var JSONObject = JSON.parse(data);
													var $edit_series = $("#edit_series");
													$edit_series.empty();
													$edit_series.append("<option value='' selected='selected'>--เลือก--</option>");
													for(var i = 0; i < JSONObject.length; i++){
													$edit_series.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
													}
													$('#edit_series').val('<?php echo @$getitem->series;?>');


											},
											error: function(err) {
													console.log(err);
											}
									});

									$.ajax({
											type: "GET",
											url: "settings/json_Diameter.php",
											data: 'key=' + '<?php echo @$getitem->WidthRubble;?>',
											cache: false,
											success: function (data) {
												var JSONObject = JSON.parse(data);
													var $edit_diameterRubber = $("#edit_diameterRubber");
													$edit_diameterRubber.empty();
													$edit_diameterRubber.append("<option value='' selected='selected'>--เลือก--</option>");
													for(var i = 0; i < JSONObject.length; i++){
													$edit_diameterRubber.append("<option value=" +  JSONObject[i].Description + ">" + JSONObject[i].Description + "</option>");
													}
													$('#edit_diameterRubber').val('<?php echo @$getitem->diameterRubber;?>');
											},
											error: function(err) {
													console.log(err);
											}
									});
								}

							$('#edit_brand').val('<?php echo @$getitem->brandRubble;?>');
							}

							$("#gettype").val('<?echo @$getitem->TypeID;?>');


							var $edit_type = $('input:radio[name=edit_type]');
							$('input:radio[name="edit_type"]').attr('disabled', true);
					    $edit_type.filter('[value=<?echo @$getitem->TypeID;?>]').prop('checked', true);
           //$('#edit_dealer_code').val('<?php echo @$getitem->dealer_code;?>');
					// $('#edit_shelf_id').val('<?php echo @$getitem->shelf_id;?>');
					 $('#edit_hand').val('<?php echo @$getitem->hand;?>');




          });

					function chkprice_edit(price){
			      var sale = $('#edit_PriceSale').val();
			      var Buy = $('#edit_PriceBuy').val();
			      if(sale > 0){
			        if(Buy > sale){
			          var txt;
			          var r = confirm("ต้องการให้ราคาซื้อมากกว่าราคาขาย ?");
			          if (r != true) {
			            $('#edit_PriceSale').val("");
			            $('#edit_PriceBuy').val("");
			          }
			        }
			      }
			    }
          </script>
