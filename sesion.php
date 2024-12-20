<?php
session_start();
if (!isset($_SESSION['idU'])) {
    header('Location: indexlogin.php');
    exit();
}
?>