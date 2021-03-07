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
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$getIDs = mysql_query("SELECT id FROM posts WHERE id=$id AND type=1");
			$IDs = array();
			while ($value = mysql_fetch_array($getIDs, MYSQL_ASSOC)) {
				$IDs[] = $value['id'];
			}
			$IDsNum = count($IDs);
			if ($IDsNum == 0) {
				echo "<h1> An ERROR occured </h1>";
			}
			else {
				$getFile = mysql_query("SELECT file FROM posts WHERE id=$id AND type=1");
				$file = array();
				while ($value2 = mysql_fetch_array($getFile, MYSQL_ASSOC)) {
					$file[] = $value2['file'];
				}
				$thisFile = $file[0];
				unlink("posts/$thisFile");
				mysql_query("UPDATE posts SET type=0 WHERE id=$id");
				header("location:admin.php?code=G73fWl1P78cxj4");
			}
		}
	}
}
