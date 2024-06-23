
<?php
require "connection.php";
$id=$_GET["id"];
$query="select * from student where Id = '$id'";

$row=$conn->query($query);
 
 if(!$row){
errlog(mysqli_error($conn), $query);
}else{
	
$res=$row->fetch_assoc();

	$sql="select * from classes where class_id=".$res["Class_id"];
		$class=$conn->query($sql);
		$name=$class->fetch_assoc();
?>
<button><a href="index.php" >Home</a></button>
<button><a href="create.php" >Add student</a></button>
<button><a href="classes.php" >Manage Classes</a></button>


<h3>Name: <?php echo $res["Name"];?> </h3>
<h3>Email: <?php echo $res["Email"];?></h3>
<h3>Creation Date: <?php echo $res["Created_at"];?></h3>
<h3>Class Name: <?php echo $name["class_name"];?></h3>
<h3>Action: 
 <a href="edit.php?id=<?php echo $res["Id"];?>" >Edit</a> | <a href="delete.php?id=<?php echo $res["Id"];?>" >Delete</a> 
</h3>
	
<div id="img">
 <img src="img/<?php echo $res['Image'];?>" alt="<?php echo $res["Name"];?>" style="height:77.91px; width:120px;">
</div>
<?php
	
	}

?>