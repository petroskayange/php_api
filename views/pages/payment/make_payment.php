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
                <h3 class="card-title">Make Payments</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="#">Reference Number</label>
                                <select id="referenceNumber" class="form-control select2" style="width: 100%;" name="referenceNumber" >
                                    <option selected="selected"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                          
                            <div class="form-group">
                                <label for="#">Payment Method</label>
                                <select class="form-control " style="width: 100%;" name="paymentMethod" id="paymentMethod" onChange="checkPaymentMethod()">
                                    <option selected="selected"></option>
                                    <option value="Cash Payment">Cash Payment</option>
                                    <option value="e Payment">e Payment</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row " id="paymentAt">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Payment At</label>
                                <select class="form-control " style="width: 100%;" name="paymentAt">
                                    <option selected="selected"></option>
                                    <option value="Drop Off">Drop Off</option>
                                    <option value="Delivery Point">Delivery Point</option>
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
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
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
<style>
    .displayStatus{
        display:none;
    }
</style>
<script>    
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});


var url ="<?=$_SESSION['base_url']?>api/post/create.php";
submitFormPayment(url)

var url = "<?=$_SESSION['base_url']?>"+"api/parcel/read.php";
getData(url,'displayReferences')
  
function displayReferences(data){
    console.log(data)
    for(reference in data){
        var amount = data[reference].amount
        var paymentMethod = data[reference].paymentMethod
        var reference    = data[reference].referenceNumber
        if(paymentMethod == null)
            $('#referenceNumber').append(`<option value="${reference}">${reference}</option>`)
    }
}
  
function submitFormPayment(url){
  $("form").on( "submit", function(e) {
    loader();
  var dataString = $(this).serialize();
  $.ajax({
    type: "POST",
    url: url,
    data: dataString,
    dataType:'JSON',
    success: function (data) {
      
      console.log(data)
      sendSMS(data)
      dismissLoader();
      Toast.fire({
        icon: 'success',
        title: 'Successfully submitted'
      })
      setTimeout(() => { window.location.reload().delay; }, 1000);
      
    },
    error: function (error) {
      if(error.statusText)
       var title = error.statusText;
      else
       var title = 'Failing to submit';
      Toast.fire({
      icon: 'error',
      title: title
    })
    }
  });

  e.preventDefault();
  });
}
function sendSMS(data){
  var form = new FormData();
  form.append("",JSON.stringify(data));
  var ip = getCookie('ipAddress');
  var settings = {
    "url": "http://"+ip+":3003/",
    "method": "POST",
    "timeout": 0,
    "processData": false,
    "mimeType": "multipart/form-data",
    "contentType": false,
    "data": form
  };

  $.ajax(settings).done(function (response) {
    console.log(response);
  });
}
  



</script>
</body>
</html>
