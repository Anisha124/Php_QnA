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

<?php include 'db_connect.php'; ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM questions WHERE ques_id=$id");
        $row = mysqli_fetch_array($record);
        $ques_title = $row['ques_title'];
        $ques_desc = $row['ques_desc'];
        $ques_cat_id=$row['ques_cat_id'];

	}

    echo '<div class="cont">
  
    <div class="form">
      <form action="" method="post">
        <h1>Update Question</h1>
        <input type="hidden" name="id" value="'.$id.'">
        <input type="text" class="user" placeholder="Title" name="title" value="'.$ques_title.'"required>
        <input type="text" class="pass" placeholder="Description" name="desc" value="'.$ques_desc.'" required></textarea>
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
        <button class="login" name="update">Update</button>
      </form>
    </div>'
?>

<?php
if (isset($_POST['update'])) {
    $sel=$_POST['cat_name'];
    $result = mysqli_query($conn, "SELECT * FROM `categories` WHERE category_name='$sel'");
    while($row = mysqli_fetch_assoc($result)) {
      $cat_id = $row['category_id'];
    }
      // Insert into thread db
      $th_title = $_POST['title'];
      $th_desc = $_POST['desc'];
      $id = $_POST['id'];

	mysqli_query($conn, "UPDATE questions SET ques_title='$th_title', ques_desc='$th_desc',ques_cat_id='$cat_id' WHERE ques_id=$id");
    $showAlert = true;
    if($showAlert){
        echo '<div class="alert alert-success" role="alert">
        Success! Your question has been updated sucessfully.
      </div>';
    } 
}
?>
</body>
</html>
