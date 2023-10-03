__<?php
include './showErrors.php';
session_start();
include './connection.php';

$doctor_id = "";
$hos_id = "";
$userid = ""; //patient nic
$date = "";
$doctor_name = "";
$hospital_name = "";
$p_nic = "";
$patient_name = "";
$p_contact = "";
$ap_count = "";
$ap_no_count = 0;
$dr_pic = "";

if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}

if ($userid === "") {
    echo "<script> alert('Unauthorized Access Detected');location='login.php' </script>";
    die();
} else {

    if (isset($_POST['doctor'])) {
        $doctor_id = $_POST['doctor'];
    }
    if (isset($_POST['hospital'])) {
        $hos_id = $_POST['hospital'];
    }
    if (isset($_POST['date'])) {
        $date = $_POST['date'];
    }



    $selecctApCountQuery = "select COUNT(appointment.id),COUNT(appointment.ap_no) from appointment join doctors on appointment.doctors_id=doctors.id_doctors join hospitals on appointment.hospitals_id=hospitals.id_hospital where appointment.date='" . $date . "' AND appointment.hospitals_id='" . $hos_id . "' AND appointment.doctors_id='" . $doctor_id . "'";
    $resultAp = $connection->query($selecctApCountQuery);
    if ($rowAp = $resultAp->fetch_assoc()) {
        $ap_count = $rowAp['COUNT(appointment.id)'];
        $ap_no_count = $rowAp['COUNT(appointment.ap_no)'];
    }

    if ($ap_no_count == 0) {

        $selectDoctorQuery = "select * from doctors where id_doctors='" . $doctor_id . "' AND hospital_id='" . $hos_id . "'";
        $resultdr2 = $connection->query($selectDoctorQuery);
        if ($rowdr2 = $resultdr2->fetch_assoc()) {
            $doctor_name = $rowdr2['dr_name'];
            $dr_pic = $rowdr2['dr_pro_pic'];
        }
        $selectHosQuery = "select * from hospitals where  id_hospital='" . $hos_id . "'";
        $resultHos = $connection->query($selectHosQuery);
        if ($rowHos = $resultHos->fetch_assoc()) {
            $hospital_name = $rowHos['hos_name'];
        }

        $searchPatientQuery = "SELECT * FROM patients WHERE pa_nic='" . $userid . "'";

        $resultpa2 = $connection->query($searchPatientQuery);
        if ($rowpa2 = $resultpa2->fetch_assoc()) {
            $p_nic = $rowpa2['pa_nic'];
            $patient_name = $rowpa2['pa_name'];
            $p_contact = $rowpa2['pa_contact'];
        }
    } else {
        $pid = "";
        $searchPatientQuery = "SELECT * FROM patients WHERE pa_nic='" . $userid . "'";

        $resultpa2 = $connection->query($searchPatientQuery);
        if ($rowpa2 = $resultpa2->fetch_assoc()) {
            $pid = $rowpa2['id_patients'];
            $p_nic = $rowpa2['pa_nic'];
            $patient_name = $rowpa2['pa_name'];
            $p_contact = $rowpa2['pa_contact'];
        }

        $selecctApCountQuery2 = "select dr_name,dr_pro_pic,hos_name,COUNT(appointment.ap_no) from appointment join doctors on appointment.doctors_id=doctors.id_doctors join hospitals on appointment.hospitals_id=hospitals.id_hospital where  appointment.date='".$date."' AND appointment.hospitals_id='" . $hos_id . "' AND appointment.doctors_id='" . $doctor_id . "'";
        $resultAp2 = $connection->query($selecctApCountQuery2);
        if ($rowAp3 = $resultAp2->fetch_assoc()) {
            $ap_no_count = $rowAp3['COUNT(appointment.ap_no)'];
            $doctor_name = $rowAp3['dr_name'];
            $dr_pic = $rowAp3['dr_pro_pic'];
            $hospital_name = $rowAp3['hos_name'];
        }
    }
    ?>

    <html>
        <head>
            <meta charset="UTF-8">
            <title>OPD Channelling</title>
            <link type="text/css" rel="stylesheet" href="channel.css"/>
            <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
            <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@500;600&family=Ranchers&display=swap" rel="stylesheet">
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="shortcut icon" href="images/logo.png"/>
        </head>
        <body>
            <div class="box-outer-div">
                <?php
                include './navBar.php';
                ?>
                <div class="topper-inner-div">
                    <div class="inner-div">
                        <div class="doc_div">
                            <br/>
                            <br/>
                            <br/>
                            <img src="<?php echo $dr_pic; ?>" width="150vh" height="150vh" class="dr_img"/>
                            <br/>
                            <br/>
                            <label class="title-cha-aligned"><img src="images/stethoscope.png" width="20vh" height="20vh"/>&nbsp;&nbsp;Dr. <?php echo $doctor_name; ?></label>
                            <br/>
                            <label class="title-cha-aligned"><img src="images/red cross.png" width="20vh" height="20vh"/>&nbsp;&nbsp;<?php echo $hospital_name; ?> Hospital</label>
                            <br/>
                            <br/>
                            <br/>
                            <label class="title-cha-aligned-ap"><?php echo $ap_count; ?> Appointments</label>

                        </div>
                        <form method="post" action="doChannel.php" class="detail-fill-up">
                            <div class="div-set-1">
                                <label class="title-cha-aligned-mini">OPD Doctor Information</label>
                                <div class="title-div">
                                    <input type="text"  class="user-input-field" placeholder="Doctor name"  value="<?php echo $doctor_name; ?>"  required readonly /> <!-- nic entering input-->&nbsp;
                                    <input type="text" class="combo-11" placeholder="Hospital Name"  value="<?php echo $hospital_name ?>" required readonly/><!--contact entering-->
                                </div>
                            </div>
                            <div class="div-set-1">
                                <label class="title-cha-aligned-mini">Patient Information</label>
                                <div class="title-div">
                                    <input type="text" class="combo-12" placeholder="Patient NIC Number"  value="<?php echo $p_nic; ?>"  required readonly/><!--name entering-->&nbsp;&nbsp;
                                    <input type="text"  class="combo-12" placeholder="Patient Contact Number"  value="<?php echo $p_contact; ?>"  required/><!--contact entering-->
                                </div>
                                <input type="text"  class="user-input-field2" placeholder="Patient Name" value="<?php echo $patient_name; ?>" required  /> <!-- nic entering input-->&nbsp;
                            </div>
                            <br/>
                            <div class="div-set-1">
                                <label class="title-cha-aligned-mini">Payment Information</label>
                                <div class="title-div">
                                    <input type="text" class="combo-12" placeholder="OPD Doctor Fees" value="Rs. <?php $payment = 1500;
            echo $payment; ?> (Doctor Fees)" required readonly /><!--OPD fees entering-->&nbsp;&nbsp;
                                    <input type="text"  class="combo-12" placeholder="Channelling Fees" value="Rs. <?php $payment_ABC = 500;
            echo $payment_ABC; ?> (Channelling fees)"   required readonly/><!--channelling entering-->
                                </div>
                                <input type="text" name="t_pay" class="combo-12" placeholder="Total Payment" value="Rs. <?php $total = $payment + $payment_ABC;
            echo $total; ?> (Total Fee)"   required readonly/><!--OPD fees entering-->&nbsp;&nbsp;
                            </div>
                            <br/>
                            <br/>
                            <div class="div-set-buttons">
                                <input type="hidden" value="<?php echo $doctor_id; ?>" name="dr_id"/>
                                <input type="hidden" value="<?php echo $hos_id; ?>" name="hos_id"/>
                                <input type="hidden" value="<?php echo $date; ?>" name="date"/>
                                <input type="hidden" value="<?php $ap_no_count2 = $ap_no_count + 1;
            echo $ap_no_count2; ?>" name="ap_no"/>
                                <input type="submit" value="Channel" class="comp-btn-channel"/>&nbsp;&nbsp;&nbsp;

                                <input type="button" value="Cancel" class="comp-btn-cancel" onclick="location.href = 'home.php';"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </html>

    <?php
}
?>