<?php 
  include('common-methods.php');
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo HOMEURL; ?>dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Cofa Admin</p>
          <!-- Status -->
          <!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
        </div>
      </div>

      <!-- search form (Optional) -->
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!--li class="header">HEADER</li-->
        <!-- Optionally, you can add icons to the links -->
      <?php if(hasPermission('enquiry')) {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Enquiry</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo HOMEURL; ?>enquiry/addenquiry.php"><i class="fa fa-edit"></i> <span>Add Enquiry</span></a></li>
            <li ><a href="<?php echo HOMEURL; ?>enquiry/view-enquiry.php"><i class="fa fa-bookmark"></i> <span>View/Edit Enquiry</span></a></li>
          </ul>
        </li>
      <?php } ?>
      <?php if(hasPermission('admin')) {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Admin</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <!--li><a href="<?php echo HOMEURL; ?>admin/employee-report-month.php"><i class="fa fa-circle-o"></i> Employee monthly report</a></li>
            <li><a href="<?php echo HOMEURL; ?>admin/employee-report.php"><i class="fa fa-circle-o"></i> Employee report</a></li>
            <li><a href="<?php echo HOMEURL; ?>admin/enquiry-status.php"><i class="fa fa-circle-o"></i> Enquiry Status</a></li-->
            <li><a href="<?php echo HOMEURL; ?>admin/enquiry-order.php"><i class="fa fa-circle-o"></i> Enquiry to Order</a></li>
            <li><a href="<?php echo HOMEURL; ?>admin/job-shoot.php"><i class="fa fa-circle-o"></i> Job to Shoot</a></li>
            <li><a href="<?php echo HOMEURL; ?>admin/project-status.php"><i class="fa fa-circle-o"></i> Project Status</a></li>
            <li><a href="<?php echo HOMEURL; ?>admin/completed-orders.php"><i class="fa fa-circle-o"></i> Completed Orders</a></li>
          </ul>
        </li>
        <?php } ?>
        <!-- <li class=""><a href="<?php //echo HOMEURL; ?>customer-care/customer-care.php"><i class="fa fa-phone-square"></i> <span>Customer Care</span></a></li> -->
        <?php if(hasPermission('warehouse')) {?>
        <li class=""><a href="<?php echo HOMEURL; ?>warehouse/warehouse.php"><i class="fa fa-truck"></i> <span>Ware House</span></a></li>
        <?php } ?>
        <?php if(hasPermission('shoot')) {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-camera"></i> <span>Shoot</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo HOMEURL; ?>shoot/shoot-calendar.php"><i class="fa fa-circle-o"></i> Shoot Calendar</a></li>
            <li><a href="<?php echo HOMEURL; ?>shoot/shoot-progress.php"><i class="fa fa-circle-o"></i> Shoot Progress</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if(hasPermission('edit')) {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-paint-brush"></i> <span>Edit</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo HOMEURL; ?>edit/edit-status.php"><i class="fa fa-circle-o"></i>Edit Progress</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if(hasPermission('design')) {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-photo"></i> <span>Design</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo HOMEURL; ?>design/design-status.php"><i class="fa fa-circle-o"></i>Design Progress</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if(hasPermission('catalog')) {?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Catalog</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo HOMEURL; ?>catalog/catalog-status.php"><i class="fa fa-circle-o"></i> <span>Catalog Progress</span></a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>