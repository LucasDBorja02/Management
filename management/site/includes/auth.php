<?php
session_start();
if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit();
}
?>
