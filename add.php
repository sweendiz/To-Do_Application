<?php
require_once 'db.php';
session_start();
if(isset($_POST['todoText'])){
	$todoText = trim($_POST['todoText']);
	echo 'here';
	if(!empty($todoText)){
		$email = $_SESSION['email'];
		$items = $mysqli->query("INSERT INTO todo (EmailID, state, todoText) VALUES(matt@gmail.com, 1, 'test'");
	}
}
//header('Location: profile.php');