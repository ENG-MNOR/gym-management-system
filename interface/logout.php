<?php
session_start();
$conn= new mysqli("localhost","root","","gym");
$time=date('Y-m-d h:i:s');
$username=$_SESSION['username'];
$sql="INSERT INTO `log`( `name`, `status`, `time`) VALUES ('$username','logout','$time');";
$data = $conn->query($sql);

if($data)
{
  session_unset();
  session_destroy();
  header("location: ./login.php");
}





?>