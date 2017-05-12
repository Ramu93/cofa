<?php 
include('../dbconfig.php');
include('../header.php');
include('../sidebar.php');
?>
<div class="content-wrapper">
 <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title pull-left">Employement Report</h3>
              <div class="pull-right"><select name="employee_month" id="employee_month"><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option></select></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Working Days</th>
                  <th>Present</th>
                  <th>Absent</th>
                  <th>Late</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>Kumar</td>
                  <td>22</td>
                  <td>22</td>
                  <td><span class="badge bg-red">0</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Kumar</td>
                  <td>22</td>
                  <td>22</td>
                  <td><span class="badge bg-red">0</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Kumar</td>
                  <td>22</td>
                  <td>22</td>
                  <td><span class="badge bg-red">0</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Kumar</td>
                  <td>22</td>
                  <td>22</td>
                  <td><span class="badge bg-red">0</span></td>
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
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php 
include('../footer_jsimports.php');
include('../footer.php'); 
?>