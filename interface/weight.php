<?php  include '../include/links.php';
if($_SESSION['type']!=0){
  header("location: ./login.php");
  exit();
}

include '../models/user.php';
// session_start();



$message =array();
 if(isset($_POST['add-user'])){
  if($_POST["name"] == "" || $_POST["phone"] == "" || $_POST["password"] == "" || $_POST["dob"]=="" || $_POST["address"]==""|| $_POST["type"]==""|| $_POST["gender"]=="" || $_POST["status"]=="")
  {
    $message = array("type"=>"error","message"=>"All Fields Are Required..");  
  }
  else{
    $data = array( 
      "user" => escape($_POST['name']), 
      "mobile"=>$_POST['phone'], 
      "dob" => $_POST['dob'], 
      "password" => $_POST['password'], 
      "address"=>$_POST['address'],
       "gender" => $_POST['gender'],
       "status" => $_POST['status'],
       "type" => $_POST['type']
      );
    insert('users',$data) ?$message = array("type"=>"success","message"=>"user inserted successfully") : $message = array("type"=>"error","message"=>"user not inserted successfully");
    
  }
 }
if(isset($_POST['update-user'])){
  //csrf_check($_POST["csrf"]);

  if($_POST["name"] == "" || $_POST["phone"] == "" || $_POST["password"] == "" || $_POST["dob"]=="" || $_POST["address"]==""|| $_POST["status"]=="" || $_POST["type"]==""){
    $message = array("type"=>"error","message"=>"All Fields Are Required..");  
  }else{
       $data = array(
      "id" => escape($_POST['id']),
      "user"=> escape($_POST['name']), 
      "mobile"=>$_POST['phone'], 
      "dob" => $_POST['dob'], 
      "password" => $_POST['password'], 
      "address"=>$_POST['address'],
       "status" => $_POST['status'],
       "gender" => $_POST['gender'],
       "type" => $_POST['type']
      );
    $sql = update("users", $data);
    if($sql){
      $message = array("type"=>"success","message"=>"user Updated successfully");  
          
    }else{
      $message = array("type"=>"error","message"=>"An Error Was Occured");  
    }
  }
}
?>



<div class="wrapper">
    // <!-- Left navbar links -->


    

   

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
 <div class="col-md-5">
 <div class="card">
              <div class="card-header">
                <h3 class="card-title">Register weight By One</h3>

               
              </div>
              <!-- /.card-header -->
              <div class="card-body p-2">
                <!-- <form class="p-2"> -->
                <div class="form-group">  
                 
                 <input type="text" class="form-control before" placeholder="Before kg"/>
</div>
<div class="form-group">  
                 
                 <input type="text" class="form-control after" placeholder="after kg"/>
</div>


<div class="form-group">  
                 
            <select class="form-control teachersData">
                <option value="">select member</option>
</select>
</div>
<input type="hidden" class="shift_id_hidden"/>
<div class="form-group">  
                 
        <button class="btn btn-success save">Save</button>
</div>
<!-- </form> -->
              </div>
              <!-- /.card-body -->
            </div>
 </div>
 <div class="col-md-7">
 <div class="card">
              <div class="card-header">
                <h3 class="card-title">Members weight</h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0 table-container-body">
                
              </div>
              <!-- /.card-body -->
            </div>
</div>
</div>
</div>
</section>
</div>
</div>

 














<?php  include '../include/footer.php'?>

<script>
  
$(document).on("click",'.delete',function(){
  deleteShift($(this).attr("shiftID"))
})
$(document).on("click",'.save',function(e){

// e.preventDefault();
   addShift((response)=>{
    if(response.error!="")
      alert(response.error);

      else{
        Swal.fire({
  position: 'center',
  icon: 'success',
  title: response.response,
  showConfirmButton: false,
  timer: 1500
})
        // alert(response.response);
        readData((response)=>{
      $('.table-container-body').html("");
  $('.table-container-body').html(response);
})
      
      }
   })
})

