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
$getitem = $getdata->my_sql_query(NULL,"product","ProductID='".addslashes($_GET['key'])."'");

                                                $getypetest = $getdata->my_sql_select(NULL,"type",NULL);
                                                $getypebrand = $getdata->my_sql_select(NULL,"brand",NULL);
                                                $getypemodel = $getdata->my_sql_select(NULL,"model",NULL);
                                                $getdealer = $getdata->my_sql_select(NULL,"dealer",NULL);
                                                $getshelf = $getdata->my_sql_select(NULL,"shelf",NULL);


                                        ?>
                                         <div class="modal-body">
                                         <div class="form-group row">
                                         <div class="col-md-6">
                                              <label for="edit_ProductID">รหัสสินค้า</label>
                                              <input type="text" name="edit_ProductID" id="edit_ProductID" value="<?php echo @$getitem->ProductID;?>" class="form-control" readonly>
                                            </div>
                                         <div class="col-md-6">
                                             <label for="edit_dealer_code">ผู้จำหน่าย</label>
                                             <select name="edit_dealer_code" id="edit_dealer_code" class="form-control">
                                              <option value="" selected="selected">--เลือกผู้จำหน่าย--</option>
                                              <?
                                              while($showdealer = mysql_fetch_object($getdealer)){?>
                                              <option value="<?php echo @$showdealer->dealer_code;?>" ><?php echo @$showdealer->dealer_name;?></option>
                                              <?
                                               }
                                             ?>
                                              </select>
                                             </div>
                                             </div>

                                        <div class="form-group">
                                           <label for="edit_ProductName">ชื่อสินค้า</label>
                                           <input type="text" name="edit_ProductName" id="edit_ProductName" class="form-control" value="<?php echo @$getitem->ProductName;?>">
                                         </div>

                                         <div class="form-group">
                                            <label for="edit_ProductDetail">รายละเอียดสินค้า</label>
                                            <textarea name="edit_ProductDetail" id="edit_ProductDetail" class="form-control"><?php echo @$getitem->ProductDetail;?></textarea>
                                          </div>

                                       <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="edit_TypeID">ประเภทสินค้า</label>
                                              <select name="edit_TypeID" id="edit_TypeID" class="form-control">
                                              <option value="" selected="selected">--เลือกประเภทสินค้า--</option>
                                              <?
                                              $rows = array();
                                              while($showtype = mysql_fetch_object($getypetest)){
                                                  $rows[] = $showtype;
                                                  ?>
                                                   <option value="<?php echo @$showtype->TypeID;?>" ><?php echo @$showtype->TypeName;?></option>
                                                  <?
                                              }
                                              $getjson = @json_encode($rows,JSON_UNESCAPED_UNICODE);
                                              ?>
                                              </select>
                                            </div>
                                             <div class="col-md-6">
                                             <label for="edit_BrandID">ยี่ห้อสินค้า</label>
                                             <select name="edit_BrandID" id="edit_BrandID" class="form-control">
                                              <option value="" selected="selected">--เลือกยี่ห้อสินค้า--</option>
                                              <?
                                              $rowsbrand = array();
                                              while($showbrand = mysql_fetch_object($getypebrand)){
                                                  $rowsbrand[] = $showbrand;
                                               }
                                              $getjsonbrand = @json_encode($rowsbrand,JSON_UNESCAPED_UNICODE);
                                              ?>
                                              </select>
                                             </div>
                                          </div>

                                           <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="edit_ModelID">รุ่น</label>
                                              <select name="edit_ModelID" id="edit_ModelID" class="form-control">
                                              <option value="" selected="selected">--เลือกรุ่นสินค้า--</option>
                                              <?
                                              $rowmodel = array();
                                              while($showmodel = mysql_fetch_object($getypemodel)){
                                                  $rowmodel[] = $showmodel;
                                               }
                                              $getjsonmodel= @json_encode($rowmodel,JSON_UNESCAPED_UNICODE);
                                              ?>
                                              </select>
                                            </div>
                                            <div class="col-md-6">
                                             <label for="edit_Warranty">การรับประกัน</label>
                                            <input type="text" name="edit_Warranty" id="edit_Warranty" class="form-control" value="<?php echo @$getitem->Warranty;?>">
                                             </div>
                                          </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="Pedit_riceSale">ราคาขาย</label>
                                              <input type="number" name="edit_PriceSale" id="edit_PriceSale" class="form-control number" value="<?php echo @$getitem->PriceSale;?>" style="text-align: right;">
                                            </div>
                                             <div class="col-md-6">
                                             <label for="edit_PriceBuy">ราคาซื้อ</label>
                                            <input type="number" name="edit_PriceBuy" id="edit_PriceBuy" class="form-control number" value="<?php echo @$getitem->PriceBuy;?>" style="text-align: right;">
                                             </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="edit_Quantity">คงเหลือ</label>
                                              <input type="number" name="edit_Quantity" id="edit_Quantity" class="form-control number" value="<?php echo @$getitem->Quantity;?>" style="text-align: right;">
                                            </div>
                                           </div>

                                           <div class="form-group">
                                              <label for="edit_shelf_id">shelf</label>
                                              <select name="edit_shelf_id" id="edit_shelf_id" class="form-control">
                                                <option value="" selected="selected">--เลือกชั้นวางสินค้า--</option>
                                                <?
                                              while($showshelf = mysql_fetch_object($getshelf)){?>
                                              <option value="<?php echo @$showshelf->shelf_id;?>"><?php echo @$showshelf->shelf_detail;?></option>
                                              <?
                                               }
                                             ?>
                                              </select>

                                          </div>


                                        </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_item" id="save_edit_item" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>

          <script language="javascript">
          $( document ).ready(function() {
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

           $('#edit_dealer_code').val('<?php echo @$getitem->dealer_code;?>');
           $('#edit_TypeID').val('<?php echo @$getitem->TypeID;?>');
            opctionBrand($('#edit_TypeID').val(),"edit_BrandID");
            $('#edit_BrandID').val('<?php echo @$getitem->BrandID;?>');
            opctionmodel($('#edit_BrandID').val(),"edit_ModelID");
            $('#edit_ModelID').val('<?php echo @$getitem->ModelID;?>');
            $('#edit_shelf_id').val('<?php echo @$getitem->shelf_id;?>');

            $("#edit_TypeID").change(function() {
              opctionBrand($(this).val(),"edit_BrandID");
            });
            $("#edit_BrandID").change(function() {
              opctionmodel($(this).val(),"edit_ModelID");
            });
          });
          </script>
