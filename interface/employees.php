<?php include '../include/links.php';
 include '../models/employee.php';
 

 
  $message =array();
 if(isset($_POST['add-employee'])){
  if($_POST["name"] == "" || $_POST["phone"] == "" || $_POST["email"] == "" || $_POST["dob"]=="" || $_POST["address"]==""|| $_POST["type"]=="")
  {
    $message = array("type"=>"error","message"=>"All Fields Are Required..");  
  }
  else{
    $data = array( 
      "name" => escape($_POST['name']), 
      "mobile"=>$_POST['phone'], 
      "dob" => $_POST['dob'], 
      "email" => $_POST['email'], 
      "address"=>$_POST['address'],
       "gender" => $_POST['gender'],
       "mode" => $_POST['waqti'],
       "type" => $_POST['type']
      );
    insert('member',$data) ?$message = array("type"=>"success","message"=>"Employee inserted successfully") : $message = array("type"=>"error","message"=>"Employee not inserted successfully");
    // readAll("member");
   
  }
 }
if(isset($_POST['update-member'])){
  //csrf_check($_POST["csrf"]);

  if($_POST["name"] == "" || $_POST["phone"] == "" || $_POST["email"] == "" || $_POST["dob"]=="" || $_POST["address"]==""|| $_POST["waqti"]=="" || $_POST["type"]==""){
    $message = array("type"=>"error","message"=>"All Fields Are Required..");  
  }else{
       $data = array(
      "name" => escape($_POST['name']), 
      "mobile"=>$_POST['phone'], 
      "id"=>$_POST['id'], 
      "Status"=>$_POST['status'], 
      "dob" => $_POST['dob'], 
      "email" => $_POST['email'], 
      "address"=>$_POST['address'],
       "mode" => $_POST['waqti'],
       "gender" => $_POST['gender'],
       "type" => $_POST['type']
      );
    $sql = update("member", $data);
    if($sql){
  
      $message = array("type"=>"success","message"=>"Employee Updated successfully");  
          
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Members</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">members</li>
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
      <div class="row">
        <div class="col-12">
  
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
            <button class="btn btn-primary float-right mt-3" href="#add-employee" data-toggle="modal">Add New</button>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>Id</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <!-- <th>Mobile</th> -->
                  <!-- <th>Email</th> -->
                  <!-- <th>Address</th> -->
                  <th>shift</th>
                  <th>type</th>                  
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach(readAll("member") as $member) {?>
                <tr>
                  <td><?=escape($member->id) ?></td>
                  <td><?=capitalize(escape($member->name))?></td>

                  <td><?=  getAge($member->dob ?? date("y-m-d")); ?></td>
                  <td> <?= getGender(escape($member->gender))?></td>
                 
                  
                  <td> <?=getshift(escape($member->mode))?></td>
                  <td> <?=escape($member->type)?></td>
                  <td> <?=escape($member->Status)?></td>
                 
                  <td> 
                      <a href="#update-member" data-toggle="modal" class="btn btn-primary" onclick="fillForm(<?= escape( $member->id); ?>);">
                        <i class="fa fa-edit"></i>
                      </a>
                      <button onclick="deleteMember('<?php echo $member->id;?>')"   memberID='<?php echo $member->id;?>'  class="btn btn-danger delete">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                 
                <th>Id</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <!-- <th>Mobile</th> -->
                  <!-- <th>Email</th> -->
                  <!-- <th>Address</th> -->
                  <th>shift</th>
                  <th>type</th>                  
                  <th>Status</th>
                  <th>Action</th>

                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  
</div>


 <?php include '../include/footer.php';?>

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
      "table": "member"
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
            data: {table:'member',id:id,action:'update'},
            success: function(response)
            {
              console.log(response)
                // var member = JSON.parse(response);
                // console.log(employee)
                  // document.querySelector('#employeeid').value=response.response.id
                  document.querySelector('#name').value=response.response.name
                  document.querySelector('.id').value=response.response.id
                  document.querySelector('#dob').value=response.response.dob
                  document.querySelector('#phone').value=response.response.mobile
                  document.querySelector('#email').value=response.response.email
                  document.querySelector('#status').value=response.response.Status

                  document.querySelector('#address').value=response.response.address
                  document.querySelector('#type').value=response.response.type
                  let gender=document.querySelectorAll('#gender input');
                  response.response.gender == 0 ? gender[0].checked= true :gender[1].checked= true;
                 
                 document.querySelector('.waqti').value=response.response.mode;
                

           }
       });
  }
</script>