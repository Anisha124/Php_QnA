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


<div class="cont">
  
  <div class="form">
    <form action="" method="post">
      <h1>Login</h1>
      <input type="text" class="user" name="username" placeholder="Username" required>
      <input type="password" class="pass" name="pass" placeholder="Password" required>
      <button class="login">Login</button>
    </form>
    <a href="signup.php">Don't have an account? Signup here</a>
  </div>
</div>

  <?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'db_connect.php';
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $sql = "select * from users where username='$username'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    // echo $numRows;
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['username'] = $username;
            // echo "logged in". $username;
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong>Logged in sucessfully!</div>';
        } 
        else{
          echo '<div class="alert alert-danger" role="alert">Unable to login!
          </div>';
        } 
    }
    // header("Location: home.php");  
}

?>
  

    
</body>
</html>