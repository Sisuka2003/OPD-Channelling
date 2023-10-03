<?php
include './showErrors.php';
include './connection.php';

$id=$_POST['id'];
$pw=$_POST['pswd'];
$nic=$_POST['nic'];
$fname=$_POST['fname'];
$contact=$_POST['contact'];
$hos=$_POST['hospital'];
$spec=$_POST['spec'];

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
    $pro_pic="images/doctor_pro.png";
if($in){
$insertQuery = "INSERT INTO `doctors`(`dr_nic`,`dr_name`,`dr_contact`,`dr_password`,`dr_pro_pic`,`hospital_id`,`specialization_id`,`dr_status`)VALUES('".$nic."','".$fname."','".$contact."','".$pw."','".$pro_pic."','".$hos."','".$spec."','".$sts."')";
$isSaved = mysqli_query($connection, $insertQuery);


if ($isSaved) {
      echo "<script> alert('Doctor Inserted successfully');location='doctor.php' </script>";die();
      echo "hello";
} else {
    $querys="SELECT * FROM `admin` where `ar_password`='".$pw."'";
      $results = $connection->query($querys);
      if ($row = $results->fetch_assoc()) {
      echo "<script> alert('Password Already Exists');location='doctor.php' </script>";die();
      }
}
}

if($update){
    
$updateQuery = "UPDATE `doctors` SET `dr_nic`='".$nic."',`dr_name`='".$fname."',`dr_contact`='".$contact."',`dr_password`='".$pw."',`dr_pro_pic`='".$pro_pic."',`hospital_id`='".$hos."',`specialization_id`='".$spec."' WHERE `id_doctors`='".$id."'";
$isSaved = mysqli_query($connection, $updateQuery);


if ($isSaved) {
      echo "<script> alert('Doctor Updated successfully');location='doctor.php' </script>";die();
} else {
      echo "<script> alert('Doctor Updation failed');location='doctor.php' </script>";die();
}
}

if($delete){
    
$insertQuery = "DELETE  FROM `doctors` WHERE `id_doctors`='".$id."'";
$isSaved = mysqli_query($connection, $insertQuery);


if ($isSaved) {
      echo "<script> alert('Doctor Deleted successfully');location='doctor.php' </script>";die();
} else {
      echo "<script> alert('Doctor Deletion Failed');location='doctor.php' </script>";die();
}
}
?>