function addShift(displayResponse){
   if($(".save").text()=="Save"){
    if($(".before").val()<40){
      Swal.fire({
  position: 'center',
  icon: 'info',
  title: 'sorry we can not accept you your KG is less than 40',
  showConfirmButton: false,
  timer: 1500
})
    }
    else
    var data={
    "addca":"addca",
    mem_id: $(".teachersData").val(),
    before: $(".before").val(),
    after: $(".after").val(),
  }
    $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
      dataType: "JSON",
      success:(response)=>{
        displayResponse(response);
      },
      error: (response)=>{
console.log(response)
      }
    })
   }else{
    var data={
    "updateca":"updateca",
    before: $(".before").val(),
    after: $(".after").val(),
    mem_id: $(".teachersData").val(),
    id: $(".shift_id_hidden").val(),
  }
    $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
      dataType: "JSON",
      success:(response)=>{
        displayResponse(response);
      },
      error: (response)=>{
console.log(response)
      }
    })
   }
    
  }



$(document).on("click",'.edit',function(){
  // alert($(this).attr("shiftID"))
  getShiftData($(this).attr("shiftID"),(response)=>{
    $(".before").val(response.before);
    $(".after").val(response.after);
    $(".teachersData").val(response.mem_id);
    $(".shift_id_hidden").val(response.kg_id);
    $(".save").html("Edit");
    
  })
})

// data shifts
// id,shift,teacher

readData((response)=>{
  console.log(response);
  $('.table-container-body').html(response);
})
function readData(displayResponse){
    var data={
      "readca": "readca",

      "table": "mem_kg"
    }
    $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
   
      success:(response)=>{
        displayResponse(response);
      },
      error: (response)=>{
console.log(response)
      }
    })
  }

  getTeachersData((response)=>{
$(".teachersData").append(response);
  })
  function getTeachersData(displayResponse){
    var data={
      "getDataTeachers": "getDataTeachers",

      "table": "member"
    }
    $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
      
      success:(response)=>{
        displayResponse(response);
      },
      error: (response)=>{
console.log(response)
      }
    })
  }


  function getShiftData(id,displayResponse){
    var data={
      "getkgData": "getkgData",
      id: id,
      "table": "mem_kg",
    
    }
    $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
      dataType: "JSON",
      success:(response)=>{
        displayResponse(response);
      },
      error: (response)=>{
console.log(response)
      }
    })
  }






  function deleteShift(id){
    const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "Confirm to delete this record that has an id "+id,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    deleteShiftAjax(id,(response)=>{
      swalWithBootstrapButtons.fire(
      'Deleted!',
      response[0],
      'success'
    )
    setTimeout(() => {
      window.location.reload();
    }, 2000);
    })
    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})

  }

  function deleteShiftAjax(id,displayResponse){
    var data={
      "delete": "delete",
      "id": id,
      "table": "mem_kg"
    }
    $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
      dataType: "JSON",
      success:(response)=>{
        displayResponse(response);
      },
      error: (response)=>{
console.log(response)
      }
    })
  }



  
function fillForm(id){
  $.ajax({
          type: "POST",
          dataType: 'JSON',
          url: '../include/ajax.php',
          data: {table:'users',id:id,action:'update'},
          success: function(response)
          {
            console.log(response)
              // var member = JSON.parse(response);
              // console.log(employee)
                // document.querySelector('#employeeid').value=response.response.id
                document.querySelector('#name').value=response.response.user
                document.querySelector('#id').value=response.response.id
                document.querySelector('#dob').value=response.response.dob
                document.querySelector('#phone').value=response.response.mobile
                document.querySelector('#status').value=response.response.status
                // response.response.status==1 ? s.value="block" : s.value="active"
                document.querySelector('#address').value=response.response.address
                document.querySelector('#type').value=response.response.type
                // response.response.type == 0 ? type.options[0].selected='selected' :type.options[1].selected='selected'
                let gender=document.querySelectorAll('#gender input');
                response.response.gender == 0 ? gender[0].checked= true :gender[1].checked= true;
               
               document.querySelector('#password').value=response.response.password;

         }
     });
}
</script>