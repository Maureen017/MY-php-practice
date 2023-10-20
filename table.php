<?php include("conn.php");?>
<?php
$tablename ="signup";
$query = "CREATE TABLE IF NOT EXISTS $tablename (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    USERNAME VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    phone_no VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if (mysqli_query($connect ,$query)) {
        echo "Table '$tablename' created successfully";
    }
    else{
        die("Error creating table:" .mysqli_error($connect));
    }
?>