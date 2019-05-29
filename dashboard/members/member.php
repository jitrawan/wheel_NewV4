 <link href="../css/plugins/dataTables.bootstrap.css" rel="stylesheet">
 <style>
  .ppp {
    background: yellow;
  }
  </style>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-users fa-fw"></i> <?php echo @LA_MN_SUPPLIER;?></h1>
     </div>
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active"><?php echo @LA_LB_SUPPLIER;?></li>
</ol>
<?php
if(isset($_POST['save_member'])){
    //$alerttest = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Case Insert</div>';
	if(addslashes($_POST['dealer_code']) != NULL && addslashes($_POST['dealer_name']) != NULL){

	//$member_key = md5(addslashes($_POST['dealer_name']).time("now"));
	//$member_born = addslashes($_REQUEST['year']).'-'.addslashes($_REQUEST['month']).'-'.addslashes($_REQUEST['day']);
    //my_sql_insert_New($table,$field,$value)
    $getdata->my_sql_insert_New("dealer","dealer_code , dealer_name, mobile, address, email, status"," '".addslashes($_POST['dealer_code'])."' , '".addslashes($_POST['dealer_name'])."' , '".addslashes($_POST['mobile'])."' , '".addslashes($_POST['address'])."'  , '".addslashes($_POST['email'])."',1 ");
    //$getdata->my_sql_insert("user","user_key='".$member_key."',name='".addslashes($_POST['member_name'])."',lastname='".addslashes($_POST['member_lastname'])."',username='".addslashes($_POST['member_code'])."',password='".md5(addslashes($_POST['member_password']))."',user_class='1',user_language='th',email='".addslashes($_POST['member_email'])."',user_status='".addslashes($_REQUEST['member_status'])."'");
	//updateMember();
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_INSERT_MEMBER_DATA_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
	}
}
if(isset($_POST['save_edit_member'])){
       if(addslashes($_POST['edit_dealer_code']) != NULL && addslashes($_POST['edit_dealer_name']) != NULL){

		$getdata->my_sql_update("dealer","dealer_name='".addslashes($_POST['edit_dealer_name'])."',address='".addslashes($_POST['edit_address'])."',mobile='".addslashes($_POST['edit_mobile'])."',email='".addslashes($_POST['edit_email'])."'","dealer_code='".addslashes($_POST['edit_dealer_code'])."'");

		$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_EDIT_MEMBER_DATA_DONE.'</div>';
        }else{
            $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>';
        }
    }
if(isset($_GET['t'])){
    $alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DELETE.'</div>';
}


echo @$alert;
?>
<div id="Success" style="display: none" class="alert alert-success fade">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p id="valuealert"></p>
    </div>
<!-- Modal -->
<div class="modal fade" id="edit_member" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="form2" name="form2" method="post" enctype="multipart/form-data">
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel"><?php echo @LA_LB_EDIT_MEMBER_DATA;?></h4>
                </div>
                <div class="ct">

                </div>
            </div>
        </div>
  </form>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo @LA_LB_NEW_MEMBER;?></h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                          <?
                                          @$getMaxid = $getdata->getMaxID("dealer_code","dealer","D");

                                          ?>
                                            <div class="col-md-6"> <label for="dealer_code"><?php echo @LA_LB_CODE_COMPANY;?></label>
                                              <input type="text" name="dealer_code" id="dealer_code" class="form-control" value="<?php echo @$getMaxid;?>" readonly>
                                            </div>
                                            <div class="col-md-6"><label for="dealer_name"><?php echo @LA_LB_NAME_CHECKIN;?></label>
                                               <input type="text" name="dealer_name" id="dealer_name" class="form-control" value=""> </div>
                                            </div>
                                            </div>

                                             <div class="form-group">
                                               <label for="address"><?php echo @LA_LB_ADDRESS;?></label>
                                               <textarea name="address" id="address" class="form-control"></textarea>
                                            </div>

                                             <div class="form-group">
                                             <div class="row">
                                          <div class="col-md-6"><label for="mobile"><?php echo @LA_LB_PHONE;?></label>
                                               <input type="text" name="mobile" id="mobile" class="form-control number" size="10" maxlength="10" value=""></div>
                                            <div class="col-md-6"><label for="email"><?php echo @LA_LB_EMAIL;?></label>
                                               <input type="text" name="email" id="email" class="form-control" value=""></div>
                                            </div>

                                            </div>

                                            <div class="form-group">
                                             <div class="row">
                                             <!--div class="col-md-6"><label for="idline"><?php echo @LA_LB_IDLINE;?></label>
                                               <input type="text" name="idline" id="idline" class="form-control" value=""></div-->
                                           </div>

                                            </div>
                                         </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_member" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                </form>
                                <!-- /.modal-dialog -->
