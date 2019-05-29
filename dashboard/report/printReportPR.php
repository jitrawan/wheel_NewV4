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
</style>

<b> </b>
<h2 style="text-align:center">รายงานรับสินค้าเข้า</h2>
<p style="text-align:center"><b>ร้านล้อยางไว้ใจผม</b></p>
<p style="text-align:center"><b>รายงาน ณ วันที่ '.date("d-m-Y").' </b></p>';
$str_sql = "";
if(htmlentities($_GET['from']) && htmlentities($_GET['to'])){
		$str_sql  .= "datedo BETWEEN '".htmlentities($_GET['from'])."' and '".htmlentities($_GET['to'])."' ";
    $head .= '<p style="text-align:center"><b>วันที่รับสินค้าเข้า ระหว่าง : '.date("d-m-Y", strtotime($_GET['from'])).' ถึง วันที่ : '.date("d-m-Y", strtotime($_GET['to'])).' </b></p>';

}
$head .= '<table>
    <tr>
		<th width="5%">ลำดับ</th>
		<th width="10%">รหัสสินค้า </th>
		<th width="30%" style="text-align: center;">รายละเอียด </th>
		<th width="10%">จำนวน</th>
		<th width="10%">ราคา</th>
    </tr>
</thead>';

$GroupType = $getdata->my_sql_select(" datedo  "," stock_tb_receive_master r ","   $str_sql Group by datedo Order by datedo ");
$content = "";
$sumAll = 0;
$sumamt3=0;
if (mysql_num_rows($GroupType) > 0) {
        while($row = mysql_fetch_object($GroupType)) {
          $gettype = "";
							$content .= '<tr style="font-weight:bold; color:#FFF; background:#A9A9A9;">
														<td colspan="5">&nbsp;&nbsp;<b>วันที่รับสินค้า : '.@$row->datedo.'</b></td>
												</tr>';

$Grouppo = $getdata->my_sql_select(" r.po ,( select COUNT(d.no) FROM stock_tb_receive_master_sub d WHERE r.po = d.po ) as sum "," stock_tb_receive_master r ","  r.datedo = '".$row->datedo."' Group by r.po Order by r.po ");

if (mysql_num_rows($Grouppo) > 0) {
	$getsumbyday = 0;
	$sumamt2=0;
			while($rowPo = mysql_fetch_object($Grouppo)) {
						if(@$rowPo->sum > 0){

								$content .= '<tr style="font-weight:bold; color:#FFF; background:#8e8a8a;">
		                          <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;<b>เลขที่ใบรับสินค้า :  '.@$rowPo->po.'</b></td>
		                      </tr>';

										            $DetailProduct = $getdata->my_sql_select(" s.*, p.*, r.*, w.* ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter,w.gen as genWheel
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
										            ," stock_tb_receive_master_sub s
																left join product_N p on p.ProductID = s.ProductID
										            left join productDetailWheel w on p.ProductID = w.ProductID
										            left join productdetailrubber r on p.ProductID = r.ProductID "
										            ," s.po = '".@$rowPo->po."' ORDER BY  s.ProductID");

										            if(mysql_num_rows($DetailProduct) > 0){
																	$sumbyproductID = 0;
																	$sumamt1=0;
																	$i = 1;
																  while($showDetailProduct = mysql_fetch_object($DetailProduct)){

										                    if($showDetailProduct->TypeID == '1'){
										                      $gettype = $showDetailProduct->BrandName." รุ่น:".$showDetailProduct->genWheel." ขนาด:".$showDetailProduct->diameterWheel." ขอบ:".$showDetailProduct->whediameter." รู:".$showDetailProduct->holeSize." ประเภท:".$showDetailProduct->typeFormat;
										                    }else if($showDetailProduct->TypeID == '2'){
										                      $gettype = $showDetailProduct->BrandName." ขนาด:".$showDetailProduct->diameterRubber." ขอบ:".$showDetailProduct->rubdiameter." ซี่รี่:".$showDetailProduct->series." ความกว้าง:".$showDetailProduct->width;
										                    }else{
										                      $gettype = "";
										                    }
																				$sumprice = $showDetailProduct->PriceSale * $showDetailProduct->total;
																				$sumbyproductID = $sumbyproductID + $sumprice;
																				$getsumbyday = $getsumbyday + $sumprice;
																				$sumAll = $sumAll + $sumprice;
																				$sumamt1 = $sumamt1 + $showDetailProduct->total;
										                $content .='<tr>
																			<td align="center"><strong>'.@$i.'</strong></td>
										                  <td align="center"><strong>'.@$showDetailProduct->code.'</strong></td>
										                  <td><strong>'.@$gettype.'</strong></td>
										                  <td valign="middle" style=" text-align: center;"><strong>'.@convertPoint2($showDetailProduct->total,'0').'&nbsp;ชิ้น</strong></td>
										                  <td valign="middle" style=" text-align: right;"><strong>'.@convertPoint2($sumprice,'2').'&nbsp;</strong></td>
										                </tr>';
																		$i ++;
																		

										              }
																	$content .='<tr style="text-align: right; background:#525050;">
																	<td style="color: white; text-align: right;" colspan="3">รวมจำนวน/ใบรับสินค้า</td>
																	<td valign="middle" style=" text-align: center; color: white;"><strong>'.@convertPoint2($sumamt1,'0').'&nbsp;ชิ้น</strong></td>
																	<td valign="middle" style=" text-align: right; color: white;"><strong>'.@convertPoint2($sumbyproductID,'2').'</strong></td>
																	</tr>';
																}
																
																
										}
										
							}
							$sumamt2 = $sumamt2 + $sumamt1;

						}
						$content .='<tr style="text-align: right; background:#525050;">
						<td style="color: white; text-align: right;" colspan="3">รวมจำนวน/วัน</td>
						<td valign="middle" style=" text-align: center; color: white;"><strong>'.@convertPoint2($sumamt2,'0').'&nbsp;ชิ้น</strong></td>
						<td valign="middle" style=" text-align: right; color: white;"><strong>'.@convertPoint2($getsumbyday,'2').'</strong></td>
				    </tr>';
				}
				
				$sumamt3 = $sumamt3 + $sumamt2;

    }
		$content .='<tr style="text-align: right; background:#A9A9A9;">
		<td style="color: white; text-align: right;" colspan="3">รวมจำนวนทั้งสิ้น</td>
		<td valign="middle" style=" text-align: center; color: white;"><strong>'.@convertPoint2($sumamt3,'0').'&nbsp;ชิ้น</strong></td>
		<td valign="middle" style=" text-align: right; color: white;"><strong>'.@convertPoint2($sumAll,'2').'</strong></td>
		</tr>';


$content .= '<tbody>';

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
