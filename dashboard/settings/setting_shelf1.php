
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa flaticon-tag20 fa-fw"></i> สถานที่จัดเก็บสินค้า</h1>
     </div>
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active">สถานที่จัดเก็บสินค้า</li>
</ol>

<?php

if(isset($_POST['save_shelf'])){
  $getShelf = $getdata->my_sql_select(NULL,"shelf_header"," shelf_header_detail ='".addslashes($_POST['shelf_detail_d'])."' ");
  if(mysql_num_rows($getShelf) < 1){
          $getdata->my_sql_insert_New("shelf_header","shelf_header_code, shelf_header_detail, shelf_header_status   ","'".addslashes($_POST['shelf_code_d'])."' ,'".addslashes($_POST['shelf_detail_d'])."','1' ");
          $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
      }else{
        $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
      }
}

if(isset($_POST['save_edit_card'])){
  if(addslashes($_POST['edit_shelf_detail'])!= NULL){
    $getShelf = $getdata->my_sql_select(NULL,"shelf_header","shelf_header_detail ='".addslashes($_POST['edit_shelf_detail'])."' ");
    if(mysql_num_rows($getShelf) < 1){
        $getdata->my_sql_update("shelf_header","shelf_header_detail='".addslashes($_POST['edit_shelf_detail'])."' ","shelf_header_id='".addslashes($_POST['edit_shelf_id'])."'");
       $alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_UPDATE_DATA_DONE.'</div>';
     }else{
       $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
     }
  }else{
    $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
  }
}

if(isset($_POST['save_Rim'])){
  $getShelf = $getdata->my_sql_select(NULL,"shelf","shelf_class ='".addslashes($_POST['shelf_class'])."' and shelf_header_code = '".addslashes($_POST['shelf_header_code'])."' ");
    if(mysql_num_rows($getShelf) < 1){
      $getdata->my_sql_insert_New("shelf","shelf_header_code,shelf_code, shelf_class, amt   ","'".addslashes($_POST['shelf_header_code'])."' ,'".addslashes($_POST['shelf_code'])."','".addslashes($_POST['shelf_class'])."','".addslashes($_POST['shelf_amt'])."' ");
      $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
     }else{
       $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
     }
 }
