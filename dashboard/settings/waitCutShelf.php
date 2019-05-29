<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-list fa-fw"></i> รายการสินค้าที่ขาย นำออกจากที่จัดเก็บ</h1>
     </div>
</div>
<ol class="breadcrumb">
<li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">รายการสินค้าที่ขาย นำออกจากที่จัดเก็บ</li>
</ol>

<?php
if(isset($_POST['save_shelf'])){

  $getitem = $getdata->my_sql_query(NULL,"shelf_detail","shelf_code='".addslashes($_POST['shelf_class']) ."' ");

  	$getshelf = $getdata->my_sql_query("s.*,s.shelf_code,(select sum(ss.amt_rimit) from shelf_detail ss where ss.shelf_code = s.shelf_code) as rimit ","shelf s","s.shelf_code ='".@addslashes($_POST['shelf_class'])."' ");

  $setisbaamt = 0;
  $setcusAmt = 0;
  if($getshelf->rimit >= $_POST['total']){
    $setcusAmt = $_POST['total'];
    $setisbaamt = $_POST['total'];
  }else{
    $setcusAmt = $getshelf->rimit;
    $setisbaamt = $_POST['total'] - $getshelf->rimit;
  }
  //หัก shelf



  $getproduct = $getdata->my_sql_query("p.*, r.*, w.* ,p.ProductID as ProductID, p.Quantity as Quantity,r.diameter as rubdiameter ,w.diameter as whediameter,w.gen as genWheel
  ,case
    when p.TypeID = '2'
    then (select b.Description from brandRubble b where r.brand = b.id)
    when p.TypeID = '1'
    then (select b.Description from BrandWhee b where b.id = w.brand)
    end BrandName
    , case
    when p.TypeID = '2'
    then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
    when p.TypeID = '1'
    then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
    end code
    "," product_N p
    left join productdetailrubber r on p.ProductID = r.ProductID
    left join productdetailwheel w on p.ProductID = w.ProductID
    "," (r.code = '".$_POST['getproid']."' or w.code = '".$_POST['getproid']."') ");

  
  $getdata->my_sql_update(" shelf_detail "," amt_rimit=amt_rimit - '".$setcusAmt."' "," ProductID='".$_POST['getproid']."' and shelf_code ='".addslashes($_POST['shelf_class'])."' ");


  $getdata->my_sql_update(" waitcutshelf "," isbaamt=isbaamt - '".$setisbaamt."' "," ProductID='".$getproduct->ProductID."' and reserve_no ='".addslashes($_POST['getreserveNo'])."' ");


}

echo @$alert;?>

  <!-- Modal Edit -->
  <div class="modal fade" id="selectshelf" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
      <form method="post" enctype="multipart/form-data" name="form2" id="form2">

       <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo @LA_BTN_CLOSE;?></span></button>
                      <h4 class="modal-title" id="memberModalLabel">เลือกshelf</h4>
                  </div>
                  <div class="ct">

                  </div>
              </div>
          </div>
    </form>
  </div>



  <div class="table-responsive">
  	<table width="100%" border="0" class="table table-bordered">
    <thead>
  <tr style="font-weight:bold; color:#FFF; text-align:center; background:#ff7709;">
    <td width="10%">วันที่ใบเสร็จ</td>
    <td width="40%">รายการสินค้า</td>
    <td width="5%">จำนวน</td>
    <td width="5%">จัดการ</td>
  </tr>
  </thead>
  <tbody>
  <?php
  if(addslashes($_GET['flag']) != NULL){
   $getcard = $getdata->my_sql_select("w.* ","waitCutShelf w","w.status = '1' and  w.reserve_no = '".addslashes($_GET['flag'])."' and w.isbaamt > 0 ORDER BY w.reserve_no ,w.ProductID");

  }else{
	   $getcard = $getdata->my_sql_select("w.* ","waitCutShelf w","w.status = '1' and w.isbaamt > 0  ORDER BY w.reserve_no ,w.ProductID");
  }


   $x = 0;
  while($showcard = mysql_fetch_object($getcard)){

    $getproduct = $getdata->my_sql_query("p.*, r.*, w.* ,p.ProductID as ProductID, p.Quantity as Quantity,r.diameter as rubdiameter ,w.diameter as whediameter,w.gen as genWheel
    ,case
      when p.TypeID = '2'
      then (select b.Description from brandRubble b where r.brand = b.id)
      when p.TypeID = '1'
      then (select b.Description from BrandWhee b where b.id = w.brand)
      end BrandName
      , case
      when p.TypeID = '2'
      then (select r.code from productdetailrubber r where r.ProductID = p.ProductID)
      when p.TypeID = '1'
      then (select w.code from productdetailwheel w where w.ProductID = p.ProductID)
      end code
      "," product_N p
      left join productdetailrubber r on p.ProductID = r.ProductID
      left join productdetailwheel w on p.ProductID = w.ProductID
      "," p.ProductID = '".@$showcard->ProductID."' ");

      if($getproduct->TypeID == '1'){
        $gettype = $getproduct->code." ล้อแม๊ก ".$getproduct->BrandName." รุ่น:".$getproduct->genWheel." ขนาด:".$getproduct->diameterWheel." ขอบ:".$getproduct->whediameter." รู:".$getproduct->holeSize." ประเภท:".$getproduct->typeFormat;
      }else if($getproduct->TypeID == '2'){
        $gettype = $getproduct->code." ยาง ".$getproduct->BrandName." ขนาด:".$getproduct->diameterRubber." ซี่รี่:".$getproduct->series." ความกว้าง:".$getproduct->width;
      }else{
        $gettype = "";
      }

  ?>
  <tr style="font-weight:bold;" >
    <td align="center"><?php echo date("d-m-Y", strtotime(@$showcard->create_date));?></td>
    <td align="left"><?php echo @$gettype?></td>
    <td align="right"><?php echo @$showcard->Amt?>&nbsp;</td>

    <td align="center">
      <a  data-toggle="modal" data-target="#selectshelf" data-whatever="<?php echo @$getproduct->code;?> <?php echo @$showcard->Amt;?> <?php echo @$showcard->reserve_no;?>" class="btn btn-xs btn-info" title="จัดการshelf"><i class="fa fa-tag"></i></a>

  </tr>

  <?php
  $x ++;
  }
  ?>
  </tbody>

</table>

</div>

<script language="javascript">

$( document ).ready(function() {
	$(".number").bind('keyup mouseup', function () {
    if (/\D/g.test(this.value)){
           this.value = this.value.replace(/\D/g, '');
        }
						});
          });
$('#edit_status').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'key=' + recipient;

            $.ajax({
                type: "GET",
                url: "card/edit_status.php",
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

function deleteCard(cardkey){
	if(confirm('คุณต้องการลบใบสั่งซ่อม/เคลมนี้ใช่หรือไม่ ?')){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(cardkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=delete_card&key="+cardkey,true);
	xmlhttp.send();
	}
}
function hideCard(cardkey){
	if(confirm('คุณต้องการซ่อนใบสั่งซ่อม/เคลมนี้ใช่หรือไม่ ?')){
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	 	xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(cardkey).innerHTML = '';
  		}
	}
	xmlhttp.open("GET","function.php?type=hide_card&key="+cardkey,true);
	xmlhttp.send();
	}
}

$('#selectshelf').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  recipient = recipient.split(" ");
  getkey = recipient[0];
  amt = recipient[1];
  reserveNo = recipient[2];
  var modal = $(this);
      var dataString = 'key='+getkey+'&amt='+amt+'&reserveNo='+reserveNo;

        $.ajax({
            type: "GET",
            url: "settings/selectShelfN.php",
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
});
</script>
