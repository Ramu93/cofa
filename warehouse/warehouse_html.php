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
              <h3 class="box-title pull-left">Ware House</h3>
              <div class="pull-right">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Shoot Date" id="filter_bydate" name="filter_bydate">
                    <span class="input-group-btn">
                      <input type="submit" class="btn btn-default" name="submit_searchcompany" value="Search">
                    </span>
                  </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Job ID</th>
                  <th>Company</th>
                  <th>Type</th>
                  <th>Count</th>
                  <th>Lot ID</th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>ID12345</td>  
                  <td>PSR Sliks</td>
                  <td>MEN</td>
                  <td>10</td>
                  <td>PSDMR-01</td>
                  <td><select name="status" id="status"><option name="reached">Reached</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>ID12345</td>  
                  <td>PSR Sliks</td>
                  <td>MEN</td>
                  <td>10</td>
                  <td>PSDMR-01</td>
                  <td><select name="status" id="status"><option name="reached">Reached</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>ID12345</td>  
                  <td>PSR Sliks</td>
                  <td>MEN</td>
                  <td>10</td>
                  <td>PSDMR-01</td>
                  <td><select name="status" id="status"><option name="reached">Reached</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>ID12345</td>  
                  <td>PSR Sliks</td>
                  <td>MEN</td>
                  <td>10</td>
                  <td>PSDMR-01</td>
                  <td><select name="status" id="status"><option name="reached">Reached</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>ID12345</td>  
                  <td>PSR Sliks</td>
                  <td>MEN</td>
                  <td>10</td>
                  <td>PSDMR-01</td>
                  <td><select name="status" id="status"><option name="reached">Reached</option></select></td>
                  <td><span class="badge bg-red">Save</span></td>
                </tr>

              </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
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