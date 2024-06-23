<?php
require "connection.php";

$query="select * from student";

$row=$conn->query($query);
 
 if(!$row){
errlog(mysqli_error($conn), $query);
}else{
?>
<button><a href="create.php" >Add student</a></button>
<button><a href="classes.php" >Manage Classes</a></button>
<br>
<br>

<table border="1px">
<thead>
<tr>
<th>Name</th>
<th >Email</th>
<th >Creation Date</th>
<th >Class Name</th>
<th >Image</th>
<th >Action</th>
</tr>
</thead>	
		
		
<?php
	foreach($row as $res)
	{
		$sql="select * from classes where class_id=".$res["Class_id"];
		$class=$conn->query($sql);
		$name=$class->fetch_assoc();
		
?>
<tbody>
<tr>
<td> <a href="view.php?id=<?php echo $res["Id"];?>" > <?php echo $res["Name"];?> </a></td>
<td> <?php echo $res["Email"];?></td>
<td> <?php echo $res["Created_at"];?></td>
<td> <?php echo $name["class_name"];?></td>
<td>
<img src="img/<?php echo $res['Image'];?>" alt="<?php echo $res["Name"];?>" style="height:120px; width:120px;">
</td>
<td> <a href="edit.php?id=<?php echo $res["Id"];?>" >Edit</a> | <a href="delete.php?id=<?php echo $res["Id"];?>" >Delete</a> </td>
</tr>
</tbody>	
		
<?php
	
	}

?>
</table>
<?php
	
	}

?>
