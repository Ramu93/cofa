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

if(!hasPermission('admin')){
  echo "<script>window.location.href=\"".HOMEURL.$_SESSION['userrole']['user_homepage']."\"</script>";
}

  //Query
  $query = "SELECT a.created_date, a.job_uuid, c.company_name, a.product_range, a.product_count, a.product_remarks FROM jobs a, orders b, marketing_enquiry c WHERE job_status = 'created' AND a.order_uuid=b.order_uuid AND b.enquiry_uuid=c.enquiry_uuid";
  $result = mysqli_query($dbc,$query);
  if(mysqli_num_rows($result) > 0) {
      $output = array();
      while ($row = mysqli_fetch_array($result)) {
          $output[] = $row;
      }
  }
?>
<div class="content-wrapper">
 <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title pull-left">Job Status</h3>
              <!-- <div class="pull-right">
              <form method="POST">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search company" id="search_companyname" name="search_companyname">
                    <span class="input-group-btn">
                      <input type="submit" class="btn btn-default" name="submit_searchcompany" value="Search">
                    </span>
                  </div>
                </form>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="viewenquiry_table">
                <thead>
                  <tr>
                    <th>Created Date</th>
                    <th>Job ID</th>
                    <th>Company Name</th>
                    <th>Product Range</th>
                    <th>Count</th>
                    <th>Remarks</th>
                    <th>Shoot Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $datatableflag = false; 
                  if(!empty($output)) {
                    $datatableflag = true;
                    foreach ($output as $value) {
                      echo "<tr>";
                        echo "<td>".date('d-m-Y',strtotime($value['created_date']))."</td>";
                        echo "<td>".$value['job_uuid']."</td>";
                        echo "<td>".$value['company_name']."</td>";
                        echo "<td>".$value['product_range']."</td>";
                        echo "<td>".$value['product_count']."</td>";
                        echo "<td>".$value['product_remarks']."</td>";
                        echo '<td><input type="text" class="shootdatepicker" name="dp_'.$value['job_uuid'].'" id="dp_'.$value['job_uuid'].'" /></td>';
                        echo '<td><button class="btn btn-warning" type="button" onclick="movetoshoot(\''.$value['job_uuid'].'\');">Move to Shoot</button></td>';
                      echo "</tr>";
                    }
                  }
                  else {
                    echo "<tr><td colspan=\"7\">No Jobs added.</td></tr>";
                  }
                ?>

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <!--div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div-->
          </div>
          <!-- /.box -->
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('../footer_jsimports.php');?>
<script type="text/javascript">
$(document).ready(function(){
  <?php if($datatableflag){ ?>
    $('#viewenquiry_table').DataTable();
  <?php } ?>
});

$(document).ready(function(){
  <?php if($datatableflag){ ?>
    $('#viewenquiry_table').DataTable();
  <?php } ?>
  var sd = new Date();
  sd.setDate(sd.getDate() + 1);
  var ed = new Date();
  ed.setDate(ed.getDate() + 30);
  $('.shootdatepicker').datepicker({
    startDate: sd,
    endDate: ed,
    format: 'yyyy-mm-dd',
  });
});

function movetoshoot(job_uuid){
  var warning_msg = '';
  var sd = new Date();
  sd.setDate(sd.getDate() + 1);
  var shootdate =$('#dp_'+job_uuid).val().trim();
  if(shootdate == ''){
    bootbox.alert("Please select the shoot date!");
  }else{
    if(shootdate == customformatDate(sd)) warning_msg = '<br><span style="color:red;">You have selected tomorrow, please check the warehouse for stock!</span>';
    bootbox.confirm('You sure you want to move this job to shoot?'+warning_msg,function(result){
        if(result){
          var data = "job_uuid="+job_uuid+"&shoot_date="+shootdate+"&action=job_shoot";
          $.ajax({
            url: "adminservices.php",
            type: "POST",
            data:  data,
            dataType: 'json',
            success: function(result){
              if(result.infocode=="SHOOTMOVED"){
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
      });
  }
}

function customformatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
</script>
<?php
include('../footer.php'); 
?>