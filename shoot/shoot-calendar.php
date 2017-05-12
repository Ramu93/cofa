<?php 
session_start();

include('../dbconfig.php');
include('../header.php');
include('../sidebar.php');
//include('../common-methods.php');

if(!$_SESSION['login']){
  echo "<script>window.location.href=\"".HOMEURL."index.php\"</script>";
  //header('Location: ../index.php');
}

if(!hasPermission('shoot')){
  echo "<script>window.location.href=\"".HOMEURL.$_SESSION['userrole']['user_homepage']."\"</script>";
}
?>
<link rel="stylesheet" href="<?php echo HOMEURL; ?>plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="<?php echo HOMEURL; ?>plugins/fullcalendar/fullcalendar.print.css" media="print">
<style type="text/css">
.error{
  color:red;
}
</style>
<div class="content-wrapper">
 <!-- Main content -->
 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title pull-left">Shoot Calendar</h3>
          <!--div class="pull-right">
            <div class="col-md-4">
              <div class="form-group">
                <select class="room_type form-control" id="room_type"><option value="room1">Room1</option></select>
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Shoot Date" id="filter_bydate" name="filter_bydate">
                <span class="input-group-btn">
                  <input type="submit" class="btn btn-default" name="submit_searchcompany" value="Search">
                </span>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <span>Total Count : 85</span-->
            <div class="clearfix"></div>
            <div class="row form-group">
              <form id="addmodel_form" action="" onsubmit="return false;">
              <fieldset>
              <div class="col-md-2 col-md-offset-2"><input type="text" name="shoot_model" id="shoot_model" class="form-control required" placeholder="Model Name"></div>
              <div class="col-md-2 ">
                <select name="shoot_room" id="shoot_room" class="form-control required" >
                  <option value="Room1">Room1</option>
                  <option value="Room2">Room2</option>
                </select>
              </div>
              <div class="col-md-2 "><input type="text" name="shoot_date" id="shoot_date" placeholder="Shoot Date" class="form-control required"></div>
              <div class="col-md-2 "><button type="button" class="btn btn-success" onclick="addmodeltodate();" >Add Model</button></div>
              <input type="hidden" name="action" id="action" value="addmodel_todate">
              </fieldset>
              </form>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="shoot_calendar"></div>
        </div>
          <!-- /.box-body -->
          
        </div>
        <!-- /.box -->
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('../footer_jsimports.php'); ?>
<script src="<?php echo HOMEURL; ?>plugins/jquery-validate/jquery.validate.js"></script>
<script src="<?php echo HOMEURL; ?>plugins/moment/moment.js"></script>
<script src="<?php echo HOMEURL; ?>plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript">
$(function () {
  $('#addmodel_form').validate();
  $('#shoot_calendar').fullCalendar({
      events: {
        url: 'calendar-feed.php',
        type: 'POST', // Send post data
        error: function() {
            alert('There was an error while fetching events.');
        }
      }
  });
  var sd = new Date();
  sd.setDate(sd.getDate() + 1);
  var ed = new Date();
  ed.setDate(ed.getDate() + 30);
  $('#shoot_date').datepicker({
    startDate: sd,
    endDate: ed,
    format: 'yyyy-mm-dd',
  });
});

function addmodeltodate(){
  if($('#addmodel_form').valid()){
    var data = $('#addmodel_form').serialize();
    $.ajax({
      url: "shootservices.php",
      type: "POST",
      data:  data,
      dataType: 'json',
      success: function(result){
        if(result.infocode=="MODELADDED"){
          bootbox.alert(result.message, function(){
            location.reload();
          });
        }else{
          bootbox.alert(result.message);
        }
      },
      error: function(){
        bootbox.alert(result.message);}           
    });
  }
}
</script>
<?php include('../footer.php'); ?>