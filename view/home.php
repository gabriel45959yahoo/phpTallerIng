<?php session_start() ?>
<?php

if (isset($_SESSION['nombre'])) {
    ?>
<h1>Bienvenido de nuevo <?php echo $_SESSION['nombre'] ?>.</h1>
<a href="logout.php"> Logout </a>
<?php

} else {
    header("Location: index.php");
}
