<?php
$servername = "remotemysql.com";
$username = "RN1wqVCQQG";
$password = "vq4ovQaRVQ";
$dbname = "RN1wqVCQQG";

// $servername = getenv('SERVER_NAME');
// $username = getenv('USERNAME');
// $password = getenv('PASSWORD');
// $dbname = getenv('DATABASE');

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	echo "<div class='alert alert-danger mb-0' role='alert'>";
	die("Connection failed: " . mysqli_connect_error());
	echo "</div>";
}
?>
