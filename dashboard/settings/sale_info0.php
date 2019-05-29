<style>
.warantryTrue {
  font-size: 20px;
  font-weight:bold;
  color: green;
}
.warantryFalse {
  font-size: 20px;
  font-weight:bold;
  color: red;
}
.autocomplete {
  position: relative;

}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  top: 100%;
  left: 0;
  right: 0;
  width: 50%;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important;
  color: #ffffff;
}
table {
  border-collapse: collapse;
  width: 100%;
}

td, th {

  padding: 8px;
}

.g-input{
    width: 100%;
}
.right{
  text-align: right;
}
.total{
  background-color: #fffacd;
    color: #255a32;
    font-size: 2.5em;
}
.total1{
  font-size: 1.5em;
}
#itable_product th{
  background-color : #C3C0C0;
  color: #FFF;
}


</style>


<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<!--link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"-->
   <!--script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script-->

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>


</head>
<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-shopping-cart fa-fw"></i> การขายสินค้า</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">รายละเอียดการทำธุรกรรม</li>
</ol>

<?
if(isset($_POST['tSave'])){
$myArray = $_REQUEST['result'];
$pieces = explode(",", $myArray);
for ($i = 0; $i <= count($pieces); $i++) {
  ?>
<script>
//console.log("count  :: "+'<?= $myArray ?>');
</script>
  <?
}


    //update stock
    //Insert reserve
}

$getproduct_info = $getdata->my_sql_select(NULL,"product_N",NULL);
while($objShow = mysql_fetch_object($getproduct_info)){
            $return_arr[] =  $objShow->ProductID;
             $data[] = $objShow;
        }

        $getjoson = json_encode($return_arr);

        $results = ["sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
        	"aaData" => $data ];
        $testdata = json_encode($results);


 if(htmlentities($_GET['q']) != ""){

  $getcard = $getdata->my_sql_selectJoin(" p.*, d.*, w.*, s.* ,r.*,p.ProductID as setProductID ,DATEDIFF(CURDATE(),r.reserveDate) as warantryDay
                                          ,CASE
                                              WHEN DATEDIFF(CURDATE(),r.reserveDate) <= p.Warranty THEN 'T'
                                              ELSE 'F'
                                              END as resultwarantry
                                          ,CASE
                                              WHEN DATEDIFF(CURDATE(),r.reserveDate) <= p.Warranty THEN 'warantryTrue'
                                              ELSE 'warantryFalse'
                                              END as csswarantry "
                                          ," product_N "
                                          ," productDetailWheel w on p.ProductID = w.ProductID
                                          left join productDetailRubber d on p.ProductID = d.ProductID
                                          left join shelf s ON p.shelf_id = s.shelf_id
                                          left join reserve r ON p.ProductID = r.ProductID "
                                          ,"WHERE r.reserveId = ".htmlentities($_GET['q']));
                                        }

  $showcard = mysql_fetch_object($getcard);
  ?>

<div class="tab-pane fade in active" id="info_data">
  <!--form method="post" enctype="multipart/form-data" name="form2" id="form2"-->
<div class="panel panel-primary">
<div class="panel-heading"><i class="fa fa-shopping-cart fa-fw"></i> การขายสินค้า</div>
<div class="panel-body">
<div class="form-group row">
  <div class="col-xs-6">
    <?
            $objQuery=$getdata->my_sql_select("max(reserveId) as maxcode ","reserve","");
            $objShow=mysql_fetch_object($objQuery);
            @$getMaxid = (int)$objShow->maxcode + 1;

            $checkPro = $getdata->my_sql_select(NULL," product_N "," ProductID = '".$getMaxid."' ");



    ?>
    <label>เลขที่ใบเสร็จ : </label>
    <div class="input-group">
      <span class="input-group-addon">123</span>
     <input class="form-control" type="text" placeholder="เว้นว่างไว้เพื่อสร้างโดยอัตโนมัติ" name="" id="" readonly>
    </div>
    <input class="form-control" type="hidden" name="reserve_no" id="reserve_no" value="<?php echo @$getMaxid;?>">
    <input class="form-control" type="hidden" name="checkpro" id="checkpro" value="<?php echo @mysql_num_rows($checkPro);?>">
    <input class="form-control" type="hidden" name="result" id="result" value="">

  </div>
  <div class="col-xs-6">
    <label>วันที่ใบเสร็จ : </label>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      <input class="form-control form_datetime" type="text" name="reserve_date" id="reserve_date" title="วันที่ใบเสร็จ" value="<?= date("Y-m-d")?>">
    </div>

  </div>
