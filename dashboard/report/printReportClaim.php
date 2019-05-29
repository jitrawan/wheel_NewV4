<?php session_start();
error_reporting(0);?>
<?php
include("mpdf/mpdf.php");
//require("../../../vendor/autoload.php");
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
//include("mpdf/mpdf.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();

use mPDF;
$mpdf = new mPDF('th', 'A4-L', '0', 'THSaraban');
$head = '
<style>
	body{
		font-family: "Garuda";//เรียกใช้font Garuda สำหรับแสดงผล ภาษาไทย
		padding: 8px;
	}
  table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
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
$getGroup = "";
$getdateclaim = "";
if(isset($_GET['Group'])){
	if(addslashes($_GET['Group']) == '1'){
		$getGroup = 'ประเภท';
	}else if(addslashes($_GET['Group']) == '2'){
			$getGroup = 'สถานะ';
	}else{
			$getGroup = 'รหัสสินค้า';
	}

  if(addslashes($_GET['key']) != 0){
    $str_sql  .= " And TypeID = '".$_GET['key']."' ";
  }

}

$head .= '<b> </b>
					<h2 style="text-align:center">รายงานการเคลม</h2>
					<p style="text-align:center"><b>ร้านล้อยางไว้ใจผม</b></p>
<p style="text-align:center"><b>รายงาน ณ วันที่ '.date("d/m/Y").' </b></p>';

if($_GET['datefrom'] != "" && $_GET['dateto'] != ""){
	$head .= '<p style="text-align:center"><b>วันที่เคลม ระหว่าง '.date("d/m/Y",strtotime($_GET['datefrom'])).'  ถึง '.date("d/m/Y",strtotime($_GET['dateto'])).' </b></p>';
}

if($_GET['status'] != ""){
   $getcard = $getdata->my_sql_query("ctype_name","card_type","ctype_key = 'c382e352e2e620a3c60a2cc7c6a7fa35' ");

		$head .= '<p style="text-align:center"><b>สถานะ : '.$getcard->ctype_name.' </b></p>';
}

$head .= '<table>';

$head .= '<tr style="font-weight:bold; color:#FFF; background:#777777;">
										<td colspan="5">&nbsp;&nbsp;<b>เคลมสินค้า</b></td>
								</tr>

           <tr>
                <th width="12%">รหัสสินค้า</th>
                <th width="30%">รายละเอียด</th>
                <th width="30%" >สาเหตุ</th>
                <th width="10%">จำนวน</th>
                <th width="10%">วันที่เคลม</th>
            </tr>
</thead>';

$content = "";
$strsql = "";
$str_hand = "";
$str_type = "";

if(htmlentities($_GET['search_hand']) != "0"){
		$str_hand .= 'and p.hand ='.htmlentities($_GET['search_hand']).' ';
}

if(htmlentities($_GET['search_type']) != "0"){
		$str_type .= 'and p.TypeID ='.htmlentities($_GET['search_type']).' ';
}

if($_GET['status'] != ""){
$strsql .= "and card_insert BETWEEN '".htmlentities($_GET['datefrom'])."' and '".htmlentities($_GET['dateto'])."'";
}
if($_GET['status'] != ""){
	$strsql .= "and card_status = '".$_GET['status']."' ";
}

