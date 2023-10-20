<?php
include("conn.php");
if(isset($_POST["submit"])) {
    //Get user iinput
    $userorEmail = $_POST['user'];
    $password =$_POST['password'];


    //check if the user exists (using email or username)
    $query = "SELECT * FROM registration WHERE (binary user = ? OR binary email = ?)";

    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "ss", $userorEmail, $userorEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        // user exists, fetch user data
        $row =mysqli_fetch_assoc($result);
        $id = $row['id'];
        $hashedpassword = $row['password'];
        //verify the password
        if(password_verify($password, $hashedpassword)) {
            //password is correct
            //session_start();
            //$_SESSION['id'] =$ID;
            //Check for output buffering
            //header("location: dashboard.php");
            //exit();
            if(mysqli_num_rows($result) > 0)
            {
                setcookie("oka",$id, time()+3600);
                header("location: dashboard.php");
            }

        }
        else{
            //incorrect password
            echo"wrong password.";
        }
    
            //user does not exist
            echo "user not found.";
    
        //close the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($connect);


    }

}
?>