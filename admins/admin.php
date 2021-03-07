<!DOCTYPE html>
<html>
<head>
	<title> Admins Page </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>

	<?php // PHP

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
			if (isset($_GET['code'])) { // Checking if value 'code' is SET
				$code = $_GET['code']; // Getting the value 'code'
				if ($code == 'G73fWl1P78cxj4') { // Checking if code is true
					echo "
					<div class='top-bar'> Welcome, Admins </div>
					<br><br><br>
					<form method='POST' action='post.php'> 
						<textarea id='postArea' placeholder=' Your post here ' name='post'></textarea> <br>
						<input type='submit' id='post' value=' Post '>
						<br><br><br>
						<div class='line'> </div> <br>
					</form>
					"; // printing top bar and textArea
					// Getting posts IDs to know the number of them
					$getPostsIDs = mysql_query("SELECT id FROM posts");
					$IDs = array(); // Creating an array to contain the IDs
					while ($value = mysql_fetch_array($getPostsIDs, MYSQL_ASSOC)) {
						$IDs[] = $value['id'];
					} // Putting all the IDs in the array '$IDs'
					$postsNum = count($IDs); // Getting the number of posts
					if ($postsNum==0) { // If posts are zero
						echo " <h2> There is no posts yet! </h2> ";
					}
					else {
						// Posts are not zero 
						// Getting posts files
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
										echo "<h2> There is not posts yet! </h2>";
									}
								}
							} //
							else {
								$getPostText = fopen("posts/$thisPostFile", "r");
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
									<div class='container' id='buttons'>
										<div class='button' id='delete'>
											<a href='delete.php?id=$thisPostID'>
												Delete </a>
										</div>
										<div class='button' id='edit'>
											<a href='edit.php?file=$thisPostFile'>
												Edit </a>
										</div><br><br>
									</div>
								</div> <br>
								";
								$notDeleted++;
							}
							$x--;
							$y--;
						}
					}
				}
				else { // Code is inncorrect
					echo "<h1> An ERROR occured! </h1>";
				}
			}
			else { // The value code is UNset
				echo "<h1> An ERROR occured! </h1>";
			}
		}
	}

	?>

</body>
</html>
