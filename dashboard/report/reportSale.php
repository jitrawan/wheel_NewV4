<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-pie-chart fa-fw"></i> รายงานการขาย</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
<li><a href="?p=report">รายงาน</a></li>
 <li class="active">รายงานการขาย</li>
</ol>

   <?php
   if(isset($_POST['search_product'])){
     $strsaerch = "";
     $strsaerchpop = "";
     $setGroup = "";
     $setothand ="";
     $setotypePo ="";
     if(addslashes($_POST['search_hand']) != ""){
       $setother = "&search_hand=".addslashes($_POST['search_hand']);
     }

     if(addslashes($_POST['search_type']) != ""){
       $setotypePo = "&search_type=".addslashes($_POST['search_type']);
     }


     if(addslashes($_POST['Typereport']) == "2"){
        $setGroup = "&pop=".addslashes($_POST['salepopType']);
        if(addslashes($_POST['salepopType']) == 'd'){
            $strsaerchpop = "&fromd=".addslashes($_POST['datepopPrfrom']);
        }else if(addslashes($_POST['salepopType']) == 'm'){
            $strsaerchpop = "&typeM=".addslashes($_POST['monthpop'])."&y=".addslashes($_POST['monthyear']);
        }else if(addslashes($_POST['salepopType']) == 'y'){
            $strsaerchpop = "&typeY=".addslashes($_POST['yearpop']);
        }


     }else{
       $strsaerch = "&from=".addslashes($_POST['datePrfrom'])."&dateto=".addslashes($_POST['datePrto']);
     }
       echo "<script>window.open(\"../dashboard/report/printReportSale.php?Typereport=".addslashes($_POST['Typereport']).$strsaerch.$setGroup.$strsaerchpop.$setother.$setotypePo."\",'_blank')</script>";
   }
   ?>
<nav class="navbar navbar-default" role="navigation">

  <div id="searchOther" name="searchOther">
 <form method="post" enctype="multipart/form-data" name="frmSearch" id="frmSearch">
   <div style="margin: 10px;">

     <div class="form-group row">
         <div class="col-md-4">
           <label ><b>เลือกออกรายงาน :    </b></label>
           <input type="radio" id="resumday" name="Typereport" value="1"  onclick="checkRadio(this.value)" checked>
           <label for="search_all">รายงานขายระหว่างวัน</label>
         </div>
         <div class="col-md-2">
           <input type="radio" id="resalegoo" name="Typereport" onclick="checkRadio(this.value)" value="2">
           <label for="wheel">รายงานขายสรุป</label>
         </div>
     </div>

<div class="sumday">
      <div class="form-group row">
          <div class="col-md-3">
            <label ><b>ระบุวันที่ จาก :    </b></label>
            <input type="text" id="datePrfrom" name="datePrfrom" class="form-control dpk" autocomplete="off">
          </div>
          <div class="col-md-3">
            <label ><b>ถึง :    </b></label>
            <input type="text" id="datePrto" name="datePrto" class="form-control dpk" autocomplete="off">
          </div>
      </div>
