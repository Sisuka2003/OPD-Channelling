<?php
include './showErrors.php';
include './connection.php';
$keyword = "";
if (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
} else {
    
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="patient.css"/>
        <link  rel="shortcut icon" href="images/logo.png"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <title>Patients</title>
    </head>
    <body>
        <div class="box-outer">
            <div class="box-inner">
                <div class="left">
                    <form method="post"  action="doPatient.php" class="form-1">
                        <div class="form-top">
                            <input type="text" name="id" class="user-input-field" placeholder="ID Number" autocomplete="off" id="id-1" readonly/>      <!--id field-->
                            <input type="text" name="nic" class="user-input-field" placeholder="NIC Number"  autocomplete="off" id="nic" required/>   <!--designation field-->
                            <input type="text" name="fname" class="user-input-field" placeholder="Full Name"  autocomplete="off" id="fname" required/>   <!--password field-->
                            <input type="text" name="contact" class="user-input-field" placeholder="Contact Number"  autocomplete="off" id="contact" required/>   <!--password field-->
                            <input type="text" name="pswd" class="user-input-field" placeholder="Password"  autocomplete="off" id="pswd" required/> 
                        </div>
                        <br/>
                        <div class="button-group">
                            <input type="submit" value="Insert" name="insert" class="act_buttons-1"/>
                            <input type="submit" value="Update" name="update"class="act_buttons-2"/>
                            <input type="submit" value="Delete" name="delete"class="act_buttons-3"/>
                        </div>
                    </form>
                </div>
                <div class="right">
                    <div class="righttop">
                        <form method="get" action="patient.php" class="form-2">
                            <input type="text" name="keyword" class="user-input-field2" placeholder="Enter NIC number"/>
                            <input type="submit" value="Search" name="search" class="act_buttons-4"/>
                        </form>
                    </div>
                    <br/>
                    <div class="rightbottom">
                        <table class="tb-user" id="tb-user">
                            <tr>
                                <th>ID</th><th>NIC</th><th>Name</th><th>Contact</th><th>Password</th>
                            </tr>
                            <?php
                            //search admin details by thier job role
                            $querys = "SELECT * FROM `patients` WHERE `pa_nic` LIKE '%" . $keyword . "%'";
                            $results = $connection->query($querys);
                            while ($row = $results->fetch_assoc()) {
                                ?>
                                <tr class="data-row">
                                    <td><?php echo $row["id_patients"]; ?></td>
                                    <td><?php echo $row["pa_nic"]; ?></td>
                                    <td><?php echo $row["pa_name"]; ?></td>
                                    <td><?php echo $row["pa_contact"]; ?></td>
                                    <td><?php echo $row["password"]; ?></td>
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
        <script type="text/javascript" src="patient.js"></script>
    </body>
</html>