</div>
<div class="form-group row">
  <div class="col-xs-3">
    <label>จำนวน : </label>
    <div class="input-group">
      <span class="input-group-addon">123</span>
     <input class="form-control right number" type="number"  name="product_quantity" id="product_quantity" value="1">
    </div>
    </div>
  <div class="col-xs-9">
    <label>รหัสสินค้า/บาร์โค้ด : </label>

<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
  <input class="form-control" placeholder="กรอกรหัสสินค้า เพื่อค้นหา" type="text" name="ProductID" id="ProductID" autocomplete="off">
  <div class="autocomplete" style="width:50%;"></div>
</div>
  </div>
</div>

<div class="table-responsive">
<table id="itable_product" class="" cellspacing="0" style="width:100%">
</table>
<table id="">

   <tfoot>
      <tr>
         <td colspan="3" rowspan="8" class="top"><label for="comment">หมายเหตุ</label>
           <label class="g-input">
           <div class="input-group">
             <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
             <textarea rows="6" name="comment" id="comment" class="form-control"></textarea>
            </div>
           </div>
          </td>
         <td class="right">รวม</td>
         <td colspan="2" class="right" id="sub_total"><input style="border:none; height: auto; " class="form-control total1 right" type="text" name="clock" id="clock" size="7" value=""></td>
         <td class="right">บาท</td>
      </tr>
     <tr>
         <td class="right"><label for="tax_status">ภาษีหัก ณ. ที่จ่าย</label></td>
         <td><label class="g-input"><span class="g-input"><div class="input-group"><input type="text" class="form-control right number" value="7" name="tax" id="tax" size="5" class="price" readonly><span class="input-group-addon">%</span></div></span></label></td>
         <td><label class="g-input"><input class="form-control right number" placeholder="0.00" type="text" id="tax_total" name="tax_total" size="5"  readonly=""></label></td>
         <td class="right">บาท</td>
      </tr>
      <tr class="due">
         <td class="right">รวมทั้งสิ้น</td>
         <td colspan="2" id="payment_amount"><input style="border:none; height: auto; " class="form-control total right" type="text" name="sum_total" id="sum_total" size="7" ></td>
         <td class="right">บาท</td>
      </tr>
      <tr class="due">
         <td class="right"></td>
         <td class="right" colspan="2" id="payment_amount"><button type="button" style="background-color: #4caf50; border-color: #4caf50; font-size:22px;" name="tSave" id="tSave" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button></td>
         <td class="right"></td>
      </tr>

   </tfoot>
</table>
</div>
</div>

<!--/form-->


</div>
  </div>

<script language="javascript">

