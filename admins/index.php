<?php

$conn = mysql_connect("localhost", "root", ""); // Connection 
if (!$conn) { // Check if there is problem while connecting to server
	echo "<h2> An ERROR occured";
}
else {
	$use = mysql_query("USE blog"); // Using DataBase 
	mysql_set_charset("UTF-8", $conn);
	if (!$use) { // Check if there is problem while Using to DB
		mysql_query("CREATE DATABASE blog"); // Creating DB
		mysql_query("USE blog"); // Using DB
		mysql_query(" 
			CREATE TABLE posts( 
			id int(11), 
			file varchar(30), 
			type int(2)
			)
		"); // Creating posts table
		/* mysql_query("
			CREATE TABLE comments(
			id int(11), 
			postid int(11),
			comment varchar(120),
			type int(2)
			)
		"); */ // Creating comments table ( In the next version )
	}
	header("location:admin.html"); // Going to homePage
}
