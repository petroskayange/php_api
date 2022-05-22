<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Speed Courier </title>
  <?php include("../../header_links.php"); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include("../../header_nav.php"); ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="quickForm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" name="firstName" class="form-control" id="firstName" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="LastName">Surname</label>
                                <input type="text" name="LastName" class="form-control" id="LastName" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email">Email address</label>
                                <input type="email" name="Email" class="form-control" id="Email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="Contact">Phone</label>
                                <input type="number" name="Contact" class="form-control" id="Contact" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" name="Address" class="form-control" id="Address" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="">
                                <input type="hidden" name="loginID" id="loginID">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Role</label>
                              <select class="form-control select2 listDistrict" style="width: 100%;" name="role">
                                  <option value="Customer" id="Customer">Customer</option>
                                  <option value="Admin" id="Admin">Admin</option>
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.php5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script src="../../dist/js/backend.js"></script>
<script>
  var url = "<?=$_SESSION['base_url']?>"+"api/user/read.php";
  getData(url,'displayData')
        // 'LastName' => $LastName,
  function displayData(data){
    data = data.user_data.concat(data.customer_data);
    data = data.map((value) =>{
      var delete_url = base_url+'api/user/delete.php?loginID='+value['loginID'];
      return [
                value['firstName'] +" "+ value['LastName'],
                value['Email'],
                value['Contact'],
                value['Address'],
                value['username'],
                value['role'],
                `
                <span class="badge bg-warning" onclick="updateData('${value['loginID']}',
                '${value['firstName']}',
                '${value['Email']}',
                '${value['Contact']}',
                '${value['Address']}',
                '${value['username']}',
                '${value['role']}',
                '${value['password']}',
                '${value['LastName']}',
                )" data-toggle="modal" data-target="#modal-default">Edit</span>
                <span class="badge bg-danger" onclick="deleteData('${delete_url}')">Delete</span>`
            ]
    })
    $('#example1').DataTable( {
      data: data
    });
  }
  function updateData(loginID,firstName,Email,Contact,Address,username,role,password,LastName){
    $('#loginID').attr('value', loginID);
    $('#firstName').attr('value',firstName);
    $('#LastName').attr('value',LastName);
    $('#Email').attr('value',Email);
    $('#Contact').attr('value',Contact);
    $('#Address').attr('value',Address);
    $('#username').attr('value',username);
    $('#'+role).attr('selected','selected');
    $('#password').attr('value',password);
  
  }
  var url ="<?=$_SESSION['base_url']?>api/user/update_user.php";
  submitFormData(url)
</script>
</body>
</html>
