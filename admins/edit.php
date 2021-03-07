<!DOCTYPE html>
<html>
<head>
	<title> Edit </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>

<?php

$conn = mysql_connect("localhost", "root", ""); // Connection
if (!$conn) { // Checking connection
	echo "<h1> An ERROR occured </h1>";
}
else {
	$use = mysql_query("USE blog"); // Using DataBase
	if (!$use) { // Checking if there if problems while using DB
		echo "<h1> An ERROR occured! </h1>";
	}
	else {
		if (isset($_POST['submit'])) {
			$edited = $_POST['post'];
			echo "$edited";
			$file = $_GET['file']; // Getting value
			// Check if file is exist
			$checkFile = @fopen("posts/$file", "r");
			if (!$checkFile) {
				echo "<h1> An ERROR occured! </h1>";
			}
			else {
				$updateFile = @fopen("posts/$file", "w");
				fwrite($updateFile, $edited);
				header("location:admin.php?code=G73fWl1P78cxj4");
			}
		}
		else {
			if (isset($_GET['file'])) { // Checking if value 'file' is SET
				$file = $_GET['file']; // Getting value
				// Check if file is exist
				$checkFile = @fopen("posts/$file", "r");
				if (!$checkFile) {
					echo "<h1> An ERROR occured! </h1>";
				}
				else {
					$postText = fread($checkFile, 999999);
					echo "
					<br><br><br><br><br>
					<form method='POST' action='#'> 
						<textarea id='postArea' placeholder=' Your post here ' name='post'>$postText</textarea> <br>
						<input type='submit' id='post' value=' Edit ' name='submit'>
					</form>
					";
				}
			}
			else {
				echo "<h1> An ERROR occured! </h1>";
			}
		}
	}
}
