<?php

echo "

<title> Post </title>

";

function post($needle) {
	$postText = $needle;
	$postFile = rand(1, 9000000000); // Get random name for the file
	// checking if file is exist
	$checkPostFile = @fopen("posts/$postFile", "r"); 
	if (!$checkPostFile) { // File is not exist
	 	$createPostFile = fopen("posts/$postFile", "w"); // Creating file
	 	fwrite($createPostFile, $postText); // Writing in the file
	 	mysql_query("USE blog");
	 	$getPostsIDs = mysql_query("SELECT id FROM posts"); // Getting IDs
	 	$IDs = array(); // Creating array to contain all IDs
	 	while ($value = mysql_fetch_array($getPostsIDs, MYSQL_ASSOC)) {
	 		$IDs[] = $value['id'];
	 	} // Putting all IDs in array '$IDs'
	 	$postsNum = count($IDs);
	 	$thisPostNum = $postsNum+1;
	 	mysql_query("INSERT INTO posts(id, file, type) VALUES($thisPostNum, $postFile, 1)"); // Type 1 is for not deleted and type 2 is for deleted
	 	header("location:admin.php?code=G73fWl1P78cxj4");
	}
	else { // File is exist
		post($postText); //recall the function
	}
}

$conn = mysql_connect("localhost", "root", ""); // Connection
if (!$conn) { // Checking connection
	// Can't connect to the SQL server
	echo "<h1> An ERROR occured! </h1>";
}
else {
	// Connected successfully
	$use = mysql_query("USE blog"); // Using DataBase 'blog'
	if (!$use) { // Checking DB
		echo "<h1> An ERROR occured! </h1>";
	}
	else {
		if (isset($_POST['post'])) { // Checking if Value 'post' is SET
			$post = $_POST['post']; // Getting the Value
			if ( $post=='' ) {
				header("location:admin.php?code=G73fWl1P78cxj4");
			}
			else {
				post($post); // Calling function 'post'
			}
		}
		else {
			// Value 'post' is UNset
			echo "<h1> An ERROR occured </h1>";
		}
	}
}
