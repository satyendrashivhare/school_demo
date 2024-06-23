<?php
require "connection.php";

$query="select * from classes";

$row=$conn->query($query);
 
 if(!$row){
errlog(mysqli_error($conn), $query);
}else{
?>
<button><a href="index.php" >Home</a></button>
<button><a href="create.php" >Add student</a></button>
<button><a href="add_class.php" >Add Class</a></button>
<br>
<br>

<table border="1px">
<thead>
<tr>
<th>Name</th>
<th >Creation Date</th>
<th >Action</th>
</tr>
</thead>	
		
		
<?php
	foreach($row as $res)
	{
		
?>
<tbody>
<tr>
<td> <?php echo $res["class_name"];?> </td>

<td> <?php echo $res["created_at"];?></td>

<td> <a href="add_class.php?id=<?php echo $res["class_id"];?>" >Edit</a> | <a href="delete.php?class_id=<?php echo $res["class_id"];?>" >Delete</a> </td>
</tr>
</tbody>	
		
<?php
	
	}

?>
</table>
<?php
	
	}

?>
