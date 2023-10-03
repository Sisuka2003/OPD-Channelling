<?php
include './connection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>OPD Channelling</title>
        <link type="text/css" rel="stylesheet" href="register.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@500;600&family=Ranchers&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="images/logo.png"/>
    </head>
    <body>
        <div class="box-outer">
            <div class="box-inner-out">
                <div class="div-top">
                    <h1 class="header1">Register</h1>
                </div>
                <div class="midder-div">
                    <div class="div-left"></div>
                    <div class="div-right">
                        <form class="data-input-form" method="post"  action="doRegister.php">
                            <div class="div-set-1">
                                <input type="text"  class="user-input-field" placeholder="NIC Number"   name="nic" required /> <!-- nic entering input-->
                                <input type="text" name="contact" class="combo-11" placeholder="Contact" required/><!--contact entering-->
<!--                                <select name="gender"class="combo-11">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>-->
                            </div>
                            <div class="div-set-02">
                                <!--Select the title-->
                                <select name="title" class="combo-1-mini" onchange="drOrNoCheck(this);">
                                    <option value="mr"  selected>Mr.</option>
                                    <option value="mrs" >Mrs.</option>
                                    <option value="ms"  >Ms.</option>
                                    <option value="dr"  >Dr.</option>
                                </select>
                                
                                
                                <input type="text"  class="user-input-field2-name" placeholder="Full Name"   name="fname" required /> <!-- full name entering input-->
                            </div>
                            <div class="div-set-02">
                                <input type="password"  class="user-input-field2" placeholder="Password"   name="password" required /> <!-- password entering input-->
                                 </div>
                            <div class="div-set-03-hide" id="div03">
                                              <!--hospital selection-->
                                <select name="hospital" class="combo-1">
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
                                
                                <!--Specialization selection-->
                                <select name="spec" class="combo-1">
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
                            <input type="submit" value="Submit" class="submit-button"/>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="register.js"></script>
</html>