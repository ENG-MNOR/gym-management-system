<?php  include '../include/links.php';
include '../models/equipment.php';
$message =array();
 if(isset($_POST['add-equipment'])){
  if($_POST["name"] == "" || $_POST["cost"] == "" || $_POST["quantity"] == "" )
  {
    $message = array("type"=>"error","message"=>"All Fields Are Required..");  
  }
  else{
    $data = array( 
      "name" => escape($_POST['name']), 
      "cost"=>$_POST['cost'], 
      "quantity" => $_POST['quantity']
      );
    insert('equipment',$data) ? $message = array("type"=>"success","message"=>"Employee inserted successfully") : $message = array("type"=>"error","message"=>"Employee not inserted successfully");
    readAll("member");
  }
 }
if(isset($_POST['update-equipment'])){
  //csrf_check($_POST["csrf"]);

  if($_POST["name"] == "" || $_POST["cost"] == "" || $_POST["quantity"] == ""){
    $message = array("type"=>"error","message"=>"All Fields Are Required..");  
  }else{
   
       $data = array(
      "name" => escape($_POST['name']), 
      "cost"=>$_POST['cost'], 
      "id"=>$_POST['id'], 
      "quantity" => $_POST['quantity'], 
      );
      $sql = update("equipment", $data);
    if($sql){
       $message = array("type"=>"success","message"=>"Employee Updated successfully");  
          
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
            <h1>Equipment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Equipments</li>
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
                <h3 class="card-title">Equipments list</h3>
                <button class="btn btn-primary float-right" href="#add-equipment" data-toggle="modal">Add New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Cost</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach(readAll("equipment") as $equipment){
                    ?>
                  <tr>
                    <td><?= escape( $equipment->id); ?></td>
                    <td><?= capitalize(escape($equipment->name)); ?>
                    </td>
                    <td><?= escape($equipment->cost); ?></td>
                    <td> <?= escape($equipment->quantity); ?></td>
                    
                    

                    <td> 
                      <a href="#update-equipment" data-toggle="modal" class="btn btn-primary"  onclick="buxi(<?= escape( $equipment->id); ?>);">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="#"  onclick="deleteMember('<?php echo $equipment->id;?>')"   memberID='<?php echo $equipment->id;?>'  class="btn btn-danger edit">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Cost</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
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
  function buxi(id){
    $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: '../include/ajax.php',
            data: {table:'equipment',id:id,action:'update'},
            success: function(response)
            {
              console.log(response)
                // var member = JSON.parse(response);
                // console.log(employee)
                  document.querySelector('#id').value=response.response.id
                  document.querySelector('#name').value=response.response.name
                  document.querySelector('#cost').value=response.response.cost
                  document.querySelector('#quantity').value=response.response.quantity
           }
       });
  }
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
      "table": "equipment"
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

</script>