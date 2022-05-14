
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=$_SESSION['base_url']?>views/dashboard.php" class="nav-link">Home</a>
      </li>
    </ul>

 <!-- Right navbar links -->
 <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" href="/php_api?logout=logout" role="button" style="background-color: #e1e1e1;border-radius: 5px;">
          <i class="fas fa-lock"> Logout</i>
        </a>
      </li>
  </nav>
  <!-- /.navbar -->


  <!-- <button type="submit" class="btn btn-secondary">Logout</button> -->

  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=$_SESSION['base_url']?>views/dashboard.php" class="brand-link">
      <img src="<?=$_SESSION['base_url']?>views/dist/img/seepdc.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Speed Courier</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=$_SESSION['base_url']?>views/dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Lisa Phaso</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Parcels
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/parcel/manage_parcel.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Parcel</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/parcel/add_parcel.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Parcel</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Payments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/payment/manage_payment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/payment/make_payment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Make Payments</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Location
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/location/manage_location.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Parcel Location</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/reports/delivery_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Delivery Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/reports/payment_report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Administrator</li>
        
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/users/manage_users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/users/register_user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register User</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                System Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/system_settings/parcel_settings.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parcel Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/system_settings/brach_settings.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Branch Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=$_SESSION['base_url']?>views/pages/system_settings/add_branch.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Branch</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Logout</a></li> -->
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>