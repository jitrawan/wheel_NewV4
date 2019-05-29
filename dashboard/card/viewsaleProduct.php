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

$card_detail = $getdata->my_sql_query(NULL,"reserve_info","reserve_key='".addslashes($_GET['key'])."'");
?>
<div class="modal-body" style="max-height: calc(100% - 120px); overflow-y: scroll;">
<div id="paper">
  <div>
	<table width="100%">

    <tr>
			<td>วันที่ใบเสร็จ <?php echo $card_detail->create_date;?></td>
			<td align="right"></td>
		</tr>
    <tr>
			<td>เลขที่ใบเสร็จรับเงิน : <?php echo $card_detail->reserve_code?></td>
			<td align="right"></td>
		</tr>
    <tr>
			<td>พนักงาน : <?php echo $_SESSION['uname']?></td>
			<td align="right"></td>
		</tr>
    <tr>
			<td></td>
			<td align="right"></td>
		</tr>

	</table>

<div class="table-responsive">
  <table width="100%" border="0" class="table table-bordered">
  <thead>
<tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
<td width="30%" align="center">รายการ </td>
      <td width="15%" align="center">จำนวน </td>
      <td width="15%" align="center">ราคา </td>
      <td width="15%" align="center">discount </td>
			<td width="15%" align="center">รวม</td>
</tr>
</thead>
<tbody>
  <?

$productInfo = $getdata->my_sql_select("i.*,p.*, r.*, w.* ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
,case
	when p.TypeID = '2'
	then (select b.BrandName from brand b where r.brand = b.BrandID)
	end BrandName "
," reserve_item i
   left join product_N p on p.ProductID = i.ProductID
   left join productDetailWheel w on p.ProductID = w.ProductID
	 left join productDetailRubber r on p.ProductID = r.ProductID "
," i.reserve_key='".addslashes($_GET['key'])."' ");

	//$productInfo = $getdata->my_sql_select("i.* , p.* ","reserve_item i left join product_n p on i.ProductID = p.ProductID "," i.reserve_key='".addslashes($_GET['key'])."' ");
  if(mysql_num_rows($productInfo) > 0){
		while($objpro = mysql_fetch_object($productInfo)){
			if($objpro->TypeID == '1'){
        $gettype = "ล้อแม๊ก"." ขนาด:".$objpro->diameterWheel." ขอบ:".$objpro->whediameter." รู:".$objpro->holeSize." ประเภท:".$objpro->typeFormat;
      }else if($objpro->TypeID == '2'){
        $gettype = "ยาง ".$objpro->BrandName." ขนาด:".$objpro->diameterRubber." ขอบ:".$objpro->rubdiameter." ซี่รี่:".$objpro->series." ความกว้าง:".$objpro->width;
      }else{
        $gettype = "";
      }
?>
   <tr>
			<td>
			<?php echo $objpro->ProductID?> <?php echo @$gettype;?></td>
      <td align="center"><?php echo $objpro->item_amt?></td>
      <td align="right"><?php echo convertPoint2($objpro->item_price,2)?> </td>
      <td align="right"><?php echo convertPoint2($objpro->item_discount,2)?></td>
			<td align="right"><?php echo convertPoint2($objpro->item_total,2)?></td>
		</tr>
	<?php
		}
		?>
			<tr>
			<td colspan="4" align="right">จำนวนเงิน</td>
			<td align="right"><?php echo convertPoint2($card_detail->reserve_total,2)?></td>
		</tr>
		<tr>
			<td colspan="4" align="right">รวมราคาทั้งสิน</td>
			<td align="right"><?php echo convertPoint2($card_detail->reserve_total,2)?></td>
		</tr>

    <tr>
			<td colspan="4" align="right">VATAble</td>
      <td align="right"><?php echo convertPoint2($card_detail->reserve_total,2)?></td>
		</tr>
    <tr>
      <?
      $gettax = ($card_detail->reserve_total * 7)/100;
      ?>
			<td colspan="4" align="right">VAT 7.00%</td>
      <td align="right"><?php echo convertPoint2($gettax,2)?></td>
		</tr>
		<?
  }else{
    ?>
<tr>
  <th colspan="5" style="text-align: center;">ไม่พบข้อมูล</th>
</tr>
<?}?>

</tbody>

</table>

</div>
<h4 align="left">*รับประกันสินค้า 15 วัน หลังการซื้อ</h4>
  <table width="100%">

    <tr>
			<td>เริ่มประกัน : <?php echo $card_detail->create_date?></td>
			<td></td>
		</tr>
    <tr>
			<td>สิ้นสุดประกัน : <?php echo Date("Y-m-d", strtotime($card_detail->create_date." +15 Day"));?></td>
			<td></td>
		</tr>


	</table>
  <br><br>

</div>
</div>
</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
</div>
