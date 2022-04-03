<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/ques_desc.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Hello, world!</title>
</head>

<body>
  <?php include 'header.php'; ?>
  <?php include 'db_connect.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <style>
      .containerx{
          min-height: 700px;
        }
  </style>

  <div class="containerx">
    <?php
        $id=$_GET['threadid'];
        $sql = "SELECT * FROM `questions` WHERE ques_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){
            $id = $row['ques_id'];
            $title=$row['ques_title'];
            $desc=$row['ques_desc'];
            $time=$row['ques_time'];
            $user_id=$row['ques_user_id'];
            $sql2 = "SELECT username FROM `users` WHERE sno='$user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
    echo '<div class="ques-container">
        <p id ="title"><style="text-decoration:none;">'.$title.'</a><p>
        <p id="time">Posted by '. $row2['username'] . ' on '.$time.'</p>
        <p id="desc">'.$desc.'</p>
    </div>';
        }
    ?><br>
    <h2 id="answer" style="text-align:center; color:rgb(5, 107, 175);">Post your answer</h2><br>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ 
    echo '<div class="container">
        <form action= "" method="post"> 
            <div class="form-group">
                <textarea class="form-control" id="comment" name="comment" rows="5" required></textarea>
                <input type="hidden" name="sno" value="">
            </div><br>
            <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
            <button type="submit" name="submit" class="btn btn-primary">Post</button>
        </form> 
    </div>';
    }
    else{
        echo '
        <div class="abc" style="padding-left:200px;padding-right:200px;">
        <div class="alert alert-danger" role="alert">Login to add an answer!
              </div></div>';
      }
    ?><br>

<?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if(isset($_POST['submit'])){
        //Insert into comment db
        $comment = $_POST['comment']; 
        $sno = $_POST['sno']; 
        $sql = "INSERT INTO `comments` ( `comment_content`, `ques_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id','$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your answer has been added!
                  </div>';
        } 
        // header('location: home.php');
    
    }
    ?>

    <h2 id="answer"style="text-align:center; color:rgb(5, 107, 175);">Answers</h2>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE ques_id=$id ORDER BY comment_time DESC"; 
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content']; 
        $comment_time = $row['comment_time']; 
        $user_id = $row['comment_by']; 
        $sql2 = "SELECT username FROM `users` WHERE sno='$user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);

        echo '<div class="abc" style="padding-bottom:20px;">
        <div class="ques-container">
        <p id="comment">'.$content.'<p>
        <p id="time">Posted by '. $row2['username'] . ' on '.$comment_time.'</p>
        </div>
        </div>';
    }

    if($noResult){
        echo '<p class="display-5" style="color:rgb(5, 115, 189) ;">No Answers Found</p>
        <p class="lead"> Be the first person to answer this question</p>';
    }
    
    ?> 


  </div>
  <?php include 'footer.php'; ?>

</body>

</html>