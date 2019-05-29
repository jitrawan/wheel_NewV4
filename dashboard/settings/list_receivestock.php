
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-plus-square fa-fw"></i> รายการการรับวัสดุทั้งหมด</h1>
     </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li class="active">รายการการรับวัสด</li>
</ol>

<?php
if($_POST['datedo_from'] != "" && $_POST['datedo_to'] != ""){
  ?>
<script>console.log('<?= $_POST['datedo_from']?>')</script>
  <?
  $getcat = $getdata->my_sql_select(" r.*, ( select COUNT(d.no) FROM stock_tb_receive_master_sub d WHERE r.po = d.po )as sum , r.po as No_po "
  ," stock_tb_receive_master r "
  ,"  r.datedo BETWEEN '".htmlentities($_POST['datedo_from'])."' and '".htmlentities($_POST['datedo_to'])."'
  order by r.po DESC");

}else{
  $getcat = $getdata->my_sql_select(" r.*, ( select COUNT(d.no) FROM stock_tb_receive_master_sub d WHERE r.po = d.po )as sum , r.po as No_po "," stock_tb_receive_master r order by r.po DESC ",NULL);
}

if(isset($_POST['save_card'])){
	if(addslashes($_POST['shelf_detail']) != NULL){
    $getdata->my_sql_insert_New("shelf","shelf_detail, shelf_color, shelf_status","'".addslashes($_POST['shelf_detail'])."' ,'".addslashes($_POST['shelf_color'])."' ,'".addslashes($_POST['shelf_status'])."'");
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
	}
}
if(isset($_POST['save_edit_card'])){
		 if(addslashes($_POST['edit_shelf_detail'])!= NULL){
			 $getdata->my_sql_update("shelf","shelf_detail='".addslashes($_POST['edit_shelf_detail'])."',shelf_color='".addslashes($_POST['edit_shelf_color'])."'","shelf_id='".addslashes($_POST['edit_shelf_id'])."'");
			$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_UPDATE_DATA_DONE.'</div>';
		 }else{
			 $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
		 }
	 }
?>

  <?php
  echo @$alert;
  ?>

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
                <div class="col-md-3">
                <label for="datedo_from">วันที่รับสินค้า จาก</label>
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

 <button type="button" class="btn btn-primary btn-sm" onclick="newreceive();"><i class="fa fa-plus fa-fw"></i> เพิ่มรายการรับสินค้า</button><br/><br/>
 <div class="panel panel-default">
  <!-- Default panel contents -->
  <!--div class="panel-heading">สถานะการซ่อม/เคลม ทั้งหมด</div-->

   <div class="table-responsive">
  <!-- Table -->
  <table width="100%" class="table table-striped table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="3%" bgcolor="#5fb760">ลำดับ</th>
    <th width="10%" bgcolor="#5fb760">เลขที่อ้างอิง </th>
    <th width="15%" bgcolor="#5fb760">วันที่รับสินค้า </th>
    <th width="20%" bgcolor="#5fb760">ผู้รับสินค้า </th>
    <th width="5%" bgcolor="#5fb760">จำนวนรายการ </th>
    <th width="15%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
if(mysql_num_rows($getcat) > 0){
  while($showcat = mysql_fetch_object($getcat)){
	  $x++;
  ?>
  <tr id="<?php echo @$showcat->rid;?>">
    <td align="center"><?php echo @$x;?></td>
    <td>&nbsp;<?php echo @$showcat->No_po;?></td>
      <td>&nbsp;<?php echo date("d-m-Y", strtotime(@$showcat->datedo));?></td>
    <td>&nbsp;<?php echo @$showcat->iduser;?></td>
    <td align="right" valign="middle"><strong><?php echo @$showcat->sum;?></strong>&nbsp;</td></td>
    <td align="center" valign="middle">
      <button type="button" class="btn btn-xs btn-info" style="color:#FFF;" onClick="editpage('<?php echo @$showcat->No_po;?>')"><i class="fa fa-edit"></i> <?php echo @LA_BTN_EDIT;?></button>
      <button type="button" class="btn btn-xs btn-info" style="color:#FFF;" onClick="viwepage('<?php echo @$showcat->No_po;?>')">รายละเอียด</button>
    </td>
  </tr>
  <?php
  }
}else{
  ?>
  <tr>
    <th colspan="6" style="text-align: center;">ไม่พบข้อมูล</th>
  </tr>
  <?
}
  ?>
  </tbody>
</table>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#addsearch").click(function(){
        $("#searchOther").toggle();
    });
$("#search_product").click(function(){
  if($("#datedo_from").val() == ""){
    alert("กรุณาระบุวันที่รับสินค้า จาก!");
    return false;
  }else if($("#datedo_to").val() == ""){
    alert("กรุณาระบุวันที่รับสินค้า ถึง!");
    return false;
  }else if($("#datedo_to").val() < $("#datedo_from").val()){
      $("#datedo_to").val("");
      alert("กรุณาระบุวันที่รับสินค้า ถึง ให้ถูกต้อง!");
      return false;
  }

});

});

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<script language="javascript">
function editpage(po){
  window.location=" ../dashboard/index.php?p=receiveaddstock&d="+po;
}
function viwepage(po){
  window.location=" ../dashboard/index.php?p=view_receiveaddstock&d="+po;
}
function newreceive(){
  window.location=" ../dashboard/index.php?p=receivestock";
}

function changecatStatus(catkey,lang){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+catkey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){

			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+catkey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+catkey).className = 'fa fa-lock';
				if(lang == 'en'){
					document.getElementById('text-'+catkey).innerHTML = 'Hide';
				}else{
					document.getElementById('text-'+catkey).innerHTML = 'ปิดใช้งาน';
				}

			}else{
				document.getElementById('btn-'+catkey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+catkey).className = 'fa fa-unlock-alt';
				if(lang == 'en'){
					document.getElementById('text-'+catkey).innerHTML = 'Show';
				}else{
					document.getElementById('text-'+catkey).innerHTML = 'เปิดใช้งาน';
				}

			}
  		}
	}

	xmlhttp.open("GET","function.php?type=change_shelf_status&key="+catkey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deletecat(catkey){
    var r = confirm("ต้องการลบข้อมูล ?");
    if (r == true) {
      if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }else{// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
        document.getElementById(catkey).innerHTML = '';
          }
      }
      xmlhttp.open("GET","function.php?type=delete_cardtype&key="+catkey,true);
      xmlhttp.send();
    }
}
</script>
<script>
    $('#edit_card_type').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/edit_shelf.php",
                data: dataString,
                cache: false,
                success: function (data) {
                   // console.log(data);
                    modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
    </script>
