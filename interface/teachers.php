<?php include '../include/links.php';
// session_start();
if($_SESSION['type']!=0){
  header("location: ./login.php");
  exit();
}

include '../models/teacher.php';
$message =array();
 if(isset($_POST['add-teacher'])){
  if($_POST["name"] == "" || $_POST["phone"] == "" || $_POST["dob"]=="" || $_POST["address"]=="" || $_POST["waqti"]=="")
  {
    $message = array("type"=>"error","message"=>"All Fields Are Required..");  
  }
  else{
    $data = array( 
      "name" => escape($_POST['name']), 
      "mobile"=>$_POST['phone'], 
      "dob" => $_POST['dob'],  
      "address"=>$_POST['address'],
       "shift" => $_POST['waqti']
      );
    insert('teachers',$data) ?$message = array("type"=>"success","message"=>"teacher inserted successfully") : $message = array("type"=>"error","message"=>"user not inserted successfully");
    
  }
 }
if(isset($_POST['update-teacher'])){
  //csrf_check($_POST["csrf"]);

  if($_POST["name"] == "" || $_POST["phone"] == "" || $_POST["dob"]=="" || $_POST["address"]=="" || $_POST["waqti"]=="")
  {
    $message = array("type"=>"error","message"=>"All Fields Are Required..");
  }else{
       $data = array(
      "id" => escape($_POST['id']),
      "name" => escape($_POST['name']), 
      "mobile"=>$_POST['phone'], 
      "dob" => $_POST['dob'],  
      "address"=>$_POST['address'],
       "shift" => $_POST['waqti']
      );
    $sql = update("teachers", $data);
    if($sql){
      $message = array("type"=>"success","message"=>"teacher Updated successfully");  
          
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
            <h1>Teachers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Teachers</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="card"> 
         <?= isset($message) ? getMessages($message) :''; ?>
              <div class="card-header ">
                <h3 class="card-title">Teachers list</h3>
                <button class="btn btn-primary float-right" href="#add-teachers" data-toggle="modal">Add New</button>
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
                    <th>Age</th>
                 
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach(readAll("teachers") as $teachers){
                    ?>
                  <tr>
                    <td><?= escape( $teachers->id); ?></td>
                    <td><?= capitalize(escape($teachers->name)); ?>
                    </td>
                    <td><?= escape($teachers->mobile); ?></td>
                    <td> <?= escape($teachers->address); ?></td>
                    
                    <td><?=  getAge($teachers->dob ?? date("y-m-d")); ?></td>
                   

                    <td> 
                      <a href="#update-teacher" data-toggle="modal" class="btn btn-primary" onclick="fillForm(<?=escape($teachers->id);?>); ">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="#"  onclick="deleteMember('<?php echo $teachers->id;?>')"   memberID='<?php echo $teahers->id;?>' class="btn btn-danger edit">
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
                    <th>Age</th>
                   
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
      "table": "teachers"
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
          data: {table:'teachers',id:id,action:'update'},
          success: function(response)
          {
            console.log(response)
              // var member = JSON.parse(response);
              // console.log(employee)
                // document.querySelector('#employeeid').value=response.response.id
                document.querySelector('#name').value=response.response.name
                document.querySelector('#id').value=response.response.id
                document.querySelector('#dob').value=response.response.dob
                document.querySelector('#phone').value=response.response.mobile
                document.querySelector('#waqti').value=response.response.shift
                document.querySelector('#address').value=response.response.address
   

         }
     });
}
</script>