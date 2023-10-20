<?php
//create a connection
$connect = mysqli_connect("Localhost", "root", "");
//check connection
if(!$connect){
    die("connection failed: " . mysqli_connect_error());
}
//create the database
$databaseName="wigaffairs";
$query = "CREATE DATABASE IF NOT EXISTS $databaseName";

if(mysqli_query($connect, $query)){
    echo "Database created successfully";
}else{
    die("Error creating database: " . mysqli_error($connect));
}



?>