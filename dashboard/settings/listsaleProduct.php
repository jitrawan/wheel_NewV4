<style>
@media (min-width: 1200px) {
   .Modalview {
      width: 1000px;
      margin: auto;
   }
}
</style>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-shopping-cart fa-fw"></i> รายการขาย</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">รายการขาย</li>
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
if(isset($_POST['save_cancelesd'])){
  $checkuser=$getdata->my_sql_select(NULL,'user','email="'.addslashes($_POST['userCancelesd']).'" OR username="'.addslashes($_POST['userCancelesd']).'" ');
    if(mysql_num_rows($checkuser) == 0){
    echo "<script>window.location=\"../dashboard/?p=listsaleProduct&result=userfalse\"</script>";
    }else{
      $checkper=$getdata->my_sql_select(NULL,'user','email="'.addslashes($_POST['userCancelesd']).'" OR username="'.addslashes($_POST['userCancelesd']).'" and user_class="3" ');
      if(mysql_num_rows($checkper) == 0){
        echo "<script>window.location=\"../dashboard/?p=listsaleProduct&result=perfalse\"</script>";
      }else{
        $getinfo=mysql_fetch_object($checkper);
        $getpassword = md5(addslashes($_POST['passCancelesd']));
        if($getinfo->password != $getpassword){
  				echo "<script>window.location=\"../dashboard/?p=listsaleProduct&result=passfalse\"</script>";
  			}else{
          //update status
          $getdata->my_sql_update(" reserve_info "," reserve_status = 'C' "," reserve_key = '".addslashes($_POST['cancelesd_reserve_key'])."' ");
          //get item
          $getnow_reserve = $getdata->my_sql_select(NULL,"reserve_item","reserve_key = '".addslashes($_POST['cancelesd_reserve_key'])."' ");
          //loop update retrue amt
          while($getreserInfo=mysql_fetch_object($getnow_reserve)){
            $getdata->my_sql_update(" product_n ", " Quantity = Quantity + '".$getreserInfo->item_amt."' " ," ProductID = '".$getreserInfo->ProductID."' ");
          }
          $cstatus_key=md5(addslashes($_POST['cancelesd_reserve_code']).time("now"));
          $getdata->my_sql_insert("cancelesd_reserve","canceles_key='".$cstatus_key."',reserve_code='".addslashes($_POST['cancelesd_reserve_code'])."',user_create='".$getinfo->user_key."',date_create=NOW() ");
          echo "<script>window.location=\"../dashboard/?p=listsaleProduct&result=usertrue\"</script>";

        }
      }

    }


}
?>
<!-- Modal cancelesd -->
<div class="modal fade" id="cancelesd" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form2" id="form2">

     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">ยืนยัน ยกเลิกใบเสร็จ</h4>
                </div>
                <div class="ct">

                </div>
            </div>
        </div>
  </form>
</div>

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

<!-- Modal view -->
<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form2" id="form2">

     <div class="modal-dialog" style="margin-right: 200px; margin-left: 200px;">
            <div class="modal-content Modalview">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">รายละเอียดใบเสร็จ</h4>
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
                                            <label for="card_customer_phone">หมายเลขโทรศัพท์</label>
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
      if(@addslashes($_GET['result']) == 'userfalse'){
       $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูล username หรือ email ไม่ถูกต้อง กรุณายกเลิกใหม่ภายหลัง !</div>';
     }else if(@addslashes($_GET['result']) == 'passfalse'){
       $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูล รหัส ไม่ถูกต้อง กรุณายกเลิกใหม่ภายหลัง !</div>';
     }else if(@addslashes($_GET['result']) == 'perfalse'){
       $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>สิทธิ์ของคุณสามารถทำรายการได้ กรุณายกเลิกใหม่ภายหลัง !</div>';
     }
   echo @$alert;?>

   <nav class="navbar navbar-default" role="navigation">
     <div class="row">
         <div class="col-xs-2" style="padding-top: 15px; padding-left: 20px;">
           <a id="addsearch" name="addsearch" style="cursor: pointer">  <i class="fa fa-search fa-fw"></i> ค้นหา</a>
        </div>
     </div>

     <div id="searchOther" name="searchOther" style="display: none">
     <form method="post" enctype="multipart/form-data" name="frmSearch" id="frmSearch">
         <div style="margin: 10px;">
          <div id="search_detailwheel" name="search_detailwheel" style="padding: 5px; border: 0px solid #4CAF50;">
 <div class="form-group row">
   <div class="col-md-4">
   <label for="datedo_from">เลขที่ใบเสร็จ</label>
     <input type="text" name="reserve_key" id="reserve_key" class="form-control"  value="<?php echo @htmlentities($_POST['reserve_key']);?>" autocomplete="off">
   </div>
 </div>
             <div class="form-group row">
                 <div class="col-md-3">
                 <label for="datedo_from">วันที่ใบเสร็จ จาก</label>
                   <input type="text" name="datedo_from" id="datedo_from" class="form-control dpk"  value="<?php echo @htmlentities($_POST['datedo_from']);?>" autocomplete="off">
                 </div>
                 <div class="col-md-3">
                 <label for="datedo_to">ถึง</label>
                 <input type="text" name="datedo_to" id="datedo_to" class="form-control dpk" value="<?php echo @htmlentities($_POST['datedo_to']);?>" autocomplete="off">
                 </div>
                </div>
         </div>
          </div>
           <div style="text-align: center;margin-bottom: 10px;">

               <button type="submit" name="search_product" id="search_product" class="btn btn-default"><i class="fa fa-search"></i> ค้นหา</button>
           </div>

         </div>

         </form>
      </div>
   </nav>
  <?php
  $getstr = "";
  if(isset($_POST['search_product'])){
      if($_POST['datedo_from'] != "" && $_POST['datedo_to'] != ""){
        $getstr .=" and create_date BETWEEN  '".htmlentities($_POST['datedo_from'])." 00:00:00' and  '".htmlentities($_POST['datedo_to'])." 23:59:59' ";
      }
      if($_POST['reserve_key'] != ""){
        $getstr .=" and reserve_no = '".htmlentities($_POST['reserve_key'])."' ";
      }
      $getsaleinfo = $getdata->my_sql_select(NULL,"reserve_info","reserve_status = 's' ".$getstr);
  }else{
    $getsaleinfo = $getdata->my_sql_select(NULL,"reserve_info","reserve_status = 's' ");
  }

  ?>

