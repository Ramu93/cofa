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

if(!hasPermission('catalog')){
  echo "<script>window.location.href=\"".HOMEURL.$_SESSION['userrole']['user_homepage']."\"</script>";
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
              <h3 class="box-title pull-left">Catalog Status</h3>
              <!-- <div class="pull-right">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Company" id="filter_bycompany" name="filter_bycompany">
                    <span class="input-group-btn">
                      <input type="submit" class="btn btn-default" name="submit_searchcompany" value="Search">
                    </span>
                  </div>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="catalogstatus_table">
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
               $mptotallist = array();
               $query = "SELECT a.job_uuid, c.company_name, a.product_range, a.product_count, a.shoot_date,a.job_status, c.marketplace_list, c.project_type, b.order_uuid, d.log_date, a.product_remarks, a.remarks_catalog FROM jobs a, orders b, marketing_enquiry c, job_log d WHERE a.order_uuid=b.order_uuid AND b.enquiry_uuid=c.enquiry_uuid AND c.project_type IN ('catalog') AND a.job_uuid=d.job_uuid AND d.status_to='designcompleted' AND (a.job_status='designcompleted' OR a.job_status='catalogstarted')";

               $result = mysqli_query($dbc,$query);
               if(mysqli_num_rows($result)>0){
                $datatableflag = true;
                $snocount = 1;
                while($row = mysqli_fetch_assoc($result)){
                  $marketplace_list = json_decode($row['marketplace_list']);
                  $tmp = array();
                  foreach ($marketplace_list as $key => $value) {
                    $tmp[] = ucfirst($key);
                  }
                  $mptotallist[$snocount] = $tmp;

                  echo "<tr><td>".$snocount."</td>";
                  echo "<td>{$row['job_uuid']}</td><td>{$row['company_name']}</td><td>Reached on : ".date('d-m-Y',strtotime($row['log_date']))."<br>Type : {$row['product_range']}<br>Count : {$row['product_count']}<br>Remarks : {$row['product_remarks']}<br>Shoot date : ".date('d-m-Y',strtotime($row['shoot_date']))."</td>";

                  echo "<td><select class=\"form-control\" name=\"select_{$row['job_uuid']}\" id=\"select_{$row['job_uuid']}\" >";
                  echo '<option value="designcompleted" '.(($row['job_status']=='designcompleted')?'selected="selected"':'').'>Not Started</option>';
                  echo '<option value="catalogstarted" '.(($row['job_status']=='catalogstarted')?'selected="selected"':'').'>Started</option>';
                  echo '<option value="catalogcompleted" '.(($row['job_status']=='catalogcompleted')?'selected="selected"':'').'>Completed</option>';
                  echo '</select><input type="hidden" name="hidden_'.$row['job_uuid'].'" id="hidden_'.$row['job_uuid'].'" value="'.$row['job_status'].'">';
                  echo '<br /><br /><input type="text" class="form-control" placeholder="Remarks" id="remarks_catalog_'.$row['job_uuid'].'" name="remarks_catalog_'.$row['job_uuid'].'" value="'.$row['remarks_catalog'].'"></td>';

                  echo '<td><button type="button" class="btn btn-success" onclick="updatecatalogstatus(\''.$row['job_uuid'].'\',\''.$row['order_uuid'].'\',\''.$row['project_type'].'\');">Update</button></br></br><button type="button" class="btn btn-primary" onclick="showdetails(\''.$snocount.'\');" >View Details</button></td></tr>'; 
                  $snocount++;
                }
               }else{
                echo '<tr><td colspan="7">No jobs awaiting catalog instructions</td></tr>';
               }
                ?>

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div> -->
          </div>
          <!-- /.box -->
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('../footer_jsimports.php'); ?>

<div class="modal fade" id="marketplace_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel"> Marketplace Details</h2>
      </div>
      <div class="modal-body" id="div_mpdetails">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  $(document).ready(function(){
    <?php if($datatableflag){ ?>
      $('#catalogstatus_table').DataTable();
    <?php } ?>
  });


  g_mptotallist = new Array;
  $(document).ready(function(){
    <?php if($datatableflag){ ?>
      g_mptotallist = JSON.parse('<?php echo json_encode($mptotallist); ?>');
      <?php } ?>
  });
  
  function updatecatalogstatus(job_uuid, order_uuid, endpoint){
    var newstatus =$('#select_'+job_uuid).val().trim();
    var oldstatus =$('#hidden_'+job_uuid).val().trim();
    if(oldstatus == newstatus){
      bootbox.alert("You havent changed the status for this Job!");
    }else{
      bootbox.confirm('You sure you want to update the catalog status?',function(result){
          if(result){
            var remarks = $('#remarks_catalog_'+job_uuid).val().trim();
            var data = "job_uuid="+job_uuid+"&order_uuid="+order_uuid+"&endpoint="+endpoint+"&job_status="+newstatus+"&jobprev_status="+oldstatus+"&remarks="+remarks+"&action=update_catalog_status";
            $.ajax({
              url: "catalogservices.php",
              type: "POST",
              data:  data,
              dataType: 'json',
              success: function(result){
                if(result.infocode=="CATALOGUPDATED"){
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

  function showdetails(arrayindex){
    var dp = '';
    $('#div_mpdetails').html('');
    dp = g_mptotallist[arrayindex].join('<br>');
    $('#div_mpdetails').html(dp);
    $('#marketplace_modal').modal('show');
  }
  
</script>
<?php
include('../footer.php');
?>