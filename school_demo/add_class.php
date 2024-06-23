<?php
require "connection.php";


if(isset($_POST["submit"])) {
$nam=$_POST["name"];
$query="INSERT INTO classes (class_name)VALUES ('$nam' )";

	$conn->query($query);

   echo "<h3>class Saved Successfully....</h3><br>";
}
	
if(isset($_POST["save"])) {
$id=$_GET["id"];
$nam=$_POST["name"];
$query="UPDATE classes set class_name='$nam' where class_id='$id' ";

	$conn->query($query);

   header("Location:classes.php");
}	

	
?>
<button><a href="index.php" >Home</a></button>
<button><a href="create.php" >Add student</a></button>
<button><a href="classes.php" >Manage Classes</a></button><br><br>

<form method="post" action="" enctype="multipart/form-data">

<?php
if(isset($_GET["id"])) {
	$id=$_GET["id"];
$query="select * from classes where class_id = '$id'";

$row=$conn->query($query);
$res=$row->fetch_assoc();

?>

	<input type="text" name="name" id="name" value="<?php echo $res["class_name"];?>">

	<input type="submit" value="save" name="save">
<?php
}else{
?>

<input type="text" name="name" id="name" >

	<input type="submit" value="submit" name="submit">
<?php 
}
?>
</form>


