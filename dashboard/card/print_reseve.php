<?php session_start();error_reporting(0);?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();
date_default_timezone_set('Asia/Bangkok');
$getmember_info = $getdata->my_sql_query(NULL,"user","user_key='".$_SESSION['ukey']."'");
$card_detail = $getdata->my_sql_query(NULL,"reserve_info","reserve_key='".addslashes($_GET['key'])."'");
			if(isset($_GET['type'])){
					$str = 'Reprint';
					$reprintReserveKey=md5($card_detail->reserve_key.time("now"));
					$getdata->my_sql_insert("reprint_reserve"," reprintReserveKey='".$reprintReserveKey."'
					,reserve_key='".$card_detail->reserve_key."'
					,createDate=NOW()
					,createBy='".$_SESSION['ukey']."' ");
			}

  //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = '../../plugins/phpqrcode/temp/';
    $PNG_WEB_DIR = '../../plugins/phpqrcode/temp/';
    require("../../plugins/phpqrcode/qrlib.php");


?>
<title><? echo $str ?>  <?php echo @$card_detail->reserve_no;?></title>
<link href="../../css/bootstrap.min.css" rel="stylesheet">
 <link href="../../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../css/iconset/ios7-set-filled-1/flaticon.css" rel="stylesheet" type="text/css">
     <link href="../../css/sb-admin-2.css" rel="stylesheet">

</head>
<style type="text/css" media="print">
#paper
{
	width: 21cm;
	min-height: 25cm;
	padding: 2.5cm;
	position: relative;

}
</style>

<style type="text/css" media="screen">
#paper
{
	background: #FFF;
	border: 1px solid #666;
	margin: 20px auto;
	width: 21cm;
	min-height: 25cm;
	padding: 50px;
	position: relative;


	/* CSS3 */

	box-shadow: 0px 0px 5px #000;
	-moz-box-shadow: 0px 0px 5px #000;
	-webkit-box-shadow: 0px 0px 5px #000;
}
</style>
<style type="text/css" >
table {
  border-collapse: collapse;
}

body{
	font-family:'thaisansliter1',sans-serif;
	font-size:14px;
}
.tt {
  border: 1px solid black;
}

@media print {
    .footerx{page-break-after: always;}
	body {-webkit-print-color-adjust: exact;}

}

#paper textarea
{
	margin-bottom:25px;
	width: 50%;
}
#paper table, #paper th, #paper td { border: none; }
#paper table.border, #paper table.border th, #paper table.border td { border: 1px solid #666; }
#paper th
{
	background: none;
	color: #000
}
#paper hr { border-style: solid; }
#signature
{
	bottom: 181px;
	margin: 50px;
	padding: 50px;
	position: absolute;
	right: 3px;
	text-align: center;
}

</style>

</head>

<body onLoad="javascript:window.print();">
<div id="paper">
  <div>
	<table width="100%">
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><h1 align="center">ใบเสร็จรับเงิน</h1></td>
		</tr>
		<tr>
			<td width="50%" align="left" >ร้านล้อยาง ไว้ใจผม</td>
			<td width="50%"  align="left" >เลขที่ใบเสร็จรับเงิน : <?php echo $card_detail->reserve_no?></td>
		</tr>
		<tr>
			<td align="leftleft">188/3 ถ.สายลวด ต.ปากน้ำ อ.เมือง จ.สมุทรปราการ 10270</td>
				<td width="50%"  align="left" >วันที่ใบเสร็จ <?= date("d-m-Y h:i:s", strtotime(@$card_detail->create_date));?></td>
		</tr>
		<tr>
			<td align="left">โทร 080-986-8795</td>
			<td align="left"></td>
		</tr>
		<tr>
			<td>พนักงาน : <?php echo @$getmember_info->name;?> <?php echo @$getmember_info->lastname;?></td>
			<td align="right"></td>
		</tr>
		<?if(@$card_detail->name != "" && @$card_detail->lname){?>
		<tr>
			<td>ชื่อลูกค้า : <?php echo @$card_detail->name;?> <?php echo @$card_detail->lname;?></td>
			<td align="right"></td>
		</tr>
<?	} ?>
<?if(@$card_detail->company != ""){?>
<tr>
	<td>บริษัทลูกค้า : <?php echo @$card_detail->company;?></td>
	<td align="right"></td>
</tr>
<?	} ?>
<?if(@$card_detail->address != ""){?>
<tr>
	<td>ที่อยู่ลูกค้า : <?php echo @$card_detail->address;?></td>
	<td align="right"></td>
</tr>
<?	} ?>
    <tr>
			<td></td>
			<td align="right"></td>
		</tr>

	</table>
	<br>
  <table width="100%" style="border: 1px solid black">
  <tr  style="border: 1px solid black">
		<td width="3%" align="center"  style="border: 1px solid black">ลำดับ </td>
			<td width="30%" align="center"  style="border: 1px solid black">รายการ </td>
      <td width="10%" align="center"  style="border: 1px solid black">จำนวน </td>
      <td width="10%" align="right"  style="border: 1px solid black">ราคา/หน่วย &nbsp;</td>
      <td width="10%" align="right"  style="border: 1px solid black">จำนวนเงิน &nbsp;</td>
		</tr>

  <!--tr>
		<td colspan="5">==================================================================================================================================</td>
	</tr-->

  <?
	$productInfo = $getdata->my_sql_select("i.*,p.*, r.*, w.* ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter,w.gen as genWheel
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
	," reserve_item i
		 left join product_N p on p.ProductID = i.ProductID
		 left join productDetailWheel w on p.ProductID = w.ProductID
		 left join productDetailRubber r on p.ProductID = r.ProductID "
	," i.reserve_key='".addslashes($_GET['key'])."' ");
  //$productInfo = $getdata->my_sql_select("i.* , p.* ","reserve_item i left join product_n p on i.ProductID = p.ProductID "," i.reserve_key='".addslashes($_GET['key'])."' ");
$x = 1;
$getsumdiscount = 0;
	while($objpro = mysql_fetch_object($productInfo)){
		if($objpro->TypeID == '1'){
			$gettype = "ล้อแม๊ก ".$objpro->BrandName." รุ่น:".$objpro->genWheel." ขนาด:".$objpro->diameterWheel." ขอบ:".$objpro->whediameter." รู:".$objpro->holeSize." ประเภท:".$objpro->typeFormat;
		}else if($objpro->TypeID == '2'){
			$gettype = "ยาง ".$objpro->BrandName." ขนาด:".$objpro->diameterRubber." ขอบ:".$objpro->rubdiameter." ซี่รี่:".$objpro->series." ความกว้าง:".$objpro->width;
		}else{
			$gettype = "";
		}
		$getdiscount = $objpro->item_discount * $objpro->item_amt;
		$getpertotal = $objpro->item_price * $objpro->item_amt;
?>
		<tr>
			<td align="center" style="border-left: 1px solid black"> <?echo $x ?></td>
			<td style="border-left: 1px solid black">&nbsp;<?php echo $objpro->code?> <?   echo $gettype ?></td>
      <td align="center" style="border-left: 1px solid black"><?php echo $objpro->item_amt?></td>
      <td align="right" style="border-left: 1px solid black"><?php echo convertPoint2($objpro->item_price,2)?>&nbsp;</td>
    	<td align="right" style="border-left: 1px solid black"><?php echo convertPoint2($objpro->item_price * $objpro->item_amt,2)?> &nbsp;</td>
		</tr>
    <? $x ++;
		$getsumdiscount = $getsumdiscount + $getdiscount;
		$gettotal = $gettotal + $getpertotal;
	}

		?>
  </tr>
	<tr style="border: 1px solid black">
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<!--tr>
	<td colspan="5">-----------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
</tr-->
		<tr>
			<td colspan="4" align="right" >จำนวนเงิน &nbsp;</td>
			<td align="right" style="border-left: 1px solid black"><?php echo convertPoint2($gettotal,2)?> &nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" align="right">หักส่วนลด &nbsp;</td>
			<td align="right" style="border-left: 1px solid black"><?php echo convertPoint2($getsumdiscount,2)?> &nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" align="right">รวมราคาทั้งสิน &nbsp;</td>
			<td align="right" style="border-left: 1px solid black"><?php echo convertPoint2($card_detail->reserve_total,2)?> &nbsp;</td>
		</tr>
  </tr>
	<tr style="border-bottom : 1px solid black; background-color:#C7C4C4;">
		<td colspan="5"><b>จำนวนเป็นตัวอักษร : <?= $getdata->convertint(convertPoint2($card_detail->reserve_total,2))?></b></td>
		</tr>
	<!--tr>
	<td colspan="5">==================================================================================================================================</td>
</tr-->
    <!--tr>
			<td colspan="4" align="right">VATAble</td>
      <td align="right"><?php echo convertPoint2($card_detail->reserve_total,2)?></td>
		</tr>
    <tr>
      <?
      $gettax = ($card_detail->reserve_total * 7)/100;
      ?>
			<td colspan="4" align="right">VAT 7.00%</td>
      <td align="right"><?php echo convertPoint2($gettax,2)?></td>
		</tr-->
  <!--/tr><td colspan="5">-----------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr-->
	</table>
  <h4 align="left">*รับประกันสินค้า 15 วัน หลังการซื้อ</h4>
  <table width="100%">

    <tr>
			<td>เริ่มประกัน : <?= date("d-m-Y h:i:s", strtotime(@$card_detail->create_date));?></td>
			<td></td>
		</tr>
    <tr>
			<td>สิ้นสุดประกัน : <?php echo Date("d-m-Y", strtotime($card_detail->create_date." +15 Day"));?></td>
			<td></td>
		</tr>


	</table>
  <br><br>

</div>
</div>
</body>
</html>
