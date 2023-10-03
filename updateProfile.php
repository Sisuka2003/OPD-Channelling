<?php
include './showErrors.php';
session_start();
include './connection.php';

$userid="";
$title="";
if(isset( $_SESSION["userid"])){$userid= $_SESSION["userid"];}
if( isset($_SESSION["titlename"])){$title= $_SESSION["titlename"];}
if($userid===''){echo "<script> alert('Unknown Error Occured. Please Log Again');location='login.php' </script>";die();}
if($title===''){echo "<script> alert('Unknown Error Occured. Please Log Again');location='login.php' </script>";die();}
$nic="";
$contact="";
$name="";
$password="";
$hospital="";
$hospital_id="";
$specialization="";
$spec_id="";
$from="";
$to="";
$periodFrom="";
$periodTo="";

if($title == "dr"){
    
if(isset($_POST['nic'])){$nic=$_POST['nic'];}
if(isset($_POST['contact'])){$contact=$_POST['contact'];}
if(isset($_POST['name'])){$name=$_POST['name'];}
if(isset($_POST['pswd'])){$password=$_POST['pswd'];}
if(isset($_POST['from'])){$from=$_POST['from'];}
if(isset($_POST['to'])){$to=$_POST['to'];}
if(isset($_POST['periodfrom'])){$periodFrom=$_POST['periodfrom'];}
if(isset($_POST['periodto'])){$periodTo=$_POST['periodto'];}
if(isset($_POST['hospital'])){$hospital=$_POST['hospital'];}
if(isset($_POST['specialization'])){$specialization=$_POST['specialization'];}

if($nic===''){ echo "<script> alert('Unknown Error Occured.NIC Number Not Found');location='profile.php' </script>";die();}
if($contact===''){ echo "<script> alert('Unknown Error Occured. Invalid Contact Number');location='profile.php' </script>";die();}
if($password===''){ echo "<script> alert('Unknown Error Occured.Invalid Password');location='profile.php' </script>";die();}
if($hospital===''){ echo "<script> alert('Unknown Error Occured.Hospital Cannot Not Be Found');location='profile.php' </script>";die();}
if($specialization===''){ echo "<script> alert('Unknown Error Occured.Undefined specialization');location='profile.php' </script>";die();}
if($name===''){ echo "<script> alert('Unknown Error Occured.Name Not Found');location='profile.php' </script>";die();}
if($from===''){ echo "<script> alert('Please Enter Your Working Time to Activate Your Account');location='profile.php' </script>";die();}
if($to===''){ echo "<script> alert('Please Enter Your Working Time to Activate Your Account');location='profile.php' </script>";die();}
if($periodFrom===''){ echo "<script> alert('Please Enter Your Working Time Correctly to Activate Your Account');location='profile.php' </script>";die();}
if($periodTo===''){ echo "<script> alert('Please Enter Your Working Time Correctly to Activate Your Account');location='profile.php' </script>";die();}
if(isset($_POST['img'])){ echo "<script> alert('Please Select An Profile Picture Before Continuing');location='profile.php' </script>";die();}


$target_dir="uploads/";
$target_file=$target_dir.basename($_FILES["img"]["name"]);
$uploadOk=1;
$fileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg"){
    $uploadOk=0;
}
if($uploadOk===0){
//    echo "only jpg png and jpeg formats";
}else{
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
}

   $selectHospitalExistency = "select * from hospitals where hos_name like '%" . $hospital . "%'";
                $HosExist2 = $connection->query($selectHospitalExistency);
                if ($HosrowExis2 = $HosExist2->fetch_assoc()) {
                    $hospital_id = $HosrowExis2["id_hospital"];
                }else{
                  echo "<script> alert('Invalid hospital');location='profile.php' </script>";die();  
                }

   $selectSpecsExistency = "select * from specialization where name like '%" . $specialization . "%'";
                $SpecExist2 = $connection->query($selectSpecsExistency);
                if ($SpecrowExis2 = $SpecExist2->fetch_assoc()) {
                    $spec_id = $SpecrowExis2["id_spec"];
                }else{
                  echo "<script> alert('Invalid Specialization');location='profile.php' </script>";die();  
                }

               $dr_status="true";
         
    $selectDoctorTime="select * from doctors where dr_nic='".$userid."'";
      $docExistRes = $connection->query($selectDoctorTime);
                if ($docExistRow = $docExistRes->fetch_assoc()) {
                      $fromtime=$from;
                $toTime=$to;
                }else{
                $fromtime=$from." ".$periodFrom;
                $toTime=$to." ".$periodTo;
                }
                
$update="UPDATE doctors SET dr_pro_pic='".$target_file."',dr_name='".$name."',dr_contact='".$contact."',hospital_id='".$hospital_id."',specialization_id='".$spec_id."',start_time='".$fromtime."',end_time='".$toTime."',dr_status='".$dr_status."' WHERE dr_nic='".$nic."'";
$result=$connection->query($update);

if($result==TRUE){
    echo "<script> alert('Doctor Details Updated');location='profile.php' </script>";die();
}else{
      echo "<script> alert('Unknown Error occured in updating Doctor Details');location='profile.php' </script>";die(); 
}


} else {
    
    
    if(isset($_POST['nic'])){$nic=$_POST['nic'];}
if(isset($_POST['contact'])){$contact=$_POST['contact'];}
if(isset($_POST['name'])){$name=$_POST['name'];}
if(isset($_POST['pswd'])){$password=$_POST['pswd'];}

if($nic===''){ echo "<script> alert('Unknown Error Occured.NIC Number Not Found');location='profile.php' </script>";die();}
if($contact===''){ echo "<script> alert('Unknown Error Occured. Invalid Contact Number');location='profile.php' </script>";die();}
if($password===''){ echo "<script> alert('Unknown Error Occured.Invalid Password');location='profile.php' </script>";die();}
if($name===''){ echo "<script> alert('Unknown Error Occured.Name Not Found');location='profile.php' </script>";die();}
if(isset($_POST['img'])){ echo "<script> alert('Please Select An Profile Picture Before Continuing');location='profile.php' </script>";die();}


$target_dir="uploads/";
$target_file=$target_dir.basename($_FILES["img"]["name"]);
$uploadOk=1;
$fileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg"){
    $uploadOk=0;
}
if($uploadOk===0){
//    echo "only jpg png and jpeg formats";
}else{
    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
}

$update="UPDATE patients SET pa_name='".$name."',pa_contact='".$contact."', password='".$password."', profile_pic='".$target_file."' WHERE pa_nic='".$nic."'";
$result=$connection->query($update);

if($result==TRUE){
    echo "<script> alert('Patient Details Updated');location='profile.php' </script>";die();
}else{
      echo "<script> alert('Unknown Error occured in updating Patient Details');location='profile.php' </script>";die(); 
}
}
?>