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

if(!hasPermission('design')){
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
              <h3 class="box-title pull-left">Design Status</h3>
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
              <table class="table table-bordered" id="designstatus_table">
                <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Job ID</th>
                  <th>Company Name</th>
                  <!--th>Reached On</th>
                  <th>Type</th>
                  <th>Count</th>
                  <th>Shoot Date</th-->
                  <th>Details</th>
                  <th>Status</th>
                  <th>Employee</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $datatableflag=false;
               $mptotallist = array();
               $query = "SELECT a.job_uuid, c.company_name, a.product_range, a.product_count, a.shoot_date,a.job_status, c.marketplace_list, b.order_uuid, c.project_type, a.design_employee1_status, a.design_employee2_status, a.design_employee_id_1, a.design_employee_id_2, d.log_date, a.product_remarks, a.remarks_design FROM jobs a, orders b, marketing_enquiry c, job_log d WHERE a.order_uuid=b.order_uuid AND b.enquiry_uuid=c.enquiry_uuid AND c.project_type IN ('edit_design', 'catalog') AND a.job_uuid=d.job_uuid AND d.status_to='editcompleted'  AND (a.job_status='editcompleted' OR a.job_status='designstarted')";

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
                  //echo "<td>{$row['job_uuid']}</td><td>{$row['company_name']}</td><td>".date('d-m-Y',strtotime($row['log_date']))."</td><td>{$row['product_range']}</td><td>{$row['product_count']}</td><td>".date('d-m-Y',strtotime($row['shoot_date']))."</td>";
                  echo "<td>{$row['job_uuid']}</td><td>{$row['company_name']}</td><td>Reached on : ".date('d-m-Y',strtotime($row['log_date']))."<br>Type : {$row['product_range']}<br>Count : {$row['product_count']}<br>Remarks : {$row['product_remarks']}<br>Shoot date : ".date('d-m-Y',strtotime($row['shoot_date']))."</td>";
                  echo "<td><select class=\"form-control\" name=\"select_{$row['job_uuid']}\" id=\"select_{$row['job_uuid']}\" >";
                  echo '<option value="editcompleted" '.(($row['job_status']=='editcompleted')?'selected="selected"':'').'>Not Started</option>';
                  echo '<option value="designstarted" '.(($row['job_status']=='designstarted')?'selected="selected"':'').'>Started</option>';
                  echo '<option value="designcompleted" '.(($row['job_status']=='designcompleted')?'selected="selected"':'').'>Completed</option>';
                  echo '</select><input type="hidden" name="hidden_'.$row['job_uuid'].'" id="hidden_'.$row['job_uuid'].'" value="'.$row['job_status'].'">';
                  echo '<br /><br /><input type="text" class="form-control" placeholder="Remarks" id="remarks_design_'.$row['job_uuid'].'" name="remarks_design_'.$row['job_uuid'].'" value="'.$row['remarks_design'].'"></td>';

                  echo '<td><table class="table"><tr><td><select class="form-control" name="select_employee1_'.$row['job_uuid'].'" id="select_employee1_'.$row['job_uuid'].'"><option>Select</option>'.display_employee_details(1, $row).'</select></td><td><input type="text" placeholder="Status" value="'.$row['design_employee1_status'].'" name="employee1_status_'.$row['job_uuid'].'" id="employee1_status_'.$row['job_uuid'].'" class="form-control"></td></tr><tr><td><select class="form-control" name="select_employee2_'.$row['job_uuid'].'" id="select_employee2_'.$row['job_uuid'].'"><option>Select</option>'.display_employee_details(2, $row).'</select></td><td><input type="text" placeholder="Status" value="'.$row['design_employee2_status'].'" name="employee2_status_'.$row['job_uuid'].'" id="employee2_status_'.$row['job_uuid'].'" class="form-control"></td></tr></table></td>';
                  echo '<td><button type="button" class="btn btn-success" onclick="updatedesignstatus(\''.$row['job_uuid'].'\',\''.$row['order_uuid'].'\',\''.$row['project_type'].'\');">Update</button></br></br><button type="button" class="btn btn-primary" onclick="showdetails(\''.$snocount.'\');" >View Details</button></td></tr>'; 
                  $snocount++;
                }
               }else{
                echo '<tr><td colspan="7">No jobs awaiting design instructions</td></tr>';
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

<?php 
  
  function display_employee_details($emp, $data){
    global $dbc;
    $query = "SELECT * FROM  employees";
    $output = "";
    $result = mysqli_query($dbc,$query);
    
    if($emp == 1){
      $tmp_data = $data['design_employee_id_1'];
    } else {
      $tmp_data = $data['design_employee_id_2'];
    }

    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result)){
        $output .= '<option value="'.$row['employee_id'].'" '.(($row['employee_id']==$tmp_data)?'selected="selected"':'').'>'.$row['employee_name'].'</option>';
      }
    }

    return $output;
  }
  
?>

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
      $('#designstatus_table').DataTable();
    <?php } ?>
  });

  g_mptotallist = new Array;
  $(document).ready(function(){
    <?php if($datatableflag){ ?>
      g_mptotallist = JSON.parse('<?php echo json_encode($mptotallist); ?>');
      <?php } ?>
  });

  function updatedesignstatus(job_uuid, order_uuid, endpoint){
    var newstatus =$('#select_'+job_uuid).val().trim();
    var oldstatus =$('#hidden_'+job_uuid).val().trim();
    var employee_id_1 = $('#select_employee1_'+job_uuid).val().trim();
    var employee_id_2 = $('#select_employee2_'+job_uuid).val().trim();
    var employee1_status = $('#employee1_status_'+job_uuid).val().trim();
    var employee2_status = $('#employee2_status_'+job_uuid).val().trim();

    if(oldstatus == newstatus){
      bootbox.alert("You havent changed the status for this Job!");
    }else{
      bootbox.confirm('You sure you want to update the design status?',function(result){
          if(result){
            var remarks = $('#remarks_design_'+job_uuid).val().trim();
            var data = "job_uuid="+job_uuid+"&order_uuid="+order_uuid+"&endpoint="+endpoint+"&job_status="+newstatus+"&jobprev_status="+oldstatus+"&employee_id_1="+employee_id_1+"&employee_id_2="+employee_id_2+"&employee1_status="+employee1_status+"&employee2_status="+employee2_status+"&remarks="+remarks+"&action=update_design_status";
            $.ajax({
              url: "designservices.php",
              type: "POST",
              data:  data,
              dataType: 'json',
              success: function(result){
                if(result.infocode=="DESIGNUPDATED"){
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