</div>
      <div class="salegoog" style="display: none">
      <div class="form-group row">
          <div class="col-md-2">
            <label ><b>สรุปการขาย :    </b></label>
            <input type="radio" id="allday" name="salepopType" value="d" checked>
            <label for="search_all">ประจำวัน</label>
          </div>
          <div class="col-md-2">
            <input type="radio" id="allmonth" name="salepopType" value="m">
            <label for="wheel">ประจำเดือน</label>
          </div>
          <div class="col-md-2">
            <input type="radio" id="allyear" name="salepopType" value="y">
            <label for="rubber">ประจำปี</label>
          </div>
      </div>

      <div id="dallday" name="dallday">
        <div class="form-group row">
            <div class="col-md-3">
              <label ><b>ระบุวันที่ :    </b></label>
              <input type="text" id="datepopPrfrom" name="datepopPrfrom" class="form-control dpk" autocomplete="off" >
            </div>
        </div>
      </div>
      <div id="dallmonth" name="dallmonth" style="display: none">
        <div class="form-group row">
            <div class="col-md-4">
              <label ><b>ประจำเดือน :    </b></label>
              <select name="monthpop" id="monthpop" class="form-control" required>
                <option value="1">มกราคม</option><option value="2">กุมภาพันธ์</option><option value="3">มีนาคม</option><option value="4">เมษายน</option>
                <option value="5">พฤษภาคม</option><option value="6">มิถุนายน</option><option value="7">กรกฎาคม</option><option value="8">สิงหาคม</option>
                <option value="9">กันยายน</option><option value="10">ตุลาคม</option><option value="11">พฤศจิกายน</option><option value="12">ธันวาคม</option>


              </select>
            </div>
            <div class="col-md-4">
                <label ><b>ปี :  (ตัวอย่าง 1992)    </b></label>
                <input type="number" id="monthyear" name="monthyear" class="form-control" autocomplete="off">
            </div>

        </div>
      </div>
      <div id="dallyear" name="dallyear" style="display: none">
        <div class="form-group row">
            <div class="col-md-4">
                <label ><b>ประจำปี :  (ตัวอย่าง 1992)    </b></label>
                <input type="number" id="yearpop" name="yearpop" class="form-control" autocomplete="off">
            </div>
      </div>
      </div>


      </div>

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

           <div style="text-align: center;margin-bottom: 10px;">

               <button type="submit" name="search_product" id="search_product" class="btn btn-default"><i class="fa fa-search"></i> ค้นหา</button>
           </div>

         </div>

         </form>
         </div>
      </nav>


    </div>


   </div>

   </form>
   </div>
</nav>
 <div class="table-responsive">

</div>
<script language="javascript">


$(document).ready(function(){


  var d = new Date();
  var n = d.getFullYear();

  $("#monthyear").val(n);

$('input[name=salepopType]').change(function(){
var value = $( 'input[name=salepopType]:checked' ).val();
    if(value == 'd'){
      $("#dallday").show();
      $("#dallmonth").hide();
        $("#monthyear").hide();
      $("#dallyear").hide();
    }else if(value == 'm'){
      $("#dallday").hide();
      $("#dallmonth").show();
      $("#monthyear").show();
      $("#dallyear").hide();
    }else if(value == 'y'){
      $("#dallday").hide();
      $("#dallmonth").hide();
        $("#monthyear").hide();
      $("#dallyear").show();
    }
});



  $("#datePrfrom").val('<?echo $_POST['datePrfrom'] ?>');

    $("#search_product").click(function(){

      var retype = $( 'input[name=Typereport]:checked' ).val();
      if(retype == '1' ){// sale day
        if($("#datePrfrom").val() == ""){
          alert("กรุณาระบุวันที่ใบเสร็จ จาก!");
          return false;
        }else if($("#datePrto").val() == ""){
          alert("กรุณาระบุวันที่ใบเสร็จ ถึง!");
          return false;
        }else if($("#datePrto").val() < $("#datePrfrom").val()){
            $("#datePrto").val("");
            alert("กรุณาระบุวันที่ใบเสร็จ ถึง ให้ถูกต้อง!");
            return false;
        }else{
            return true;
        }
      }else{ // sale all
        var getradio = $( 'input[name=salepopType]:checked' ).val();
        console.log(getradio);
      //  return false;
        if(getradio != "" && getradio != "underfined"){
          if(getradio == 'd'){
              if($("#datepopPrfrom").val() == ""){
                alert("กรุณาระบุวันที่ จาก!");
                return false;
              }else{
                  return true;
              }
            }else if(getradio == 'y'){
              if($("#yearpop").val() == ""){
                alert("กรุณาระบุปี");
                return false;
              }

            }else if(getradio == 'm'){
              if($("#monthyear").val() == ""){
                alert("กรุณาระบุปี");
                return false;
              }
            }
        }else{
          alert("กรุณาสินค้าขายดี");
          return false;
        }
      }


    });


  });

function checkRadio(isvalue){
  if(isvalue == '1'){
    $('.sumday').show();
    $('.salegoog').hide();
  }else if(isvalue == '2'){
      $('.sumday').hide();
      $('.salegoog').show();
  }

}






</script>
