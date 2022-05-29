<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Speed Courier </title>
  <?php include("./views/header_links.php"); ?>

</head>
<body class="hold-transition sidebar-mini" style="background:#f32800">

    <!-- Main content -->
    <section class="content" style="margin:100px;">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Register User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
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
                                <input type="hidden" value="Admin" name="role" >
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <a href="<?=$_SESSION['base_url']?>register_admin.php">
                      <span class="">Login </span>
                  </a>
                  <button type="submit" class="btn btn-primary">Submit</button> -->

                  <div class="row">
                    <div class="col-4">
                      <a href="<?=$_SESSION['base_url']?>index.php">
                          <span class="">Login</span>
                      </a>
                    </div>
                    <!-- /.col -->
                    
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary">Submit</button> 
                    </div>
                    <!-- /.col -->
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->


<!-- jQuery -->
<script src="<?=$_SESSION['base_url']?>views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=$_SESSION['base_url']?>views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="<?=$_SESSION['base_url']?>views/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?=$_SESSION['base_url']?>views/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?=$_SESSION['base_url']?>views/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?=$_SESSION['base_url']?>views/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=$_SESSION['base_url']?>views/dist/js/adminlte.min.js"></script>
<script src="<?=$_SESSION['base_url']?>views/dist/js/backend.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script>
  var url ="<?=$_SESSION['base_url']?>api/user/create_user.php";
  submitLogin(url)
// $(function () {
//   $.validator.setDefaults({
//     submitHandler: function () {
//       alert( "Form successful submitted!" );
//     }
//   });
//   $('#quickForm').validate({
//     rules: {
//       email: {
//         required: true,
//         email: true,
//       },
//       password: {
//         required: true,
//         minlength: 5
//       },
//       terms: {
//         required: true
//       },
//     },
//     messages: {
//       email: {
//         required: "Please enter a email address",
//         email: "Please enter a valid email address"
//       },
//       password: {
//         required: "Please provide a password",
//         minlength: "Your password must be at least 5 characters long"
//       },
//       terms: "Please accept our terms"
//     },
//     errorElement: 'span',
//     errorPlacement: function (error, element) {
//       error.addClass('invalid-feedback');
//       element.closest('.form-group').append(error);
//     },
//     highlight: function (element, errorClass, validClass) {
//       $(element).addClass('is-invalid');
//     },
//     unhighlight: function (element, errorClass, validClass) {
//       $(element).removeClass('is-invalid');
//     }
//   });
// });
</script>
</body>
</html>
