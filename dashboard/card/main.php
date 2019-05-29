<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-edit fa-fw"></i> ส่งซ่อมสินค้า/เคลม</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">ส่งซ่อมสินค้า/เคลม</li>
</ol>
<?php
$getparamKey = "";
if(isset($_GET['paramKey'])){
$getparamKey = '&reserve_key='.$_GET['reserveKey'].'&item_key='.$_GET['item_key'].'&paramKey='.$_GET['paramKey'];
}
if(isset($_POST['save_card'])){

	if(addslashes($_POST['card_customer_name'])!= NULL && addslashes($_POST['card_customer_phone']) != NULL ){
		$card_key=md5(addslashes($_POST['card_customer_name']).addslashes($_POST['card_code']).time("now"));
		$getdata->my_sql_insert("card_info","card_key='".$card_key."',card_code='".addslashes($_POST['card_code'])."',card_customer_name='".addslashes($_POST['card_customer_name'])."',card_customer_lastname='".addslashes($_POST['card_customer_lastname'])."',card_customer_address='".addslashes($_POST['card_customer_address'])."',card_customer_phone='".addslashes($_POST['card_customer_phone'])."',card_customer_email='".addslashes($_POST['card_customer_email'])."',card_note='".addslashes($_POST['card_note'])."',card_done_aprox='0000-00-00',card_insert=NOW(),user_key='".$user_data->user_key."',card_status=''");
		echo '<script>window.location="?p=card_create_detail&key='.$card_key.''.$getparamKey.' ";</script>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
	}
}
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                        </div>
                                        <?
                                        @$getMaxid = $getdata->genreserv("card_code","card_info","C",date("dmY"));
                                        // $getdata->getMaxID_N("card_code","card_info","C");

                                        ?>

                                        <div class="modal-body">
                                          <div class="form-group">
                                            <label for="card_code">รหัสการส่งซ่อม/เคลม</label>
                                            <input type="text" name="card_code" id="card_code" value="<?php echo @$getMaxid;?>" class="form-control" readonly>
                                          </div>
                                          <div class="form-group row">
                                           	<div class="col-md-6">
                                           	  <label for="card_customer_name">ชื่อผู้ส่งซ่อม</label>
                                              <input type="text" name="card_customer_name" id="card_customer_name" class="form-control" autofocus  autocomplete="off" onkeypress='validate(event)' required>
                                           	</div>
                                            <div class="col-md-6">
                                              <label for="card_customer_lastname">นามสกุล</label>
                                              <input type="text" name="card_customer_lastname" id="card_customer_lastname" class="form-control"  autocomplete="off" onkeypress='validate(event)' required>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="card_customer_address">ที่อยู่</label>
                                            <textarea name="card_customer_address" id="card_customer_address" class="form-control"></textarea>
                                          </div>
                                          <div class="form-group row">
                                          <div class="col-md-6">
                                            <label for="card_customer_phone">หมายเลขโทรศัพท์</label>
                                            <input type="text" name="card_customer_phone" id="card_customer_phone" size="10" maxlength="10" class="form-control number"  autocomplete="off"  onblur='phonenumber(this.value)' required>
                                            </div>
                                            <div class="col-md-6"> <label for="card_customer_email">อีเมล</label>
                                            <input type="email" name="card_customer_email" id="card_customer_email" class="form-control"  autocomplete="off" required></div>
                                          </div>
                                          <div class="form-group">
                                            <label for="card_note">หมายเหตุ</label>
                                            <textarea name="card_note" id="card_note" class="form-control"></textarea>
                                          </div>
                                      </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="return confirm('ต้องการปิดหน้าต่าง ?');"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_card" class="btn btn-primary btn-sm" ><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
   <?php
   echo @$alert;?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-edit"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
      <ul class="nav navbar-nav">
   <li><a id="openmodal" data-toggle="modal" data-target="#myModal" style="cursor:pointer;"><i class="fa fa-plus"></i> เพิ่มใบส่งซ่อม/เคลม</a></li>
       </ul>

  <form class="navbar-form from-group navbar-right" role="search" method="get" action="?p=search">

    <input type="text" class="form-control" name="q" placeholder="ระบุชื่อ/รหัสส่งซ่อม/เคลม เพื่อค้นหา" size="50" autofocus  autocomplete="off">
    <input type="hidden" name="p" id="p" value="search" >

</form>
</div>

  </div>
  </nav>
  <?php
   $getcard_count = $getdata->my_sql_show_rows("card_info","card_status IS NOT NULL  ORDER BY card_insert");
   if($getcard_count != 0){
  ?>
  <div class="table-responsive">
  	<table width="100%" border="0" class="table table-bordered">
    <thead>
  <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
    <td width="12%">รหัสส่งซ่อม/เคลม</td>
    <td width="16%">วันที่</td>
    <td width="28%">ชื่อผู้ส่งซ่อม/เคลม</td>
    <td width="13%">หมายเลขโทรศัพท์</td>
    <td width="16%">สถานะ</td>
    <td width="15%">จัดการ</td>
  </tr>
  </thead>
  <tbody>
  <?php
  $getcard = $getdata->my_sql_select(NULL,"card_info"," card_status IS NOT NULL  ORDER BY card_insert");
  while($showcard = mysql_fetch_object($getcard)){
  ?>
  <tr style="font-weight:bold;" id="<?php echo @$showcard->card_key;?>">
    <td align="center"><?php echo @$showcard->card_code;?></td>
    <td align="center"><?php echo $showcard->card_insert;?></td>
    <td>&nbsp;<?php echo @$showcard->card_customer_name.'&nbsp;&nbsp;&nbsp;'.$showcard->card_customer_lastname;?></td>
    <td align="center"><?php echo @$showcard->card_customer_phone;?></td>
    <td align="center"><?php echo @cardStatus($showcard->card_status);?></td>
    <td align="right"><a href="?p=card_create_detail&key=<?php echo @$showcard->card_key;?>" title="แก้ไข" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a><a onClick="javascript:deleteCard('<?php echo @$showcard->card_key;?>');" title="ลบข้อมูล" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
  </tr>
  <?php
  }
  ?>
  </tbody>

</table>

</div>
<?php
   }else{
	   echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ไม่พบข้อมูลใบสั่งซ่อม/เคลมที่ไม่สมบูรณ์</div>';
   }
?>
<script language="javascript">
$( window ).load(function() {
  $(".number").bind('keyup mouseup', function () {
    if (/\D/g.test(this.value)){
           this.value = this.value.replace(/\D/g, '');
        }

		});

  if('<?= $_GET['paramKey']?>' != ""){
    $( "#openmodal" ).click();
  }

});
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
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|[๐-๙]/;
  if(regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

function phonenumber(inputtxt){
  var phoneno = /^\d{10}$/;
  if(inputtxt.match(phoneno)){
      return true;
  }else{
        alert("กรอกข้อมูลเบอร์โทรศัพท์ไม่ถูกต้อง !");
        return false;
  }
}
</script>
