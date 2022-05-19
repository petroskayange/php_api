function submitParameters(parameters, url, returnToFunction) {
 loader();
    var parametersPassed = JSON.stringify(parameters);
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && (this.status == 201 || this.status == 200)) {
        dismissLoader()
        var obj = JSON.parse(this.responseText);
        eval(returnToFunction)(obj);
      
      }
      dismissLoader()
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader('Authorization', sessionStorage.getItem("authorization"));
    xhttp.setRequestHeader('Content-type', "application/json");
    xhttp.send(parametersPassed);
  }
  
  
  function getData(url,returnToFunction) {
    loader();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && (this.status == 201 || this.status == 200)) {
        dismissLoader()
        var obj = JSON.parse(this.responseText);
        eval(returnToFunction)(obj);
      }
      dismissLoader()
    };
    xhttp.open("GET", url, true);
    xhttp.setRequestHeader('Authorization', sessionStorage.getItem("authorization"));
    xhttp.setRequestHeader('Content-type', "application/json");
    xhttp.send();
  }

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
            

function submitFormData(url){
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
      dismissLoader();
      if(data == "login successfully")
       window.location = "/php_api/views/dashboard.php";
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
function deleteData(url){
  loader();
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && (this.status == 201 || this.status == 200)) {
      dismissLoader()
      Toast.fire({
        icon: 'success',
        title: 'Successfully Deleted'
      })
      setTimeout(() => { window.location.reload().delay; }, 1000);
    }
    dismissLoader()
  };
  xhttp.open("GET", url, true);
  xhttp.setRequestHeader('Authorization', sessionStorage.getItem("authorization"));
  xhttp.setRequestHeader('Content-type', "application/json");
  xhttp.send();
}
function loader(){
  try {
    $('body').append(
      `
      <div id="cover_page" style="width:100%; height:100%; background:#000;position: absolute; top: 0;opacity: 0.5;">
        <img src="${base_url}views/dist/img/formloader.gif" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" 
        style="opacity: .8;position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
      </div>
      `);
  } catch (error) {
    console.log(error)
  }
 
}

function dismissLoader(){
  $('#cover_page').attr('style','display:none')
}