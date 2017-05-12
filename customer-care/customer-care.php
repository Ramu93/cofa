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
              <h3 class="box-title pull-left">Customer Care</h3>
              <div class="pull-right"><select name="customercare_filter" id="customercare_filter"><option value="today">Today</option><option value="3months">Last 3 months</option></select></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Start</th>
                  <th>Next</th>
                  <th>Company</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>14/04</td>
                  <td>26/06</td>
                  <td>PSR Sliks</td>
                  <td><input type="text" name="customer_id" id="customer_id"></td>
                  <td><select name="customer_option" id="customer_option"><option value="possiblity">possiblity</option></select></td>
                  <td><select name="customer_name" id="customer_name"><option name="arun">Arun</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>14/04</td>
                  <td>26/06</td>
                  <td>PSR Sliks</td>
                  <td><input type="text" name="customer_id" id="customer_id"></td>
                  <td><select name="customer_option" id="customer_option"><option value="possiblity">possiblity</option></select></td>
                  <td><select name="customer_name" id="customer_name"><option name="arun">Arun</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>14/04</td>
                  <td>26/06</td>
                  <td>PSR Sliks</td>
                  <td><input type="text" name="customer_id" id="customer_id"></td>
                  <td><select name="customer_option" id="customer_option"><option value="possiblity">possiblity</option></select></td>
                  <td><select name="customer_name" id="customer_name"><option name="arun">Arun</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>14/04</td>
                  <td>26/06</td>
                  <td>PSR Sliks</td>
                  <td><input type="text" name="customer_id" id="customer_id"></td>
                  <td><select name="customer_option" id="customer_option"><option value="possiblity">possiblity</option></select></td>
                  <td><select name="customer_name" id="customer_name"><option name="arun">Arun</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>14/04</td>
                  <td>26/06</td>
                  <td>PSR Sliks</td>
                  <td><input type="text" name="customer_id" id="customer_id"></td>
                  <td><select name="customer_option" id="customer_option"><option value="possiblity">possiblity</option></select></td>
                  <td><select name="customer_name" id="customer_name"><option name="arun">Arun</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
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