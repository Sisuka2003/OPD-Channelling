<?php
include './showErrors.php';
session_start();
include './connection.php';
$userid = "";
$fname = "";
$nic= "";
$contact = "";
$password= "";
$img = "";
$hospital="";
$specialization="";
$title="";
$fromtime="";
$toTime="";
$pid="";
$patient_sts="";
$doctor_sts="";
$ap_number="";

if(isset($_GET['doctor_click'])){$doctor_sts=$_GET['doctor_click'];}
if(isset($_GET['patient_click'])){$patient_sts=$_GET['patient_click'];}
if(isset($_GET['ap_no'])){$ap_number=$_GET['ap_no'];}


if($patient_sts){
    $p_sts="false";
$updateQuery = "UPDATE `appointment` SET `patient_sts`='".$p_sts."'WHERE `id`='".$ap_number."'";
$isSaved = mysqli_query($connection, $updateQuery);


if ($isSaved) {
      echo "<script> alert('Patient Updated successfully');location='profile.php' </script>";die();
}
}

if($doctor_sts){
       $d_sts="false";
$updateQuery = "UPDATE `appointment` SET `doctor_sts`='".$d_sts."' WHERE `id`='".$ap_number."'";
$isSaved = mysqli_query($connection, $updateQuery);


if ($isSaved) {
      echo "<script> alert('Doctor Appointment completed');location='profile.php' </script>";die();
}
}

if (isset($_SESSION["userid"]) && isset($_SESSION["titlename"])) {
    $userid = $_SESSION["userid"];
    $title=$_SESSION["titlename"];
}
if ($userid === '') {
    echo "<script> alert('Unauthorized Access Detected');location='login.php' </script>";
    die();
}
if ($title === '') {
    echo "<script> alert('Unauthorized Access Detected');location='login.php' </script>";
    die();
}

