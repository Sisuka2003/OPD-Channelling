<?php
include './showErrors.php';
include './connection.php';

$id=$_POST['id'];
$name=$_POST['name'];
$address=$_POST['address'];
$contact=$_POST['contact'];
$color=$_POST['color'];

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

$t_docs=0;
if($in){
$insertQuery = "INSERT INTO hospitals(hos_name,address,hos_contact,total_doctors,hos_color)VALUES('".$name."','".$address."','".$contact."','".$t_docs."','".$color."')";
$isSaved = mysqli_query($connection, $insertQuery);


if ($isSaved) {
      echo "<script> alert('Hospital Inserted successfully');location='hospital.php' </script>";die();
} else {
      echo "<script> alert('Hospital Inserting Failed');location='hospital.php' </script>";die();
      
}
}

if($update){
    
$updateQuery = "UPDATE `hospitals` SET `hos_name`='".$name."',`address`='".$address."',`hos_contact`='".$contact."',`hos_color`='".$color."' WHERE `id_hospital`='".$id."'";
$isSaved = mysqli_query($connection, $updateQuery);


if ($isSaved) {
      echo "<script> alert('Hospital Updated successfully');location='hospital.php' </script>";die();
} else {
      echo "<script> alert('Hospital Updation failed');location='hospital.php' </script>";die();
}
}

if($delete){
    
$insertQuery = "DELETE  FROM `hospitals` WHERE `id_hospital`='".$id."'";
$isSaved = mysqli_query($connection, $insertQuery);


if ($isSaved) {
      echo "<script> alert('Hospital Deleted successfully');location='hospital.php' </script>";die();
} else {
      echo "<script> alert('Hospital Deletion Failed');location='hospital.php' </script>";die();
}
}
?>