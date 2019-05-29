<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-pie-chart fa-fw"></i> รายงานสินค้า</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
<li><a href="?p=report">รายงาน</a></li>
 <li class="active">รายงานสินค้า</li>
</ol>

   <?php
     if(isset($_POST['search_product'])){
        echo "<script>window.open(\"../dashboard/report/printReportProduct.php?key=".addslashes($_POST['search_type'])."&hand=".addslashes($_POST['search_hand'])."\",'_blank')</script>";
     }
   ?>
<nav class="navbar navbar-default" role="navigation">

  <div id="searchOther" name="searchOther">
 <form method="post" enctype="multipart/form-data" name="frmSearch" id="frmSearch">
   <div style="margin: 10px;">
        <!--div class="form-group row">
              <div class="col-md-3">
                <label ><b>Group By :    </b></label>
                <input type="radio" id="" name="" value="" checked>
                <label for="wheel">ประเภทสินค้า</label>
              </div>
          </div-->

        <div class="form-group row">
            <div class="col-md-2">
              <label ><b>ประเภทสินค้า :    </b></label>
              <input type="radio" id="search_all" name="search_type" value="0" checked>
              <label for="search_all">ทั้งหมด</label>
            </div>
            <div class="col-md-2">
              <input type="radio" id="search_wheel" name="search_type" value="1">
              <label for="wheel">ล้อแม๊ก</label>
            </div>
            <div class="col-md-2">
              <input type="radio" id="search_rubber" name="search_type" value="2">
              <label for="rubber">ยาง</label>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-2">
              <label ><b>สินค้า มือ :    </b></label>
              <select name="search_hand" id="search_hand" class="form-control">
                <option value="0" selected="selected">--ทั้งหมด--</option>
                <option value="1">สินค้ามือ 1</option>
                  <option value="2">สินค้ามือ 2</option>

              </select>
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
  var getradio = '<?echo $_POST['search_type'] ?>'
   var $radios = $('input:radio[name=search_type]');
    $radios.filter('[value='+getradio+']').prop('checked', true);

});
</script>
