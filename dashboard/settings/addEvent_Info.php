<style>
#custom-search-input{
    padding: 3px;
    border: solid 1px #E4E4E4;
    border-radius: 6px;
    background-color: #fff;
}

#custom-search-input input{
    border: 0;
    box-shadow: none;
}

#custom-search-input button{
    margin: 2px 0 0 0;
    background: none;
    box-shadow: none;
    border: 0;
    color: #666666;
    padding: 0 8px 0 10px;
    border-left: solid 1px #ccc;
}

#custom-search-input button:hover{
    border: 0;
    box-shadow: none;
    border-left: solid 1px #ccc;
}

#custom-search-input .glyphicon-search{
    font-size: 23px;
}
</style>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-bookmark-o fa-fw"></i> Event</h1>
     </div>
</div>
<ol class="breadcrumb">
    <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
   <li><a href="?p=setting"><?php echo @LA_LB_SETTING;?></a></li>
  <li class="active">เพิ่ม Event</li>
</ol>

 <?php
$getpo = $getdata->my_sql_query(NULL,"Event_Info","Event_Code='".$_GET['d']."'");


if(isset($_POST['addEventitem'])){
?>
<script>console.log('insert');</script>
<?
  $getporduct = $getdata->my_sql_select(NULL,"Event_Item"," Event_Code='".$_GET['d']."' and ProductID='".$_POST['ProductID']."'");
    if(mysql_num_rows($getporduct) < 1){
       $getdata->my_sql_insert_New("Event_Item","Event_Code, ProductID, code
          , PriceSale, item_amt "
          ," '".$_GET['d']."'
          ,'".addslashes($_POST['ProductID'])."'
          ,'".addslashes($_POST['code'])."'
          ,".addslashes($_POST['PriceSale'])."
          ,".addslashes($_POST['item_amt'])." ");

        echo "<script>window.location=\"../dashboard/index.php?p=addEvent_Info&d=".addslashes($_GET['d'])."\"</script>";

          $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
    }else{
      $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
    }

}

 ?>



  <div class="panel panel-primary">
                        <div class="panel-heading">
                          รายละเอียด Event
                        </div>
                        <div class="panel-body">
                           <div class="form-group">

                             <div class="form-group row">
                                <div class="col-xs-2">
                                            <label >Event Code :  </label>&nbsp;<label style="font-size: 20px; color: #0056ff;"><?= @$getpo->Event_Code?></label>

                                </div>
                                <div class="col-xs-10">
                                  <label>Event Name :</label>&nbsp;<label style="font-size: 20px; color: #0056ff;"><?= @$getpo->Event_Name?></label>
                                </div>
                            </div>

                           </div>
                           <div class="form-group row">

                             	   <div class="col-xs-3">
                             	     <label>Effective Date :</label>&nbsp;<label style="font-size: 20px; color: #0056ff;"><?= @$getpo->eff_date?></label>
                             	   </div>
                                 <div class="col-xs-3">
                             	     <label>Expiry Date :</label>&nbsp;<label style="font-size: 20px; color: #0056ff;"><?= @$getpo->exp_date?></label>
                             	   </div>
                                 <div class="col-md-3">
                                   <label>Status :</label>&nbsp;<label style="font-size: 20px; color: #0056ff;">
                                     <? if($getpo->Event_Status == '1'){
                                       $getstatus = "เปิดใช้งาน";
                                     }else{
                                       $getstatus = "ปิดใช้งาน";
                                     }?>
                                     <?= $getstatus?>
                                   </label>

                                 </div>
                           </div>
                           <hr>
                             <form class="" role="search" method="get">
                                   <div class="row">
                                           <div class="col-md-9">
                                             <div id="custom-search-input">
                                                   <div class="input-group col-md-12">
                                                     <input type="hidden" name="p" id="p" value="addEvent_Info" >
                                                     <input type="hidden" name="d" id="d" value="<?= $_GET['d']?>" >
                                                      <input type="text" class="form-control" name="proId" id="proId" placeholder="กรอกรหัสสินค้า เพื่อเพิ่มรายการ" value="<?php echo @htmlentities($_GET['proId']);?>" />
                                                       <span class="input-group-btn">
                                                           <button type="submit" class="btn btn-info btn-lg">
                                                               <i class="glyphicon glyphicon-search"></i>
                                                           </button>
                                                       </span>
                                                   </div>
                                               </div>
                                           </div>
                                         </div>
                                </form>
                                 <br>
<?
if($_GET['proId'] != ""){
  $gettype = $getdata->my_sql_select("p.TypeID,p.ProductID","
  product_N p
  left join productDetailWheel w on p.ProductID = w.ProductID
  left join productDetailRubber r on p.ProductID = r.ProductID
  "," (w.code='".$_GET['proId']."' or r.code='".$_GET['proId']."') ");
  if(mysql_num_rows($gettype) > 0){
    while($showtype = mysql_fetch_object($gettype)){
      if($showtype->TypeID == '1'){
        $getfont = $getdata->my_sql_query("p.*, r.*, w.* ,w.code as wcode, r.code as rcode ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
        ,case
        when p.TypeID = '2'
        then (select b.Description from brandRubble b where r.brand = b.id)
        when p.TypeID = '1'
        then (select b.Description from BrandWhee b where b.id = w.brand)
        end BrandName
        ,case
          when p.TypeID = '2'
          then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
          when p.TypeID = '1'
          then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
          end code "
        ,"product_N p
        left join productDetailWheel w on p.ProductID = w.ProductID
        left join productdetailrubber r on p.ProductID = r.ProductID "
        ," p.TypeID = '1'
         And p.ProductID = '".$showtype->ProductID."' ");
       }else{
         $getfont = $getdata->my_sql_query("p.*, r.*, w.* ,w.code as wcode, r.code as rcode ,w.diameter as diameterWheel,r.diameter as diameterRubber,p.ProductID as ProductID,r.diameter as rubdiameter ,w.diameter as whediameter
         ,case
         when p.TypeID = '2'
         then (select b.Description from brandRubble b where r.brand = b.id)
         when p.TypeID = '1'
         then (select b.Description from BrandWhee b where b.id = w.brand)
         end BrandName
         ,case
           when p.TypeID = '2'
           then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
           when p.TypeID = '1'
           then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
           end code "
         ,"product_N p
         left join  productDetailWheel w on p.ProductID = w.ProductID
         left join productdetailrubber r on p.ProductID = r.ProductID "
         ," p.TypeID = '2'
          And p.ProductID = '".$showtype->ProductID."' ");
       }

    }

    if($getfont->TypeID == '1'){
      $getdetail = "ล้อแม๊ก ".$getfont->BrandName." ขนาด:".$getfont->diameterWheel." ขอบ:".$getfont->whediameter." รู:".$getfont->holeSize." ประเภท:".$getfont->typeFormat;
    }else if($getfont->TypeID == '2'){
      $getdetail = "ยาง ".$getfont->BrandName." ขนาด:".$getfont->diameterRubber." ซี่รี่:".$getfont->series." ความกว้าง:".$getfont->width;
    }else{
      $getdetail = "";
    }
    ?>
    <form method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="panel panel-green">
                          <div class="panel-heading">
                            เพิ่มรายการ Event
                          </div>
                          <div class="panel-body">
                             <div class="form-group">

                               <div class="form-group row">
                                  <div class="col-xs-3">
                                              <label for="musername">ProductID </label>
                                              <input class="form-control" type="text" name="ProductID" id="ProductID" value="<?= @$getfont->ProductID?>" style="display:none;">
                                              <input class="form-control" type="text" name="code" id="code" value="<?= @$getfont->code?>" readonly>
                                  </div>
                                  <div class="col-xs-8">
                                              <label for="musername">รายละเอียด</label>
                                              <input class="form-control" type="text" name="Productdetail" id="Productdetail" value="<?= @$getdetail?>" readonly>
                                  </div>
                               </div>

                             </div>
                             <div class="form-group row">
                               <div class="col-xs-3">
                                 <label>ราคาขาย/ชิ้น ราเดิม : </label>&nbsp;<label style="font-size: 20px; color: #0056ff;"><?= @$getfont->PriceSale?></label>
                                   <input type="number" name="PriceSale" id="PriceSale" class="form-control" value=""  required>
                               </div>

                                   <div class="col-xs-3">
                                     <label for="mname">จำนวน</label>
                                       <input type="text" name="item_amt" id="item_amt" class="form-control" value="" required  >
                                   </div>

                                   <div class="col-xs-1">
                                     <button type="submit" name="addEventitem" id="addEventitem" style="margin-top: 25px;" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
                                   </div>
                                 </div>
           </div>
         </div>
        </form>
    <?
  }else{
  $alert = '<div class="alert alert-danger alert-dismissable"><button data-dismiss="alert" class="close" type="button">×</button>ไม่พบข้อมูล !</div>';
  }

}

echo @$alert;
?>


                           <table width="80%" border="0" class="table-bordered">
                           <thead>
                         <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
                           <td width="12%">รหัสสินค้า</td>
                           <td width="15%">ราคา/ชิ้น</td>
                           <td width="15%">จำนวน</td>
                           <td width="10%">ปรับปรุง</td>
                         </tr>
                         </thead>
                           <tbody>
                           <?
                            $getproduct = $getdata->my_sql_select(NULL,"Event_Item","Event_Code='".$_GET['d']."'");
                            if(mysql_num_rows($getproduct) > 0){
                           while($showproduct = mysql_fetch_object($getproduct)){
                             ?>
                           <tr id="<?php echo @$showproduct->id;?>">
                             <td align="center"><?php echo @$showproduct->code;?></td>
                             <td align="right" valign="middle"><strong><?php echo @$showproduct->PriceSale;?></strong>&nbsp;</td>
                             <td align="right" valign="middle"><strong><?php echo @$showproduct->item_amt;?></strong>&nbsp;</td>
                             <td align="center"><button type="submit" name="btn_delete" onClick="javascript:deleteEventitem('<?php echo @$showproduct->id;?>');" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> <?php echo @LA_BTN_DELETE;?></button></td>

                          </tr>
                        <? }
                      }else{ ?>
                        <tr>
                          <td colspan="4">
                            <?
                         echo '<div class="alert alert-danger alert-dismissable">ไม่พบข้อมูล !</div>';
                           ?>
                         </td>
                       </tr>
                     <?  }?>
                         </tbody>
                       </table>
                         </div>
  </div>

<script language="javascript">

$(document).ready(function(){
    $("#eff_date").val('<?echo $_POST['eff_date'] ?>');
    $("#exp_date").val('<?echo $_POST['exp_date'] ?>');

    $("#addEvent").click(function(){
      var d = new Date();
      var e = new Date($("#eff_date").val());
      console.log(d);
      console.log(e);
      if($("#eff_date").val() != ""){
          if($("#exp_date").val() < $("#eff_date").val()){
              var d = new Date();
              var e = new Date($("#eff_date").val());
              $("#eff_date").val("");
                alert("กรุณาระบุวันที่ ให้ถูกต้อง!");
                return false;
              }
              if(e < d){
                $("#eff_date").val("");
                alert("กรุณาระบุวันที่ Effective Date มากกว่าหรือเท่ากันวันที่ปัจจุบัน!");
                return false;
              }
        }
  });


});


function deleteEventitem(catkey){
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
    xmlhttp.open("GET","function.php?type=delete_Eventitem&key="+catkey,true);
    xmlhttp.send();
  }
}
</script>
