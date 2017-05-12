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

if(!hasPermission('warehouse')){
  echo "<script>window.location.href=\"".HOMEURL.$_SESSION['userrole']['user_homepage']."\"</script>";
}
?>
<div class="content-wrapper">
 <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <!-- general form elements -->
          <form action="" onsubmit="return false;">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title pull-left">Ware House</h3>
             <!--  <div class="pull-right">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Shoot Date" id="filter_bydate" name="filter_bydate">
                    <span class="input-group-btn">
                      <input type="submit" class="btn btn-default" name="submit_searchcompany" value="Search">
                    </span>
                  </div>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="warehouselist_table">
                <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Job ID</th>
                  <th>Company Name</th>
                  <th>Details</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $datatableflag=false;
               $query = "SELECT a.job_uuid, c.company_name, a.product_range, a.product_count, a.shoot_date, b.warehouse_status, a.product_remarks FROM jobs a, warehouse b, marketing_enquiry c, orders d WHERE a.job_uuid=b.job_uuid AND a.order_uuid=d.order_uuid AND c.enquiry_uuid=d.enquiry_uuid";
               $result = mysqli_query($dbc,$query);
               if(mysqli_num_rows($result)>0){
                $datatableflag = true;
                $snocount = 1;
                while($row = mysqli_fetch_assoc($result)){
                  echo "<tr><td>".$snocount++."</td>";
                 
                  echo "<td>{$row['job_uuid']}</td><td>{$row['company_name']}</td><td>Type : {$row['product_range']}<br>Count : {$row['product_count']}<br>Remarks : {$row['product_remarks']}<br>Shoot date : ".date('d-m-Y',strtotime($row['shoot_date']))."</td>";
                  echo "<td><select class=\"form-control\" name=\"select_{$row['job_uuid']}\" id=\"select_{$row['job_uuid']}\" >";
                  echo '<option value="notinformed" '.(($row['warehouse_status']=='notinformed')?'selected="selected"':'').'>Not Informed</option>';
                  echo '<option value="informed" '.(($row['warehouse_status']=='informed')?'selected="selected"':'').'>Informed</option>';
                  echo '<option value="reached" '.(($row['warehouse_status']=='reached')?'selected="selected"':'').'>Reached</option>';
                  echo '</select><input type="hidden" name="hidden_'.$row['job_uuid'].'" id="hidden_'.$row['job_uuid'].'" value="'.$row['warehouse_status'].'"></td>';
                  echo '<td><button type="button" class="btn btn-success" onclick="updatewarehousestatus(\''.$row['job_uuid'].'\');">Update</button></td></tr>';
                }
               }else{
                echo '<tr><td colspan="7">No jobs waiting for warehouse instructions</td></tr>';
               }
                ?>

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <!--div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div-->
          </div>
          <!-- /.box -->
        </form>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('../footer_jsimports.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  <?php if($datatableflag){ ?>
    $('#warehouselist_table').DataTable();
  <?php } ?>
});


function updatewarehousestatus(job_uuid){
  var newstatus =$('#select_'+job_uuid).val().trim();
  var oldstatus =$('#hidden_'+job_uuid).val().trim();
  if(oldstatus == newstatus){
    bootbox.alert("You havent changed the status for this Job!");
  }else{
    bootbox.confirm('You sure you want to update the warehouse status?',function(result){
        if(result){
          var data = "job_uuid="+job_uuid+"&warehouse_status="+newstatus+"&warehouseprev_status="+oldstatus+"&action=update_warehouse_status";
          $.ajax({
            url: "warehouseservices.php",
            type: "POST",
            data:  data,
            dataType: 'json',
            success: function(result){
              if(result.infocode=="WAREHOUSEUPDATED"){
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
</script>
<?php
include('../footer.php'); 
?>