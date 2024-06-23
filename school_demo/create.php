<?php
require "connection.php";

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	

$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	
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

$nam=$_POST["name"];
$eml=$_POST["email"];
$add=$_POST["add"];
$cls=$_POST["class"];
$im=basename( $_FILES["fileToUpload"]["name"]);

$query="INSERT INTO student (Name,Email, Address, Class_id, Image )VALUES ('$nam', '$eml', '$add','$cls','$im' )";



if ($uploadOk == 1) 
 {
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	$conn->query($query);
	
   
   echo "<h3>Student Saved Successfully....</h3><br>";
}




}	

$sql="select * from classes";
$class=$conn->query($sql);
	
?>
<button><a href="index.php" >Home</a></button>
<button><a href="create.php" >Add student</a></button>
<button><a href="classes.php" >Manage Classes</a></button>

<form method="post" action="create.php" enctype="multipart/form-data">
	<br><br><table>
	<tr><td>Stuent Name </td><td>
	<input type="text" name="name" id="name">
	</td></tr><tr><td> Email</td><td>
	<input type="text" name="email" id="email">
	</td></tr><tr><td> Classes</td><td>
	<select name="class">
	<option value="">select</option>
<?php
	foreach ($class as $res){
		?>
		<option value="<?php echo $res["class_id"];?>"> <?php echo $res["class_name"];?> </option>
		
		<?php
		
	}

?>
	</select>
	</td></tr><tr><td> Address</td><td>
	<input type="textarea" name="add" id="add">
	</td></tr><tr><td> Image</td><td>
	<input type="file" name="fileToUpload" id="img">
	</td></tr>
	</table><br><br>
	<input type="submit" value="submit" name="submit">
</form>


