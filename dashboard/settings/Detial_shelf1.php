<?php
session_start();
require("../../core/config.core.php");
require("../../core/connect.core.php");
require("../../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();

if(@addslashes($_GET['lang'])){
	$_SESSION['lang'] = addslashes($_GET['lang']);
}else{
	$_SESSION['lang'] = $_SESSION['lang'];
}
if(@$_SESSION['lang']!=NULL){
	require("../../language/".@$_SESSION['lang']."/site.lang");
	require("../../language/".@$_SESSION['lang']."/menu.lang");
}else{
	require("../../language/th/site.lang");
	require("../../language/th/menu.lang");
	$_SESSION['lang'] = 'th';

}
?>


		<!-- Modal detail shelf -->
		<div class="modal fade" id="detailShelf" name="detailShelf" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form id="formt" name="formt" method="post">
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" onclick="closesmodal()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel">รายการสินค้าในshelf</h4>
                </div>
                <div class="cttexxt">

                </div>
            </div>
        </div>
  </form>
</div>


 <div class="modal-body">
	 <nav class="navbar navbar-default" role="navigation">
	   <div class="row">
	       <div class="col-xs-4" style="padding-top: 15px; padding-left: 20px;">
	         <a id="addsearch" name="addsearch" style="cursor: pointer">  <i class="fa fa-plus fa-fw"></i> เพิ่มข้อมูล shelf <?php echo @$_GET['key'];?></a>
	      </div>
	   </div>
<div style="margin: 10px;">
	   <div id="searchOther" name="searchOther" style="display: none">
			  <div class="form-group row">
					<div class="col-md-6">
					<?
					 @$getcode = $getdata->getMaxID("shelf_code","shelf","s");
					?>

							<input type="hidden" name="shelf_header_code" id="shelf_header_code" class="form-control" value="<?php echo @$_GET['key'];?>">
							<input type="hidden" name="shelf_code" id="shelf_code" class="form-control" value="<?php echo @$getcode;?>">
							<label for="shelf_class">ชั้น สินค้า</label>
									<select name="shelf_class" id="shelf_class" class="form-control" required>
										<option value="1" selected="selected">ชั้น 1</option>
										<option value="2">ชั้น 2</option><option value="3">ชั้น 3</option><option value="4">ชั้น 4</option><option value="5">ชั้น 5</option>
										<option value="6">ชั้น 6</option><option value="7">ชั้น 7</option><option value="8">ชั้น 8</option><option value="9">ชั้น 9</option>
										<option value="10">ชั้น 10</option>
									</select>
						</div>
						<div class="col-md-6">
											<label for="shelf_amt">บรรจุ (ชิ้น)</label>
											<input type="number" name="shelf_amt" id="shelf_amt" class="form-control number" required>
										</div>
						</div>
						<button type="submit" name="save_Rim" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i><?php echo @LA_BTN_SAVE;?></button>
			</div>
	    </div>


	 </nav>
	 <table width="70%" class="table table-striped table-bordered table-hover">
   <thead>
   <tr style="color:#FFF;">
     <th width="3%" bgcolor="#5fb760">#</th>
     <!--th width="20%" bgcolor="#5fb760">รหัส</th-->
     <th width="30%" bgcolor="#5fb760">รายละเอียด</th>
		 <th width="15%" bgcolor="#5fb760">บรรจุ</th>
		 <th width="10%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
   </tr>
   </thead>
   <tbody>
   <?php
   $x=0;
	 $getcat = $getdata->my_sql_select("s.shelf_code,s.*
	 ,(select sum(d.amt_rimit) FROM shelf_detail d where d.shelf_code = s.shelf_code) as useAmt "
	 ,"shelf s"
	 ,"s.shelf_header_code = '".@$_GET['key']."' ORDER BY s.shelf_code, s.shelf_detail, s.shelf_class ");

   while($showcat = mysql_fetch_object($getcat)){
 	  $x++;
   ?>
   <tr id="<?php echo @$showcat->id;?>">
     <td align="center"><?php echo @$x;?></td>
     <!--td>&nbsp;<?php echo @$showcat->shelf_code;?></td-->
     <td>&nbsp;ชั้น <?php echo $showcat->shelf_class?></td>
		 <td>&nbsp;<a data-toggle="modal" data-target="#detailShelf" data-whatever="<?php echo @$showcat->shelf_code;?>"><?php if(@$showcat->useAmt > 0){echo @$showcat->useAmt;}else{echo 0;}  ;?>/<?php echo @$showcat->amt;?> &nbsp; ชิ้น</a></td>
		 <td><button type="button" class="btn btn-danger btn-xs" onClick="javascript:deletecat('<?php echo @$showcat->id;?>');"><i class="glyphicon glyphicon-remove"></i> <?php echo @LA_BTN_DELETE;?></button></td>
  </tr>
   <?php
   }
   ?>
   </tbody>
 </table>
                                        </div>
		<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" id="teeddd" name="teeddd" data-dismiss="modal"><i class="fa fa-times fa-fw"></i><?php echo @LA_BTN_CLOSE;?></button>

		</div>
   <script>
$( document ).ready(function() {
	$("#addsearch").click(function(){
			$("#searchOther").toggle();
	});
});
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
	xmlhttp.open("GET","function.php?type=delete_detailRimwheel&key="+catkey,true);
	xmlhttp.send();
	}
}

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
                  $('#teeddd').click();
									modal.find('.cttexxt').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })




</script>
