<?php

include './showErrors.php';
session_start();
include './connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nic = "";
$contact = "";
$title = "";
$fname = "";
$password = "";
$hospital = "";
$spec = "";
if (isset($_POST['nic']) && isset($_POST['contact']) && isset($_POST['title']) && isset($_POST['fname']) && isset($_POST['password'])) {
    $nic = $_POST['nic'];
    $contact = $_POST['contact'];
    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $password = $_POST['password'];
}
if (isset($_POST['hospital']) && isset($_POST['spec'])) {
    $hospital = $_POST['hospital'];
    $spec = $_POST['spec'];
}

//checking for the title Dr./ Mr./ Mrs./ Ms.

if ($title == "dr") {

    // checking nic validity of patient
    $selectExistingQuery = "select * from doctors where dr_nic='" . $nic . "'";
    $resultExist = $connection->query($selectExistingQuery);
    if ($rowExis = $resultExist->fetch_assoc()) {

        echo "<script> alert('The NIC number Already Exists');location='register.php' </script>";
    } else {

        //checking the password validity of doctor
        $selectExistingQuery2 = "select * from doctors where dr_password='" . $password . "'";
        $resultExist2 = $connection->query($selectExistingQuery2);

        if ($rowExis2 = $resultExist2->fetch_assoc()) {
            echo "<script> alert('Password Already Exists');location='register.php' </script>";
        } else {

            $dr_status="false";
            //inserting the doctor
            $hquery = "INSERT INTO `doctors`(`dr_nic`,`dr_name`,`dr_contact`,`dr_password`,`dr_pro_pic`,`hospital_id`,`specialization_id`,`dr_status`)VALUES('" . $nic . "','" . $fname . "','" . $contact . "','" . $password . "','images/doctor_pro.png','" . $hospital . "','" . $spec . "','".$dr_status."')";

            $isSaved = mysqli_query($connection, $hquery);
            if ($isSaved) {
                $_SESSION["name"] = $fname;
                $_SESSION["is_login"] = true;
                $_SESSION["userid"] = $nic;
                $_SESSION["titlename"] = $title;

                $exis_count = 0;
                $selectExistingQuery2 = "select * from hospitals where id_hospital='" . $hospital . "'";
                $resultExist2 = $connection->query($selectExistingQuery2);
                if ($rowExis2 = $resultExist2->fetch_assoc()) {
                    $exis_count = $rowExis2["total_doctors"];
                }

                $new_dr_count = $exis_count + 1;
                $update = "UPDATE hospitals SET total_doctors='" . $new_dr_count . "' WHERE id_hospital='" . $hospital . "'";
                $result = $connection->query($update);

                if ($result == TRUE) {
                echo "<script> alert('Doctor Registered Successfully!!');location='profile.php' </script>";   // directing to profile page
                    die();
                } else {
                  echo "<script> alert('Error occured : Please Get Registered Again');location='register.php' </script>";  // directing to register page again
                    die();
                }
            } else {

                echo "<script> alert('Error occured : Please Get Registered Again');location='register.php' </script>";  // directing to register page again
            }
        }
    }
} else {
    // checking nic validity of patient
    $selectExistingQuery = "select * from patients where pa_nic='" . $nic . "'";
    $resultExist = $connection->query($selectExistingQuery);
    if ($rowExis = $resultExist->fetch_assoc()) {
        echo "<script> alert('The NIC number Already Exists');location='register.php' </script>";
    } else {
        //checking the password validity 
        $selectExistingQuery2 = "select * from patients where password='" . $password . "'";
        $resultExist2 = $connection->query($selectExistingQuery2);

        if ($rowExis2 = $resultExist2->fetch_assoc()) {
            echo "<script> alert('Password Already Exists');location='register.php' </script>";
        } else {
            //inserting the patient
            $hquery = "INSERT INTO `patients`(`pa_nic`,`pa_name`,`pa_contact`,`profile_pic`,`password`)VALUES('" . $nic . "','" . $fname . "','" . $contact . "','images/user.png','" . $password . "')";

            $isSaved = mysqli_query($connection, $hquery);
            if ($isSaved) {
                $_SESSION["name"] = $fname;
                $_SESSION["is_login"] = true;
                $_SESSION["userid"] = $nic;
                $_SESSION["titlename"] = $title;
                echo "<script> alert('Patient Registered Successfully!!');location='profile.php' </script>";    // directing to profile page
            } else {
                echo "<script> alert('Error occured : Please Get Registered Again');location='register.php' </script>";  //directing back to register page
            }
        }
    }
}
?>

