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

if(!hasPermission('enquiry')){
  echo "<script>window.location.href=\"".HOMEURL.$_SESSION['userrole']['user_homepage']."\"</script>";
}

  //Query
  $query = "SELECT * FROM marketing_enquiry";
  $result = mysqli_query($dbc,$query);
  if(mysqli_num_rows($result) > 0) {
      $output = array();
      while ($row = mysqli_fetch_array($result)) {
          $output[] = array (
              'company_name'=>$row['company_name'],
              'contact_name' => $row['contact_name'],
              'contact_email'=>$row['contact_email'],
              'contact_phone'=>$row['contact_phone'],
              'enquiry_uuid'=>$row['enquiry_uuid']
          );
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
              <h3 class="box-title pull-left">Enquiry Status</h3>
              <div class="pull-right">
              <form method="POST">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search company" id="search_companyname" name="search_companyname">
                    <span class="input-group-btn">
                      <input type="submit" class="btn btn-default" name="submit_searchcompany" value="Search">
                    </span>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered" id="viewenquiry_table">
                <thead>
                  <tr>
                    <th>Company Name</th>
                    <th>Contact Name</th>
                    <th>Contact Email</th>
                    <th>Contact Phone</th>
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
                        echo "<td>".$value['company_name']."</td>";
                        echo "<td>".$value['contact_name']."</td>";
                        echo "<td>".$value['contact_email']."</td>";
                        echo "<td>".$value['contact_phone']."</td>";
                        echo '<td><a href="'.HOMEURL.'enquiry/edit-enquiry.php?uuid='.$value['enquiry_uuid'].'"><button class="btn btn-warning" type="button">Edit</button></a> <button class="btn btn-danger" onclick="deleteenquiry(\''.$value['enquiry_uuid'].'\')" type="button">Delete</button></td>';
                      echo "</tr>";
                    }
                  }
                  else {
                    echo "<tr><td colspan=\"5\">No Enquiries added. <a href=\"addenquiry.php\">Add One</a> now</td></tr>";
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
            </div>
          </div-->
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

function deleteenquiry(enquiry_uuid){

    bootbox.confirm('You sure you want to update the shoot status?',function(result){
          if(result){
            var data = "enquiry_uuid="+enquiry_uuid+"&action=delete_enquiry";
            $.ajax({
            url: "enquiryservices.php",
            type: "POST",
            data:  data,
            dataType: 'html',
            success: function(result){ 
              bootbox.alert(result, function(){
                    location.reload();
                  });;
            },
            error: function(){
              bootbox.alert(result.message);}           
            });
          }
        });
  }

</script>
<?php
include('../footer.php'); 
?>