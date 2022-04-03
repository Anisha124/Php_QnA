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
  </style>
    <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>

        <?php  
        $noresults = true;
        $query = $_GET["search"];
        $sql = "select * from questions where match(ques_title, ques_desc) against ('$query')"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['ques_title'];
            $desc = $row['ques_desc']; 
            $ques_id= $row['ques_id'];
            $url = "ques_desc.php?threadid=". $ques_id;
            $noresults = false;

            // Display the search result
            echo '<div class="result">
                        <h3><a href="'. $url. '" class="text-dark">'. $title. '</a> </h3>
                        <p>'. $desc .'</p>
                  </div>'; 
            }
        if ($noresults){
            echo '<div class="alert alert-danger" role="alert">No Results Found!
            </div>';
        }        
    ?>


  
  </div>
<?php include 'footer.php'; ?>
</body>
</html>
