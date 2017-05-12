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
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registration Documents</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">TIN Number</label>
                  <input type="text" placeholder="TIN Number" name="tin_number" id="tin_number" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Trademark</label>
                  <input type="text" placeholder="Trademark" name="trademark" id="trademark" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">CST Number</label>
                  <input type="text" placeholder="CST Number" name="cst_number" id="cst_number" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">PAN Number</label>
                  <input type="password" placeholder="PAN Number" name="pan_number" id="pan_number" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Cheque Numbers</label>
                  <input type="text" placeholder="Cheque Numbers" name="cheque_numbers" id="cheque_numbers" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Logo URL</label>
                  <input type="text" placeholder="Logo URL" name="logo_url" id="logo_url" class="form-control">
                </div>
                <!--div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div-->
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary" type="button">Add Enquiry</button>
              </div>
            </form>
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