?>

   <!-- Modal Edit -->
   <div class="modal fade" id="Detial_shelf1" name="Detial_shelf1" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="form3" name="form3" method="post">
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">ชั้น สินค้า</h4>
                </div>
                <div class="ct">

                </div>
            </div>
        </div>
  </form>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit_card_type" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="form2" name="form2" method="post">
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">แก้ไข สถานที่จัดเก็บ</h4>
                </div>
                <div class="ct">

                </div>
            </div>
        </div>
  </form>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalshelf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <form id="form4" name="form4" method="post">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลสถานที่จัดเก็บ</h4>
                                        </div>
                                        <div class="modal-body">
                                    <?php
                                          @$getcode = $getdata->getMaxID("shelf_header_code","shelf_header","H");
                                          ?>
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="shelf_detail">รัหส สถานที่จัดเก็บ</label>
                                              <input type="hidden" name="shelf_code_d" id="shelf_code_d" value="<?= @$getcode?>" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="shelf_detail">ชื่อที่จัดเก็บสินค้า</label>
                                              <input type="text" name="shelf_detail_d" id="shelf_detail_d" class="form-control" autofocus required>
                                            </div>

                                          </div>

                                          <div class="form-group row">

                                                  <div class="col-md-6"><label for="shelf_status_d"><?php echo @LA_LB_STATUS;?></label>
                                                  <select name="shelf_status_d" id="shelf_status_d" class="form-control">
                                                    <option value="1" selected="selected"><?php echo @LA_BTN_SHOW;?></option>
                                                    <option value="0"><?php echo @LA_BTN_HIDE;?></option>

                                                  </select></div>

                                                  </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_shelf" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                  </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
                            <!-- /.modal -->
  <?php
  echo @$alert;
  ?>

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
         <input type="hidden" name="p" id="p" value="setting_shelf1" >
         <input type="text" class="form-control" name="q" placeholder="ค้นหา" value="<?php echo @htmlentities($_GET['q']);?>" size="100">
         </div>
         <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> <?php echo @LA_BTN_SEARCH;?></button>
       </form>

     </div><!-- /.navbar-collapse -->
   </div><!-- /.container-fluid -->
 </nav>
 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalshelf"><i class="fa fa-plus fa-fw"></i> เพิ่มข้อมูลสถานที่จัดเก็บ </button><br/>

 <div class="panel panel-default">
  <!-- Default panel contents -->
  <!--div class="panel-heading">สถานะการซ่อม/เคลม ทั้งหมด</div-->

   <div class="table-responsive">
  <!-- Table -->
  <table width="70%" class="table table-striped table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="3%" bgcolor="#5fb760">ลำดับ</th>
    <!--th width="10%" bgcolor="#5fb760">รหัส</th-->
    <th width="54%" bgcolor="#5fb760">รายละเอียด</th>
    <th width="10%" bgcolor="#5fb760">ชั้น</th>
    <th width="23%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $sql = "";
     if(htmlentities($_GET['q']) != ""){
        $sql .= "and (shelf_header_code LIKE '%".htmlentities($_GET['q'])."%' or shelf_header_detail LIKE '%".htmlentities($_GET['q'])."%' )";

     }

  $x=0;
  $getcat = $getdata->my_sql_select("s.* "
  ,"shelf_header s"
  ,"s.shelf_header_status in ('1','0') $sql ORDER BY s.shelf_header_code, s.shelf_header_detail ");
  while($showcat = mysql_fetch_object($getcat)){
	  $x++;
  ?>
  <tr id="<?php echo @$showcat->shelf_header_id;?>">
    <td align="center"><?php echo @$x;?></td>
    <!--td>&nbsp;<?php echo @$showcat->shelf_header_code;?> </td-->
    <td>&nbsp;<?php echo @$showcat->shelf_header_detail;?> &nbsp;</td>
    <td align="center">&nbsp;<a data-toggle="modal" data-target="#Detial_shelf1" data-whatever="<?php echo @$showcat->shelf_header_code;?>">ข้อมูลชั้น</a> &nbsp;</td>
    <td align="center" valign="middle">
    <a data-toggle="modal" data-target="#edit_card_type" data-whatever="<?php echo @$showcat->shelf_header_id;?>" class="btn btn-xs btn-info" style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT;?></a>
    <button type="button" class="btn btn-danger btn-xs delete" id="del_<?php echo @$showcat->shelf_header_id;?>"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button>
    </td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</div>
</div>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<script language="javascript">
$(document).ready(function(){

  $(".number").bind('keyup mouseup', function () {
								if($(this).val() < 0) {
									alert("กรุณากรอกตัวเลขให้ถูกต้อง ! ");
									$(this).val(0);
								}
						});

  $('.delete').click(function(){
    var id = this.id;
    var splitid = id.split("_");
    var deleteid = splitid[1];
    var r = confirm("ต้องการลบข้อมูล ?");
    if (r == true) {
        $.ajax({
           url: 'settings/deleteShelf.php',
           type: 'POST',
           data: { id:deleteid },
           success: function(response){
             if(response == 1){
                deletecat(deleteid);
                alert("ลบข้อมูลสำเร็จ ! ");
              }else{
                alert("ไม่สามารถลบได้  เนื่องจากมีสินค้าอยู่ใน Shelf นี้ ! ");
              }
            }
         });
    }

  });
  	});

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

function myNewFunction(sel) {
    var shelf_detail = sel.options[sel.selectedIndex].text;
  $('#shelf_detail').val(shelf_detail.substring(6, shelf_detail.indexOf("ชั้น")-1));
  $('#shelf_class').val(shelf_detail.substring(shelf_detail.indexOf("ชั้น") + 5,shelf_detail.length));
}
	function deletecat(catkey){
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
	xmlhttp.open("GET","function.php?type=delete_shelf&key="+catkey,true);
	xmlhttp.send();
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
                url: "settings/edit_shelf1.php",
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

     $('#detailShelf').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/detailShelf.php",
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

    $('#Detial_shelf1').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/Detial_shelf1.php",
                data: dataString,
                cache: false,
                success: function (data) {
                   modal.find('.ct').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })

    
    </script>
