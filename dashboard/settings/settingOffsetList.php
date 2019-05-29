
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-gear fa-fw"></i>OffSet</h1>
     </div>
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
   <li><a href="?p=MainSettingWheel">ตั้งค่าล้อแม็ก</a></li>
  <li class="active">OffSet</li>
</ol>
<?php
if(isset($_POST['save_card'])){
	if(addslashes($_POST['shelf_detail']) != NULL){
    $chk_DiameterWhee = $getdata->my_sql_select(NULL,"offset"," Description = '".addslashes($_POST['shelf_detail'])."' ");
    if(mysql_num_rows($chk_DiameterWhee) < 1){
      $getdata->my_sql_insert_New(" offset "," Description "," '".addslashes($_POST['shelf_detail'])."' ");
  		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
    }else{
      $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
    }
  }else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>กรุณากรอกข้อมูลให้ครบ</div>';
	}
}

?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลOffSet</h4>
                                        </div>
                                        <div class="modal-body">


                                          <div class="form-group">
                                            <label for="shelf_detail">รายละเอียด</label>
                                            <input type="number" name="shelf_detail" id="shelf_detail" class="form-control"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            maxlength="3" 
                                            autofocus>
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
    <th width="54%" bgcolor="#5fb760">รายละเอียด</th>
    <th width="23%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
  $getcat = $getdata->my_sql_select(NULL,"offset","Description IS NOT NULL order by Description");
  while($showcat = mysql_fetch_object($getcat)){
	  $x++;
  ?>
  <tr id="<?php echo @$showcat->id;?>">
    <td align="center"><?php echo @$x;?></td>
    <td>&nbsp;<?php echo @$showcat->Description;?></td>
    <td align="center" valign="middle">
    <button type="button" class="btn btn-danger btn-xs" onClick="javascript:deletecat('<?php echo @$showcat->id;?>');"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</div>
</div>

<script language="javascript">

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
    xmlhttp.open("GET","function.php?type=delete_offset&key="+catkey,true);
    xmlhttp.send();
    }
}
</script>
