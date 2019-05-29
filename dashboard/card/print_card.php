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
$card_detail = $getdata->my_sql_query(NULL,"card_info","card_key='".addslashes($_GET['key'])."'");


  //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = '../../plugins/phpqrcode/temp/';
    $PNG_WEB_DIR = '../../plugins/phpqrcode/temp/';
    require("../../plugins/phpqrcode/qrlib.php");


?>
<title>ใบเคลมสินค้า</title>
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

<body>
<div id="paper">
  <div>
	<table width="100%">
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><h1 align="center">ใบเคลมสินค้า</h1></td>
		</tr>
		<tr>
			<td width="50%" align="left" >ร้านล้อยาง ไว้ใจผม</td>
			<td width="50%"  align="left"  >วันที่ <?php echo date("d-m-Y", strtotime($card_detail->card_insert));?></td>
		</tr>
		<tr>
			<td align="leftleft">188/3 ถ.สายลวด ต.ปากน้ำ อ.เมือง จ.สมุทรปราการ 10270</td>
				<td width="50%"  align="left" >ออกโดย <?php $getuserx = $getdata->my_sql_query("name,lastname","user","user_key='".$card_detail->user_key."'"); echo $getuserx->name.'&nbsp;&nbsp;&nbsp;&nbsp;'.$getuserx->lastname;?></td>
		</tr>
		<tr>
			<td align="left">โทร 080-986-8795</td>
			<td align="left"></td>
		</tr>
    <tr>
      <td align="left">เลขที่ใบเคลม <?php echo @$card_detail->card_code;?></td>
      <td align="left"></td>
    </tr>

    <tr>
      <td colspan="2">==================================================================================================================================</td>
    </tr>

    <tr>
      <td align="left">ชื่อลูกค้า  <?php echo @$card_detail->card_customer_name.'&nbsp;&nbsp;&nbsp;'.$card_detail->card_customer_lastname;?></td>
      <td align="left">เบอร์ติดต่อ <?php echo @$card_detail->card_customer_phone;?></td>
    </tr>
    <tr>
      <td align="left">ที่อยู่ <?php echo @$card_detail->card_customer_address;?></td>
      <td align="left">อีเมล์ <?php echo @$card_detail->card_customer_email;?></td>
    </tr>

			<td></td>
			<td align="right"></td>
		</tr>

	</table>
	<br>
  <table width="100%"  class="table table-bordered">
                            <thead>
    <tr style="font-weight:bold; color:#FFF; background:#888888; text-align:center; border: 1px solid black;">
      <td width="5%">ลำดับ</td>
      <td width="37%">ชื่อรายการ</td>
      <td width="43%">จำนวน</td>
      <td width="43%">สาเหตุที่ส่งซ่อม/เคลม</td>
      <td width="20%">ราคาโดยประมาณ</td>
      </tr>
      </thead>
      <tbody>
   <?php
   $x = 1;
  	$getitem = $getdata->my_sql_select(NULL,"card_item","card_key='".$card_detail->card_key."' ORDER BY item_insert");
  	while($showitem = mysql_fetch_object($getitem)){
  	?>
    <tr id="<?php echo @$showitem->item_key;?>">
      <td align="center" style="border-left: 1px solid black"><?php echo $x;?></td>
      <td style="border-left: 1px solid black"><?php echo @$showitem->reseve_item_key;?> <?php echo @$showitem->item_name;?></td>
      <td style="border-left: 1px solid black"><?php echo @$showitem->item_amt;?></td>
      <td style="color:#970002; border-left: 1px solid black;"><?php echo @$showitem->item_note;?></td>
      <td align="right" style="border-left: 1px solid black; border-right: 1px solid black"><?php echo @($showitem->item_price_aprox == 0)?'ไม่ระบุ':convertPoint2($showitem->item_price_aprox,2);?></td>

      </tr>
      <?php
      $x ++;
  	}
  	?>
    <tr style="border: 1px solid black; background-color:#C7C4C4;">
      <td colspan="4"><b>วันนัดรับสินค้า :<?php echo date("d-m-Y h:i:s", strtotime(@$card_detail->card_done_aprox));?></b></td>
    </tr>


      </tbody>
  </table>
  <br><br>


                  <div class="row form-group" style="text-align:center">
                      <div class="col-xs-5">(............................................)</div>
                      <div class="col-xs-2"></div>
                      <div class="col-xs-5">(............................................)</div>
                      </div>
                      <div class="row form-group" style="text-align:center">
                      <div class="col-xs-5">วันที............................................่</div>
                      <div class="col-xs-2"></div>
                      <div class="col-xs-5">วันที............................................</div>
                      </div>
                      <div class="row form-group" style="text-align:center">
                      <div class="col-xs-5">ผู้ส่งซ่อม/เคลม</div>
                      <div class="col-xs-2"></div>
                      <div class="col-xs-5">เจ้าหน้าที่</div>
                      </div>

  <br><br>

</div>
</div>
</body>
</html>
