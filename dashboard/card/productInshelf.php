<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-search fa-fw"></i> ค้นหาสินค้า</h1>
     </div>        
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">ค้นหาสินค้า</li>
</ol>
<?php

if(isset($_POST['save_new_status'])){
	$getdata->my_sql_update("card_info","card_status='".htmlentities($_POST['card_status'])."'","card_key='".htmlentities($_POST['card_key'])."'");
	$cstatus_key=md5(htmlentities($_POST['card_status']).time("now"));
	$getdata->my_sql_insert("card_status","cstatus_key='".$cstatus_key."',card_key='".htmlentities($_POST['card_key'])."',card_status='".htmlentities($_POST['card_status'])."',card_status_note='".htmlentities($_POST['card_status_note'])."',user_key='".$userdata->user_key."'");
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


   <?php
   echo @$alert;?>
     
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
        <input type="hidden" name="p" id="p" value="productInshelf" >
        <input type="text" class="form-control" name="q" placeholder="ระบุชื่อ/รหัสสินค้า/รายละเอียดชั้นวาง เพื่อค้นหา" value="<?php echo @htmlentities($_GET['q']);?>" size="100">
        </div>
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> <?php echo @LA_BTN_SEARCH;?></button>
      </form>
   
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 <div class="table-responsive">
  	<table width="100%" border="0" class="table table-bordered">
    <thead>
  <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
    <td width="12%">รหัสสินค้า</td>
    <td width="26%">shelf</td>
    <td width="26%">ชื้อสินค้า</td>
    <td width="13%">คงเหลือ</td>
    <td width="15%">ราคา</td>
  </tr>
  </thead>
  <tbody>
  <?php
  
   if(htmlentities($_GET['q']) != ""){
    $getcard = $getdata->my_sql_selectJoin(NULL,"product","shelf s ON p.shelf_id = s.shelf_id","(p.ProductName LIKE '%".htmlentities($_GET['q'])."%') OR (p.ProductID LIKE '%".htmlentities($_GET['q'])."%') OR (s.shelf_detail LIKE '%".htmlentities($_GET['q'])."%') ");
  }else{
    $getcard = $getdata->my_sql_selectJoin(NULL,"product","shelf s ON p.shelf_id = s.shelf_id",NULL);
   }
	   
 
 
  while($showcard = mysql_fetch_object($getcard)){
  ?>
  <tr style="font-weight:bold;" id="<?php echo @$showcard->ProductID;?>">
    <td align="center"><?php echo @$showcard->ProductID;?></td>
    <td >&nbsp;<i class="fa fa-circle" style="color:<?php echo @$showcard->shelf_color;?>"></i>&nbsp;<?php echo @$showcard->shelf_detail;?></td>
    <td>&nbsp;<?php echo @$showcard->ProductName;?></td>
    <td align="right"><?php echo number_format(@$showcard->Quantity,2);?>&nbsp;</td>
    <td align="right"><?php echo number_format(@$showcard->PriceBuy,2);?>&nbsp;</td>
  </tr>
  <?php
  }
  ?>
  </tbody>
  
</table>

</div>
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
</script>