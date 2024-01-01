<?php
    $conn = mysqli_connect('localhost', 'root', '');
    if(!$conn){
        echo 'Not connected to server';
    } else {
        mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `mydb`");
    }