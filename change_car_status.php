<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auto loc";

// Create connexion
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connexion
if ($conn->connect_error) {
    die("Connection échoue: " . $conn->connect_error);
}

$_SESSION['conn'] = $conn;
$plate_id = $_SESSION['plate_id'];
$status = $_SESSION['status'];
$current_date = date("Y-m-d");

$query = "SELECT * FROM `reservation` WHERE plate_id = '$plate_id' AND ('$current_date' < return_time)";
$result = mysqli_query($conn, $query);
$output = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) != 0) {
    echo '<script>';
    echo 'alert("Vous ne pouvez pas changer le statut de la voiture ")';
    echo '</script>';
    echo '<script>';
    echo 'window.location = "car_status.php"';
    echo '</script>';
} else {

    if ($status === 'Disponible') {
        $status = 'T';  //becomes hors service 
        $query = "INSERT INTO `car_status` (plate_id,out_of_service_start_date) VALUES('$plate_id','$current_date')";
        $result = mysqli_query($conn, $query);
    } else {
        $status = 'F';  //becomes disponible
        $query = "UPDATE `car_status` SET out_of_service_end_date= '$current_date' WHERE plate_id='$plate_id' and out_of_service_end_date is null";
        $result = mysqli_query($conn, $query);
    }
    $query = "UPDATE `car` SET out_of_service = '$status' WHERE plate_id = '$plate_id'";
    $result = mysqli_query($conn, $query);
    header('location: admin_dashboard.php');
}

$conn->close();
?>