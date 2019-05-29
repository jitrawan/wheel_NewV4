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

$getctype_detail =$getdata->my_sql_select("s.ProductID as proId, s.amt_rimit as rimit ,p.*, r.*, w.*, s.*,p.ProductID as productMain,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
,"shelf_detail s
left join product_n p on p.ProductID = (select pp.ProductID
										from product_n pp
										left join productDetailWheel ww on pp.ProductID = ww.ProductID
										left join productDetailRubber rr on pp.ProductID = rr.ProductID
										where (rr.code = s.ProductID or ww.code = s.ProductID) )
left join productDetailWheel w on p.ProductID = w.ProductID
left join productDetailRubber r on p.ProductID = r.ProductID "
,"s.shelf_code='".addslashes($_GET['key'])."' ");
?>

 <div class="modal-body">
 <div class="form-group row">
		 <div class="col-md-12">
		 <?


		 $getcattt = $getdata->my_sql_query("s.* "
		 ,"shelf s"
		 ,"s.shelf_code = '".addslashes($_GET['key'])."' ");
		 ?>
			 <label for="edit_shelf_detail">shelf No : <?= addslashes($_GET['key'])?>  <?php echo @$getcattt->shelf_detail;?> &nbsp; ชั้น &nbsp;<?php echo @$getcattt->shelf_class;?></label>
		 </div>
	 </div>

 <div class="table-responsive">
  <!-- Table -->
  <table width="100%" class="table table-striped table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="70%" bgcolor="#5fb760">รหัสสินค้า 5555</th>
    <th width="20%" bgcolor="#5fb760">จำนวนบรรจุ </th>
  </tr>
  </thead>
  <tbody>
  <?php
  while($showproduct = mysql_fetch_object($getctype_detail)){
	  
	  if($showproduct->TypeID == '1'){
		$gettype = "ล้อแม๊ก ".$showproduct->BrandName." รุ่น:".$showproduct->gen." ขนาด:".$showproduct->diameterWheel." ขอบ:".$showproduct->whediameter." รู:".$showproduct->holeSize." ประเภท:".$showproduct->typeFormat." <br>ยี่ห้อ:".$showproduct->BrandName." offset:".$showproduct->offset." สี: ".$showproduct->color." รุ่น: ".$showproduct->gen ;
	  }else if($showproduct->TypeID == '2'){
		$gettype = "ยาง ".$showproduct->BrandName." ขนาด:".$showproduct->diameterRubber." ขอบ:".$showproduct->rubdiameter." ซี่รี่:".$showproduct->series." ความกว้าง:".$showproduct->width." ยี่ห้อ:".$showproduct->BrandName." กลุ่มยาง: ".$showproduct->groudRubber
		." <br>สัปดาห์: ".$showproduct->productionWeek." ปี: ".$showproduct->productionYear." รุ่น: ".$showproduct->genRubber." ดัชนีความเร็ว: ".$showproduct->speedIndex." ดัชนีน้ำหนัก: ".$showproduct->weightIndex;
	  }else{
		$gettype = "";
	  }
  ?>
  <tr>
    <td><?php echo @$showproduct->proId;?> <?php echo @$gettype;?> </td>
    <td align="right"><?php echo @$showproduct->rimit;?> &nbsp; ชิ้น</a></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</div>
<div class="modal-footer">
				<button type="button" onclick="closesmodal()" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>

		</div>

<script language="javascript">
 $(document).ready(function(){
	 $('#save_edit_card').click(function(){
				var r = confirm("ต้องการแก้ไขข้อมูล ?");
		    if (r == true) {
					return true;
				}else{
					return false;
				}
			});
   	});

		 function closesmodal(){
			//$('#detailShelf').dialog("close");
			window.location="../dashboard?p=setting_shelf1";
		 }


</script>
