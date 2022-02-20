<?php
include 'db_connect.php';
$sid = $_GET['sid'];
$sql = mysqli_query($conn,"SELECT * FROM `users` WHERE id='$sid'");
while($row = mysqli_fetch_assoc($sql)){
    $name = $row['name'];
    $name = $row['address'];
    $name = $row['contact'];
    $name = $row['username'];
    $name = $row['password'];
}

?>