$getGroup = $getdata->my_sql_select("card_code, card_key "
,"card_info"
," card_status != '' $strsql  Group by card_code ,card_key");
while($row = mysql_fetch_object($getGroup)){
/*$content .= '<tr style="font-weight:bold; color:#FFF; background:#A9A9A9;">
<td colspan="5">&nbsp;&nbsp;<b>เลขที่ใบเคลม : '.$row->card_code.' </b></td>
</tr>';*/
				$getDetail = $getdata->my_sql_select(Null
				,"card_item c
				left join product_N p on p.ProductID =
				(select pp.ProductID
				FROM product_N pp
				left join productDetailWheel w on pp.ProductID = w.ProductID
				left join productdetailrubber r on pp.ProductID = r.ProductID
				where (w.code = c.reseve_item_key or r.code = c.reseve_item_key) )
				left join productDetailWheel w on p.ProductID = w.ProductID
				left join productdetailrubber r on p.ProductID = r.ProductID "
				," c.card_key = '".$row->card_key."'  $str_hand $str_type Order by c.item_insert ");
				if(mysql_num_rows($getDetail) > 0){
						while($rowD = mysql_fetch_object($getDetail)){
							$content .='<tr>
								<td align="center"><strong>'.@$rowD->reseve_item_key.'</strong></td>
								<td align="left"><strong>'.@$rowD->item_name.'</strong></td>
								<td align="left"><strong></strong>'.@$rowD->item_note.'</td>
								<td valign="middle" style=" text-align: center;"><strong>'.@$rowD->item_amt.'&nbsp;ชิ้น</strong></td>
								<td valign="middle" ><strong>'.@$rowD->item_insert.'</strong></td>
							</tr>';
						}

				}

}

    $content .='<tr style="font-weight:bold; color:#FFF; background:#A9A9A9;">
    <th colspan="5" style=" height: 15px;"></th>
    </tr>
		</table>
    <br>';


    $head2 = '<table>';

    $head2 .= '<tr style="font-weight:bold; color:#FFF; background:#777777;">
                <td colspan="5">&nbsp;&nbsp;<b>เปลี่ยนสินค้า</b></td>
            </tr>
            <tr>
			        <th width="12%">รหัสสินค้า</th>
			        <th width="40%">รายละเอียด</th>
			        <th width="10%" >สาเหตุ</th>
			        <th width="10%">จำนวน</th>
              <th width="10%">วันที่เปลี่ยน</th>
			    </tr>
      </thead>';
      $getchangeData  = $getdata->my_sql_select("reserve_key","changeproduct"," reserve_key != '' and createDate BETWEEN '".htmlentities($_GET['datefrom'])."' and '".htmlentities($_GET['dateto'])."' group by reserve_key ");
      while($rowchange = mysql_fetch_object($getchangeData)){
      $getreserve_key = $getdata->my_sql_query("reserve_code","reserve_info"," reserve_key = '".$rowchange->reserve_key."' ");

$content2 .= '<tr style="font-weight:bold; color:#FFF; background:#A9A9A9;">
<td colspan="5">&nbsp;&nbsp;<b>เลขที่ใบเสร็จ : '.$getreserve_key->reserve_code.'</b></td>
</tr>';

$getDetailC = $getdata->my_sql_select("c.*,p.*, r.*, w.* ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
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
	,"changeproduct c
	left join product_N p on p.ProductID = c.ProductID
	left join productDetailWheel w on p.ProductID = w.ProductID
	left join productDetailRubber r on p.ProductID = r.ProductID "
	," c.reserve_key = '".$rowchange->reserve_key."'  ");
if(mysql_num_rows($getDetailC) > 0){
		while($rowC = mysql_fetch_object($getDetailC)){
			if($rowC->TypeID == '1'){
				$gettype = "ล้อแม๊ก ".$rowC->BrandName." ขนาด:".$rowC->diameterWheel." ขอบ:".$rowC->whediameter." รู:".$rowC->holeSize." ประเภท:".$rowC->typeFormat;
			}else if($rowC->TypeID == '2'){
				$gettype = "ยาง ".$rowC->BrandName." ขนาด:".$rowC->diameterRubber." ขอบ:".$rowC->rubdiameter." ซี่รี่:".$rowC->series." ความกว้าง:".$rowC->width;
			}else{
				$gettype = "";
			}
			$content2 .='<tr>
				<td align="center"><strong>'.@$rowC->code.'</strong></td>
				<td align="left"><strong>'.@$gettype.'</strong></td>
				<td align="left"><strong></strong>'.@$rowC->remark.'</td>
				<td valign="middle" style=" text-align: center;"><strong>'.@$rowC->change_Amt.'&nbsp;ชิ้น</strong></td>
				<td valign="middle" ><strong>'.@$rowC->createDate.'</strong></td>
			</tr>';
		}

}

      }

			$content2 .='<tr style="font-weight:bold; color:#FFF; background:#A9A9A9;">
	    <th colspan="5" style=" height: 15px;"></th>
	    </tr>
			</table>';

$end = '
<div class="footer">
 <p style="margin-right: 10px; color: #bbb7b7;">@รายงานร้านยางไว้ใจผม</p>
</div>';



$mpdf->WriteHTML($head);
$mpdf->WriteHTML($content);
$mpdf->WriteHTML($head2);
$mpdf->WriteHTML($content2);

$mpdf->WriteHTML($end);

$mpdf->Output();
?>