</div>
                            <!-- /.modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i><?php echo @LA_LB_NEW_MEMBER;?></button><br/><br/>


   <div class="table-responsive tooltipx">
  <!-- Table -->
  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
  <thead>
  <tr style=" font-weight:bold;">
    <th width="8%" >ลำดับ</th>
    <th width="11%" >รหัสผู้จำหน่าย</th>
    <th width="11%" >ชื่อผู้จำหน่าย/ชื่อร้าน</th>
    <th width="16%" ><?php echo @LA_LB_PHONE;?></th>
    <th width="24%" ><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;

	    @$getmember = $getdata->my_sql_select(NULL,"dealer","status=1");

	 while(@$showmember = mysql_fetch_object($getmember)){
	  $x++;

  ?>
  <tr id="<?php echo @$showmember->member_key;?>">
    <td align="center"><?php echo @$x;?></td>
    <td>&nbsp;<?php echo $showmember->dealer_code;?></td>
    <td>&nbsp;<span data-toggle="tooltip" data-placement="right" title="<?php echo $showmember->dealer_name;?>"><?php echo $showmember->dealer_name;?></span></td>
    <td align="center" valign="middle"><?php echo @$showmember->mobile;?></td>
    <td align="center" valign="middle">
    <a href="?p=member_history&key=<?php echo @$showmember->dealer_id;?>" class="btn btn-xs btn-primary"><i class="fa fa-list"></i> <?php echo @LA_LB_PRODUCTDETAIL;?></a><a data-toggle="modal" data-target="#edit_member" data-whatever="<?php echo @$showmember->dealer_id;?>" class="btn btn-xs btn-info" style="color:#FFF;"><i class="fa fa-edit fa-fw"></i> <?php echo @LA_BTN_EDIT;?></a><button type="button" name="deleteMember" class="btn btn-danger btn-xs" onClick="javascript:deleteMember('<?php echo @$showmember->dealer_id;?>');"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button>
    </td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>

</div>

<!--<div style="text-align:right">
<nav>
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>-->
<script language="javascript">
 $( window ).load(function() {
        $(".number").bind('keyup mouseup', function () {
          if (/\D/g.test(this.value)){
                this.value = this.value.replace(/\D/g, '');
              }

                  });
          });
function getValidNumber(value){
  value = $.trim(value).replace(/\D/g,'');
  if(value.substring(0,1) == '1'){
    value = value.substring(1);
    }
  if(value.length == 10){
    return value;
  }
  return false;
}

function changeMemberStatus(memberkey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+memberkey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){

			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+memberkey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+memberkey).className = 'fa fa-lock';
				document.getElementById('text-'+memberkey).innerHTML = 'ซ่อน';
			}else{
				document.getElementById('btn-'+memberkey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+memberkey).className = 'fa fa-unlock-alt';
				document.getElementById('text-'+memberkey).innerHTML = 'แสดง';
			}
  		}
	}

	xmlhttp.open("GET","function.php?type=change_member_status&key="+memberkey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteMember(memberkey){
    var txt;
  var r = confirm("คุณต้องการลบข้อมูล !");
  if (r == true) {
      	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
      	 	xmlhttp=new XMLHttpRequest();
      	}else{// code for IE6, IE5
        		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      	}
      	xmlhttp.onreadystatechange=function(){
        		if (xmlhttp.readyState==4 && xmlhttp.status==200){
      			document.getElementById(memberkey).innerHTML = '';

        		}
      	}
      	xmlhttp.open("GET","function.php?type=delete_dealer&key="+memberkey,true);
      	xmlhttp.send();
          alert_Success("Success","<?=@LA_ALERT_DELETE;?>");
        } else {
          return false;
        }
}
function alert_Success(id,value){
    $( "#Success" ).show();
    $("#Success").removeClass("in").show();
    $("#valuealert").text(value);
    $("#Success").delay(3000).addClass("in").fadeOut(3000);
    }
</script>
<script>
    $('#edit_member').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "members/edit_member.php",
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
    function copyAddress(){
		var addr = document.getElementById('member_address').value;
		document.getElementById('member_address_now').value = addr;
	}
	function randomPassword(password_id,password_pattern,password_prefix,password_length){
	 var text = "";
	 if(password_pattern == 1){
		 var possible = "0123456789";
	 }else if(password_pattern == 2){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	 }else if(password_pattern == 3){
		 var possible = "abcdefghijklmnopqrstuvwxyz";
	 }else if(password_pattern == 4){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	 }else if(password_pattern == 5){
		 var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
	 }else if(password_pattern == 6){
		 var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	 }else{
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	 }

    for( var i=0; i < password_length; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    document.getElementById(password_id).value = password_prefix+text;
}
    </script>
                             <!-- DataTables JavaScript -->

    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

                            <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();


    });

    </script>
