<?php 
include "../include/operations.php";




?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GYM SYS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>GYM</b> SYS</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <!-- <form action="" method="post"> -->
        <div class="input-group mb-3">
          <input type="text" class="form-control username" placeholder="User name" name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control password" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              
            </div>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="button" name="login" class="btn btn-primary btn-block login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      <!-- </form> -->

      
      <!-- /.social-auth-links -->

 
   
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<script>
  $(".login").click(()=>{
    var data={
      username: $(".username").val(),
      password: $(".password").val(),
      "login":"login",
      type: "login"
    }

    $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
      dataType: "JSON",

      success:(response)=>{
        if(response.valid){

          logginInsertion();
        }else{
          alert(response.response);
        }
       
      },
      error: (response)=>{
console.log(response)
      }
    })
  })

function logginInsertion(){
  var data={
    username : $(".username").val(),
    status: "login",
    type: "login",
    "inserLoginLogout": "inserLoginLogout"
  }
  $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
      dataType: "JSON",
      success:(response)=>{
        if(response.valid){

          window.location="./dashboard.php";
        }else{
          alert(response.response);
        }
       
      },
      error: (response)=>{
console.log(response)
      }
    })
}
  function getTeachersData(displayResponse){
    var data={
      "getDataTeachers": "getDataTeachers",

      "table": "teachers"
    }
    
  }
  </script>
</body>
</html>
