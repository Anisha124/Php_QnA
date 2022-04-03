<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/profile.css">
    <title>Document</title>
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'db_connect.php'; ?>

<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        $username=$_SESSION['username'];

        $sql = "SELECT * FROM `users` WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
            echo '<div class="cont">
  
            <div class="form">
                <h1>Profile</h1>
                <p id="name">Name: '.$row['name'].'</p>
                <p id="user">Username: '.$row['username'].'</p>
                <p id="email">Email Id: '.$row['user_email'].'</p>
                <p id="mem_since">Member Since: '.$row['timestamp'].'</p>
            </div>
          </div>';
    }
    else{
        echo '  <div class="abc" style="padding-left:200px;padding-right:200px;">
        <div class="alert alert-danger" role="alert">Login to view!
              </div></div>';
    }
?>
<h2>Questions asked by you</h2>
<?php
$user_id=$_SESSION['sno'];
$sql = "SELECT * FROM `questions` WHERE ques_user_id='$user_id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)){
    $noResult=false;
    $id = $row['ques_id'];
    $title=$row['ques_title'];
    $desc=$row['ques_desc'];
    $time=$row['ques_time'];
    $user_id = $row['ques_user_id']; 
    echo '<div class="ques-container">
    <a href="update.php?edit='.$row['ques_id'].'" class="edit_btn" id="edit"><img src="https://img.icons8.com/material-rounded/30/4a90e2/edit--v1.png"/ align="right" style="padding-right: 10px;padding-top:5px;"></a>
    <a href="delete.php?del='.$row['ques_id'].'" class="del_btn" id="del"><img src="https://img.icons8.com/fluency/30/000000/filled-trash.png"/ align="right" style="padding-right: 10px;padding-top:5px;"></a>
    <p id ="size"><a href="ques_desc.php?threadid='.$id.'" style="text-decoration:none;">'.$title.'</a><p>
    <p id="time">Posted by you on '.$time.'</p>
</div>';
}
?>



</body>
</html>