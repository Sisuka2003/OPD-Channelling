<?php
include './showErrors.php';
include './connection.php';
 $keyword="";
if (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
} else {
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="doctor.css"/>
        <link  rel="shortcut icon" href="images/logo.png"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <title>Doctor</title>
    </head>
    <body>
        <div class="box-outer">
            <div class="box-inner">
                <div class="left">
                    <form method="post"  action="doDoctor.php" class="form-1">
                        <div class="form-top">
                            <input type="text" name="id" class="user-input-field" placeholder="ID Number" autocomplete="off" id="id-1" readonly/>      <!--id field-->
                            <input type="text" name="nic" class="user-input-field" placeholder="NIC Number"  autocomplete="off" id="nic" required/>   <!--designation field-->
                            <input type="text" name="fname" class="user-input-field" placeholder="Full Name"  autocomplete="off" id="fname" required/>   <!--password field-->
                            <input type="text" name="contact" class="user-input-field" placeholder="Contact Number"  autocomplete="off" id="contact" required/>   <!--password field-->
                            <input type="text" name="pswd" class="user-input-field" placeholder="Password"  autocomplete="off" id="pswd" required/> 
                            <select name="hospital" class="user-input-field">
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
                             <select name="spec" class="user-input-field">
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
                        <div class="button-group">
                            <input type="submit" value="Insert" name="insert" class="act_buttons-1"/>
                            <input type="submit" value="Update" name="update"class="act_buttons-2"/>
                            <input type="submit" value="Delete" name="delete"class="act_buttons-3"/>
                        </div>
                    </form>
                </div>
                <div class="right">
                    <div class="righttop">
                        <form method="get" action="doctor.php" class="form-2">
                            <input type="text" name="keyword" class="user-input-field2" placeholder="Enter NIC Number"/>
                            <input type="submit" value="Search" name="search" class="act_buttons-4"/>
                        </form>
                    </div>
                        <br/>
                        <br/>
                    <div class="rightbottom">
                        <table class="tb-user" id="tb-user">
                            <tr>
                                <th>ID</th><th>NIC</th><th>Name</th><th>Contact</th><th>Password</th><th>Hospital</th><th>Specialization</th>  
                            </tr>
                            <?php
                            //search admin details by thier job role
                            $querys = "SELECT * FROM `doctors` join hospitals on doctors.hospital_id=hospitals.id_hospital join specialization on doctors.specialization_id=specialization.id_spec WHERE `dr_nic` LIKE '%" . $keyword . "%'";
                            $results = $connection->query($querys);
                            while ($row = $results->fetch_assoc()) {
                                ?>
                                <tr class="data-row">
                                    <td><?php echo $row["id_doctors"]; ?></td>
                                    <td><?php echo $row["dr_nic"]; ?></td>
                                    <td><?php echo $row["dr_name"]; ?></td>
                                    <td><?php echo $row["dr_contact"]; ?></td>
                                    <td><?php echo $row["dr_password"]; ?></td>
                                    <td><?php echo $row["hos_name"]; ?></td>
                                    <td><?php echo $row["name"]; ?></td>
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
        <script type="text/javascript" src="doctor.js"></script>
    </body>
</html>
