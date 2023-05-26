<?php
include '../include/links.php';


 



?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              
                <h3><?php echo c("member")['count'];?></h3>

                <p>Members</p>
              </div>
              <div class="icon">
              <i class="fa-solid fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> <?php echo c("teachers")['count'];?><sup style="font-size: 20px"></sup></h3>

                <p>Teachers</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-stats-bars"></i> -->
                <i class="fa-solid fa-chalkboard-user"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo c("users")['count'];?></h3>

                <p>Users </p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo c("equipment")['count'];?></h3>

                <p>equiments</p>
              </div>
              <div class="icon">
              <i class="fa-solid fa-dumbbell"></i>              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
      <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">last users log in</h3>

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
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">Id#</th>
                      <th>Username</th>
                      <th>status</th>
                      <th style="width: 40px">Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach(readAll("log") as $log) {?>
                    <tr>
                      <td><?=$log->id?></td>
                      <td><?=$log->name?></td>
                      <td><?=$log->status?></td>
                      <td><span class="badge bg-danger"><?=$log->time?></span></td>
                    </tr>
                    <?php } ?>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         
            <!-- /.card -->
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  
  <?php
include '../include/footer.php';
  ?>
  