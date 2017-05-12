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
  $query = "SELECT * FROM marketing_enquiry WHERE enquiry_status = 'created'";
  $result = mysqli_query($dbc,$query);
  if(mysqli_num_rows($result) > 0) {
      $output = array();
      while ($row = mysqli_fetch_array($result)) {
          $output[] = $row;
              /*array (
              'company_name'=>$row['company_name'],
              'contact_name' => $row['contact_name'],
              'contact_email'=>$row['contact_email'],
              'contact_phone'=>$row['contact_phone'],
              'enquiry_uuid'=>$row['enquiry_uuid'],
              'enquiry_date'=>$row['enquiry_date']
          );*/
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
                    <th>Contact Phone</th>
                    <th>Product Range</th>
                    <th>Enquiry Date</th>
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
                        echo "<td>".$value['contact_phone']."</td>";
                        $productarray = json_decode($value['product_range']);
                        echo "<td>";
                        foreach($productarray as $k=>$v){
                          echo "<strong>".ucfirst($k)."</strong> - Count : ".$v->count."<br>";
                        }
                        echo "</td>";
                        echo "<td>".date('d-m-Y',strtotime($value['enquiry_date']))."</td>";
                        echo '<td><button class="btn btn-warning" type="button" onclick="converttoorder(\''.$value['enquiry_uuid'].'\');">Convert to Order</button></td>';
                      echo "</tr>";
                    }
                  }
                  else {
                    echo "<tr><td colspan=\"6\">No Enquiries added. <a href=\"".HOMEURL."addenquiry.php\">Add One</a> now</td></tr>";
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

function converttoorder(enquiry_uuid){
  bootbox.confirm('You sure you want to convert this enquiry to order?',function(result){
      if(result){
        var data = "enquiry_uuid="+enquiry_uuid+"&action=enquiry_order";
        $.ajax({
          url: "adminservices.php",
          type: "POST",
          data:  data,
          dataType: 'json',
          success: function(result){
            if(result.infocode=="ORDERCREATED"){
              bootbox.alert(result.message, function(){
                location.reload();
              });
            }else{
              bootbox.alert(result.message);
            }
          },
          error: function(){
            alert(result.message);}           
        });
      }
    });
}
</script>
<?php
include('../footer.php'); 
?>