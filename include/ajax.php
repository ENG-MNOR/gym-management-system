<?php
include 'config.php';
if(isset($_POST['action']) && $_POST['action']=='update'){
    getdata($_POST['table'],$_POST['id']);
}else if(isset($_POST['action']) && $_POST['action']=='updateOne'){
    updateOne($_POST['table'],$_POST['id']);
}
else if(isset($_POST['action']) && $_POST['action']=='updates'){
    getdatas($_POST['table'],$_POST['id']);
}
function getdata($table, $id){
    $conn= new mysqli("localhost","root","","gym");
    $sql = "select * from $table where id=$id";
   $data = $conn->query($sql);
   $rows=$data->fetch_assoc();
   $response=array('response'=>$rows);
   echo json_encode($response);
}
function getdatas($table, $id){
    $conn= new mysqli("localhost","root","","gym");
    // $sql = "select * from $table where id='$id'";
    $sql = "SELECT $table.id,$table.amount,$table.bil,member.name from $table
    JOIN member ON $table.emp_id=member.id
    WHERE payment.id='$id'";
    $data = $conn->query($sql);
    $response=array();
   $data = $conn->query($sql);
   $rows=$data->fetch_assoc();
   $response=array('response'=>$rows);
   echo json_encode($response);
}
function updateOne($id,$table){
    global $db;
    $sql="update `$table` set fee=2 where id=`$id`;";
    $data = $db->query($sql);
    $response=array("");
    if($data)
     $response=array("Deleted Successfully");
     echo json_encode($response);
  }
?>