<?php

    session_start();

        include "includes/dbh.inc.php";
           if (isset($_SESSION['u_id'])) 
            {
                include "home1.php";
            }
            else
            {
               echo "You are not logged in";
            }
            //include "home_body.php";
?>