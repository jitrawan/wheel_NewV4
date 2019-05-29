<style>
.warantryTrue {
  font-size: 20px;
  font-weight:bold;
  color: green;
}
.warantryFalse {
  font-size: 20px;
  font-weight:bold;
  color: red;
}
</style>
<?
if(isset($_POST['save_edit_item'])){
  if(addslashes($_POST['edit_ProductID']) != NULL){
      $change_key=md5($_POST['edit_reserve_key'].addslashes($_POST['edit_ProductID']).@RandomString(4,'C',7));

      $getdata->my_sql_insert("changeProduct"," change_key='".$change_key."'
      ,ProductID='".addslashes($_POST['edit_ProductID'])."'
      ,reserve_key='".$_POST['edit_reserve_key']."'
      ,change_Amt='".$_POST['edit_change_Amt']."'
      ,remark='".addslashes($_POST['edit_remark'])."'
      ,createBy='".$_SESSION['uname']."'
      ,createDate=NOW() ");

      //หัก shelf
      $getdata->my_sql_update(" shelf_detail "," amt_rimit=amt_rimit - '".$_POST['edit_change_Amt']."' "," ProductID='".$_POST['edit_ProductCode']."' and shelf_code ='".$_POST['shelf_id']."' ");

      //หัก stock
      $getdata->my_sql_update(" product_n "," Quantity=Quantity - '".$_POST['edit_change_Amt']."' "," ProductID='".addslashes($_POST['edit_ProductID'])."' ");

      echo "<script>window.location=\"../dashboard/?p=claim_info&q=\"+'".@htmlentities($_GET['q'])."'</script>";
  }else{
  		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
  	}

}
?>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-desktop fa-fw"></i> ตรวจการเคลม</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">ตรวจการเคลม</li>
</ol>

 <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-search"></i></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <form class="navbar-form navbar-left" role="search" method="get">
        <div class="form-group">
        <input type="hidden" name="p" id="p" value="claim_info" >
        <input type="text" class="form-control" name="q" placeholder="ระบุเลขที่ใบเสร็จ เพื่อค้นหา" value="<?php echo @htmlentities($_GET['q']);?>" size="100">
        </div>
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> <?php echo @LA_BTN_SEARCH;?></button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form2" id="form2">

     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">ข้อมูลรายการ</h4>
                </div>
                <div class="ct">

                </div>
            </div>
        </div>
  </form>
</div>
<?php
echo @$alert;
?>

<?
 if(htmlentities($_GET['q']) != ""){
   $getcard = $getdata->my_sql_select(" rf.*,ri.*,p.*, d.*, w.*, s.* "
                                          ," reserve_info rf
                                          left join reserve_item ri on rf.reserve_key = ri.reserve_key
                                          left join product_N p on ri.ProductID = p.ProductID
                                          left join productDetailWheel w on p.ProductID = w.ProductID
                                          left join productDetailRubber d on p.ProductID = d.ProductID
                                          left join shelf s ON p.shelf_id = s.shelf_id "
                                          ," rf.reserve_no = '".htmlentities($_GET['q'])."' ");

  if(mysql_num_rows($getcard) > 0){
    $showcard = mysql_fetch_object($getcard);
  ?>

<div class="tab-pane fade in active" id="info_data">
<div class="panel panel-primary">
<div class="panel-heading">ข้อมูลการเคลม</div>
<div class="panel-body">
<div class="form-group">
              <label>เลขที่ใบเสร็จ : </label> <label> &nbsp;<?php echo @$showcard->reserve_no;?> </label>
              <input type="hidden" name="reserveKey" id="reserveKey" value="<?php echo @$showcard->reserve_key;?>" >

</div>
<div class="form-group row">

   <div class="col-xs-6">
     <label>วันที่ใบเสร็จ : </label> <label> &nbsp;<?php echo date("d-m-Y h:i:s", strtotime(@$showcard->create_date));?></label>
   </div>
     <div class="col-xs-6">

     </div>

</div>


<div class="form-group row">
  <div class="col-xs-6">
    <?
/*$dteStart = new DateTime($showcard->create_date);
$dteEnd   = Date("Y-m-d", strtotime($showcard->create_date," +15 Day"));
$dteDiff  = $dteStart->diff($dteEnd)->days;*/

/*$datetime1 = new DateTime("2019-01-18");
$datetime2 = new DateTime("2019-02-02");
$interval = $datetime1->diff($datetime2);
$dteDiff = $interval->format('%R%a days');*/

$date1=date_create(Date("Y-m-d", strtotime($showcard->create_date." +15 Day")));
//$date1=date_create("2019-03-08");
$date2=date_create();
$diff=date_diff($date1,$date2);
$dteDiff = $diff->format("%R%a days");

if($dteDiff >= 0){
  $checkchange = "disabled";
  $textwarantry = 'ไม่อยู่ในการรับประกัน!';
  $csswarantry = 'warantryFalse';
}else{
  $checkchange = "";
  $textwarantry = 'ยังอยู่ในระหว่างการรับประกัน';
  $csswarantry = 'warantryTrue';

}

    ?>
  <label class="<? echo @$showcard->csswarantry?>">สิ้นสุดการรับประกันสินค้า :</label> <label class="<? echo @$csswarantry?>"> &nbsp;<?php echo Date("d-m-Y", strtotime($showcard->create_date." +15 Day"));?> <?= $textwarantry?></label>

 </div>
</div>

<div class="panel panel-green">
    <div class="panel-heading">
      รายการสินค้า
    </div>
<form id="form1" name="form1" method="post">
    <div class="table-responsive">
     <table width="100%"  class="table table-bordered">
      <tr style="font-weight:bold; color:#FFF; text-align:center;">
        <td width="5%" bgcolor="#888888">จำนวน</td>
        <td width="25%" bgcolor="#888888">รายละเอียด</td>
        <td width="10%" bgcolor="#888888"></td>
        </tr>
        <tbody>
          <?
          $gettotal = 0;
          $getproduct_info = $getdata->my_sql_select("i.* , p.* , r.*, w.* ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter,w.gen as genWheel
          ,case
            when p.TypeID = '2'
            then (select b.BrandName from brand b where r.brand = b.BrandID)
            end BrandName
            ,case
              when p.TypeID = '2'
              then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
              when p.TypeID = '1'
              then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
              end code
            ","reserve_item i
            left join product_n p on i.ProductID = p.ProductID
            left join productDetailWheel w on p.ProductID = w.ProductID
            left join productDetailRubber r on p.ProductID = r.ProductID "
            ," reserve_key='".$showcard->reserve_key."' ");
          while($objShow = mysql_fetch_object($getproduct_info)){
            if($objShow->TypeID == '1'){
              $gettype = "ล้อแม๊ก"." รุ่น:".$objShow->genWheel." ขนาด:".$objShow->diameterWheel." ขอบ:".$objShow->whediameter." รู:".$objShow->holeSize." ประเภท:".$objShow->typeFormat;
            }else if($objShow->TypeID == '2'){
              $gettype = "ยาง ".$objShow->BrandName." ขนาด:".$objShow->diameterRubber." ขอบ:".$objShow->rubdiameter." ซี่รี่:".$objShow->series." ความกว้าง:".$objShow->width;
            }else{
              $gettype = "";
            }
          ?>
          <tr id="<?php echo @$objShow->item_key;?>">
            <td style="text-align: center;"><?= @$objShow->item_amt?></td>
            <td class=""><?= @$objShow->code?> <?= $gettype?></td>
            <td style="text-align: center;">
            <a onClick="javascript:sentclaim('<?php echo @$showcard->reserve_key;?>','<?php echo @$showcard->item_key;?>','<?php echo @$objShow->ProductID;?>');" class="btn btn-xs btn-success" style="color:#FFF;" title="ส่งเคลม"><i class="fa fa-edit"></i> ส่งเคลม</a>
            <button type="button" data-toggle="modal" data-target="#edit_item" data-whatever="<?php echo @$objShow->ProductID;?>" class="btn btn-xs btn-warning" style="color:#FFF;" title="เปลี่ยนสินค้า" <?= @$checkchange?>><i class="fa fa-refresh"></i> เปลี่ยนสินค้า</button></td>
          </tr>
        <?}?>

        </tbody>
    </table>
    </div>
    </form>
</div>

<!--**********-->
<?
$getdataclaim = $getdata->my_sql_select("c.*,p.*, r.*, w.* ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
,(select f.card_code from card_info f where f.card_key = c.card_key) as card_code
,(select f.card_status from card_info f where f.card_key = c.card_key) as card_status
,case
  when p.TypeID = '2'
  then (select b.Description from brandRubble b where r.brand = b.id)
  when p.TypeID = '1'
  then (select b.Description from BrandWhee b where b.id = w.brand)
  end BrandName "
,"card_item c
left join product_n p on c.reseve_item_key = p.ProductID
left join productDetailWheel w on p.ProductID = w.ProductID
left join productDetailRubber r on p.ProductID = r.ProductID "
," c.reserve_key='".$showcard->reserve_key."' ");

if(mysql_num_rows($getdataclaim) > 0){

?>
<div class="panel panel-yellow">
    <div class="panel-heading">
      รายการเคลม
    </div>
<form id="form1" name="form1" method="post">
    <div class="table-responsive">
     <table width="100%"  class="table table-bordered">
       <tr style="font-weight:bold; color:#FFF; text-align:center;">
        <td width="5%" bgcolor="#888888">จำนวน</td>
         <td width="7%" bgcolor="#888888">เลขที่ใบเคลม</td>
         <td width="20%" bgcolor="#888888">รายละเอียด</td>
        <td width="7%" bgcolor="#888888">สถานะ</td>
         </tr>
         <tbody>
          <?
          while($objclaimShow = mysql_fetch_object($getdataclaim)){
              $getcardStatus = $getdata->my_sql_query("ctype_name","card_type","ctype_key = '".@$objclaimShow->card_status."' and ctype_status='1' ORDER BY ctype_insert");
            if($objclaimShow->TypeID == '1'){
              $gettypeclaim = "ล้อแม๊ก ".$objclaimShow->BrandName." ขนาด:".$objclaimShow->diameterWheel." ขอบ:".$objclaimShow->whediameter." รู:".$objclaimShow->holeSize." ประเภท:".$objclaimShow->typeFormat;
            }else if($objclaimShow->TypeID == '2'){
              $gettypeclaim = "ยาง ".$objclaimShow->BrandName." ขนาด:".$objclaimShow->diameterRubber." ขอบ:".$objclaimShow->rubdiameter." ซี่รี่:".$objclaimShow->series." ความกว้าง:".$objclaimShow->width;
            }else{
              $gettypeclaim = "";
            }
          ?>
          <tr>
            <td style="text-align: center;"><?= @$objclaimShow->item_amt?></td>
            <td style="text-align: center;"><?= @$objclaimShow->card_code?></td>
            <td ><?= @$objclaimShow->reseve_item_key?> <?= $gettypeclaim?></td>
            <td style="text-align: center;"><?= $getcardStatus->ctype_name?></td>
          </tr>
        <?}?>
        </tbody>
    </table>
    </div>
    </form>
</div>
<?}?>

<!--**********-->
<?
$getdatachange = $getdata->my_sql_select("c.*,p.*, r.*, w.* ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
,case
  when p.TypeID = '2'
  then (select b.Description from brandRubble b where r.brand = b.id)
  when p.TypeID = '1'
  then (select b.Description from BrandWhee b where b.id = w.brand)
  end BrandName "
,"changeProduct c
left join product_n p on c.ProductID = p.ProductID
left join productDetailWheel w on p.ProductID = w.ProductID
left join productDetailRubber r on p.ProductID = r.ProductID "
," c.reserve_key='".@$showcard->reserve_key."' ");

if(mysql_num_rows($getdatachange) > 0){

?>
<div class="panel panel-red">
    <div class="panel-heading">
      รายการเปลี่ยน
    </div>
<form id="form1" name="form1" method="post">
    <div class="table-responsive">
     <table width="100%"  class="table table-bordered">
      <tr style="font-weight:bold; color:#FFF; text-align:center;">
        <td width="5%" bgcolor="#888888">จำนวน</td>
        <td width="15%" bgcolor="#888888">รายละเอียด</td>
        <td width="20%" bgcolor="#888888">หมายเหตุ</td>
        </tr>
        <tbody>
          <?
          $gettotal = 0;

          while($objShow = mysql_fetch_object($getdatachange)){
            if($objShow->TypeID == '1'){
              $gettypechange = "ล้อแม๊ก ".$objShow->BrandName." ขนาด:".$objShow->diameterWheel." ขอบ:".$objShow->whediameter." รู:".$objShow->holeSize." ประเภท:".$objShow->typeFormat;
            }else if($objShow->TypeID == '2'){
              $gettypechange = "ยาง ".$objShow->BrandName." ขนาด:".$objShow->diameterRubber." ขอบ:".$objShow->rubdiameter." ซี่รี่:".$objShow->series." ความกว้าง:".$objShow->width;
            }else{
              $gettypechange = "";
            }
          ?>
          <tr>
            <td style="text-align: center;"><?= @$objShow->change_Amt?></td>
            <td class=""><?= @$objShow->ProductID?> <?= $gettypechange?></td>
            <td class=""><?= @($objShow->remark == "")?'ไม่ระบุ':$objShow->remark?></td>
          </tr>
        <?}?>

        </tbody>
    </table>
    </div>
    </form>
</div>
<?}?>

</div>
</div>
</div>


  <?
}else{
  echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ไม่พบข้อมูล ใบเสร็จนี้ !</div>';
}
}

?>
<script language="javascript">
$('#edit_status').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "card/edit_status.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })

function deleteCard(cardkey){
	if(confirm('คุณต้องการลบใบสั่งซ่อม/เคลมนี้ใช่หรือไม่ ?')){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(cardkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_card&key="+cardkey,true);
	xmlhttp.send();
	}
}
function hideCard(cardkey){
	if(confirm('คุณต้องการซ่อนใบสั่งซ่อม/เคลมนี้ใช่หรือไม่ ?')){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(cardkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=hide_card&key="+cardkey,true);
	xmlhttp.send();
	}

}
function sentclaim(reserveKey,itemKey,paramKey){
  window.location="../dashboard/?p=card_create&reserveKey="+reserveKey+"&item_key="+itemKey+"&paramKey="+paramKey;
}

$('#edit_item').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient + '&reserveKey=' + $('#reserveKey').val();

            $.ajax({
                type: "GET",
                url: "card/changeProduct.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
</script>
