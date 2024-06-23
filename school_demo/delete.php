<?php

require 'connection.php'; // Using database connection file here
if(isset($_GET["id"])) {
	
	$id=$_GET["id"];
	$sql="DELETE FROM student WHERE Id = '$id'";
	$conn->query($sql);
	
	header("Location:index.php");
}
if(isset($_GET["class_id"])) {
	
	$id=$_GET["class_id"];
	$sql="DELETE FROM classes WHERE class_id = '$id'";
	$conn->query($sql);
	
	header("Location:classes.php");
}
	
	
	
?>