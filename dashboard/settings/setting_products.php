
<style>
.fontawesome-select {
    font-family: 'FontAwesome', 'Helvetica';
}
</style>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa flaticon-bullet1 fa-fw"></i> <?php echo @LA_MN_PRODUCT;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <!--li><a href="?p=setting"><--?php echo @LA_LB_SETTING;?></a></li-->
  <li class="active"><?php echo @LA_MN_PRODUCT;?></li>
</ol>
<?php
if(isset($_POST['save_product'])){
	if(addslashes($_POST['ProductName']) != NULL){
		//$cat_key = md5(addslashes($_POST['cat_name']).time("now"));
    $getdata->my_sql_insert_New("product","ProductID, ProductName, BrandID, ModelID, dealer_code, ProductDetail, Quantity, PriceSale, PriceBuy, IsNew, IsRecommend, TypeID, ProductStatus, Warranty, shelf_id"," '".addslashes($_POST['ProductID'])."','".addslashes($_POST['ProductName'])."','".addslashes($_POST['BrandID'])."','".addslashes($_POST['ModelID'])."','".addslashes($_POST['dealer_code'])."','".addslashes($_POST['ProductDetail'])."','".addslashes($_POST['Quantity'])."','".addslashes($_POST['PriceSale'])."','".addslashes($_POST['PriceBuy'])."', '' , '' ,'".addslashes($_POST['TypeID'])."','".addslashes($_POST['ProductStatus'])."','".addslashes($_POST['shelf_id'])."' ");
		$alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}

if(isset($_POST['save_edit_item'])){
	if(addslashes($_POST['edit_ProductName']) != NULL){
	  $getdata->my_sql_update("product","ProductName='".addslashes($_REQUEST['edit_ProductName'])."',BrandID='".addslashes($_POST['edit_BrandID'])."',ModelID='".addslashes($_POST['edit_ModelID'])."',dealer_code='".addslashes($_POST['edit_dealer_code'])."',ProductDetail='".addslashes($_POST['edit_ProductDetail'])."',Quantity='".addslashes($_POST['edit_Quantity'])."',TypeID='".addslashes($_POST['edit_TypeID'])."',Warranty='".addslashes($_POST['edit_Warranty'])."' ,shelf_id='".addslashes($_POST['edit_shelf_id'])."' ","ProductID='".addslashes($_POST['edit_ProductID'])."'");
	
	$alert = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_UPDATE_DATA_DONE.'</div>';
	}else{
		$alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_DATA_MISMATCH.'</div>'; 
	}
}
?>
<!-- Modal Edit -->
<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <form method="post" enctype="multipart/form-data" name="form2" id="form2">
     
     <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                    <h4 class="modal-title" id="memberModalLabel"><?php echo @LA_LB_EDIT_EXPENDITURES;?></h4>
                </div>
                <div class="ct">
              
                </div>
            </div>
        </div>
  </form>
</div>

<div class="modal fade" id="model_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มรายการสินค้า</h4>
                                        </div>
                                        <?
                                                @$getMaxid = $getdata->getMaxID("ProductID","product","P");
                                              
                                                $getypetest = $getdata->my_sql_select(NULL,"type",NULL);
                                                $getypebrand = $getdata->my_sql_select(NULL,"brand",NULL);
                                                $getypemodel = $getdata->my_sql_select(NULL,"model",NULL);
                                                $getdealer = $getdata->my_sql_select(NULL,"dealer",NULL);
                                                $getshelf = $getdata->my_sql_select(NULL,"shelf",NULL);
                                                
                                        ?>
                                         <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="ProductID">รหัสสินค้า</label>
                                              <input type="text" name="ProductID" id="ProductID" value="<?php echo @$getMaxid;?>" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6">
                                             <label for="dealer_code">ผู้จำหน่าย</label>
                                             <select name="dealer_code" id="dealer_code">
                                              <option value="" selected="selected">--เลือกผู้จำหน่าย--</option>
                                              <?
                                              while($showdealer = mysql_fetch_object($getdealer)){?>
                                              <option value="<?php echo @$showdealer->dealer_code;?>" ><?php echo @$showdealer->dealer_name;?></option>
                                              <?
                                               }
                                             ?>
                                              </select>
                                             </div>
                                         </div>

                                        <div class="form-group">
                                           <label for="ProductName">ชื่อสินค้า</label>
                                           <input type="text" name="ProductName" id="ProductName" class="form-control">
                                         </div>

                                         <div class="form-group">
                                            <label for="ProductDetail">รายละเอียดสินค้า</label>
                                            <textarea name="ProductDetail" id="ProductDetail" class="form-control"></textarea>
                                          </div>
                                       
                                       <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="TypeID">ประเภทสินค้า</label>
                                              <select name="TypeID" id="TypeID">
                                              <option value="" selected="selected">--เลือกประเภทสินค้า--</option>
                                              <?
                                              $rows = array();
                                              while($showtype = mysql_fetch_object($getypetest)){
                                                  $rows[] = $showtype;
                                                  ?>
                                                   <option value="<?php echo @$showtype->TypeID;?>" ><?php echo @$showtype->TypeName;?></option>
                                                  <?
                                              }
                                              $getjson = @json_encode($rows,JSON_UNESCAPED_UNICODE);
                                              ?>
                                              </select>
                                            </div>
                                             <div class="col-md-6">
                                             <label for="BrandID">ยี่ห้อสินค้า</label>
                                             <select name="BrandID" id="BrandID">
                                              <option value="" selected="selected">--เลือกยี่ห้อสินค้า--</option>
                                              <?
                                              $rowsbrand = array();
                                              while($showbrand = mysql_fetch_object($getypebrand)){
                                                  $rowsbrand[] = $showbrand;
                                               }
                                              $getjsonbrand = @json_encode($rowsbrand,JSON_UNESCAPED_UNICODE);
                                              ?>
                                              </select>
                                             </div>
                                          </div>

                                           <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="ModelID">รุ่น</label>
                                              <select name="ModelID" id="ModelID">
                                              <option value="" selected="selected">--เลือกรุ่นสินค้า--</option>
                                              <?
                                              $rowmodel = array();
                                              while($showmodel = mysql_fetch_object($getypemodel)){
                                                  $rowmodel[] = $showmodel;
                                               }
                                              $getjsonmodel= @json_encode($rowmodel,JSON_UNESCAPED_UNICODE);
                                              ?>
                                              </select>
                                            </div>
                                            <div class="col-md-6">
                                             <label for="Warranty">การรับประกัน</label>
                                            <input type="text" name="Warranty" id="Warranty" class="form-control" >
                                             </div>
                                          </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="PriceSale">ราคาขาย</label>
                                              <input type="number" name="PriceSale" id="PriceSale" class="form-control number" value="0" style="text-align: right;">
                                            </div>
                                             <div class="col-md-6">
                                             <label for="PriceBuy">ราคาซื้อ</label>
                                            <input type="number" name="PriceBuy" id="PriceBuy" class="form-control number" value="0" style="text-align: right;">
                                             </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="Quantity">คงเหลือ</label>
                                              <input type="number" name="Quantity" id="Quantity" class="form-control number" value="0" style="text-align: right;">
                                            </div>
                                            <div class="col-md-6">
                                            <label for="pro_status"><?php echo @LA_LB_STATUS;?></label>
                                           <select name="pro_status" id="pro_status">
                                                <option value="1" selected="selected">เปิดใช้งาน</option>
                                                <option value="0">ปิดใช้งาน</option>
                                              
                                              </select>
                                            </div>
                                           </div>
                                          
                                        
                                         <div class="form-group">
                                         
                                              <label for="shelf_id">shelf</label>
                                              <select name="shelf_id" id="shelf_id" >
                                                <option value="" selected="selected">--เลือกชั้นวางสินค้า--</option>
                                                <?
                                              while($showshelf = mysql_fetch_object($getshelf)){?>
                                              <option value="<?php echo @$showshelf->shelf_id;?>"><?php echo @$showshelf->shelf_detail;?></option>
                                              <?
                                               }
                                             ?>
                                              </select>
     
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> <?php echo @LA_BTN_CLOSE;?></button>
                                          <button type="submit" name="save_product" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
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
 
 <!--button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i><?php echo @LA_LB_ADD_NEW_CATEGORIES;?></button--><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#model_product"><i class="fa flaticon-bullet1 fa-fw"></i>เพิ่มรายการสินค้า</button>
 <br/><br/>

 <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><i class="fa fa-folder-o"></i></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Model<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          <?php
		  if(addslashes($_GET['type']) != NULL){
			  $gettype_detail = $getdata->my_sql_query(NULL,"model","ModelID='".addslashes($_GET['type'])."'");
			  $text_cat = $gettype_detail->ModelName;
		  }else{
			 $text_cat = LA_LB_ALL;
		  }
		  $gettype = $getdata->my_sql_select(NULL,"model","ModelStatus='1'");
		  		echo '<li><a href="?p=setting_products">'.LA_LB_ALL.'</a></li>';
            while($showtype = mysql_fetch_object($gettype)){
				echo '<li><a href="?p=setting_products&type='.$showtype->ModelID.'">'.$showtype->ModelName.'</a></li>';
            }
			?>
          </ul>
        </li>
        <li><a><?php echo @$text_cat;?></a></li>
      </ul>
     <!-- <form class="navbar-form navbar-right" method="get" role="search" action="">
        <div class="input-group">
         <span class="input-group-addon" id="sizing-addon2">ค้นหา</span>
         <input type="hidden" name="p" id="p" value="product_search">
<input type="text" class="form-control" name="search" placeholder="พิมพ์ชื่อรายการค่าใช้จ่ายหรือ รหัสที่นี่">
    </div>
      </form>-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 <div class="panel panel-default">
   <div class="table-responsive tooltipx">
  <!-- Table -->
  <table width="100%" class="table table-bordered ">
  <thead>
  <tr style="color:#FFF;">
    <th width="4%" bgcolor="#5fb760">#</th>
    <th width="7%" bgcolor="#5fb760">รหัส</th>
    <th width="23%" bgcolor="#5fb760">ชื่อสินค้า</th>
    <th width="10%" bgcolor="#5fb760">ยี่ห้อ</th>
    <th width="10%" bgcolor="#5fb760">ประเภท</th>
    <th width="10%" bgcolor="#5fb760"><?php echo @LA_LB_PRICE;?></th>
    <th width="13%" bgcolor="#5fb760"><?php echo @LA_LB_MANAGE;?></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $x=0;
   if(@addslashes($_GET['type']) != NULL){
	   $getproduct = $getdata->my_sql_select(NULL,"product","ModelID='".addslashes($_GET['type'])."'");
   }else{
	   $getproduct = $getdata->my_sql_select(NULL,"product",NULL);
	}
  while($showproduct = mysql_fetch_object($getproduct)){
    $getbrand = $getdata->my_sql_query("BrandName","brand","BrandID='".@$showproduct->BrandID."'");
    $gettype = $getdata->my_sql_query("TypeName","type","TypeID='".@$showproduct->TypeID."'");
	  $x++;
	  if($showproduct->pro_instore <= $showproduct->pro_alert){
		  $proalert = 'style="font-weight:bold; color:#FFF; background:#FF5E6B;"';
	  }else{
		  $proalert = 'style="font-weight:bold; color:#FFF; background:#6EC038;"';
	  }
	  if($showproduct->pro_vat_type == 1){
		  $tax = 'style="color:#6EC038"';
	  }else if($showproduct->pro_vat_type == 2){
		  $tax = 'style="color:#FF66FF"';
	  }else{
		  $tax = 'style="color:#CCCCCC"';
	  }
  ?>
  <tr id="<?php echo @$showproduct->ProductID;?>">
    <td align="center" ><?php echo @$x;?></td>
    <td align="center"><?php echo @$showproduct->ProductID;?></td>
    <td>&nbsp;<span data-toggle="tooltip" data-placement="right" title="<?php echo $showproduct->ProductName;?>"><?php echo @$showproduct->ProductName;?></span></td>
    <td>&nbsp;<?php echo @$getbrand->BrandName;?></td>
    <td>&nbsp;<?php echo @$gettype->TypeName;?></td>
    <td align="right" valign="middle"><strong><?php echo @convertPoint2($showproduct->PriceBuy,'2');?></strong>&nbsp;</td>
    <td align="center" valign="middle">
      <?php
	  if($showproduct->ProductStatus == '1'){
		  echo '<button type="button" class="btn btn-success btn-xs" id="btn-'.@$showproduct->ProductID.'" onClick="javascript:changeproductsStatus(\''.@$showproduct->ProductID.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-unlock-alt" id="icon-'.@$showproduct->ProductID.'"></i> <span id="text-'.@$showproduct->ProductID.'">'.LA_BTN_ON.'</span></button>';
	  }else{
		  echo '<button type="button" class="btn btn-danger btn-xs" id="btn-'.@$showproduct->ProductID.'" onClick="javascript:changeproductsStatus(\''.@$showproduct->ProductID.'\',\''.$_SESSION['lang'].'\');"><i class="fa fa-lock" id="icon-'.@$showproduct->ProductID.'"></i> <span id="text-'.@$showproduct->ProductID.'">'.LA_BTN_OFF.'</span></button>';
	  }
	  ?><a data-toggle="modal" data-target="#edit_item" data-whatever="<?php echo @$showproduct->ProductID;?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> <?php echo @LA_BTN_EDIT;?></a><a onClick="javascript:deleteProduct('<?php echo @$showproduct->ProductID;?>');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> <?php echo @LA_BTN_DELETE;?></a></td>
  </tr>
  <?php
  }
  ?>
  </tbody>
</table>
</div>
</div>
<script language="javascript">
$( document ).ready(function() {

$(".number").bind('keyup mouseup', function () {
								if($(this).val() < 0) {
									alert("กรุณากรอกตัวเลขให้ถูกต้อง ! "); 
									$(this).val(0);
								}       
						});

   $('select').selectize();
  
  $("#TypeID").change(function() {
    opctionBrand($(this).val(),"BrandID");
  });
  $("#BrandID").change(function() {
    opctionmodel($(this).val(),"ModelID");
  });
  
});

function opctionmodel(val,id){
  var getjson = <?echo @$getjsonmodel?>;
  var $ModelID = $("#"+id);
  $ModelID.empty();
  if(getjson != null){
    $ModelID.append("<option>--เลือกรุ่นสินค้า--</option>");
    for (var i = 0; i < getjson.length; i++) { 
      if(val == getjson[i].BrandID){
        $ModelID.append("<option value=" +  getjson[i].ModelID + ">" + getjson[i].ModelName + "</option>");
      }
    }
  }else{
    $ModelID.append("<option>--เลือกรุ่นสินค้า--</option>");
  }
};

function opctionBrand(val,id){
  var getjson = <?echo @$getjsonbrand?>;
  var $BrandID = $("#"+id);
  $BrandID.empty();
  if(getjson != null){
    $BrandID.append("<option>--เลือกยี่ห้อสินค้า--</option>");
    for (var i = 0; i < getjson.length; i++) { 
      if(val == getjson[i].TypeID){
        $BrandID.append("<option value=" +  getjson[i].BrandID + ">" + getjson[i].BrandName + "</option>");
      }
    }
  }else{
    $BrandID.append("<option>--เลือกยี่ห้อสินค้า--</option>");
  }
};

function changeproductsStatus(prokey,lang){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var es = document.getElementById('btn-'+prokey);
	if(es.className == 'btn btn-success btn-xs'){
		var sts= 1;
	}else{
		var sts= 0;
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			if(es.className == 'btn btn-success btn-xs'){
				document.getElementById('btn-'+prokey).className = 'btn btn-danger btn-xs';
				document.getElementById('icon-'+prokey).className = 'fa fa-lock';
				if(lang == 'en'){
					document.getElementById('text-'+prokey).innerHTML = 'Hide';
				}else{
					document.getElementById('text-'+prokey).innerHTML = 'ไม่ใช้งาน';
				}
				
			}else{
				document.getElementById('btn-'+prokey).className = 'btn btn-success btn-xs';
				document.getElementById('icon-'+prokey).className = 'fa fa-unlock-alt';
				if(lang == 'en'){
					document.getElementById('text-'+prokey).innerHTML = 'Show';
				}else{
					document.getElementById('text-'+prokey).innerHTML = 'เปิดใช้งาน';
				}
				
			}
  		}
	}
	
	xmlhttp.open("GET","function.php?type=change_products_status&key="+prokey+"&sts="+sts,true);
	xmlhttp.send();
}
	function deleteProduct(prokey){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById(prokey).innerHTML = '';
			
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_products&key="+prokey,true);
	xmlhttp.send();
}

    $('#edit_item').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "settings/edit_item.php",
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