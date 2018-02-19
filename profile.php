<?php
require 'db.php';
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
   // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
	$query = $mysqli->query("SELECT * FROM todo WHERE emailID='$email'");
	$items = $query;
	
 
	if(isset($_POST['submit'])){
		$task = $_POST['task'];
		if($task){
		mysqli_query($mysqli,"INSERT INTO TODO (todoText,EmailID,state) VALUES('$task','$email',1);");
		header('location: profile.php');
		}
	}
	if(isset($_GET['del_task'])){
		$id = $_GET['del_task'];
		mysqli_query($mysqli,"DELETE FROM todo WHERE TodoID=$id");
		header('location: profile.php');
		
	}
}
?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>Welcome <?= $first_name.' '.$last_name ?></title>
    <?php include 'css/css.html'; ?>
</head>
<body>
  <div class="form">
	<h1>To-Do List</h1>
	  <p>
          <?php 
     
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
          
          ?>
          </p>
	
	<?php	
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          }
          
          ?>
	 <?php 
	foreach($items as $item){
		$id = $item['TodoID'];
		echo '<div class="listItem">',$item['todoText'],'<a href="profile.php?del_task=', $id,'"> X</a> </div>';
	}
	?>
			</ul>
		
		<form method="POST" action="profile.php">
			<input type="text" name="task" class="task_input">
			<button type="submit" class="button" name="submit">Add to List</button>
		</form>
		<br>
		<a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
		</div>
		

</body>

</html>
