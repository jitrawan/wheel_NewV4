<?php session_start();
error_reporting(0);?>
<?php
include("mpdf/mpdf.php");
//require("../../../vendor/autoload.php");
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();

use mPDF;
$mpdf = new mPDF('th', 'A4-L', '0', 'THSaraban');
$head = '
<style>
	body{
		font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
	}
  table {
  border-collapse: collapse;
  width: 100%;
}

th {
  text-align: center;
  padding: 8px;
}

td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #465246;
  color: white;
}
.footer {
  font-size: 14px;
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   color: black;
   text-align: right;
}
</style>';
	$str_sql = "";

	$str_hand = "";
	$str_type = "";

	if(htmlentities($_GET['search_hand']) != "0"){
			$str_hand .= 'and p.hand ='.htmlentities($_GET['search_hand']).' ';
	}

	if(htmlentities($_GET['search_type']) != "0"){
			$str_type .= 'and p.TypeID ='.htmlentities($_GET['search_type']).' ';
	}

if(htmlentities($_GET['Typereport']) == "2"){
	if(htmlentities($_GET['pop']) == "d"){
		$head .= '<b> </b>
							<h2 style="text-align:center">รายงานการขายสินค้าประจำวัน</h2>
							<p style="text-align:center"><b>ร้านล้อยางไว้ใจผม</b></p>
							<p style="text-align:center"><b>รายงานการขาย วันที่ '.htmlentities($_GET['fromd']).'</b></p>';
		$str_sql  .= "create_date = '".htmlentities($_GET['fromd'])."'";
	}else if(htmlentities($_GET['pop']) == "m"){
		$strmont = "";
		if(htmlentities($_GET['typeM']) == '1'){
				$strmont = "มกราคม";
		}else if(htmlentities($_GET['typeM']) == '2'){
				$strmont = "กุมภาพันธ์";
		}else if(htmlentities($_GET['typeM']) == '3'){
				$strmont = "มีนาคม";
		}else if(htmlentities($_GET['typeM']) == '4'){
				$strmont = "เมษายน";
		}else if(htmlentities($_GET['typeM']) == '5'){
				$strmont = "พฤษภาคม";
		}else if(htmlentities($_GET['typeM']) == '6'){
				$strmont = "มิถุนายน";
		}else if(htmlentities($_GET['typeM']) == '7'){
				$strmont = "กรกฎาคม";
		}else if(htmlentities($_GET['typeM']) == '8'){
				$strmont = "สิงหาคม";
		}else if(htmlentities($_GET['typeM']) == '9'){
				$strmont = "กันยายน";
		}else if(htmlentities($_GET['typeM']) == '10'){
				$strmont = "ตุลาคม";
		}else if(htmlentities($_GET['typeM']) == '11'){
				$strmont = "พฤศจิกายน";
		}else if(htmlentities($_GET['typeM']) == '12'){
				$strmont = "ธันวาคม";
		}

		//if
		$head .= '<b> </b>
							<h2 style="text-align:center">รายงานการขายสินค้าประจำเดือน</h2>
							<p style="text-align:center"><b>ร้านล้อยางไว้ใจผม</b></p>
							<p style="text-align:center"><b>ประจำเดือน '.$strmont.' ปี '.htmlentities($_GET['y']).'</b></p>';
							$str_sql  .= "DATE_FORMAT(create_date,'%c') = '".htmlentities($_GET['typeM'])."' and DATE_FORMAT(create_date,'%Y') = '".htmlentities($_GET['y'])."'";
	}if(htmlentities($_GET['pop']) == "y"){
		$head .= '<b> </b>
							<h2 style="text-align:center">รายงานการขายสินค้าประจำปี</h2>
							<p style="text-align:center"><b>ร้านล้อยางไว้ใจผม</b></p>
							<p style="text-align:center"><b>ประจำปี '.htmlentities($_GET['typeY']).'</b></p>';
							$str_sql  .= "DATE_FORMAT(create_date,'%Y') = '".htmlentities($_GET['typeY'])."'";
	}

$head .= '<table>
			<tr>
			<th width="5%">ลำดับ</th>
			<th width="10%">รหัสสินค้า </th>
			<th width="30%" style="text-align: center;">รายละเอียด </th>
			<th width="10%">จำนวน</th>
			</tr>
	</thead>';

	$GroupType = $getdata->my_sql_select(" r.ProductID,sum(item_amt) as sumamt "
	," reserve_item r
	left join product_N p on p.ProductID = r.ProductID  "
	," $str_sql  $str_hand $str_type
	Group by ProductID  ORDER by sumamt desc ");
	$content = "";
	$i = 1;
	$sumtotal = 0;
	while($row = mysql_fetch_object($GroupType)) {
		$showDetailProduct = $getdata->my_sql_query(" p.*, r.*, w.* ,r.code as rcode , w.code as wcode ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
		," product_N p
		left join productDetailWheel w on p.ProductID = w.ProductID
		left join productdetailrubber r on p.ProductID = r.ProductID "
		," p.ProductID = '".$row->ProductID."' ");




				if($showDetailProduct->TypeID == '1'){
				 $getcode = $showDetailProduct->wcode;
				 $gettype = $showDetailProduct->BrandName." ขนาด:".$showDetailProduct->diameterWheel." ขอบ:".$showDetailProduct->whediameter." รู:".$showDetailProduct->holeSize." ประเภท:".$showDetailProduct->typeFormat;
				}else if($showDetailProduct->TypeID == '2'){
				 $getcode = $showDetailProduct->rcode;
				 $gettype = $showDetailProduct->BrandName." ขนาด:".$showDetailProduct->diameterRubber." ขอบ:".$showDetailProduct->rubdiameter." ซี่รี่:".$showDetailProduct->series." ความกว้าง:".$showDetailProduct->width;
				}else{
				 $gettype = "";
				}

		$content .='<tr>
		<td align="center"><strong>'.@$i.'</strong></td>
		<td align="center"><strong>'.@$getcode.'</strong></td>
		<td><strong>'.$gettype.'</strong></td>
		<td valign="middle" style=" text-align: right;"><strong>'.@convertPoint2($row->sumamt,'0').'&nbsp;ชิ้น</strong></td>
		</tr>';
		$sumtotal = $sumtotal + $row->sumamt;
		$i++;
	}
	$content .='<tr style="text-align: right; background:#525050;">
	<td style="color: white; text-align: right;" colspan="3">รวมจำนวน</td>
	<td valign="middle" style=" text-align: right; color: white;"><strong>'.@convertPoint2($sumtotal,'0').'&nbsp;ชิ้น</strong></td>
	</tr>';
	$content .='<tr>
	<th colspan="4"></th>
	</tr>';
}else{
	$head .= '<b> </b> <h2 style="text-align:center">รายงานการขาย </h2>
	<p style="text-align:center"><b>ร้านล้อยางไว้ใจผม</b></p>
	<p style="text-align:center"><b>รายงาน ณ วันที่ '.date("d-m-Y").' </b></p>';
	$str_sql = "";
	if(htmlentities($_GET['from'])){
			$str_sql  .= "create_date  BETWEEN '".htmlentities($_GET['from'])." 00:00:00' and  '".htmlentities($_GET['dateto'])." 23:59:59'";
	    $head .= '<p style="text-align:center"><b>วันที่ขาย ระหว่าง : '.date("d-m-Y", strtotime($_GET['from'])).'  ถึง '.date("d-m-Y", strtotime($_GET['dateto'])).' </b></p>';

	}
	$head .= '<table>
		    <tr>
				<th width="5%">ลำดับ</th>
				<th width="10%">รหัสสินค้า </th>
				<th width="10%">สินค้า </th>
				<th width="10%">ชนิดสินค้า </th>
				<th width="30%" style="text-align: center;">รายละเอียด </th>
				<th width="10%">จำนวน</th>
				<th width="10%">ราคา/ชิ้น</th>
				<th width="10%">ลดราคา</th>
				<th width="10%">รวมเงิน</th>
		    </tr>
		</thead>';

	$GroupType = $getdata->my_sql_select(" r.ProductID,sum(item_amt) as sumamt,sum(item_discount * item_amt) as discout "
	," reserve_item r
	left join product_N p on p.ProductID = r.ProductID  "
	," $str_sql  $str_hand $str_type
	Group by ProductID  ORDER by sumamt desc ");
	$content = "";
	$getDiscout = 0;
	$getsumamt = 0;
	$getsumdiscout = 0;
	$getsumprict = 0;
	$i = 1;
	while($row = mysql_fetch_object($GroupType)) {

		$showDetailProduct = $getdata->my_sql_query(" p.*,p.hand as hand, r.*, w.* ,r.code as rcode , w.code as wcode ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
		," product_N p
		left join productDetailWheel w on p.ProductID = w.ProductID
		left join productdetailrubber r on p.ProductID = r.ProductID "
		," p.ProductID = '".$row->ProductID."' ");



			$settype = "";
				if($showDetailProduct->TypeID == '1'){
					$settype = "ล้อแม็ก";
				 $getcode = $showDetailProduct->wcode;
				 $gettype = $showDetailProduct->BrandName." ขนาด:".$showDetailProduct->diameterWheel." ขอบ:".$showDetailProduct->whediameter." รู:".$showDetailProduct->holeSize." ประเภท:".$showDetailProduct->typeFormat;
				}else if($showDetailProduct->TypeID == '2'){
					$settype = "ยาง";
				 $getcode = $showDetailProduct->rcode;
				 $gettype = $showDetailProduct->BrandName." ขนาด:".$showDetailProduct->diameterRubber." ขอบ:".$showDetailProduct->rubdiameter." ซี่รี่:".$showDetailProduct->series." ความกว้าง:".$showDetailProduct->width;
				}else{
				 $gettype = "";
				}


		$content .='<tr>
		<td align="center"><strong>'.@$i.'</strong></td>
		<td align="center"><strong>'.@$getcode.'</strong></td>
		<td align="center"><strong>'.@$settype.'</strong></td>
		<td align="center"><strong>มือ '.@$showDetailProduct->hand.'</strong></td>
		<td><strong>'.$gettype.'</strong></td>
		<td valign="middle" style=" text-align: right;"><strong>'.@convertPoint2($row->sumamt,'0').'&nbsp;ชิ้น</strong></td>
		<td valign="middle" style=" text-align: right;"><strong>'.@convertPoint2($showDetailProduct->PriceSale,'2').'&nbsp;</strong></td>

			<td valign="middle" style=" text-align: right;"><strong>'.@convertPoint2($row->discout,'0').'&nbsp;</strong></td>
				<td valign="middle" style=" text-align: right;"><strong>'.@convertPoint2(	($showDetailProduct->PriceSale * $row->sumamt) - $row->discout,'2').'&nbsp;</strong></td>

		</tr>';

		$getsumamt = $getsumamt + $row->sumamt;
		$getsumdiscout = $getsumdiscout + $row->discout;
		$getsumprict = $getsumprict + ($showDetailProduct->PriceSale * $row->sumamt) - $row->discout;

		$i++;
	}
	$content .='<tr style="text-align: right; background:#525050;">
							<td style="color: white; text-align: right;" colspan="5">รวม</td>
							<td valign="middle" style=" text-align: right; color: white;"><strong>'.@convertPoint2($getsumamt,'0').'&nbsp;ชิ้น</strong></td>
							<td valign="middle" style=" text-align: right; color: white;"><strong></strong></td>
							<td valign="middle" style=" text-align: right; color: white;"><strong>'.@convertPoint2($getsumdiscout,'2').'</strong></td>
								<td valign="middle" style=" text-align: right; color: white;"><strong>'.@convertPoint2($getsumprict,'2').'</strong></td>
							</tr>';



}



$end = '</tbody>
</table>
<div class="footer">
 <p style="margin-right: 10px; color: #bbb7b7;">@รายงานร้านยางไว้ใจผม</p>
</div>';



$mpdf->WriteHTML($head);
$mpdf->WriteHTML($content);
$mpdf->WriteHTML($end);

$mpdf->Output();
?>
