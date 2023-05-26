  <!-- Main Sidebar Container -->
<?php
session_start();
ob_start();
if(!isset($_SESSION['user_id']))
{
  header("location: ../interface/login.php");
  exit();
}?>
<?php
if($_SESSION['type']==0){
  ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../../dist/img/gym.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GYM Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username']?></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Members
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="employees.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Members List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-user"></i>
              <p>
                Teachers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="teachers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teachers List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar-days"></i>
              <p>
                Shifts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="shifts.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shifts List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-dumbbell"></i>
              <p>
                Equipments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="equipments.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Equipments lists</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Payment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="payment.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-weight-scale"></i>
              <p>
                weight
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="weight.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>weight List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                REPORT
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="report.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>REPORT List</p>
                </a>
              </li>
            </ul>
            <li class="nav-item">
            <a  href="./logout.php" class="nav-link logout">
            <i class="fa-solid fa-right-from-bracket"></i>
           
                Log out
              
</a>
            
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


<?php
}else if ($_SESSION['type']==1){
  ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../../dist/img/gym.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GYM Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username']?></a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Members
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="employees.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Members List</p>
                </a>
              </li>
            </ul>
          </li>
         
         
          


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-dumbbell"></i>
              <p>
                Equipments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="equipments.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Equipments lists</p>
                </a>
              </li>
            </ul>
          </li>
          
          
            <li class="nav-item">
            <a  href="./logout.php" class="nav-link logout">
            <i class="fa-solid fa-right-from-bracket"></i>
           
                Log out
              
</a>
            
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


<?php
}else{
  header("location: ../interface/login.php");
  exit();
}


// ob_end_flush();

?>
  

  

  <script>

  // $(".logout").click(()=>{
  //  alert("hello")
  //   logginInsertion();
  
  // })

function logginInsertion(){
  var data={
   
    status: "logout",
    "inserLoginLogout": "inserLoginLogout",
    type: "logout"
  }
  $.ajax({
      method: "POST",
      url: "../include/operations.php",
      data: data,
      dataType: "JSON",
      success:(response)=>{
        if(response.valid){

          window.location="./login.php";
        }else{
          alert(response.response);
        }
       
      },
      error: (response)=>{
console.log(response)
      }
    })
}
</script>