<div class="table-responsive">
  <table width="100%" border="0" class="table table-bordered">
  <thead>
<tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
  <td width="12%">เลขที่ใบเสร็จ</td>
  <td width="16%">วันที่ใบเสร็จ</td>
  <td width="25%">ผู้ขาย</td>
  <td width="10%">รวมรายการ</td>
  <td width="13%">รวมจำนวนเงิน</td>
  <td width="18%">จัดการ</td>
</tr>
</thead>
<tbody>
  <?
  if(mysql_num_rows($getsaleinfo) > 0){
    while($showsaleinfo = mysql_fetch_object($getsaleinfo)){
      $getmember_info = $getdata->my_sql_query(NULL,"user","user_key='".@$showsaleinfo->empolyee."'");
      $getsale_count = $getdata->my_sql_show_rows("reserve_item","reserve_key='".@$showsaleinfo->reserve_key."'");
    ?>
    <tr style="font-weight:bold;" id="<?php echo @$showsaleinfo->reserve_key;?>">
      <td align="center"><?php echo @$showsaleinfo->reserve_no;?></td>
      <td align="center"><?php echo @dateTimeConvertor($showsaleinfo->create_date);?></td>
      <td align="left"><?php echo @$getmember_info->name;?> <?php echo @$getmember_info->lastname;?></td>
      <td  align="right"><?php echo @$getsale_count;?></td>
      <td align="right"><?php echo @convertPoint2($showsaleinfo->reserve_total,2);?></td>
      <td align="right">
      <a data-toggle="modal" data-target="#cancelesd" data-whatever="<?php echo @$showsaleinfo->reserve_key;?>" class="btn btn-xs btn-default" title="ยกเลิกใบเสร็จ"><i class="fa fa-ban"></i></a>
      <a data-toggle="modal" data-target="#edit_item" data-whatever="<?php echo @$showsaleinfo->reserve_key;?>"  title="รายละเอียด" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
      <a href="card/print_reseve.php?type=re&key=<?php echo @$showsaleinfo->reserve_key;?>" target="_blank" class="btn btn-xs btn-warning" title="พิมพ์"><i class="fa fa-print"></i></a>
      </td>
    </tr>
    <?php
    }
  }else{
    ?>
<tr>
  <th colspan="5" style="text-align: center;">ไม่พบข้อมูล</th>
</tr>
<?}?>

</tbody>

</table>

</div>

<script language="javascript">
$(document).ready(function(){
   $(".number").bind('keyup mouseup', function () {
    if (/\D/g.test(this.value)){
           this.value = this.value.replace(/\D/g, '');
        }
						});

    $("#addsearch").click(function(){
        $("#searchOther").toggle();
    });
    $("#search_product").click(function(){
      if($("#datedo_from").val() != ""){
        if($("#datedo_to").val() == ""){
          alert("กรุณาระบุวันที่รับสินค้า ถึง!");
          return false;
        }else if($("#datedo_to").val() < $("#datedo_from").val()){
            $("#datedo_to").val("");
            alert("กรุณาระบุวันที่รับสินค้า ถึง ให้ถูกต้อง!");
            return false;
        }

        }
    });
});

$('#edit_item').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "card/viewsaleProduct.php",
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
    });

    $('#cancelesd').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) // Button that triggered the modal
              var recipient = button.data('whatever') // Extract info from data-* attributes
              var modal = $(this);
              var dataString = 'key=' + recipient;

                $.ajax({
                    type: "GET",
                    url: "card/cancelesd.php",
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
