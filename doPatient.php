<?php
include './showErrors.php';
include './connection.php';

$id=$_POST['id'];
$pw=$_POST['pswd'];
$nic=$_POST['nic'];
$fname=$_POST['fname'];
$contact=$_POST['contact'];

$in="";
$update="";
$delete="";

if(isset($_POST['insert'])){
    $in=$_POST['insert'];
}
if(isset($_POST['update'])){
    $update=$_POST['update'];
}
if(isset($_POST['delete'])){
    $delete=$_POST['delete'];
}


    $sts="false";
    $pro_pic="images/user.png";
if($in){
$insertQuery = "INSERT INTO `patients`(`pa_nic`,`pa_name`,`pa_contact`,`password`,`profile_pic`)VALUES('".$nic."','".$fname."','".$contact."','".$pw."','".$pro_pic."')";
$isSaved = mysqli_query($connection, $insertQuery);


if ($isSaved) {
      echo "<script> alert('Patient Inserted successfully');location='patient.php' </script>";die();
      echo "hello";
} else {
    $querys="SELECT * FROM `admin` where `ar_password`='".$pw."'";
      $results = $connection->query($querys);
      if ($row = $results->fetch_assoc()) {
      echo "<script> alert('Password Already Exists');location='patient.php' </script>";die();
      }
}
}

if($update){
    
$updateQuery = "UPDATE `patients` SET `pa_nic`='".$nic."',`pa_name`='".$fname."',`pa_contact`='".$contact."',`password`='".$pw."',`profile_pic`='".$pro_pic."' WHERE `id_patients`='".$id."'";
$isSaved = mysqli_query($connection, $updateQuery);


if ($isSaved) {
      echo "<script> alert('Patient Updated successfully');location='patient.php' </script>";die();
} else {
      echo "<script> alert('Patient Updation failed');location='patient.php' </script>";die();
}
}

if($delete){
    
$insertQuery = "DELETE  FROM `patients` WHERE `id_patients`='".$id."'";
$isSaved = mysqli_query($connection, $insertQuery);


if ($isSaved) {
      echo "<script> alert('Patient Deleted successfully');location='patient.php' </script>";die();
} else {
      echo "<script> alert('Patient Deletion Failed');location='patient.php' </script>";die();
}
}
?>