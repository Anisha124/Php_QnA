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
    #ques{
      min-height: 500px;
    }
  </style>
  <div class="containerx">
    <h1 id="heading">Recent Categories</h1>
    <!-- <div class="ques-container">
      <div class=inner-ques-container>
        <p>What is Python?
        <p>
      </div>
    </div> -->
  </div>
  <div class="container my-4" id="ques">
    <div class="row my-4">
      <?php
      $sql = "SELECT * FROM `categories`";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['category_id'];
        $cat = $row['category_name'];
        $desc = $row['category desc'];
        echo '<div class="col-md-4 my-2"style="padding-left:40px;">
              <div class="card" style="width: 18rem">
            <img src="https://source.unsplash.com/1600x900/?' . $cat . ',any" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><a href="/php/Php_QnA/threads.php?catid=' . $id . '">' . $cat . '</a></h5>
            <p class="card-text">' . $desc . '</p>
            <a href="/php/Php_QnA/threads.php?catid=' . $id . '" class="btn btn-primary">View</a>
          </div>
        </div>
      </div>';
      }
      ?>
    </div>

  </div>
  <?php include 'footer.php'; ?>
  

</body>

</html>