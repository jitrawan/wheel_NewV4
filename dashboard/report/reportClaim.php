<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-pie-chart fa-fw"></i> รายงานเคลมสินค้า</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
<li><a href="?p=report">รายงาน</a></li>
 <li class="active">รายงานเคลมสินค้า</li>
</ol>

<?php
$setothand ="";
$setotypePo ="";
if(addslashes($_POST['search_hand']) != ""){
  $setother = "&search_hand=".addslashes($_POST['search_hand']);
}

if(addslashes($_POST['search_type']) != ""){
  $setotypePo = "&search_type=".addslashes($_POST['search_type']);
}

  if(isset($_POST['search_product'])){
      echo "<script>window.open(\"../dashboard/report/printReportClaim.php?Group=".addslashes($_POST['G_type'])."&status=".addslashes($_POST['card_status'])."&datefrom=".addslashes($_POST['datePrfrom'])."&dateto=".addslashes($_POST['datePrto']).$setother.$setotypePo."\",'_blank')</script>";
  }
?>

<nav class="navbar navbar-default" role="navigation">

  <div id="searchOther" name="searchOther">
 <form method="post" enctype="multipart/form-data" name="frmSearch" id="frmSearch">
   <div style="margin: 10px;">
        <!--div class="form-group row">
              <div class="col-md-2">
                <label ><b>Group By :    </b></label>
                <input type="radio" id="G_status" name="G_type" value="2" checked>
                <label for="wheel">สถานะ</label>
              </div>


          </div-->
          <div class="form-group row">
            <div class="col-md-2">
                <label ><b>ประเภท :    </b></label>
              <select name="search_type" id="search_type" class="form-control">
                <option value="0" selected="selected">--ทั้งหมด--</option>
                <option value="1">แม็ก</option>
                  <option value="2">ยาง</option>

              </select>
            </div>
            <div class="col-md-2">
                <label ><b>ชนิดสินค้า :    </b></label>
              <select name="search_hand" id="search_hand" class="form-control">
                <option value="0" selected="selected">--ทั้งหมด--</option>
                <option value="1">มือ 1</option>
                  <option value="2">มือ 2</option>

              </select>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-2">
              <label ><b>สถานะ :    </b></label>
              <select name="card_status" id="card_status" class="form-control">
              <?php
                $getcard_type = $getdata->my_sql_select(NULL,"card_type","ctype_status='1' ORDER BY ctype_insert");
                echo '<option value="" select>ทุกสถานะ</option>';
                while($showcard_type = mysql_fetch_object($getcard_type)){
                echo '<option value="'.$showcard_type->ctype_key.'">'.$showcard_type->ctype_name.'</option>';
                }
                ?>
              </select>
            </div>

          </div>

        <div class="form-group row">
          <div class="col-md-3">
            <label ><b>ระบุวันที่เคลม จาก :    </b></label>
            <input type="text" id="datePrfrom" name="datePrfrom" class="form-control dpk" autocomplete="off">
          </div>
          <div class="col-md-3">
            <label ><b>ถึง :    </b></label>
            <input type="text" id="datePrto" name="datePrto" class="form-control dpk" autocomplete="off">
          </div>


        </div>

    </div>
     <div style="text-align: center;margin-bottom: 10px;">
          <button type="submit" name="search_product" id="search_product" class="btn btn-default"><i class="fa fa-print"></i> Print Previwe</button>
     </div>

   </div>

   </form>
   </div>
</nav>
 <div class="table-responsive">

</div>
<script language="javascript">


$(document).ready(function(){
  var getradio = '<?echo $_POST['G_type'] ?>'
   var $radios = $('input:radio[name=G_type]');
    $radios.filter('[value='+getradio+']').prop('checked', true);
    $("#datePrfrom").val('<?echo $_POST['datePrfrom'] ?>');
    $("#datePrto").val('<?echo $_POST['datePrto'] ?>');
    $("#search_product").click(function(){

      if($("#datePrfrom").val() != ""){
          if($("#datePrto").val() < $("#datePrfrom").val()){
              $("#datePrto").val("");
              alert("กรุณาระบุวันที่รับสินค้า ถึง ให้ถูกต้อง!");
              return false;
            }else{
              return true;
            }
      }


    });

});
</script>
