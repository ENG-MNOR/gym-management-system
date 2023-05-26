<?php
include 'config.php';
if(isset($_POST['delete'])){
  deleteOne($_POST['id'],$_POST['table']);
}else if (isset($_POST['read'])){
  read($_POST['table']);
}
else if (isset($_POST['readca'])){
  readca($_POST['table']);
}
else if (isset($_POST['getDataTeachers'])){
  getDataTeachers($_POST['table']);
}
else if (isset($_POST['getShiftData'])){
  getShiftData($_POST['table']);
}
else if (isset($_POST['getkgData'])){
  getkgData($_POST['table']);
}
else if (isset($_POST['add'])){
  add();
}
else if (isset($_POST['addca'])){
  addca();
}
else if (isset($_POST['inserLoginLogout'])){
  inserLoginLogout();
}
else if (isset($_POST['readpay'])){
  readpay();
}
else if (isset($_POST['reportAll'])){
  readReport();
}
else if (isset($_POST['readpaid'])){
  readpaid();
}
else if (isset($_POST['readunpaid'])){
  readpaid();
}
else if (isset($_POST['login'])){
  login();
}
else if (isset($_POST['fetchDate'])){
  fetchDate();
}
else if (isset($_POST['update'])){
  updateShift();
}
else if (isset($_POST['updateca'])){
  updateca();
}
else if (isset($_POST['loadAndRegister'])){
  loadAndRegister();
}
else if (isset($_POST['updatePayment'])){
  updateOne($_POST['id']);
}
function get_single($table,$column, $where){
  global $db;
  $result  =   $db->query("SELECT * FROM $table where $column = $where")->fetchAll(PDO::FETCH_OBJ);
  return $result;
}
function get_one($table,$column, $where){
  global $db;
  $result  =   $db->query("SELECT 'name' FROM $table where $column = $where")->fetchAll(PDO::FETCH_OBJ);
  return $result;
}
function updateOne($id){
  $conn= new mysqli("localhost","root","","gym");
  $sql="update payment set fee=2 where id='$id'";
      $data = $conn->query($sql);
     $response=array();
     if($data){
     
      $response=array(
        "response"=>"Payment Was Proceeded Successfully..."
      );
     }
    echo json_encode($response);
  
  
}
// get all data
function readAll($table){
     global $db;
     $sql = "select * from $table";
     $data = $db->query($sql)->fetchAll(PDO::FETCH_OBJ);
     return $data;
}
function readpay(){
  extract($_POST);
  // $FROM=date_format(new date($from), 'Y-m-d H:i:s');
  // $TO=date_format(new date($to), 'Y-m-d H:i:s');
  $FROM = date("Y-m-d", strtotime($from));
  $TO = date("Y-m-d", strtotime($to));
  // echo "New date format is: ". $FROM.$TO;
  $data=array();
  $array_data=array();
  $conn= new mysqli("localhost","root","","gym");
     $sql = "SELECT payment.id 'Payment Id', member.name 'Member Name', payment.amount 'Amount',payment.fee 'fee', 
     payment.month 'Month', payment.status 'Status', payment.bil 'Bil'
     from payment JOIN member on payment.emp_id = member.id WHERE   payment.month BETWEEN '$FROM' AND '$TO' ";   
     $result = $conn->query($sql);
     if($result){
      $result = $conn->query($sql);
      if($result){
       while($row=$result->fetch_assoc()){
         $array_data []=$row;
       }
       $data=array("status"=>true,"data"=>$array_data);
 
      }}
      else{
       
       $data=array("status"=>false, "data"=>$conn->error);
      }
      echo json_encode($data); 
}
function readpaid(){
  extract($_POST);
  $data=array();
  $array_data=array();
  $conn= new mysqli("localhost","root","","gym");
     $sql = "SELECT payment.id 'Payment Id', member.name 'Member Name', payment.amount 'Amount',payment.fee 'fee', 
     payment.month 'Month', payment.status 'Status', payment.bil 'Bil'
     from payment JOIN member on payment.emp_id = member.id WHERE   payment.fee='$fee' ";   
     $result = $conn->query($sql);
     if($result){
      $result = $conn->query($sql);
      if($result){
       while($row=$result->fetch_assoc()){
         $array_data []=$row;
       }
       $data=array("status"=>true,"data"=>$array_data);
 
      }}
      else{
       
       $data=array("status"=>false, "data"=>$conn->error);
      }
      echo json_encode($data); 
}
function getDataTeachers($table){
  $conn= new mysqli("localhost","root","","gym");
     $sql = "select * from $table";
     $data = $conn->query($sql);
     if($data){
      while($rows=$data->fetch_assoc()){
        ?>
<option value="<?php echo $rows['id']?>"><?php echo $rows['name']?></option>

<?php
      }
     }
    
}
function getShiftData($table){
  extract($_POST);
  $conn= new mysqli("localhost","root","","gym");
     $sql = "select * from $table where id='$id'";
     $data = $conn->query($sql);
     $response=array();
     if($data){
      $row=$data->fetch_assoc();
      $response=array(
        "name"=>$row['shift'],
        "teacher_id"=>$row['teacher_id'],
        "shift_id"=>$row['id'],
      );
     }
    echo json_encode($response);
}
function getkgData($table){
  extract($_POST);
  $conn= new mysqli("localhost","root","","gym");
     $sql = "select * from $table where id='$id'";
     $data = $conn->query($sql);
     $response=array();
     if($data){
      $row=$data->fetch_assoc();
      $response=array(
        "before"=>$row['before'],
        "after"=>$row['after'],
        "mem_id"=>$row['mem_id'],
        "kg_id"=>$row['id'],
      );
     }
    echo json_encode($response);
}
function login(){
  extract($_POST);
  session_start();
  $conn= new mysqli("localhost","root","","gym");
     $sql = "select * from users where user='$username' AND password='$password';";
     $data = $conn->query($sql);
     $response=array();
     if($data){
      if(mysqli_num_rows($data)>0){
        $row=$data->fetch_assoc();
        $_SESSION['user_id']=$row['id'];
        $_SESSION['username']=$row['user'];
        $_SESSION['type']=$row['type'];

        $response=array(
         "valid"=>true
        );
      }else 
      $response=array("valid"=>false,"response"=>"Incorrect Username Or password");
     
     }
    echo json_encode($response);
}
function read($table){
  $conn= new mysqli("localhost","root","","gym");
     $sql = "SELECT teachers.id as teacherID,teachers.name as teacherName,$table.id,$table.shift from teachers
     JOIN $table ON teachers.id=$table.teacher_id";
     $data = $conn->query($sql);
     if($data){
      ?>
<table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Shift</th>
                      <th>Teacher</th>
                      <th>Actions</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   
                 <?php
 while($rows=$data->fetch_assoc()){
  ?>
<tr>
<td><?php echo $rows['id']?></td>
<td><?php echo $rows['shift']?></td>
<td><?php echo $rows['teacherName']?></td>
<td> 
                      <button shiftID="<?php echo $rows['id']?>" class="btn btn-primary edit" >
                        <i class="fa fa-edit"></i>
                      </button>
                      <button  shiftID="<?php echo $rows['id']?>" class="btn btn-danger delete">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
 </tr>


<?php
 }

?>
                  </tbody>
                </table>

<?php
     
     }
    
   
    
}function readca($table){
  $conn= new mysqli("localhost","root","","gym");
     $sql = "SELECT member.id as memberID,member.name as memberName,$table.id,$table.before,$table.after from member
     JOIN $table ON member.id=$table.mem_id";
     $data = $conn->query($sql);
     if($data){
      ?>
<table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>members</th>
                      <th>before</th>
                      <th>after</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   
                 <?php
 while($rows=$data->fetch_assoc()){
  ?>
<tr>
<td><?php echo $rows['id']?></td>
<td><?php echo $rows['memberName']?></td>
<td><?php echo $rows['before']?>kg</td>
<td><?php echo $rows['after']?>kg</td>
<td> 
                      <button shiftID="<?php echo $rows['id']?>" class="btn btn-primary edit" >
                        <i class="fa fa-edit"></i>
                      </button>
                      <button  shiftID="<?php echo $rows['id']?>" class="btn btn-danger delete">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
 </tr>


<?php
 }

?>
                  </tbody>
                </table>

<?php
     
     }
    
   
    
}

