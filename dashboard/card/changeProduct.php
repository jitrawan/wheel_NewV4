<?php
session_start();
error_reporting(0);
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


$getitem_detail = $getdata->my_sql_query(" ri.*,p.*, d.*, w.*, s.*,ri.ProductID as ProductID
,case
	when p.TypeID = '2'
	then (select b.BrandName from brand b where d.brand = b.BrandID)
	end BrandName
	, case
  when p.TypeID = '2'
  then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
  when p.TypeID = '1'
  then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
  end code
	"
																			 ," reserve_item ri
																			 left join product_N p on ri.ProductID = p.ProductID
																			 left join productDetailWheel w on p.ProductID = w.ProductID
																			 left join productDetailRubber d on p.ProductID = d.ProductID
																			 left join shelf s ON p.shelf_id = s.shelf_id "
																			 ," ri.reserve_key = '".htmlentities($_GET['reserveKey'])."' and ri.ProductID = '".htmlentities($_GET['key'])."' ");

 if($getitem_detail->TypeID == '1'){
	 $gettype = "ล้อแม๊ก ".$getitem_detail->BrandName." รุ่น:".$getitem_detail->gen." ขนาด:".$getitem_detail->diameterWheel." ขอบ:".$getitem_detail->whediameter." รู:".$getitem_detail->holeSize." ประเภท:".$getitem_detail->typeFormat." <br>ยี่ห้อ:".$getitem_detail->BrandName." offset:".$getitem_detail->offset." สี: ".$getitem_detail->color." รุ่น: ".$getitem_detail->gen ;
 }else if($getitem_detail->TypeID == '2'){
	 $gettype = "ยาง ".$getitem_detail->BrandName." ขนาด:".$getitem_detail->diameterRubber." ขอบ:".$getitem_detail->rubdiameter." ซี่รี่:".$getitem_detail->series." ความกว้าง:".$getitem_detail->width." ยี่ห้อ:".$getitem_detail->BrandName." กลุ่มยาง: ".$getitem_detail->groudRubber
	 ." <br>สัปดาห์: ".$getitem_detail->productionWeek." ปี: ".$getitem_detail->productionYear." รุ่น: ".$getitem_detail->genRubber." ดัชนีความเร็ว: ".$getitem_detail->speedIndex." ดัชนีน้ำหนัก: ".$getitem_detail->weightIndex;
 }else{
	 $gettype = "";
 }
?>

<div class="modal-body">
 <div class="form-group">
    <label for="edit_ProductID">หมายเลขสินค้า</label>
    <input type="text" name="edit_ProductID" id="edit_ProductID" style="display:none;" class="form-control" value="<?php echo @$getitem_detail->ProductID;?>">
		<input type="text" name="edit_ProductCode" id="edit_ProductCode" readonly class="form-control" value="<?php echo @$getitem_detail->code;?>">
 </div>
 <div class="form-group">
    <label>ชื่อรายการ</label>
    <input type="text" name="" id="" class="form-control" value="<?php echo @$gettype;?>" readonly>
 </div>
 <div class="form-group">
    <label for="edit_remark">สาเหตุที่เปลี่ยน</label>
    <textarea name="edit_remark" id="edit_remark" class="form-control" autofocus required></textarea>
 </div>

<div class="form-group row" >
	<div class="col-md-6">
			    <label for="edit_change_Amt">จำนวน</label>
					<div class="input-group">
					<span class="input-group-addon">123</span>
					 <input class="form-control right number" type="number"  name="edit_change_Amt" id="edit_change_Amt" style="text-align: right;" value="<?php echo @$getitem_detail->item_amt;?>">
			<input type="hidden" name="get_item_am" id="get_item_am" class="form-control number" value="<? echo @$getitem_detail->item_amt ?>">
					</div>
	</div>
 <div class="col-md-6">
			<label for="edit_ProductID">shelf </label>
		<select name="shelf_id" id="shelf_id" class="form-control"  required>
				<option value="" selected="selected">--เลือกชั้นวางสินค้า--</option>
				<?
				$getitem = $getdata->my_sql_select(NULL,"shelf_detail","ProductID='".@$getitem_detail->code."' and amt_rimit >=  '".@$getitem_detail->item_amt."' ");
			while($showshelf = mysql_fetch_object($getitem)){
				$getshelf = $getdata->my_sql_query("s.*,s.shelf_code,(select sum(ss.amt_rimit) from shelf_detail ss where ss.shelf_code = s.shelf_code) as rimit ","shelf s","s.shelf_code ='".@$showshelf->shelf_code."' ");
				?>
			<option value="<?php echo @$showshelf->shelf_code;?>"><?php echo @$getshelf->shelf_detail;?> ชั้น <?php echo @$getshelf->shelf_class;?> มี <?php echo $showshelf->amt_rimit ?> ชิ้น</option>
			<?
			 }
		 ?>
			</select>
		</div>
			</div>

 <div class="form-group">
  <input type="hidden" name="edit_reserve_key" id="edit_reserve_key" value="<?php echo @$getitem_detail->reserve_key;?>">

 </div>
 </div>
                                         <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_edit_item" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
<script language="javascript">
$( document ).ready(function() {


$(".number").bind('keyup mouseup', function () {
	var amt = $("#get_item_am").val();
	if($(this).attr('name') == 'edit_change_Amt'){
		if($(this).val() < 0){
			alert("กรุณากรอกตัวเลขให้ถูกต้อง ! ");
			$(this).val(0);
		}else if($(this).val() > amt){
			alert("จำนวนสินค้าที่กรอกเกินจำนวนสินค้าที่ซื้อ ! ");
			$(this).val(amt);
		}
}else{
	if($(this).val() < 0) {
		alert("กรุณากรอกตัวเลขให้ถูกต้อง ! ");
		$(this).val(0);
	}
}

						});
							});


</script>
