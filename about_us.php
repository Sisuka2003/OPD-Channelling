<?php
include './showErrors.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>About ABC</title>
        <link type="text/css" rel="stylesheet" href="about.css"/>
        <link  rel="shortcut icon" href="images/logo.png"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
    </head>
    <body>
        <div class="box-div">
            <?php
            include './navBar.php';
            ?>
            <div class="people-div">
                <div class="people-div-inner">
                    <div class="person">
                        <div class="dp2"></div>
                        <div class="data"  id="person2">
                            <h1 class="h1person">&nbsp;&nbsp;ABC Software Solutions&nbsp;&nbsp;</h1>
                            <br/>
                            <br/>
                            <p class="p-display" id="para2">We are a software development team which is formed with the combination of 8 members who are talented the software industry. We are creating this as a national project to provide service to all the Sri lankan citizens to make it easy on channelling thier OPD doctor without waiting in queues and minimizing the risk of being influenced to the Corona Virus.
                            <br/>
                            <br/>
                            Contact Us  :&nbsp;+94 0701597170 <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    +94 0777312335
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script type="text/javascript" src="about.js"></script>
    </body>
</html>

