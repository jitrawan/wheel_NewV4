<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-list fa-fw"></i> รายการส่งซ่อม/เคลม</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">รายการส่งซ่อม/เคลม</li>
</ol>
<?php
if(isset($_POST['save_card'])){
	if(addslashes($_POST['card_customer_name'])!= NULL && addslashes($_POST['card_customer_phone']) != NULL ){
		$card_key=md5(addslashes($_POST['card_customer_name']).addslashes($_POST['card_code']).time("now"));
		$getdata->my_sql_insert("card_info","card_key='".$card_key."',card_code='".addslashes($_POST['card_code'])."',card_customer_name='".addslashes($_POST['card_customer_name'])."',card_customer_lastname='".addslashes($_POST['card_customer_lastname'])."',card_customer_address='".addslashes($_POST['card_customer_address'])."',card_customer_phone='".addslashes($_POST['card_customer_phone'])."',card_customer_email='".addslashes($_POST['card_customer_email'])."',card_note='".addslashes($_POST['card_note'])."',card_done_aprox='0000-00-00',user_key='".$userdata->user_key."',card_status='',card_insert='".date("Y-m-d H:i:s")."'");
		echo '<script>window.location="?p=card_create_detail&key='.$card_key.'";</script>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลไม่ถูกต้อง กรุณาระบุอีกครั้ง !</div>';
	}
}
if(isset($_POST['save_new_status'])){
	$getdata->my_sql_update("card_info","card_status='".addslashes($_POST['card_status'])."'","card_key='".addslashes($_POST['card_key'])."'");
	$cstatus_key=md5(addslashes($_POST['card_status']).time("now"));
	$getdata->my_sql_insert("card_status","cstatus_key='".$cstatus_key."',card_key='".addslashes($_POST['card_key'])."',card_status='".addslashes($_POST['card_status'])."',card_status_note='".addslashes($_POST['card_status_note'])."',user_key='".$userdata->user_key."'");
	$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>บันทึกข้อมูลสถานะ สำเร็จ</div>';
}
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_status" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form2" id="form2">

     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">เปลี่ยนสถานะ</h4>
                </div>
                <div class="ct">

                </div>
            </div>
        </div>
  </form>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มใบส่งซ่อม/เคลม</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group">
                                            <label for="card_code">รหัสการส่งซ่อม/เคลม</label>
                                            <input type="text" name="card_code" id="card_code" value="<?php echo @RandomString(4,'C',7);?>" class="form-control" readonly>
                                          </div>
                                          <div class="form-group row">
                                           	<div class="col-md-6">
                                           	  <label for="card_customer_name">ชื่อผู้ส่งซ่อม</label>
                                              <input type="text" name="card_customer_name" id="card_customer_name" class="form-control" autofocus>
                                           	</div>
                                            <div class="col-md-6">
                                              <label for="card_customer_lastname">นามสกุล</label>
                                              <input type="text" name="card_customer_lastname" id="card_customer_lastname" class="form-control">
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="card_customer_address">ที่อยู่</label>
                                            <textarea name="card_customer_address" id="card_customer_address" class="form-control"></textarea>
                                          </div>
                                          <div class="form-group row">
                                          <div class="col-md-6">
                                            <label for="card_customer_phone">หมายเลขโทรศัพท์ddd</label>
                                            <input type="text" name="card_customer_phone" id="card_customer_phone" size="10" maxlength="10" class="form-control number">
                                            </div>
                                            <div class="col-md-6"> <label for="card_customer_email">อีเมล</label>
                                            <input type="text" name="card_customer_email" id="card_customer_email" class="form-control"></div>
                                          </div>
                                          <div class="form-group">
                                            <label for="card_note">หมายเหตุ</label>
                                            <textarea name="card_note" id="card_note" class="form-control"></textarea>
                                          </div>
                                      </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_card" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
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
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">สถานะการซ่อม/เคลม <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          <?php
		  if(addslashes($_GET['type']) != NULL){
			  $gettype_detail = $getdata->my_sql_query(NULL,"card_type","ctype_key='".addslashes($_GET['type'])."'");
			  $text_cat = $gettype_detail->ctype_name;
		  }else{
			 $text_cat = 'ทุกสถานะ';
		  }
		  $gettype = $getdata->my_sql_select(NULL,"card_type","ctype_status='1' ORDER BY ctype_insert");
		  		echo '<li><a href="?p=card">ทุกสถานะ</a></li>';
            while($showtype = mysql_fetch_object($gettype)){
				echo '<li><a href="?p=card&type='.$showtype->ctype_key.'">'.$showtype->ctype_name.'</a></li>';
            }
			?>
          </ul>
        </li>
        <li><a><?php echo @$text_cat;?></a></li>
      </ul>

  <form class="navbar-form from-group navbar-right" role="search" method="get" action="?p=search">

    <input type="text" class="form-control" name="q" placeholder="ระบุชื่อ/รหัสส่งซ่อม/เคลม เพื่อค้นหา" size="50" autofocus autocomplete="off">
    <input type="hidden" name="p" id="p" value="search" >

