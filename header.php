<?php
session_start();

error_reporting(0);

echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding: 20px;">
<div class="container-fluid">
  <a class="navbar-brand" href="home.php">Q&A</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item" style="margin-left:40px;">
        <a class="nav-link " aria-current="page" href="home.php" active style="font-size: larger;">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_post.php" style="font-size: larger;">Ask Question</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php" style="font-size: larger;">Profile</a>
      </li>


    </ul>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '
       <p class="text-light my-0 mx-5" style="font-size:20px;">Welcome '. $_SESSION['username']. ' </p>
      <a href="logout.php"><button type="button" class="btn btn-outline-light"style="margin-right: 30px;">Logout</button></a>
      <form class="d-flex" method="get" action="search.php">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit"  style="margin-right: 10px;">Search</button>
    </form>' ;
    }
    else{
      echo '<a href="login.php"><button type="button" class="btn btn-outline-light"style="margin-right: 30px;">Login</button></a>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit"  style="margin-right: 10px;">Search</button>
      </form>';
    }
  echo '</div>
</div>
</nav>';
?>
