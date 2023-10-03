<?php
include './showErrors.php';
include './connection.php';
 $keyword="";
if (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
} 
$sts="";
$id="";
$notation=0;
if(isset($_GET["sts"])){ $sts=$_GET["sts"];$notation=1;}
if(isset($_GET["id"])){ $id=$_GET["id"];}

if($notation == 1){
    $upquery="update appointment set patient_sts='".$sts."',doctor_sts='".$sts."' where id='".$id."'";
    $result=$connection->query($upquery);
    
if($result==TRUE){
    echo "<script> alert('Appointment Detail Cancelled');location='appointment.php' </script>";die();
}else{
      echo "<script> alert('Appointment Detail Cancelling Failed');location='appointment.php' </script>";die(); 
}

}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="appointment.css"/>
        <link  rel="shortcut icon" href="images/logo.png"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <title>Appointment</title>
    </head>
    <body>
        <div class="box-outer">
            <div class="box-inner">
                <div class="right">
                    <div class="righttop">
                        <form method="get" action="appointment.php" class="form-2">
                            <input type="date" name="keyword" class="user-input-field2" />
                            <input type="submit" value="Search" name="search" class="act_buttons-4"/>
                        </form>
                    </div>
                        <br/>
                        <br/>
                    <div class="rightbottom">
                        <table class="tb-user" id="tb-user">
                            <tr>
                                <th>ID</th><th>Ap. Number</th><th>Date</th><th>Payment</th><th>Doctor</th><th>Patient</th><th>Hospital</th><th>Cancel Appointment</th>  
                            </tr>
                            <?php
                            $d_sts="true";
                            $p_sts="true";
                            //search admin details by thier job role
                            $querys = "SELECT * FROM appointment join hospitals on appointment.hospitals_id=hospitals.id_hospital join doctors on doctors.id_doctors=appointment.doctors_id  join patients on appointment.patients_id=patients.id_patients WHERE `date` LIKE '%" . $keyword . "%' AND doctor_sts='".$d_sts."' AND patient_sts='".$p_sts."'";
                            $results = $connection->query($querys);
                            while ($row = $results->fetch_assoc()) {
                                ?>
                                <tr class="data-row">
                                    <td><?php echo $row["id"]; ?></td>
                                    <td><?php echo $row["ap_no"]; ?></td>
                                    <td><?php echo $row["date"]; ?></td>
                                    <td><?php echo $row["payment"]; ?></td>
                                    <td><?php echo $row["dr_name"]; ?></td>
                                    <td><?php echo $row["pa_name"]; ?></td>
                                    <td><?php echo $row["hos_name"]; ?></td>
                                    <td>
                                        <form method="get" action="appointment.php">
                                            <input type="hidden" value="false" name="sts">
                                            <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                                            <input type="submit" value="Cancel" class="comp-btn">
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            //end of table data loading and searching
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="appointment.js"></script>
    </body>
</html>
