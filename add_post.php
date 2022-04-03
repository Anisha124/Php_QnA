<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/add_post.css">
    <title>Document</title>
</head>
<body>
<?php include 'header.php'; ?>
<?php include 'db_connect.php'; ?>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
echo '<div class="cont">
  
  <div class="form">
    <form action="" method="post">
      <h1>Add Question</h1>
      <input type="text" class="user" placeholder="Title" name="title" required>
      <textarea type="text" class="pass" placeholder="Description" name="desc" required></textarea>
      <label for="Category" id="cat">Category</label>
    <select id="cat_name" name="cat_name">' ;   
        $records = mysqli_query($conn, "SELECT category_name,category_id From categories");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['category_name'] ."'>" .$data['category_name'] ."</option>";
        }	
        echo'
    </select>
    <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
      <button class="login">Submit</button>
    </form>
  </div>';
      }
else{
  echo '
  <h1>Add Question</h1>
  <div class="abc" style="padding-left:200px;padding-right:200px;">
  <div class="alert alert-danger" role="alert">Login to add a question!
        </div></div>';
}
      ?>
<!-- <?php
  $sel=$_POST['cat_name'];
  //  echo 'You have chosen: ' . $sel;
  $result = mysqli_query($conn, "SELECT * FROM `categories` WHERE category_name='$sel'");
  while($row = mysqli_fetch_assoc($result)) {
    $cat_id = $row['category_id'];
    // echo "<h2>" . $cat_id . "</h2>";
}
?>   -->

<?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){

      $sel=$_POST['cat_name'];
      //  echo 'You have chosen: ' . $sel;
      $result = mysqli_query($conn, "SELECT * FROM `categories` WHERE category_name='$sel'");
      while($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row['category_id'];
        // echo "<h2>" . $cat_id . "</h2>";
      }
        // Insert into thread db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sno = $_POST['sno']; 
        
        $sql = "INSERT INTO `questions` (`ques_title`, `ques_desc`, `ques_cat_id`, `ques_user_id`, `ques_time`) VALUES ( '$th_title', '$th_desc', '$cat_id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success" role="alert">
            Success! Your question has been added.
          </div>';
        } 
    }
    ?>

    
</body>
</html>