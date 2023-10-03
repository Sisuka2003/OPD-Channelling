<?php  
include './showErrors.php';
$username="root";
$password="20030909";
$databaseName="opd_channelling";
$hostUrl="localhost";
$hostPort="3307";
$connection=new mysqli($hostUrl, $username,$password,$databaseName,$hostPort);
if($connection->connect_error){
    echo "Error Not connected".$connection->connect_error;
}else{
   //echo "connect successfully";
}
?>