function readReport(){
  extract($_POST);
  $data=array();
  $array_data=array();
  $conn= new mysqli("localhost","root","","gym");
     $sql = "SELECT payment.id 'Payment Id', member.name 'Member Name', payment.amount 'Amount',payment.fee 'fee', 
     payment.month 'Month', payment.status 'Status', payment.bil 'Bil'
     from member JOIN payment on payment.emp_id = member.id ;";
     $result = $conn->query($sql);
     if($result){
      while($row=$result->fetch_assoc()){
        $array_data []=$row;
      }
      $data=array("status"=>true,"data"=>$array_data);

     }
     else{
      
      $data=array("status"=>false, "data"=>$conn->error);
     }
     echo json_encode($data);   
}
function c($n){
  $conn= new mysqli("localhost","root","","gym");
  $sql="select count(*) as count from $n";
  $data = $conn->query($sql);
$result= $data->fetch_assoc();  return $result;

 }
function deleteOne($id,$table){
    global $db;
    $sql="DELETE FROM `$table` where id='$id';";
    $data = $db->query($sql);
    $response=array("");
    if($data)
     $response=array("Deleted Successfully");
     echo json_encode($response);
}

function add(){
  extract($_POST);
  $conn= new mysqli("localhost","root","","gym");
  $sql="INSERT INTO `shift`( `shift`, `teacher_id`) VALUE('$shift_name','$teacher_id');";
  $data = $conn->query($sql);
  $response=array("");
  if($data)
   $response=array("error"=>"","response"=>"Shift Was Added Successfully..");
   echo json_encode($response);
}
function addca(){
  extract($_POST);
  $conn= new mysqli("localhost","root","","gym");
  $sql="INSERT INTO `mem_kg`( `mem_id`, `before`,`after`) VALUE('$mem_id','$before','$after');";
  $data = $conn->query($sql);
  $response=array("");
  if($data)
   $response=array("error"=>"","response"=>"Was Added Successfully..");
   echo json_encode($response);
}
function inserLoginLogout(){
  extract($_POST);
  $response=array("");
  if($type=="login")
  {


    $conn= new mysqli("localhost","root","","gym");
    $time=date('Y-m-d h:i:s');
    $sql="INSERT INTO `log`( `name`, `status`, `time`) VALUES ('$username','$status','$time');";
    $data = $conn->query($sql);
   
    if($data)
     $response=array("valid"=>true);
  }else if($type=="logout"){
    $conn= new mysqli("localhost","root","","gym");
    $time=date('Y-m-d h:i:s');
    $username=$_SESSION['username'];
    $sql="INSERT INTO `log`( `name`, `status`, `time`) VALUES ('$username','$status','$time');";
    $data = $conn->query($sql);
   
    if($data)
    {
      session_unset();
      session_destroy();
      $response=array("valid"=>true);
    }
  }
 
   echo json_encode($response);
}

