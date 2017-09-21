<?php
session_start();
if(!isset($_SESSION['session']))
{
    
    echo "<script> window.location.assign('/index.html'); </script>";
    
    exit();
} 
?>