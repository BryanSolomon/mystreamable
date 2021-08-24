<?php 

session_start();
if(!isset($_SESSION['userID']) || $_SESSION['userID'] == NULL) {
    include "homepage.php";
} else {
    header("Location: ./dashboard");
}

?>