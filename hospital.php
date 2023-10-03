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
        <link type="text/css" rel="stylesheet" href="hospital.css"/>
        <link  rel="shortcut icon" href="images/logo.png"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
        <title>Hospital</title>
    </head>
    <body>
        <div class="box-outer">
            <div class="box-inner">
                <div class="left">
                    <form method="post"  action="doHospital.php" class="form-1">
                        <div class="form-top">
                            <input type="text" name="id" class="user-input-field" placeholder="ID Number" autocomplete="off" id="id-1" readonly/>      <!--id field-->
                            <input type="text" name="name" class="user-input-field" placeholder="Hospital Name"  autocomplete="off" id="name" required/>   <!--designation field-->
                            <input type="text" name="address" class="user-input-field" placeholder="Hospital Address"  autocomplete="off" id="address" required/>   <!--password field-->
                            <input type="text" name="contact" class="user-input-field" placeholder="Contact Number"  autocomplete="off" id="contact" required/>   <!--password field-->
                            <input type="text" name="color" class="user-input-field" placeholder="Color Code"  autocomplete="off" id="color" required/> 
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
                        <form method="get" action="hospital.php" class="form-2">
                            <input type="text" name="keyword" class="user-input-field2" placeholder="Enter Hospital Name"/>
                            <input type="submit" value="Search" name="search" class="act_buttons-4"/>
                        </form>
                    </div>
                    <br/>
                    <div class="rightbottom">
                        <table class="tb-user" id="tb-user">
                            <tr>
                                <th>ID</th><th>Name</th><th>Address</th><th>Contact</th><th>Color Code</th>
                            </tr>
                            <?php
                            //search admin details by thier job role
                            $querys = "SELECT * FROM `hospitals` WHERE `hos_name` LIKE '%" . $keyword . "%'";
                            $results = $connection->query($querys);
                            while ($row = $results->fetch_assoc()) {
                                ?>
                                <tr class="data-row">
                                    <td><?php echo $row["id_hospital"]; ?></td>
                                    <td><?php echo $row["hos_name"]; ?></td>
                                    <td><?php echo $row["address"]; ?></td>
                                    <td><?php echo $row["hos_contact"]; ?></td>
                                    <td><?php echo $row["hos_color"]; ?></td>
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
        <script type="text/javascript" src="hospital.js"></script>
    </body>
</html>
