<?php include 'db_connect.php'; ?>
<?php
if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($conn, "DELETE FROM questions WHERE ques_id=$id");
    echo '<div class="alert alert-success" role="alert">
    Success! Your question has been deleted sucessfully.
  </div>';

}?>