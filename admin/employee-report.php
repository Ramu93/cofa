<?php 
include('../dbconfig.php');
include('../header.php');
include('../sidebar.php');
?>
<div class="content-wrapper">
 <!-- Main content -->
 <section class="content">
  <div class="row">
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title pull-left">Employement Report</h3>
          <div class="pull-right">
            <!-- Report date picker -->
            <input type="date" name="report_date" id="report_date">
            <!-- End of report date picker -->
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>In Time</th>
              <th>Out Time</th>
              <th></th>
            </tr>
            <tr>
              <td>2.</td>
              <td>9:20</td>
              <td></td>
              <td><span class="badge bg-red">Leave</span></td>
            </tr>
            <tr>
              <td>3.</td>
              <td>9:20</td>
              <td></td>
              <td><span class="badge bg-red">Leave</span></td>
            </tr>
            <tr>
              <td>4.</td>
              <td>9:20</td>
              <td></td>
              <td><span class="badge bg-red">Leave</span></td>
            </tr>
            <tr>
              <td>5.</td>
              <td>9:20</td>
              <td></td>
              <td><span class="badge bg-red">Leave</span></td>
            </tr>
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
    <!-- Col 6 -->
    <div class="col-md-6 col-sm-6">
      <!-- Total strength -->
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title pull-left">Total Strength</h3>
          <div class="pull-right">18</div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <h3 class="pull-left">Total Present</h3>
          <h3 class="pull-right">16</h3>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- End of Total strength -->
      <!-- Total strength -->
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Absenties</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="list-unstyled">
            <li>Sethur</li>
            <li>Vignesh</li>
          </ul>
        <!-- /.box-body -->
      </div>
      <!-- End of Total strength -->
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