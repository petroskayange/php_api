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
      <div id="alert_message"></div>
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Parcel</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="#">Parcel Name</label>
                                <input type="text" name="name" class="form-control" name="weight" id="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Sender Phone</label>
                                <input type="number" name="sender_phone" class="form-control" name="quantity" id="exampleInputPassword1" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Receiver Phone</label>
                                <input type="number" name="receiver_phone" class="form-control" name="quantity" id="exampleInputPassword1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="#">From</label>
                                <select class="form-control select2" style="width: 100%;" name="from">
                                    <option selected="selected"></option>
                                    <option value="Blantyre">Blantyre</option>
                                    <option value="Lilongwe">Lilongwe</option>
                                    <option value="Mangochi">Mangochi</option>
                                    <option value="Salima">Salima</option>
                                    <option value="Nkhotakota">Nkhotakota</option>
                                    <option value="Mzuzu">Mzuzu</option>
                                    <option value="Kasungu">Kasungu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputPassword1">To</label>
                              <select class="form-control select2" style="width: 100%;" name="to">
                                  <option selected="selected"></option>
                                  <option value="Blantyre">Blantyre</option>
                                  <option value="Lilongwe">Lilongwe</option>
                                  <option value="Mangochi">Mangochi</option>
                                  <option value="Salima">Salima</option>
                                  <option value="Nkhotakota">Nkhotakota</option>
                                  <option value="Mzuzu">Mzuzu</option>
                                  <option value="Kasungu">Kasungu</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="#" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">description</label>
                                <input type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="#">Weight</label>
                                <input type="number" name="weight" class="form-control" id="#" placeholder="KG">
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

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/backend.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script>
  var url ="<?=$_SESSION['base_url']?>api/parcel/create.php";
  submitFormData(url)
  // $("#alert_message").append(`<div class="alert alert-success alert-dismissible">
  //                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  //                 <h5><i class="icon fas fa-inf"></i> Notes!</h5>
  //                 Fail to submit
  //               </div>`)
 

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
