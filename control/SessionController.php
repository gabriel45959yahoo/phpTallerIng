<?php
session_start();
if(!isset($_SESSION['session']))
{
    
//     echo "<script> window.location.assign('/index.html'); </script>";
    
    $response= 'error';

} else{
    $response = 'OK';
}
//json_encode(array('response' => $response))
echo $response
?>