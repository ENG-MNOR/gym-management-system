<?php  include '../include/links.php';
// session_start();
if($_SESSION['type']!=0){
  header("location: ./login.php");
  exit();
}


include '../models/payment.php';

$message =array();
 if(isset($_POST['payment'])){
  if($_POST["name"] == "" || $_POST["month"] == "" )
  {
    $message = array("type"=>"error","message"=>"All Fields Are Required..");  
  }
  else{
    updateOne($_POST['id']) ? $message = array("type"=>"success","message"=>"Employee inserted successfully") : $message = array("type"=>"error","message"=>"Employee not inserted successfully");
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
            <h1>Payments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payment</li>
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
                <h3 class="card-title">payment list</h3>
                <!-- <button class="btn btn-primary float-right" href="#pay" data-toggle="modal">pay</button> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Month</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach(readAll("payment") as $payment){
                    ?>
                  <tr>
                    <?php foreach(get_single("member","id",escape($payment->emp_id))as $mem){
                      ?>
                    <td><?= escape( $payment->id); ?></td>
                    <td><?= $mem->name; ?>
                    </td>
                    <td><?= escape($payment->amount); ?></td>
                    <td> <?= getfee(escape($payment->fee)); ?></td>
                    <td> <?= escape($payment->bil); ?></td>
                    <td> <?= escape($payment->status); ?></td>
                    <?php }?>
    

                    <td> 
                      <?php
                    if(getfee(escape($payment->fee))=="Paid"){
                      ?>
 <a href="#" paymentID="<?php echo $payment->id ?>" class="btn btn-primary">
 <i class="fa-regular fa-circle-check"></i>
                      </a>
                      <?php
                    }else{
                      ?>
                     <a href="#" paymentID="<?php echo $payment->id ?>" class="btn btn-primary payByOne">
                      <i class="fa-brands fa-amazon-pay fa-beat"></i>
                      </a>
                                           <?php
                    }
                      ?>

                     
                    
                    </td>
                  </tr>
                  <?php } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Month</th>
                    <th>Status</th>
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



<div class="modal fade payModal" >
  <div class="modal-dialog modal-lg">
  <!-- <form > -->
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Pay The Amount of one member</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">      
      <div class="form-group">
        <input type="text" disabled class="form-control member"  />
          </div>
           <label>month of payment</label>
          <div class="form-group">
          <input type="text" disabled class="form-control month" name="month" />
          </div>
          <div class="form-group">
          <input type="hidden"  class="form-control id" name="id" />
          </div>
          
          <div class="form-group">
          <input type="number" placeholder="amount" class="form-control amount" name="amount" id="amount" disabled/>
          </div>  
          </div>
            <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary payment" >Pay</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- update employee -->



<!-- delete member -->


<!-- delete member -->

<script>


  getAndCompare((res)=>{
  console.log(res)
  if(res.response!="true"){
    console.log("has No Data")
    loadAndRegister()
  }
  // loadAndRegister();
})

   function getAndCompare(display){
    $.ajax({
      method: "POST",
      dataType: "JSON",
      data: {
        "fetchDate": "fetchDate",
      },
      url: "../include/operations.php",
      success: (response)=>{
        display(response);
      },
      error: (response)=>{
        console.log(response);

      },
    })

   }
   function loadAndRegister(){
    $.ajax({
      method: "POST",
      dataType: "JSON",
      data: {
        "loadAndRegister": "loadAndRegister",
      },
      url: "../include/operations.php",
      success: (response)=>{
       console.log(response);
      },
      error: (response)=>{
        console.log(response);

      },
    })

   }





















  $(document).on("click",".payByOne",function(){
    // alert("Paying..")
   buxi($(this).attr("paymentID"))
    
  })
  $(document).on("click",".payment",function(){
    // alert("Paying..")
    updatePayment((response)=>{
      // alert(response.response);
 
      setTimeout(() => {
        window.location.reload();
      }, 800);     
      $(".payModal").modal("hide");
      Swal.fire({
  position: 'top',
  icon: 'success',
  title: response.response,
  showConfirmButton: false,
  timer: 1500
})
    })
    
  })

  function updatePayment(displayResponse){
  
    var data={
    "updatePayment":"updatePayment",
    id: $(".id").val(),
  
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
function buxi(id){
    $.ajax({
            type: "POST",
            dataType: 'JSON',
            url: '../include/ajax.php',
            data: {table:'payment',id:id,action:'updates'},
            success: function(response)
            {
              console.log(response)
              console.log(response.response.id)
              $(".amount").val(response.response.amount)
              $(".month").val(response.response.bil)
              $(".member").val(response.response.name)

              $(".id").val(response.response.id)
                // // var member = JSON.parse(response);
                // // console.log(employee)
                //   document.querySelector('#id').value=response.response.id
                //   // document.querySelector('#name').value=response.response.name
                //   document.querySelector('#month').value=response.response.month
                //   document.querySelector('#amount').value=20
                  $(".payModal").modal("show");
           }
       });
  }

</script>