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
              <h3 class="box-title">Add Enquiry</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Company Name</label>
                  <input type="text" placeholder="Company name" name="company_name" id="company_name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Contact Name</label>
                  <input type="text" placeholder="Contact name" name="contact_name" id="contact_name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" placeholder="Email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Phone</label>
                  <input type="password" placeholder="Phone" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Registered Address</label>
                  <textarea type="text" placeholder="Registered Address" name="reg_address" id="reg_address" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Pickup Address</label>
                  <textarea type="text" placeholder="Pickup Address" name="pickup_address" id="pickup_address" class="form-control"></textarea>
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