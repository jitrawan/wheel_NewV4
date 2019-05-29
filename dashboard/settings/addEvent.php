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
if(isset($_POST['addEvent'])){

  $getEvent = $getdata->my_sql_select(NULL,"Event_Info","Event_Code ='".addslashes($_POST['EventCode'])."' ");
  if(mysql_num_rows($getEvent) < 1){
     $getdata->my_sql_insert_New("Event_Info","Event_Code, Event_Name
        , Event_Status, eff_date, exp_date "
        ," '".addslashes($_POST['EventCode'])."'
        ,'".addslashes($_POST['Event_Name'])."'
        ,'".addslashes($_POST['Event_Status'])."'
        ,'".addslashes($_POST['eff_date'])."'
        ,'".addslashes($_POST['exp_date'])."' ");

      echo "<script>window.location=\"../dashboard/index.php?p=addEvent_Info&d=".addslashes($_POST['EventCode'])."\"</script>";

        $alert = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.LA_ALERT_ADD_NEW_TYPE_OF_IS_DONE.'</div>';
  }else{
    $alert = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>ข้อมูลซ้ำ</div>';
  }
}


 ?>

   <form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div class="panel panel-primary">
                        <div class="panel-heading">
                          Event
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                             <?
                              @$getEventCode = $getdata->getMaxID("Event_Code","Event_Info","E");
                             ?>
                             <div class="form-group row">
                                <div class="col-xs-2">
                                            <label for="musername">Event Code</label>
                                            <input class="form-control" type="text" name="EventCode" id="EventCode" value="<?php echo @$getEventCode?>" readonly>
                                </div>
                                <div class="col-xs-8">
                                  <label for="mname">Event Name</label>
                                    <input type="text" name="Event_Name" id="Event_Name" value="" class="form-control" required >
                                </div>
                            </div>

                           </div>
                           <div class="form-group row">

                             	   <div class="col-xs-3">
                             	     <label for="mname">Effective Date</label>
                                     <input type="text" id="eff_date" name="eff_date" class="form-control dpk" autocomplete="off" required >
                             	   </div>
                                 <div class="col-xs-3">
                             	     <label for="mname">Expiry Date</label>
                                     <input type="text" id="exp_date" name="exp_date" class="form-control dpk" autocomplete="off" required >
                             	   </div>

                           </div>

                           <div class="form-group row">
                            <div class="col-md-3">
                              <label for="Event_Status">Status</label>
                              <select name="Event_Status" id="Event_Status" class="form-control">
                                  <option value="1" selected="selected">เปิดใช้งาน</option>
                                  <option value="0">ปิดใช้งาน</option>

                                </select>
                            </div>
                            <div class="col-md-3">

                            </div>
                           </div>



                        </div>
                        <div class="panel-footer">
                          <button type="submit" name="addEvent" id="addEvent" onclick="newevent()" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> <?php echo @LA_BTN_SAVE;?></button>
                        </div>
  </div>
</form>

<script language="javascript">

$(document).ready(function(){

    $("#eff_date").val('<?echo $_POST['eff_date'] ?>');
    $("#exp_date").val('<?echo $_POST['exp_date'] ?>');

    $("#addEvent").click(function(){
      var d = new Date();
      var e = new Date($("#eff_date").val());
    //  console.log(d.setHours(0,0,0,0));
    //  console.log(e.setHours(0,0,0,0));
      if($("#eff_date").val() != ""){
          if($("#exp_date").val() < $("#eff_date").val()){
              $("#eff_date").val("");
                alert("กรุณาระบุวันที่ ให้ถูกต้อง!");
                return false;
              }
              if(e.setHours(0,0,0,0) < d.setHours(0,0,0,0)){
                $("#eff_date").val("");
                alert("กรุณาระบุวันที่ Effective Date มากกว่าหรือเท่ากันวันที่ปัจจุบัน!");
                return false;
              }
        }
  });


});



function newevent(eventCode){
/*  var eventCode = $('#EventCode').val();
  window.location=" ../dashboard/index.php?p=addEvent_Info&d="+eventCode;*/
}
</script>
