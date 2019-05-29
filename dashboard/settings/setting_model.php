
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa flaticon-tag20 fa-fw"></i> รุ่นสินค้า</h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active">รุ่นสินค้า</li>
</ol>

<?php
if(isset($_POST['save_card'])){
	if(addslashes($_POST['ModelName']) != NULL){
	//	$ctype_key = md5(addslashes($_POST['cat_title']).time("now"));
		$getdata->my_sql_insert_New("model","BrandID, ModelID, ModelName, ModelStatus"," '".addslashes($_POST['BrandID'])."' , '".addslashes($_POST['ModelID'])."' , '".addslashes($_POST['ModelName'])."' , '".addslashes($_POST['ModelStatus'])."' ");
    $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
if(isset($_POST['save_edit_card'])){
		 if(addslashes($_POST['edit_ModelName'])!= NULL){
			 $getdata->my_sql_update("model","BrandID='".addslashes($_POST['edit_BrandID'])."' , ModelName = '".addslashes($_POST['edit_ModelName'])."' ","ModelID='".addslashes($_POST['edit_ModelID'])."'");
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
                    <h4 class="modal-title" id="memberModalLabel"><?php echo @LA_LB_ROOM_TYPE_DATA;?></h4>
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
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลรุ่นสินค้า</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                              <!--input type="text" name="ctype_color" id="ctype_color" class="form-control cp1"-->
                                              <?
                                                @$getMaxid = $getdata->getMaxID("ModelID","Model","M");
                                              
                                              ?>
                                              <label for="ModelID">รหัสรุ่นสินค้า</label>
                                              <input type="text" name="ModelID" id="ModelID" value="<?php echo @$getMaxid;?>" class="form-control" readonly>
                                            </div>
                                             <div class="col-md-6">
                                             <label for="ModelName">ชื่อรุ่นสินค้า</label>
                                            <input type="text" name="ModelName" id="ModelName" class="form-control" autofocus>
                                             </div>
                                            
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <!--input type="text" name="ctype_color" id="ctype_color" class="form-control cp1"-->
                                             <label for="BrandID">ยี่ห้อสินค้า</label>
                                              <select name="BrandID" id="BrandID" class="form-control">
                                              <option value="" selected="selected">--เลือกยี่ห้อสินค้า--</option>
                                              <?
                                              $getselecttype = $getdata->my_sql_select("BrandID,BrandName","brand",NULL);
                                              while($showtype = mysql_fetch_object($getselecttype)){
                                              ?>
                                                <option value="<?php echo @$showtype->BrandID;?>" ><?php echo @$showtype->BrandName;?></option>
                                                <? } ?>
                                              </select>
                                            </div>
                                             <div class="col-md-6"><label for="ModelStatus"><?php echo @LA_LB_STATUS;?></label>
                                              <select name="ModelStatus" id="ModelStatus" class="form-control">
                                                <option value="1" selected="selected"><?php echo @LA_BTN_ON;?></option>
                                                <option value="0"><?php echo @LA_BTN_OFF;?></option>
                                              
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
  <?php
  echo @$alert;
  ?>
 
 <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i> เพิ่มรุ่นสินค้า</button><br/><br/>
 <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">รุ่นสินค้า ทั้งหมด</div>
   <div class="table-responsive">
  <!-- Table -->
  <table width="100%" class="table table-striped table-bordered table-hover">
  <thead>
  <tr style="color:#FFF;">
    <th width="3%" bgcolor="#5fb760">#</th>
    <th width="10%" bgcolor="#5fb760">รหัส</th>
    <th width="20%" bgcolor="#5fb760">ยี่ห้อสินค้า</th>
    <th width="44%" bgcolor="#5fb760">ชื่อรุ่นสินค้า </th>
    <th width="23%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
  $getcat = $getdata->my_sql_select(NULL,"model",NULL);
  while($showcat = mysql_fetch_object($getcat)){
    $x++;
    $getbrand = $getdata->my_sql_query("BrandName","brand","BrandID='".@$showcat->BrandID."'");
  ?>
  <tr id="<?php echo @$showcat->ModelID;?>">
    <td align="center"><?php echo @$x;?></td>
    <td align="center"><?php echo @$showcat->ModelID;?></td>
    <td>&nbsp;<?php echo @$getbrand->BrandName;?></td>
    <td>&nbsp;<?php echo @$showcat->ModelName;?></td>
    <td align="center" valign="middle">
      <?php
	  if($showcat->ModelStatus == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showcat->ModelID.'" onClick="javascript:changecatStatus(\''.@$showcat->ModelID.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showcat->ModelID.'"></i> <span id="text-'.@$showcat->ModelID.'">'.@LA_BTN_ON.'</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showcat->ModelID.'" onClick="javascript:changecatStatus(\''.@$showcat->ModelID.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-lock" id="icon-'.@$showcat->ModelID.'"></i> <span id="text-'.@$showcat->ModelID.'">'.@LA_BTN_OFF.'</span></button>';
	  }
	  ?><a data-toggle="modal" data-target="#edit_card_type" data-whatever="<?php echo @$showcat->ModelID;?>" class="btn btn-xs btn-info" style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT;?></a><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deletecat('<?php echo @$showcat->ModelID;?>');"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button></td>
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
					document.getElementById('text-'+catkey).innerHTML = 'ซ่อน';
				}
				
			}else{
				document.getElementById('btn-'+catkey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+catkey).className = 'fa fa-unlock-alt';
				if(lang == 'en'){
					document.getElementById('text-'+catkey).innerHTML = 'Show';
				}else{
					document.getElementById('text-'+catkey).innerHTML = 'แสดง';
				}
				
			}
  		}
	}
	
	xmlhttp.open("GET","function.php?type=change_type_status&key="+catkey+"&sts="+sts,true);
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
	xmlhttp.open("GET","function.php?type=delete_brand&key="+catkey,true);
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
                url: "settings/edit_model.php",
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