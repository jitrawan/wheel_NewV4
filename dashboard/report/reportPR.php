<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-pie-chart fa-fw"></i> รายงานรับสินค้าเข้า</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
<li><a href="?p=report">รายงาน</a></li>
 <li class="active">รายงานรับสินค้าเข้า</li>
</ol>

   <?php
     if(isset($_POST['search_product'])){
        echo "<script>window.open(\"../dashboard/report/printReportPR.php?from=".addslashes($_POST['datePrfrom'])."&to=".addslashes($_POST['datePrto'])."\",'_blank')</script>";
     }
   ?>


<nav class="navbar navbar-default" role="navigation">

  <div id="searchOther" name="searchOther">
 <form method="post" enctype="multipart/form-data" name="frmSearch" id="frmSearch">
   <div style="margin: 10px;">


        <div class="form-group row">
            <div class="col-md-3">
              <label ><b>วันที่รับสินค้า จาก :    </b></label>
              <input type="text" id="datePrfrom" name="datePrfrom" class="form-control dpk" value="<? echo date("Y-m-d")?>">
            </div>
            <div class="col-md-3">
              <label ><b>ถึง :    </b></label>
              <input type="text" id="datePrto" name="datePrto" class="form-control dpk" value="<? echo date("Y-m-d")?>">
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
  if('<?echo $_POST['datePrfrom'] ?>' != "" && '<?echo $_POST['datePrto'] ?>' != ""){
    $("#datePrfrom").val('<?echo $_POST['datePrfrom'] ?>');
    $("#datePrto").val('<?echo $_POST['datePrto'] ?>');
  }

    $("#search_product").click(function(){
      if($("#datePrfrom").val() == ""){
        alert("กรุณาระบุวันที่รับสินค้า จาก!");
        return false;
      }else if($("#datePrto").val() == ""){
        alert("กรุณาระบุวันที่รับสินค้า ถึง!");
        return false;
      }else if($("#datePrto").val() < $("#datePrfrom").val()){
          $("#datePrto").val("");
          alert("กรุณาระบุวันที่รับสินค้า ถึง ให้ถูกต้อง!");
          return false;
      }else{
        return true;
      }

    });


  });



</script>
