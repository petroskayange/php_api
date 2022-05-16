function submitParameters(parameters, url, returnToFunction) {
 
    var parametersPassed = JSON.stringify(parameters);
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && (this.status == 201 || this.status == 200)) {
        var obj = JSON.parse(this.responseText);
        eval(returnToFunction)(obj);
      
      }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader('Authorization', sessionStorage.getItem("authorization"));
    xhttp.setRequestHeader('Content-type', "application/json");
    xhttp.send(parametersPassed);
  }
  
  
  function getData(url,returnToFunction) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && (this.status == 201 || this.status == 200)) {
        var obj = JSON.parse(this.responseText);
        eval(returnToFunction)(obj);
      }
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
  var dataString = $(this).serialize();
  $.ajax({
    type: "POST",
    url: url,
    data: dataString,
    dataType:'JSON',
    success: function (data) {
      console.log(data)
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