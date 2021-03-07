<!DOCTYPE html>
<html>
<head>
	<title> Discover </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/discover.css">
</head>
<body>

	<?php 

	//php 
	$conn = mysql_connect("localhost", "root", ""); // Connection
	if (!$conn) { // Checking connection
		echo " <h1> An ERROR occured! </h1> ";
	}
	else {
		$use = mysql_query("USE blog"); // Using DataBase
		if (!$use) { // Checking if there is problems while using DB
			echo "<h1> An ERROR occured! </h1>";
		}
		else { // What will happen if all things correct
			if (isset($_GET['file'])) {
				// Checking if file is exist
				$file = $_GET['file'];
				$checkFile = @fopen("admins/posts/$file", "r");
				if (!$checkFile) {
					echo "<h1> An ERROR occured! </h1>";
				}
				else { // File is exist
					$postText = fread($checkFile, 999999);
					echo " <br><br><br><br><br>
					<div class='post'> 
						<div class='container'>
							$postText
						</div>
					</div>
					";
				}
			}
			else { //
				echo "
				<div class='top-bar'> Welcome | Discover </div>
				<br><br><br><br>
				"; // Printing top bar
				// Getting IDs of posts to know the number of them
				$getPostsIDs = mysql_query("SELECT id FROM posts");
				$IDs = array(); // Creating an array to contain all IDs
				while ($value = mysql_fetch_array($getPostsIDs, MYSQL_ASSOC)) {
					$IDs[] = $value['id'];
				} // Putting all IDs into the array '$IDs'
				$postsNum = count($IDs); // Getting the number of posts
				if ($postsNum==0) { // What will happen if there is no posts
					echo " <h2> There is no any posts from admin yet! </h2> ";
				}
				else { // What will happen if system found posts
					// The posts system here
					$getPostsFile = mysql_query("SELECT file FROM posts");
					$files = array(); // Creating array to contain all files
					while ($value2 = mysql_fetch_array($getPostsFile, MYSQL_ASSOC)) {
						$files[] = $value2['file'];
					}
					// Getting posts types
					$getPostsType = mysql_query("SELECT type FROM posts");
					$types = array();
					while ($value3 = mysql_fetch_array($getPostsType, MYSQL_ASSOC)) {
					 	$types[] = $value3['type'];
					 } 
					//
					$x = $postsNum;
					$y = $postsNum-1;
					$notDeleted = 0;
					while ($x >= 1) {
						$thisPostID = $IDs[$y];
						$thisPostFile = $files[$y];
						$thisPostType = $types[$y];
						if ($thisPostType==0) {//
							if ($x == 1) {
								if ($notDeleted == 0) {
									echo "<h2> There is no any posts from admin yet! </h2>";
								}
							}
						} //
						else {
							$getPostText = fopen("admins/posts/$thisPostFile", "r");
							$thisPostText = fread($getPostText, 999999);
							echo "
							<div class='post'> 
								<div class='container'>
									$thisPostText
								</div>
								<div class='container'>
									<b>Link: </b>
									http://localhost/business/personalblog/discover.php?file=$thisPostFile
								</div> 
							</div>
							";
							$notDeleted++;
						}
						$x--;
						$y--;
					}
				}
			} //
		}
	}

	?>

</body>
</html>