function loadAndRegister(){
  extract($_POST);
  $conn= new mysqli("localhost","root","","gym");
  $response=array("");
  $date=date("Y-m-d");
  $month=strtolower(getmonth(date("Y-m-d")));
  

  
  $sql_member="SELECT id from member;";
  $data_member = $conn->query($sql_member);
  if($data_member){
    
    $count=0;
    while($rows=$data_member->fetch_assoc()){
      $count++;
     $m_id=$rows['id'];
      $sql_insertion="INSERT INTO `payment`(`emp_id`, `amount`, `fee`, `month`, `status`, `bil`) VALUES ('$m_id',50,1,'$date','active','$month');";
      $data_payment = $conn->query($sql_insertion);
    $response=array("status"=>true,"date"=>$date,"count"=>$count);

    }
     
    }

// $response[]=array("date"=>$date);
  
   echo json_encode($response);
}
function fetchDate(){
  extract($_POST);
  $conn= new mysqli("localhost","root","","gym");
  $month=strtolower(getmonth(date('Y-m-d')));
  $sql="SELECT * from payment where bil='$month';";
  // $current_month_Table=getmonth()
  $data=$conn->query($sql);
  $response=array("");
  if($data){
    if(mysqli_num_rows($data)>0)
    $response=array("error"=>"","response"=>"true");
else
$response=array("error"=>"","response"=>"false");

  }
   echo json_encode($response);
}
function updateShift(){
  extract($_POST);
  $conn= new mysqli("localhost","root","","gym");
  $sql="UPDATE shift set shift='$shift_name', teacher_id='$teacher_id' where id='$shift_id';";
  $data = $conn->query($sql);
  $response=array("");
  if($data)
   $response=array("error"=>"","response"=>"Shift Was Updated Successfully..");
   echo json_encode($response);
}
function updateca(){
  extract($_POST);
  $conn= new mysqli("localhost","root","","gym");
  $sql="UPDATE `mem_kg` set `mem_id`='$mem_id', `before`='$before', `after`='$after' where id='$id';";
  $data = $conn->query($sql);
  $response=array("");
  if($data){
   $response=array("error"=>"","response"=>"Updated Successfully...");
   echo json_encode($response);
  
}}


