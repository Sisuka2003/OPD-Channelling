<?php
include './showErrors.php';
session_start();
include './connection.php';

$userid = "";
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
}

if ($userid === "") {
    echo "<script> alert('Unauthorized Access Detected');location='login.php' </script>";
    die();
}else{

$hos_id="";
$spec_id="";
$dr_id="";
$dr_name="";
$start_time="";
$end_time="";
$access="";
$valid=false;
$date="";
    
if(isset($_GET['hospital'])){$hos_id=$_GET['hospital'];}
if(isset($_GET['spec'])){$spec_id=$_GET['spec'];}
if(isset($_GET['access'])){$access=$_GET['access'];}
if(isset($_GET['date'])){$date=$_GET['date'];}


if($access == "okk"){
    
if($hos_id===''){ echo "<script> alert('Unknown Error Occured.Hospital Cannot Not Be Found');location='home.php' </script>";die();}
if($spec_id===''){ echo "<script> alert('Unknown Error Occured.Undefined specialization');location='home.php' </script>";die();}
$sts="true";
$selectDoctorQuery = "SELECT * FROM doctors  join hospitals on doctors.hospital_id=hospitals.id_hospital join specialization on doctors.Specialization_id=specialization.id_spec where hospitals.id_hospital='".$hos_id."' AND specialization.id_spec='".$spec_id."' AND dr_status='".$sts."' ";
$result = $connection->query($selectDoctorQuery);
$valid=true;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>OPD Channelling</title>
        <link type="text/css" rel="stylesheet" href="home.css"/>
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
            <div class="box-inner-div">
                <div class="ap-searcher">
                    <form method="get" action="home.php" class="form-searcher">
                        <h2 class="title-cha">Channel OPD Section</h2>
                        <br/>
                        <br/>
                        <br/>
                        <div class="left">
                        <h5 class="title-cha-aligned">Select Hospital & Specialization</h5>
                        </div>
                        
                        <div class="hospital-div">
                                    <!--hospital selection-->
                                <select name="hospital" class="combo-1" required>
                                    <option value="" disabled selected >Select Hospital</option>
                                    <?php
                                    $query = "SELECT * FROM `hospitals`";
                                    $resultd = $connection->query($query);

                                    while ($row = $resultd->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row['id_hospital']; ?>"><?php echo $row['hos_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                    </div>
                                
                        <div class="spec-div">
                                <!--Specialization selection-->
                                <select name="spec" class="combo-1" required>
                                    <option value="" disabled selected >Select Specialization</option>
                                    <?php
                                    $query = "SELECT * FROM `specialization`";
                                    $resultd = $connection->query($query);

                                    while ($row = $resultd->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row['id_spec']; ?>"><?php echo $row['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                        </div>
                        
                        <br/>
                        <br/>
                        
                         <div class="left">
                        <h5 class="title-cha-aligned">Select Channelling Date</h5>
                        </div>
                        <div class="spec-div">
                                <!--date selection-->
                                <input type="date" name="date" class="combo-1" required/>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <input type="hidden" value="okk" name="access"/>
                        <input type="submit" value="Search Channel" class="comp-btn" />
                    </form>
                </div>
                <div class="ap-resulter">
                    <div class="resulter-section">
                        <?php
                        if($valid){
                        if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dr_name=$row['dr_name'];
        $dr_id=$row['id_doctors'];
        $hos_id=$row['hospital_id'];
        $start_time=$row['start_time'];
        $end_time=$row['end_time'];
                        ?>
                          <div class="ap-record">
                            <div class="p-name">
                                <h5>Dr. <?php echo $dr_name;?></h5>
                            </div>
                            <div class="ap-date">
                                <h5><?php echo $date;?></h5>
                            </div>
                            <div class="ap-time">
                                  <h5><?php echo $start_time;?></h5>&nbsp;
                                  <h5>-</h5>&nbsp;
                                  <h5><?php echo $end_time;?></h5>
                            </div>
                            <div class="ap-sts">
                                <form method="post" action="channel.php" class="comp-fm">
                                    <input type="hidden" value="<?php echo $dr_id;?>" name="doctor"/>
                                    <input type="hidden" value="<?php echo $hos_id;?>" name="hospital"/>
                                    <input type="hidden" value="<?php echo $date;?>" name="date"/>
                                    <input type="submit" value="Channel" class="comp-btn-channel"/>
                                </form>
                            </div>
                        </div>
                        <br/>
                        <?php
                        }}else{
                            echo "<script> alert('No OPD Doctors Available');location='home.php' </script>";die();
                        }}else{
                        ?>
                        
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>