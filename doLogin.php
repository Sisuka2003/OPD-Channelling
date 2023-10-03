<?php
include './showErrors.php';
session_start();
if (isset($_SESSION["is_login"])) {
    if (($_SESSION["is_login"] == true)) {  
        header("Location: home.php");die(); 
    }
} else {
    include './connection.php';
    $pw = "";
    $pass="";
    if (isset($_POST["pswd"])) {
        $pw = $_POST["pswd"];
       
    $_SESSION["vid"]=$pw;
        $searchAdminQuery="select * from `admin` where `ar_password`='".$pw."'";
        
           $result = $connection->query($searchAdminQuery);
            if ($row = $result->fetch_assoc()) {
                $pass=$row['ar_password'];
            }
        if ($pw==$pass) {
            $_SESSION["is_admin_login"] = true;
            header("Location:  admin_home.php");
            exit();
        } else {

            $searchQuery = "SELECT * FROM `doctors` WHERE `dr_password`='".$pw."'";

            $result = $connection->query($searchQuery);
            if ($row = $result->fetch_assoc()) {
                $_SESSION["is_login"] = true;    
                $_SESSION["userid"]=$row['dr_nic'];
                $_SESSION["titlename"] = "dr";
                echo "<script> alert('Welcome To OPD Channelling !!!');location='profile.php' </script>";
                exit();
            } else{
             
             $searchQuery2 = "SELECT * FROM `patients` WHERE `password`='".$pw."'";

            $result2 = $connection->query($searchQuery2);
            if ($row2 = $result2->fetch_assoc()) {
                $_SESSION["is_login"] = true;    
                $_SESSION["userid"]=$row2['pa_nic'];
                $_SESSION["titlename"] = "not_dr";
                echo "<script> alert('Welcome To OPD Channelling !!!');location='profile.php' </script>";
                exit();
                }else{
                    echo "<script> alert('Please check your Registration');location='register.php' </script>";
                }
                }
            }
        }
    }
?>