if($title == "dr"){

$select = "SELECT * FROM doctors  join hospitals on doctors.hospital_id=hospitals.id_hospital join specialization on doctors.Specialization_id=specialization.id_spec WHERE doctors.dr_nic='" . $userid . "'";
$result = $connection->query($select);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
$fname = $row['dr_name'];
$nic= $row['dr_nic'];
$contact = $row['dr_contact'];
$password = $row['dr_password'];
$hospital = $row['hos_name'];
$img = $row['dr_pro_pic'];
$specialization = $row['name'];
$fromtime=$row['start_time'];
$totime=$row['end_time'];
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
        <link type="text/css" rel="stylesheet" href="profile.css"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@500;600&family=Ranchers&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="shortcut icon" href="images/logo.png"/>
    </head>
    <body>
        <div class="box-outer-div" >

            <table class="nav-div" border="0">
                <tr>
                    <td class="logo"></td>
                    <td class="seperaor"></td>
                    <td class="directing-pages">
                   
                        <button class="move-btn" onclick="popupMenu2();"><img src="images/menu.png" width="37" height="37"/></button>
                        <ul class="nav-pages" id="nav-pages">
                            <div class="top-div-nav">
                                <img src="images/cancel.png" width="25" height="25" onclick="popoutMenu();">
                            </div>
                            <!--<li class="li1"><a href="#ap-div" class="anchor-tag">Appointments</a></li>-->
                            <li class="li1"><a href="about_us.php" class="anchor-tag">About Us</a></li>
                            <li class="li1"><a href="logout.php" class="anchor-tag">Log Out</a></li>
                        </ul> 
                    </td>
                </tr>
            </table>

            <div class="profile-outer-div" id="profile-outer-div">
                <div class="original-details-div">
                    <div class="dp">
                        <img src="<?php echo $img;?>" class="dp-img"/>
                    </div>
                    <br/>
                    <br/>
                    <p class="username"><?php echo $nic; ?></p>
                    <br/>
                    <p class="email"><?php echo $fname; ?></p>
                    <br/>
                    <br/>
                </div>
                <div class="details-seperator-div"></div>
                <div class="updating-details-div">
                    <form method="post" action="updateProfile.php" enctype="multipart/form-data" class="form-out2">
                     <div class="div-set-1">
                         <input type="text"  class="user-input-field" placeholder="NIC Number"   name="nic" required value="<?php echo $nic;?>" readonly/> <!-- nic entering input-->
                         <input type="text"  class="combo-11" placeholder="Contact" required name="contact" value="<?php echo $contact;?>" /> <!-- contact entering input-->
                            </div>
                            <div class="div-set-02">
                                <input type="text"  class="user-input-field2" placeholder="Full Name" name="name" value="<?php echo $fname;?>"required /> <!-- full name entering input-->
                            </div>
                            <div class="div-set-03">
                                <input type="text"  class="combo-1"  name="hospital" placeholder="Hospital" value="<?php echo $hospital;?>"   /><!-- hospital entering input-->
                                <input type="text" class="combo-12" name="specialization" placeholder="Specialization" value="<?php echo $specialization;?>"  /><!-- specialization entering input-->
                            </div>
                            <div class="div-set-04">
                                <input type="password" class="combo-1-large" name="pswd" placeholder="password" value="<?php echo $password;?>"   /><!-- Password entering input-->
                                <br/>
                                <br/>
                                <br/>
                                <h3 class="availability">Available TimeSlots</h3>
                                <?php
                                if($fromtime == ""){
                                ?>
                                <input type="text"  class="from" placeholder="From"   name="from" required/> <!-- from time entering input-->
                                <?php
                                }else{
                                ?>
                                <input type="text"  class="from" placeholder="From"   name="from"  value="<?php echo $fromtime;?>"/> <!-- from time entering input-->
                                <?php
                                }
                                ?>
                                <select name="periodfrom" class="amOpm">
                                    <option value="AM" selected>AM</option>
                                    <option value="PM">PM</option>
                                </select>
                                <?php
                                if($totime == ""){
                                ?>
                                    <input type="text"  class="to" placeholder="To"  name="to" required/> <!-- to time entering entering input-->
                                <?php
                                }else{
                                ?>
                                <input type="text"  class="to" name="to" value="<?php echo $totime;?>"/> <!-- to time entering entering input-->
                                <?php
                                }
                                ?>
                                 <select name="periodto" class="amOpm">
                                    <option value="AM" >AM</option>
                                    <option value="PM" selected>PM</option>
                                </select>
                                <br/>
                                <br/>
                                <br/>
                        <input type="file" name="img" id="file" hidden/>
                        <label class="lb-icon" for="file" >Upload Profile Picture</label>
                        <br/>
                        <br/>
                        <br/>
                        <input type="submit" value="Save" class="submit-button"/>
                        &nbsp;&nbsp;&nbsp;
                         <a href="#ap-div">
                        <input value="Manage Appointments" class="ap-button"/>
                        </a>
                            </div>
                        
                    </form>
                     <br/>
                    <br/>
                    <br/>
                    <div class="appointments-div" id="ap-div">
                         <?php
                         $ap_no="";
                         $pa_name="";
                         $date="";
                         $channel_stime="";
                         $channel_ftime="";
                         $drid="";
                         $doctor_sts="true";
                         
                          $selectpatientIDQuery="select * from doctors where dr_nic='".$nic."'";
                          $resultpid = $connection->query($selectpatientIDQuery);
                           if ($rowpid = $resultpid->fetch_assoc()) {
                             $drid = $rowpid['id_doctors'];
                              }

                         $selectAvApquery="select * from appointment join doctors on appointment.doctors_id=doctors.id_doctors join hospitals on appointment.hospitals_id=hospitals.id_hospital where appointment.doctors_id='" . $drid . "' AND appointment.doctor_sts='".$doctor_sts."'";
                          $resultapdet = $connection->query($selectAvApquery);
                           while ($rowapdet = $resultapdet->fetch_assoc()) {
                               $ap_id=$rowapdet['id'];
                             $ap_no = $rowapdet['ap_no'];
                             $pa_id = $rowapdet['patients_id'];
                             $date = $rowapdet['date'];
                             $channel_stime = $rowapdet['start_time'];
                             $channel_ftime = $rowapdet['end_time'];
                              
                             
                             $selectPaQuery="select * from patients where id_patients=$pa_id";  
                             $resultpadet = $connection->query($selectPaQuery);
                           if ($rowpadet = $resultpadet->fetch_assoc()) {
                               $pa_name=$rowpadet['pa_name'];
                           }
                         
                         ?>
                        <div class="ap-record">
                                  <div class="ap-num">
                                  <h5><?php echo $ap_no;?></h5>
                            </div>
                            <div class="p-name">
                                <h5>Mr. <?php echo $pa_name;?></h5>
                            </div>
                            <div class="ap-date">
                                <h5><?php echo $date;?></h5>
                            </div>
                            <div class="ap-time">
                                  <h5><?php echo $channel_stime;?></h5>&nbsp;
                                  <h5>-</h5>&nbsp;
                                  <h5><?php echo $channel_ftime;?></h5>
                            </div>
                            <div class="ap-sts">
                                <form method="get" action="profile.php" class="comp-fm">
                                    <input type="hidden" value="true" name="doctor_click"/>
                                    <input type="hidden" value="<?php echo $ap_id;?>" name="ap_no"/>
                                    
                                    <input type="submit" value="Completed" class="comp-btn"/>
                                </form>
                            </div>
                        </div>
                        <br/>
                        <?php
                           }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="profile.js"></script>
    </body>
</html>
<?php
}else{

$select = "SELECT * FROM patients WHERE pa_nic='" . $userid . "'";
$result = $connection->query($select);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
$fname = $row['pa_name'];
$nic= $row['pa_nic'];
$contact = $row['pa_contact'];
$password = $row['password'];
$img = $row['profile_pic'];
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
        <link type="text/css" rel="stylesheet" href="profile.css"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@500;600&family=Ranchers&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="shortcut icon" href="images/doctor.png"/>
    </head>
    <body>
        <div class="box-outer-div" >

            <table class="nav-div" border="0">
                <tr>
                    <td class="logo"></td>
                    <td class="seperaor"></td>
                    <td class="directing-pages">
                        
                        <button class="move-btn" onclick="popupMenu2();"><img src="images/menu.png" width="37" height="37"/></button>
                        <ul class="nav-pages" id="nav-pages">
                            <div class="top-div-nav">
                                <img src="images/cancel.png" width="25" height="25" onclick="popoutMenu();">
                            </div>
                            <li class="li1"><a href="home.php" class="anchor-tag">Channel</a></li>
                            <li class="li1"><a href="about_us.php" class="anchor-tag">About Us</a></li>
                            <li class="li1"><a href="logout.php" class="anchor-tag">Log Out</a></li>
                        </ul> 
                    </td>
                </tr>
            </table>

            <div class="profile-outer-div" id="profile-outer-div">
                <div class="original-details-div">
                    <div class="dp">
                        <img src="<?php echo $img;?>" class="dp-img"/>
                    </div>
                    <br/>
                    <br/>
                    <p class="username"><?php echo $nic; ?></p>
                    <br/>
                    <p class="email"><?php echo $fname; ?></p>
                    <br/>
                    <br/>
                </div>
                <div class="details-seperator-div"></div>
                <div class="updating-details-div" id="up-div">
                    <form method="post" action="updateProfile.php" enctype="multipart/form-data" class="form-out">
                     <div class="div-set-1">
                         <input type="text"  class="user-input-field" placeholder="NIC Number"   name="nic" required value="<?php echo $nic;?>" readonly/> <!-- nic entering input-->
                         <input type="text"  class="combo-11" placeholder="Contact Number" required name="contact" value="<?php echo $contact;?>" /> <!-- contact entering input-->
                            </div>
                            <div class="div-set-02">
                                <input type="text"  class="user-input-field2" placeholder="Full Name" name="name" value="<?php echo $fname;?>"required /> <!-- full name entering input-->
                            </div>
                            <div class="div-set-04">
                                <input type="password" class="combo-1-large"  name="pswd" placeholder="Password" value="<?php echo $password;?>"/><!-- password entering input-->
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                        <input type="file" name="img" id="file" hidden/>
                        <label class="lb-icon" for="file" >Upload Profile Picture</label>
                        <br/>
                        <br/>
                        <br/>
                        <input type="submit" value="Save" class="submit-button"/>
                        &nbsp;&nbsp;
                        <a href="#ap-div">
                        <input value="Manage Appointments" class="ap-button"/>
                        </a>
                            </div>
                        
                    </form>
                    <br/>
                    <br/>
                    <br/>
                     <div class="appointments-div" id="ap-div">
                         <?php
                         $ap_no="";
                         $dr_name="";
                         $date="";
                         $channel_stime="";
                         $channel_ftime="";
                         
                          $selectpatientIDQuery="select * from patients where pa_nic='".$userid."'";
                          $resultpid = $connection->query($selectpatientIDQuery);
                           if ($rowpid = $resultpid->fetch_assoc()) {
                             $pid = $rowpid['id_patients'];
                              }

                         $selectAvApquery="select * from appointment join doctors on appointment.doctors_id=doctors.id_doctors join hospitals on appointment.hospitals_id=hospitals.id_hospital where appointment.patients_id='" . $pid . "'";
                          $resultapdet = $connection->query($selectAvApquery);
                           while ($rowapdet = $resultapdet->fetch_assoc()) {
                             $ap_id = $rowapdet['id'];
                             $ap_no = $rowapdet['ap_no'];
                             $dr_name = $rowapdet['dr_name'];
                             $date = $rowapdet['date'];
                             $channel_stime = $rowapdet['start_time'];
                             $channel_ftime = $rowapdet['end_time'];
                              
                         
                         ?>
                        <div class="ap-record">
                            <div class="ap-num">
                                  <h5><?php echo $ap_no;?></h5>
                            </div>
                            <div class="p-name">
                                <h5>Dr. <?php echo $dr_name;?></h5>  <!--Dr. Name-->
                            </div>
                            <div class="ap-date">
                                <h5><?php echo $date;?></h5>   <!--Appointment Date-->
                            </div>
                            <div class="ap-time">
                                  <h5><?php echo $channel_stime?></h5>&nbsp;
                                  <h5>-</h5>&nbsp;
                                  <h5><?php echo $channel_ftime;?></h5>
                            </div>
                            <div class="ap-sts-pa">
                                <form method="get" action="profile.php" class="comp-fm">
                                    <input type="hidden" value="true" name="patient_click"/>
                                    <input type="hidden" value="<?php echo $ap_id;?>" name="ap_no"/>
                                    <input type="submit" value="Channel" class="comp-btn"/>
                                </form>
                            </div>
                        </div>
                         <br/>
                        <?php
                           }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="profile.js"></script>
    </body>
</html>
<?php } ?>