$(document).ready(function(){



//localStorage.setItem('DataSeto', []);
//localStorage.setItem('dataSet', []);
    let gettotal = 0;
    let DataSeto;
    try{
        DataSeto = JSON.parse(localStorage.getItem('DataSeto')) || [];
        console.log(gettotal);

    } catch (err) {
        DataSeto = [];
    }

  $('#itable_product').dataTable({
      "bProcessing": true,
        "data": [],
            "columns": [{
            "title": "จำนวน",
            "width": '5%'
        }, {
            "title": "",
            "width": '10%'
        }, {
            "title": "รายละเอียด",
            "width": '20%'
        }, {
            "title": "หน่วยละ",
            "width": '10%',
            "background-color": "#C3C0C0"
        }, {
            "title": "ส่วนลด",
            "width": '10%'
        }, {
            "title": "จำนวนเงิน (บาท)",
            "width": '10%'
        }, {
            "title": "",
            "width": '5%'
        }],
        "ordering": false,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false,
        "language" : {
          "zeroRecords": " "
        },
        drawCallback: function () {
     var api = this.api();
     $( api.table().footer() ).html(
      gettotal = api.column( 5 ).data().sum()
      );
      let gettotaltax = 0;
      let sum_total = 0.00
      $('#clock').val(numberWithCommas(gettotal));
      gettotaltax = (Number(gettotal) * $('#tax').val()) / 100;
        $('#tax_total').val(numberWithCommas(gettotaltax));
        if(gettotaltax > 0){
          sum_total = gettotaltax + gettotal;
        }
        $('#sum_total').val(numberWithCommas(sum_total));


   }
    });

  jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
    return this.flatten().reduce( function ( a, b ) {
        if ( typeof a === 'string' ) {
            a = a.replace(/[^\d.-]/g, '') * 1;
        }
        if ( typeof b === 'string' ) {
            b = b.replace(/[^\d.-]/g, '') * 1;
        }

        return a + b;
    }, 0 );
} );

    proTable = $('#itable_product').DataTable();
    for (var x = 0; x < DataSeto.length; x++) {
         proTable.row.add(DataSeto[x]).draw();

    }

    var getjson = <?= $getjoson?>;
    $("#ProductID").autocomplete({
           source: getjson,
           minLength: 1,
           select: function (event, ui) {
             var str = ui.item.value;
             if (str=="") {
               document.getElementById("txtHint").innerHTML="";
               return;
             }
             if (window.XMLHttpRequest) {
               xmlhttp=new XMLHttpRequest();
             } else { // code for IE6, IE5
               xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
             }
             xmlhttp.onreadystatechange=function() {
               if (this.readyState==4 && this.status==200) {
                 var obj = JSON.parse(this.response);
                 var gettype = "";
                 if(obj[0].TypeID == '1'){
                   gettype = "ล้อแม๊ก";
                 }else{
                   gettype = "ยาง";
                 }

                 let discount = 0;
                 if( Number(obj[0].discount) > 0){
                    discount = (Number(obj[0].PriceSale) * Number(obj[0].discount)) / 100;
                 }
                 let total = Number($('#product_quantity').val()) * (Number(obj[0].PriceSale) - discount);
                 var quantity = '<label class="g-input"><div><input type="text" class="form-control right" placeholder="0.00" name="quantity[]" size="5" value=" ' + $('#product_quantity').val() + ' " class="price" id="price_0"></div></label>';
                 var getdetail = '<label class="g-input"><div><input type="text" class="form-control" name="topic[]" value='+gettype+' id="topic_0"></label></div>';
                 var getPriceSale = '<label class="g-input"><div><input type="text" class="form-control right" placeholder="0.00" name="PriceSale[]" size="5" value=" ' + obj[0].PriceSale + ' " class="price" id="price_0"></div></label>';
                 var getdiscount = '<label class="g-input"><span class="g-input"><div class="input-group"><input type="text" class="form-control right number" value="'+obj[0].discount+'" placeholder="0.00" name="discount[]" size="5" class="price" id="price_0"><span class="input-group-addon">%</span></div></span></label>';
                 var butdelete = '<a class="btn btn-danger btn-xs idelete"><i class="fa fa-times"></i> <?php echo @LA_BTN_DELETE;?></a>';
                 var data = [
                         $('#product_quantity').val(),
                         obj[0].setProductID,
                         getdetail,
                         obj[0].PriceSale,
                         getdiscount,
                         total,
                         butdelete
                     ];

                 proTable.row.add(data).draw();
                 DataSeto.push(data);
                 localStorage.setItem('DataSeto', JSON.stringify(DataSeto));

               }
             }
             xmlhttp.open("GET","function.php?type=saveTable&key="+str,true);
             xmlhttp.send();
            }


       });


       $(document).on('click', '.idelete', function () {
             var row = $(this).closest('tr');
             proTable.row(row).remove().draw();
             var rowElements = row.find("td");
             for (var i = 0; i < DataSeto.length; i++) {
                 var equals = true;
                 for (var j = 0; j < 1; j++) {
                     if (DataSeto[i][j] != rowElements[j].innerHTML) {
                         equals = false;
                        break;
                     }
                 }
                 if (equals) {
                   console.log(equals);
                     DataSeto.splice(i, 1);
                     break;
                 }
             }
             localStorage.setItem('DataSeto', JSON.stringify(DataSeto));
         });

      //  $('#result').val(DataSeto);
         $('#tSave').click(function(){
            var arr = [];
            var animals = [];
          for (i = 0; i < DataSeto.length; i++) {
            arr.push({
            "amt": DataSeto[i][0],
            "pid" : DataSeto[i][1]
          });
          }
            console.log(proTable);


            var json = JSON.stringify(DataSeto);

             $.ajax({
                 type: "POST",
                 url: "saveReserve.php",
                 data:  'key=' + DataSeto,
                 cache: false,
                 success: function (data) {
                    console.log(data);
                     //modal.find('.ct').html(data);
                 },
                 error: function(err) {
                     console.log(err);
                 }
             });
         });



});

$(".form_datetime").datepicker({
  format: 'yyyy-mm-dd',
  todayHighlight: true
}).on('changeDate', function(e){
$(this).datepicker('hide');
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



</script>
