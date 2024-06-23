<?php
require "connection.php";
$id=$_GET["id"];


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

$nam=$_POST["name"];
$eml=$_POST["email"];
$add=$_POST["add"];
$cls=$_POST["class"];
	
	
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(basename($_FILES["fileToUpload"]["name"])!=""){
	
  
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
   
    $uploadOk = 1;
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

if (file_exists($target_file)) {
  echo "Sorry, file already exists..edit file name..</br>";
  $uploadOk = 0;
}


$im=basename( $_FILES["fileToUpload"]["name"]);

$query="UPDATE student set Name='$nam',Email='$eml', Address='$add', Class_id='$cls', Image='$im' where Id ='$id' ";



}
else{
	$query="UPDATE student set Name='$nam',Email='$eml', Address='$add', Class_id='$cls' where Id ='$id' ";

}

if ($uploadOk == 1) 
 {
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
   $conn->query($query);
   
   echo "Student Saved Successfully....";
   header("Location:index.php");
}




}

$id=$_GET["id"];
$query="select * from student where Id = '$id'";

$row=$conn->query($query);
 
 if(!$row){
errlog(mysqli_error($conn), $query);
}else{

$res=$row->fetch_assoc();
	
$sql1="select * from classes";
$class1=$conn->query($sql1);

$sql="select * from classes where class_id=".$res["Class_id"];
$class=$conn->query($sql);
$name=$class->fetch_assoc();

	
?>
<button><a href="index.php" >Home</a></button>
<button><a href="create.php" >Add student</a></button>
<button><a href="classes.php" >Manage Classes</a></button>

<form method="post" action="" enctype="multipart/form-data">
	<br><br><table>
	<tr><td>Stuent Name </td><td>
	<input type="text" name="name" id="name" value="<?php echo $res["Name"];?>">
	</td></tr><tr><td> Email</td><td>
	<input type="text" name="email" id="email" value="<?php echo $res["Email"];?>">
	</td></tr><tr><td> Student Class</td><td>
	<select name="class" id="class">
	
	<option value="<?php echo $id; ?>"><?php echo $name["class_name"];?></option>
<?php
	foreach ($class1 as $res1){
		if($name["class_name"]!=$res1["class_name"]){
		?>
		<option value="<?php echo $res1["class_id"];?>" > <?php echo $res1["class_name"];?> </option>
		
		<?php
		}
	}

?>
	</select>
	</td></tr><tr><td> Address</td><td>
	<input type="textarea" name="add" id="add" value="<?php echo $res["Address"];?>">
	</td></tr><tr><td> Image</td><td>
	<input type="file" name="fileToUpload" id="img">
	</td></tr></table><br><br>
	
	<input type="submit" value="submit" name="submit">
</form>


<?php
	
	}

?>
