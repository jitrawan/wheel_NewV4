
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-gear fa-fw"></i>ความกว้าง</h1>
     </div>
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
   <li><a href="?p=MainSettingRubble">ตั้งค่ายาง</a></li>
  <li class="active">ความกว้าง (mm)</li>
</ol>
<?php
if(isset($_POST['save_detailseries'])){

  if(addslashes($_POST['detail_SeriesRubble']) != NULL){
    $chk_Dup = $getdata->my_sql_select(NULL,"relationSeries"," SeriesRubble = '".addslashes($_POST['detail_SeriesRubble'])."' and SeriesId =  '".addslashes($_POST['id'])."' ");
    if(mysql_num_rows($chk_Dup) < 1){

      $getdata->my_sql_insert_New(" relationSeries "," SeriesId, SeriesRubble "
      ," '".addslashes($_POST['id'])."'
      ,'".addslashes($_POST['detail_SeriesRubble'])."' ");
      $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
    }else{
      $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
    }
  }else{
    $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>กรุณาระบุช้อมูลให้ถูกต้อง</div>';
  }
}

if(isset($_POST['save_detaildiameter'])){
  if(addslashes($_POST['detail_DiameterRubble']) != NULL){
    $chk_Dupdia = $getdata->my_sql_select(NULL,"relationDiameter"," DiameterRubble = '".addslashes($_POST['detail_DiameterRubble'])."' and DiameterId = '".addslashes($_POST['diaId'])."' ");
    if(mysql_num_rows($chk_Dupdia) < 1){
      $getdata->my_sql_insert_New(" relationDiameter "," DiameterId, DiameterRubble "
      ," '".addslashes($_POST['diaId'])."'
      ,'".addslashes($_POST['detail_DiameterRubble'])."' ");
      $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
    }else{
      $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
    }
  }else{
    $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>กรุณาระบุช้อมูลให้ถูกต้อง</div>';
  }
}

if(isset($_POST['save_card'])){

	if(addslashes($_POST['shelf_detail']) != NULL){
    $chk_DiameterWhee = $getdata->my_sql_select(NULL,"WidthRubble"," Description = '".addslashes($_POST['shelf_detail'])."' ");
    if(mysql_num_rows($chk_DiameterWhee) < 1){

    /*  $getdata->my_sql_insert_New(" WidthRubble "," code, Description, status, DiameterRubble, SeriesRubble "
      ," '".addslashes($_POST['code'])."'
      ,'".addslashes($_POST['shelf_detail'])."'
      ,'".addslashes($_POST['shelf_status'])."'
      ,'".addslashes($_POST['shelf_DiameterRubble'])."'
      ,'".addslashes($_POST['shelf_SeriesRubble'])."' ");*/
      $getdata->my_sql_insert_New(" WidthRubble "," code, Description, status "
      ," '".addslashes($_POST['code'])."'
      ,'".addslashes($_POST['shelf_detail'])."'
      ,'".addslashes($_POST['shelf_status'])."' ");
  		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
    }else{
      $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
    }
  }else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
	}
}
if(isset($_POST['save_edit_card'])){
		 if(addslashes($_POST['edit_shelf_detail'])!= NULL){
			 $getdata->my_sql_update("WidthRubble","Description='".addslashes($_POST['edit_shelf_detail'])."'
       ","id='".addslashes($_POST['edit_shelf_id'])."'");

      $alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_UPDATE_DATA_DONE.'</div>';
		 }else{
			 $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
		 }
	 }
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_card_type" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="form2" name="form2" method="post">
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">แก้ไขข้อมูลความกว้างยาง</h4>
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
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลความกว้างยาง</h4>
                                        </div>
                                        <div class="modal-body">

                                          <?php
                                          @$getcode = $getdata->getMaxID_N("code","WidthRubble","RW");
                                          ?>
                                          <div class="form-group row">

                                             <div class="col-md-6">
                                               <label for="code">รหัส</label>
                                               <input type="text" name="code" id="code" class="form-control" value="<?= $getcode?>" readonly>
                                            </div>

                                          </div>
                                          <div class="form-group">
                                            <label for="shelf_detail">รายละเอียด</label>
                                            <input type="number" name="shelf_detail" id="shelf_detail"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            maxlength="3"
                                            class="form-control" autofocus>
                                          </div>


                                        <!--div class="form-group row">
                                          <div class="col-md-6">
                                              <label for="shelf_DiameterRubble">ขนาด</label>
                                              <select name="shelf_DiameterRubble" id="shelf_DiameterRubble" class="form-control">
                                                <option value="" selected="selected">--เลือก--</option>
                                                <? $getDiameterRubble = $getdata->my_sql_select(NULL,"DiameterRubble","status = '1' ORDER BY Description ");
                                                  while($showDiameterRubble = mysql_fetch_object($getDiameterRubble)){?>
                                                <option value="<?= $showDiameterRubble->id?>" ><?= $showDiameterRubble->Description?></option>
                                                <?}?>
                                             </select>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="shelf_SeriesRubble">ซี่รี่</label>
                                                <select name="shelf_SeriesRubble" id="shelf_SeriesRubble" class="form-control">
                                                  <option value="" selected="selected">--เลือก--</option>
                                                  <? $getSeriesRubbleRubble = $getdata->my_sql_select(NULL,"SeriesRubble","status = '1' ORDER BY Description ");
                                                    while($showSeriesRubbleRubble = mysql_fetch_object($getSeriesRubbleRubble)){?>
                                                  <option value="<?= $showSeriesRubbleRubble->id?>" ><?= $showSeriesRubbleRubble->Description?></option>
                                                  <?}?>
                                               </select>
                                              </div>
                                            </div-->
                                            <div class="form-group row">

                                               <div class="col-md-6"><label for="shelf_status"><?php echo @LA_LB_STATUS;?></label>
                                                <select name="shelf_status" id="shelf_status" class="form-control">
                                                  <option value="1" selected="selected"><?php echo @LA_BTN_SHOW;?></option>
                                                  <option value="0"><?php echo @LA_BTN_HIDE;?></option>

                                                </select></div>
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
                            <!-- /.modal -->
      <!-- Modal Edit -->
      <div class="modal fade" id="Detial_Series" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
          <form id="form3" name="form3" method="post">
           <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                          <h4 class="modal-title" id="memberModalLabel">ข้อมูลซี่รี่</h4>
                      </div>
                      <div class="ct">

                      </div>
                  </div>
              </div>
        </form>
      </div>

      <!-- Modal Edit -->
      <div class="modal fade" id="Detial_Diameter" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
          <form id="form3" name="form3" method="post">
           <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                          <h4 class="modal-title" id="memberModalLabel">ข้อมูลขนาด</h4>
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

 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i> เพิ่ม</button><br/><br/>
 <div class="panel panel-default">
  <!-- Default panel contents -->
  <!--div class="panel-heading">สถานะการซ่อม/เคลม ทั้งหมด</div-->

   <div class="table-responsive">
  <!-- Table -->
  <table width="70%" class="table table-striped table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="3%" bgcolor="#5fb760">ลำดับ</th>
    <th width="20%" bgcolor="#5fb760">รหัส</th>
    <th width="34%" bgcolor="#5fb760">รายละเอียด</th>
    <th width="10%" bgcolor="#5fb760">ซี่รี่</th>
    <th width="10%" bgcolor="#5fb760">ขนาด</th>
    <th width="23%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
  $getcat = $getdata->my_sql_select(NULL,"WidthRubble","status in ('0','1','2') ORDER BY id ");
  while($showcat = mysql_fetch_object($getcat)){
	  $x++;
  ?>
  <tr id="<?php echo @$showcat->id;?>">
    <td align="center"><?php echo @$x;?></td>
    <td>&nbsp;<?php echo @$showcat->code;?></td>
    <td>&nbsp;<?php echo @$showcat->Description;?></td>
    <td align="center"><a data-toggle="modal" data-target="#Detial_Series" data-whatever="<?php echo @$showcat->id;?>" class="pointer">ข้อมูลซี่รี่</a></td>
    <td align="center"><a data-toggle="modal" data-target="#Detial_Diameter" data-whatever="<?php echo @$showcat->id;?>" class="pointer">ข้อมูลขนาด</a></td>
    <td align="center" valign="middle">
      <?php
	  if($showcat->status == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showcat->id.'" onClick="javascript:changecatStatus(\''.@$showcat->id.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showcat->id.'"></i> <span id="text-'.@$showcat->id.'">'.@LA_BTN_ON.'</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showcat->id.'" onClick="javascript:changecatStatus(\''.@$showcat->id.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-lock" id="icon-'.@$showcat->id.'"></i> <span id="text-'.@$showcat->id.'">'.@LA_BTN_OFF.'</span></button>';
	  }
	  ?><a data-toggle="modal" data-target="#edit_card_type" data-whatever="<?php echo @$showcat->id;?>" class="btn btn-xs btn-info" style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT;?></a><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deletecat('<?php echo @$showcat->id;?>');"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button></td>
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
  xmlhttp.open("GET","function.php?type=change_status_WidthRubble&key="+catkey+"&sts="+sts,true);
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
    xmlhttp.open("GET","function.php?type=delete_WidthRubble&key="+catkey,true);
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
                url: "settings/edit_WidthRubble.php",
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

    $('#Detial_Series').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/Detial_Series.php",
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

    $('#Detial_Diameter').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/Detial_Diameter.php",
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