function getAge($date){
    $diff = abs(strtotime(date("y-m-d")) - strtotime($date));
    $years = floor($diff / (365*60*60*24));
    return $years;
}
function escape($input){
    return htmlspecialchars($input);
}
function getGender($gender){
    return escape($gender==1 ? "Female": "Male");
  }
  function nooc($type){
    return escape($type==0 ? "Admin": "user");
  }
  function getStatus($status){
    return escape($status==0 ? "Active": "block");
  }
  function getshift($shift){
    return escape($shift==1 ? "Day": "Night");
  }
  function getfee($fee){
    return escape($fee==1 ? "Unpaid": "Paid");
  }
  function getmonth($date){
    $num = date("m",strtotime($date));
    return date("F",mktime(0,0,0, $num,10));
  }
  // capitize function 
function capitalize($input){
    return ucwords($input);
}
function getMessages($ms){
  if(count($ms)>0){
    if($ms['type']=='success'){
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
<strong><?php echo $ms['message']?></strong> 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>


      <?php
    }else{
      ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong><?php echo $ms['message']?></strong> 
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>


      <?php
    }
  }
}
//insert function
function insert($table, $data){
    global $db;
    $keys = implode(",",array_keys($data));
    $keyWithColon =":".implode(",:",array_keys($data));
    $sql =$db->prepare( "INSERT INTO $table ($keys) values( $keyWithColon)");
    $sql->execute($data);
   
    return $sql ?$db->lastInsertId() :false;
}
// update function
function update($table,$data){
  global $db;
  $pairs = array();
  foreach($data as $k => $v){
      $pairs[] = $k . " = :" . $k;
  }
  $keyVal = implode(",",$pairs);
  try{
    $sql = $db->prepare("UPDATE  $table SET 
    $keyVal
    WHERE id    = :id");
    $sql->execute($data);
    return $sql ? true : false;

  }catch(PDOException $e){
        die($e->getMessage());
  }
}
// capitize function 
// function capitalize($input){
//     return ucwords($input);
// }
// function leexi($location){
//   header("location: $location");
// }
function csrf_check($input){
  if (!hash_equals($_SESSION['csrf'], $input)){
      // leexi("400.php");
      exit();
  }
}
?>