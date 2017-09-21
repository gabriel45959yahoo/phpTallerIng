<?php
    session_start();
    session_unset();
    session_destroy();
    session_regenerate_id(true);
    echo "<script> window.location.assign('/index.html'); </script>";
?>
