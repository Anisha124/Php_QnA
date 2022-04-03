<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Hello, world!</title>
</head>

<body>
  <?php include 'header.php'; ?>
  <?php include 'db_connect.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <style>
    .containerx {
      min-height: 700px;
    }
  </style>
  <?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `categories` WHERE category_id=$id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $catname = $row['category_name'];
  }
  ?>

  <div class="containerx">
    <h2 id="heading">Recent Questions in <?php echo $catname; ?> category</h2>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `questions` WHERE ques_cat_id=$id ORDER BY ques_time DESC";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
      $noResult = false;
      $id = $row['ques_id'];
      $title = $row['ques_title'];
      $desc = $row['ques_desc'];
      $time = $row['ques_time'];
      $user_id = $row['ques_user_id'];
      $sql2 = "SELECT username FROM `users` WHERE sno='$user_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      echo '<div class="ques-container">
        <p id ="size"><a href="ques_desc.php?threadid=' . $id . '" style="text-decoration:none;">' . $title . '</a><p>
        <p id="time">Posted by ' . $row2['username'] . ' on ' . $time . '</p>
    </div>';
    }
    if ($noResult) {
      echo '
          <br>
              <p class="display-5" style="color:rgb(5, 115, 189) ;">No Questions Found</p>
              <p class="lead"> Be the first person to ask a question</p>';
    }
    ?>
  </div>
  <?php include 'footer.php'; ?>

</body>

</html>