<?php
include("conn.php");
//Function to validate input
function validateInput($data){
    //Remove leading and trailing whitespaces
    $data = trim($data);
    //Remove backslashes
    $data = stripslashes($data);
    //convert special characters to html entities to prevent xss attacks
    $data = htmlspecialchars($data);
    return $data;
}


// Function to check if an email or username already exists
function isUserExists($connect, $email, $username) {
    $query = "SELECT * FROM signup WHERE email = '$email' OR username = '$username'";
    $result = $connect->query($query);
    return ($result->num_rows > 0);
}

$exist = "";
//process the form data 
if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $email  = validateInput($_POST["email"]);
    $firstname = validateInput($_POST["firstname"]);
    $lastname = validateInput($_POST["lastname"]);
    $username = validateInput($_POST["username"]);
    $phonenumber = validateInput($_POST["phonenumber"]);
    $password = validateInput($_POST["password"]);


    //Hash the password
    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

    $query = "INSERT INTO bussiness(email, firstname, lastname, username, phonenumber, password) VALUES (?, ?, ?, ?, ?, ?)";


    
    

    $stmt = mysqli_prepare($connect, $query);

    mysqli_stmt_bind_param($stmt, "ssssss", $email, $firstname, $lastname, $username, $phonenumber, $hashedPassword);
    if (mysqli_stmt_execute($stmt)){
        echo "Registration successfully!";
        header("Location: CompanyLogin.php"); // redirect to login page
        exit();
    }else{
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    
}
?>




<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" rel="stylesheet" href="SignUp.css" />
    <title>Document</title>
  </head>
  <body>
    <div class="container">
      <h2>SignUp</h2>
      <form method="post" enctype="multipart/form-data" action="">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required placeholder="enter a valid email"/>
            <?php if (!empty($exist)&& strpos($exist, "email")!==false) echo'<div class="error">' .$exist . '</div>';?>
          </div>
          <div class="form-group">
            <label for="firstname">Firstname</label>
            <input type="text" id="firstname" name="firstname" required placeholder="enter your firstname"/>
          </div>
          <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" id="lastname" name="lastname" required placeholder="enter your lastname"/>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required  placeholder="choose your username"/>
            <?php if (!empty($exist)&& strpos($exist, "username")!==false) echo'<div class="error">' .$exist . '</div>';?>
          </div>
        <div class="form-group">
          <label for="number">Phonenumber</label>
          <input type="number" id="phonenumber" name="phonenumber" required placeholder="enter a valid number"/>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required placeholder="password"/>
        </div>
        <span style="color: red;"><?php $exist ?></span>
        <div class="form-group">
          <button type="submit" name="submit">Sign up 
            <!-- <div class="loading-circle"></div> -->
          </button>
        </div>
      </form>
    </div>
  </body>
</html>
