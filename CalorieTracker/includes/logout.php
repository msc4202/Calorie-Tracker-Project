<?php

    session_start();
    session_unset();
    session_destroy();

    header("Location:../Dashboard.php?logout=success");
    exit();