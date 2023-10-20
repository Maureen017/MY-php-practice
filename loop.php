<?php include ("conn.php");


//select Query
$sql = mysqli_query($connect,"SELECT * FROM blog order by id desc")or die ("Could Not Select Profile".mysqli_error($connect));

$count = 0;//$count is used to identify the first value
//check if there is something in the table
if(mysqli_num_rows($sql)>$count){
	//fetch each array
	while($row=mysqli_fetch_assoc($sql))
	{
		//select whatever is in the table
		$id[] = $row["id"];
		$title[] = $row["title"];
		$image[] = $row["image"];
		$writeup[] = $row["writeup"];
		
		
		$count++;
	}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<table width="800" border="1" align="center">
<tr>
	<td width="50">ID</td>
	<td width="100">Title</td>
	<td width="130">image</td>
	<td width="180">writeup</td>
	<td width="80">&nbsp;</td>
	<td width="60">&nbsp;</td>
	<td></td>
	</tr>
	<?php for($s=0; $s<$count;$s++){?>
<tr>
	<td><?php echo $id[$s] ?></td>
	<td><?php echo $title[$s] ?></td>
	<td><img src="img/<?php echo $image[$s] ?>" width="100%" alt=""></td>
	<td><?php echo $writeup[$s] ?></td>
	<td><a href="editblog.php?id=<?php echo $id[$s]?>">Edit</td>
	<td id="del" onClick="alert('DELETED')"><a href="viewblog.php?id=<?php echo $id[$s]?>">Delete</td>
	<?php }?>
	</tr>
</body>
</html>