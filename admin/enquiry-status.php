<?php 
include('../dbconfig.php');
include('../header.php');
include('../sidebar.php');

if(isset($_POST['submit_searchcompany'])) {
  $search = mysqli_real_escape_string($dbc, trim($_POST['search_companyname']));

  //Query
  $query = "SELECT * FROM marketing_enquiry WHERE company_name = '$search'";
  $result = mysqli_query($dbc,$query);
  if(mysqli_num_rows($result) > 0) {
      $output = array();
      while ($row = mysqli_fetch_array($result)) {
          $output[] = array (
              'create_date'=>$row['created_date'],
              'company_name'=>$row['company_name'],
              'model' => 'Men'
          );
      }
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
              <table class="table table-bordered">
                <tbody>
                <?php 
                  if(!empty($output)) {

                    foreach ($output as $value) {
                      echo "<tr>";
                        echo "<td>".substr($value['create_date'],0,10)."</td>";
                        echo "<td>".$value['company_name']."</td>";
                        echo "<td>".$value['model']."</td>";
                        echo "<td>High</td>";
                        echo '<td><center><span class="btn badge bg-red">Move to Shoot</span></center></td>';
                      echo "</tr>";
                    }
                  }
                  else {
                    echo "No Data Found";
                  }
                ?>

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php 
include('../footer_jsimports.php');
include('../footer.php'); 
?>