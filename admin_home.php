<?php
include './showErrors.php';
session_start();
include './connection.php';


$islogin = false;
$doc_id="";
$hos_id="";

if (isset($_SESSION["is_admin_login"])) {
    $islogin = $_SESSION["is_admin_login"];
}
if ($islogin) {


?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="admin_home.css"/>
        <link  rel="shortcut icon" href="images/logo.png"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <title>Control Panel</title>
    </head>
    <body>
        <div class='box-outer'>
            <div class="div-top">
                <div class="topic-div">
                <h1 class="header1">Control Panel</h1>
                </div>
                <div class="logout-div">
                <a href="logout.php"><button class="logout">Logout</button></a>
                </div>
            </div>
            <div class='div-bottom' id="divbtm" >
                <div class='bottom-left'></div>
                <div class='bottom-right'>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <h3 class="h3head">Overall Doctor Rate</h3>
                    <div class="progress_sections0">
                        <?php
                        $t_docs="";
                            $searchAllDocs = "SELECT COUNT(id_doctors) FROM doctors";
                            $resultAllDocs = $connection->query($searchAllDocs);
                            if ($rowAllDocs = $resultAllDocs->fetch_assoc()) {
                                $t_docs = $rowAllDocs["COUNT(id_doctors)"];
                            }
                            
                            $searchDocsinHospital = "SELECT * FROM hospitals";
                            $resultDocsInHospital = $connection->query($searchDocsinHospital);
                            while ($rowDocsInHospital = $resultDocsInHospital->fetch_assoc()) {
                                $doc_count = $rowDocsInHospital["total_doctors"];
                                $calculation = ($doc_count / $t_docs) * 100;
                                ?>
                                <div class="container">
                                    <!--<div class="picture"><img src="<?php // echo $rowDocsInHospital["hos_dp"]; ?>" class="dp-img"/></div>&nbsp;&nbsp;&nbsp;-->
                                <!--<div class="progress" max="10" value="<?php // $val = "2"; echo $val;    ?>"></div>-->
                                    <div class="container-div">
                                        <div style="
                                             width: <?php echo $calculation; ?>%;
                                             height: 11px;
                                             background-color: <?php echo $rowDocsInHospital["hos_color"]; ?>;
                                             border-top-right-radius: 10px;
                                             border-bottom-right-radius: 10px;
                                             position: absolute;
                                             z-index: 2;
                                             transition: 0.5s;
                                             "></div>
                                        <div class="status-bar-text">
                                            <h6 class="val3"><?php echo $rowDocsInHospital["hos_name"]." Hospital"; ?>&nbsp;&nbsp;(&nbsp;<?php echo $doc_count; ?>&nbsp;&nbsp;Doctors)</h6>
                                            <h5 class="val"><?php echo round($calculation); ?>%</h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        
                        ?>
                    </div>
                    <br/>
                    <div class="buttons">
                       <a href="admin.php" class="anchor"><button class="btn1">Admin</button></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="doctor.php" class="anchor"><button class="btn1">Doctors</button></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="patient.php" class="anchor"><button class="btn1">patients</button></a>
                        <br/>
                        <a href="hospital.php" class="anchor"> <button class="btn1">Hospitals</button></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="anchor"><button class="btn1">Appointments</button></a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="logout.php" class="anchor"><button class="btn1">Logout</button></a>
                    </div>
                    <br/>
                </div>
            </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <?php
        include './footer.php';
        ?>
        <script type="text/javascript" src="admin_home.js"></script>
    </body>
</html>
<?php
}else{
    echo "<script> alert('Unauthorized Access Detected');location='login.php' </script>";
    die();
}
?>