<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>
<?php include 'header.php'; ?>


<div class="conts">
  
  <div class="form">
    <form action="" method="post">
      <h1>Sign Up</h1>
      <input type="text" class="name" name="name" placeholder="Name" required>
      <input type="text" class="email" name="email" placeholder="Email ID" required>
      <input type="text" class="user" name="user" placeholder="Username" required>
      <input type="password" class="pass" name="pass" placeholder="Password" required>
      <input type="password" class="conpass" name="conpass" placeholder="Confirm Password" required>
      <button class="login">Sign Up</button>
    </form>
    <a href="login.php">Already have an account? Login here</a>
  </div>
  
  <?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'db_connect.php';
    $name = $_POST['name'];
    $user_email = $_POST['email'];
    $username = $_POST['user'];
    $pass = $_POST['pass'];
    $cpass = $_POST['conpass'];

    // Check whether this email exists
    $existSql = "select * from `users` where user_email = '$user_email' or username='$username'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email id or username already in use";
        echo '<div class="alert alert-danger" role="alert">Email id or password already in use!
        </div>';
        exit();
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name`,`username`, `user_email`,`user_pass`, `timestamp`) VALUES ( '$name','$username','$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                $showAlert = true;
                echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success!</strong> You can now login</div>';
                exit();
            }

        }
        else{
            $showError = "Passwords do not match"; 
            echo '<div class="alert alert-danger" role="alert">Passwords do not match!
            </div>';
            exit();
            
        }
    }
    // header("Location: /home.php?signupsuccess=false&error=$showError");

}
?>

    
</body>
</html>