</form>
</div>

  </div>
  </nav>
  <?php
   if(addslashes($_GET['type']) != NULL){
	   $getcard_count = $getdata->my_sql_show_rows("card_info","card_status = '".addslashes($_GET['type'])."' ORDER BY card_insert");
  }else{
	   $getcard_count = $getdata->my_sql_show_rows("card_info","card_status <> 'hidden'  AND  card_status <> '' ORDER BY card_insert");
  }

   if($getcard_count != 0){
  ?>
  <div class="table-responsive">
  	<table width="100%" border="0" class="table table-bordered">
    <thead>
  <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
    <td width="12%">รหัสส่งซ่อม/เคลม</td>
    <td width="16%">วันที่</td>
    <td width="26%">ชื่อผู้ส่งซ่อม/เคลม</td>
    <td width="13%">หมายเลขโทรศัพท์</td>
    <td width="15%">สถานะ</td>
    <td width="18%">จัดการ</td>
  </tr>
  </thead>
  <tbody>
  <?php
  if(addslashes($_GET['type']) != NULL){
	   $getcard = $getdata->my_sql_select(NULL,"card_info","card_status = '".addslashes($_GET['type'])."' ORDER BY card_insert");
  }else{
	   $getcard = $getdata->my_sql_select(NULL,"card_info","card_status <> 'hidden'  AND  card_status <> '' ORDER BY card_insert");
  }

  while($showcard = mysql_fetch_object($getcard)){
  ?>
  <tr style="font-weight:bold;" id="<?php echo @$showcard->card_key;?>">
    <td align="center"><?php echo @$showcard->card_code;?></td>
    <td align="center"><?php echo date("d-m-Y", strtotime($showcard->card_insert));?></td>
    <td>&nbsp;<?php echo @$showcard->card_customer_name.'&nbsp;&nbsp;&nbsp;'.$showcard->card_customer_lastname;?></td>
    <td align="center"><?php echo @$showcard->card_customer_phone;?></td>
    <td align="center"><?php echo @cardStatus($showcard->card_status);?></td>
    <td align="right"><a class="btn btn-xs btn-default" title="ซ่อน" onClick="javascript:hideCard('<?php echo @$showcard->card_key;?>');"><i class="fa fa-ban"></i></a>
      <? if($showcard->card_status != '58dc6633d9c14d0189efd328fc119591'){?>
      <a data-toggle="modal" data-target="#edit_status" data-whatever="<?php echo @$showcard->card_key;?>" class="btn btn-xs btn-info" title="เปลี่ยนสถานะ"><i class="fa fa-tag"></i></a>
<?}?>
      <a href="?p=card_all_status&key=<?php echo @$showcard->card_key;?>" class="btn btn-xs btn-success" title="ประวัติ"><i class="fa fa-history"></i></a><a href="card/print_card.php?key=<?php echo @$showcard->card_key;?>" target="_blank" class="btn btn-xs btn-warning" title="พิมพ์"><i class="fa fa-print"></i></a><a onClick="javascript:deleteCard('<?php echo @$showcard->card_key;?>');" title="ลบข้อมูล" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a></td>
  </tr>
  <?php
  }
  ?>
  </tbody>

</table>

</div>
<?php
   }else{
	   echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ไม่พบข้อมูลใบสั่งซ่อม/เคลม</div>';
   }
?>
<script language="javascript">

$( document ).ready(function() {
	$(".number").bind('keyup mouseup', function () {
    if (/\D/g.test(this.value)){
           this.value = this.value.replace(/\D/g, '');
        }
						});
          });
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
</script>
