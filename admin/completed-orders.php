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
?>

<style type="text/css">
  
  .modal-lg {
    width:62%;
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
              <h3 class="box-title pull-left">Completed Orders</h3>
              <!-- <div class="pull-right">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search company" id="search_companyname" name="search_companyname">
                    <span class="input-group-btn">
                      <input type="submit" class="btn btn-default" name="submit_searchcompany" value="Search">
                    </span>
                  </div>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="completedorders_table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Order ID</th>
                    <th>Company Name</th>
                    <th>Order Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $datatableflag=false;
                   $query = "SELECT a.order_uuid, b.company_name, b.project_type, a.order_status FROM orders a, marketing_enquiry b WHERE a.enquiry_uuid=b.enquiry_uuid AND a.order_status='completed'";
  
                   $result = mysqli_query($dbc,$query);
                    if(mysqli_num_rows($result)>0){
                      $datatableflag = true;
                      $snocount = 1;
                      while($row = mysqli_fetch_assoc($result)){
                        
                        echo "<tr><td>".$snocount."</td>";
                        echo "<td>{$row['order_uuid']}</td><td>{$row['company_name']}</td><td>{$row['order_status']}</td>";
                        
                        echo '<td><button type="button" class="btn btn-primary" onclick="showdetails(\''.$row['order_uuid'].'\',\''.$row['project_type'].'\');" >View Details</button></td></tr>'; 
                        $snocount++;
                      }
                    }else{
                      echo '<tr><td colspan="7">No jobs available</td></tr>';
                    }
                  ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
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

<div class="modal fade" id="jobdetails_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="myModalLabel"> Job Details</h2>
      </div>
      <div class="modal-body" id="div_jobdetails">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->
<?php 
include('../footer_jsimports.php'); ?>


<script type="text/javascript">

  $(document).ready(function(){
    <?php if($datatableflag){ ?>
      $('#completedorders_table').DataTable();
    <?php } ?>
  });
  
  function showdetails(order_uuid, endpoint){

    var data = "order_uuid="+order_uuid+"&endpoint="+endpoint+"&action=show_completed_job_details";
    $.ajax({
    url: "projectservices.php",
    type: "POST",
    data:  data,
    dataType: 'html',
    success: function(result){ 
      $('#div_jobdetails').html(result);
      $('#jobdetails_modal').modal('show');
    },
    error: function(){
      bootbox.alert(result.message);}           
    });

  }

  

</script>

<?php include('../footer.php'); 
?>

