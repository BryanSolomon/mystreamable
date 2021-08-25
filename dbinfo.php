<?php
$servername = $_ENV['SERVER_NAME'];
$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$dbname = $_ENV['DATABASE'];
print($servername . $username . $password . $dbname);
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	echo "<div class='alert alert-danger mb-0' role='alert'>";
	die("Connection failed: " . mysqli_connect_error());
	echo "</div>";
}
?>
