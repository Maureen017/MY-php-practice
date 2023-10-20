<?php
include ("conn.php");
if(isset($_POST['submit'])){
    $pics = $_FILES['picture']['name'];
    $p ='pictures/'.$pics;
    move_uploaded_file($_FILES['picture']['tmp_name'],$p);
    // $insert = mysqli_query($connect,"insert into picture (picture)values('$pics')")or die ("could not insert" .mysqli_error($connect));

    $query = "INSERT INTO picture(picture) VALUES (?)";
    
    $stmt = mysqli_prepare($connect, $query);

    mysqli_stmt_bind_param($stmt, "s", $pics);
    if (mysqli_stmt_execute($stmt)) {
      echo "picture successful!";
      exit();
  } else {
      echo "Error: " . mysqli_stmt_error($stmt);
  }
  



}




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="picture">
        <input type="submit" name="submit">
    </form>
</body>
</html>