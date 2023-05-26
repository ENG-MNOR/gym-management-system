<?php 
include '../include/links.php';
// session_start();
if($_SESSION['type']!=0){
  header("location: ./login.php");
  exit();
}


include '../models/user.php';
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





 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if(isset($message)){
     getMessages($message);
        } ?>
    <div class="card"> 
        
              <div class="card-header ">
                <h3 class="card-title">Users list</h3>
                <button class="btn btn-primary float-right" href="#add-user" data-toggle="modal">Add New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>address</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>type</th>
                    <th>status</th>
                    <th>password</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach(readAll("users") as $users){
                    ?>
                  <tr>
                    <td><?= escape( $users->id); ?></td>
                    <td><?= capitalize(escape($users->user)); ?>
                    </td>
                    <td><?= escape($users->mobile); ?></td>
                    <td> <?= escape($users->address); ?></td>
                    <td><?= getGender($users->gender); ?></td>
                    
                    <td><?=  getAge($users->dob ?? date("y-m-d")); ?></td>
                    <td><?= nooc(escape($users->type)); ?></td>
                    <td><?= getStatus(escape($users->status)); ?></td>
                    <td><?= escape($users->password); ?></td>

                    <td> 
                      <a href="#update-user" data-toggle="modal" class="btn btn-primary" onclick="fillForm(<?=escape($users->id);?>); ">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="#" onclick="deleteMember('<?php echo $users->id;?>')"   memberID='<?php echo $users->id;?>'  class="btn btn-danger edit">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                     <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>address</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>type</th>
                    <th>status</th>
                    <th>password</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
    </section>
    <!-- /.content -->
  </div>















<?php  include '../include/footer.php'?>

<script>
function deleteMember(id){
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
    deleteMemberAjax(id,(response)=>{
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
// document.querySelector(".delete").addEventListener("click",function(){
//  deleteMember(document.querySelector(".delete").getAttribute("memberID"));
// })

//   function deletAction(id){
   
//     alert("HELLO")
//   }


  function deleteMemberAjax(id,displayResponse){
    var data={
      "delete": "delete",
      "id": id,
      "table": "users"
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