<?php
include './showErrors.php';
session_start();
include './connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$dr_id = "";
$hos_id = "";
$payment_string= "";
$payment_int=0;
$date = "";
$ap_no=0;
$userid="";
$pid="";
$patient_sts="true";
$doctor_sts="true";

if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}

if ($userid === "") {
    echo "<script> alert('Unauthorized Access Detected');location='login.php' </script>";
    die();
} else {
if(isset($_POST['dr_id'])){$dr_id=$_POST['dr_id'];}
if(isset($_POST['hos_id'])){$hos_id=$_POST['hos_id'];}
if(isset($_POST['t_pay'])){$payment_string=$_POST['t_pay'];}
if(isset($_POST['date'])){$date=$_POST['date'];}
if(isset($_POST['ap_no'])){$ap_no=$_POST['ap_no'];}

$payment_int=preg_replace('/\D/', '', $payment_string);


//echo $dr_id;
//echo $hos_id;
//echo $payment_int;
//echo $date;
//echo $userid;
//echo $patient_sts;
//echo $doctor_sts;
//echo $ap_no;


$selectpatientIDQuery="select * from patients where pa_nic='".$userid."'";
 $resultpid = $connection->query($selectpatientIDQuery);
    if ($rowpid = $resultpid->fetch_assoc()) {
        $pid = $rowpid['id_patients'];
    }


    
    $insertQuery = "INSERT INTO `appointment`(`ap_no`,`date`,`payment`,`doctors_id`,`patients_id`,`hospitals_id`,`patient_sts`,`doctor_sts`)VALUES('" . $ap_no . "','" . $date . "','" . $payment_int . "','" . $dr_id . "','" . $pid . "','" . $hos_id . "','".$patient_sts."','".$doctor_sts."')";
    $isSaved = mysqli_query($connection, $insertQuery);


    if ($isSaved) {
        echo "<script> alert('Appointment Recorded Successfully');location='home.php' </script>";
        die();
    }else{
         echo "<script> alert('Appointment Recording Failed');location='home.php' </script>";
        die();
    }


}
?>