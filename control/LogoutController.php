<?php
session_start();
if(session_destroy())
{
    header("Location: https://tallermr2g.000webhostapp.com");
}
?>
