<?php
session_start();
if (isset($_SESSION['USER']) == "admin") {
    unset($_SESSION['status']);
    unset($_SESSION['id']);
    unset($_SESSION['patientId']);
    header('Location: appointment.php');
    exit();
}
?>