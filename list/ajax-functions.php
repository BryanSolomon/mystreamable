<?php

// ADD TO FAVORITES
if (isset($_POST['ft']) && $_POST['ft'] == 1){
    $userID = $_SESSION['userID'];
    $objectID = (int)$_POST['objectID'];
    $type = $_POST['type'];
    $listID = $_POST['lID'];
    $queryn = "SELECT `userID`, `name`, `listID`, `objectID`, `progress`, `type`, `streamingService`, `season`, `episode` FROM `listitems` WHERE objectID=$objectID AND userID=$userID AND listID=$listID";
    $resultf = mysqli_query($conn, $queryn);
    $resultARR = mysqli_fetch_array($resultf);
    $n = str_replace("'", "''", $resultARR['name']);
    require('../tmdb_v3-PHP-API--master/tmdb-api.php');
    $tmdb = new TMDB();
    $tmdb->setAPIKey('1ef601ddfcc2248eda53874c4027c1b5'); 
    if ($listID == 3) {
        if($type == 1){
            $n = str_replace("'", "''",($tmdb->getMovie($objectID))->getName());
        }
        else if($type == 2){
            $n = str_replace("'", "''",($tmdb->getTVShow($objectID))->getName());
        }
    }
    $listID = 3;
    $query = "INSERT INTO `listitems` (`userID`, `name`, `listID`, `objectID`, `progress`, `type`, `streamingService`, `season`, `episode`) VALUES ($userID, '".$n."', $listID, $objectID, '', $type, '', 0, 0)";
    $conn->query($query);
}                                   

// REMOVE FROM FAVORITES
if(isset($_POST['ft']) && $_POST['ft'] == 2) {
    $userID = $_SESSION['userID'];
    $obj = $_POST['objectID'];
    $type = $_POST['type'];
    $listID = 3;
    $qquery = "DELETE FROM listItems where userID = $userID AND listID = $listID AND objectID = '" . $obj ."' AND type= '". $type ."' ";
    $conn->query($qquery);
}

// ADD TO CURRENTLY WATCHING
if(isset($_POST['ft']) && $_POST['ft'] == 3){
    $userID = $_SESSION['userID'];
    $objectID = (int)$_POST['objectID'];
    $type = $_POST['type'];
    $querygrab = "SELECT `userID`, `name`, `listID`, `objectID`, `progress`, `type`, `streamingService`, `season`, `episode` FROM `listitems` WHERE objectID=$objectID AND userID=$userID AND listID=2";
    $resultgrab = mysqli_query($conn, $querygrab);
    $resultARR = mysqli_fetch_array($resultgrab);
    $n = str_replace("'", "''", $resultARR['name']);
    $listID = 1;
    $querywatch = "INSERT INTO `listitems` (`userID`, `name`, `listID`, `objectID`, `progress`, `type`, `streamingService`, `season`, `episode`) VALUES ($userID, '".$n."', $listID, $objectID, '', $type, '', 0, 0)";
    $conn->query($querywatch);
    $querydelete = "DELETE FROM listITEMS WHERE userID=$userID AND objectID=$objectID AND listID=2";
    $conn->query($querydelete);
}

// REMOVE FROM History
if(isset($_POST['ft']) && $_POST['ft'] == 4) {
    $userID = $_SESSION['userID'];
    $obj = $_POST['objectID'];
    $type = $_POST['type'];
    $listID = 4;
    $qquery = "DELETE FROM listItems where userID = $userID AND listID = $listID AND objectID = '" . $obj ."' AND type= '". $type ."' ";
    $conn->query($qquery);
}

// ADD MARK COMPLETE
if(isset($_POST['ft']) && $_POST['ft'] == 5){
    $userID = $_SESSION['userID'];
    $obj = $_POST['objectID'];
    $type = $_POST['type'];
    $querygrab = "SELECT `userID`, `name`, `listID`, `objectID`, `progress`, `type`, `streamingService`, `season`, `episode` FROM `listitems` WHERE objectID=$obj AND userID=$userID AND listID=1";
    $resultgrab = mysqli_query($conn, $querygrab);
    $resultARR = mysqli_fetch_array($resultgrab);
    $n = str_replace("'", "''", $resultARR['name']);
    $querywatch = "INSERT INTO `listitems` (`userID`, `name`, `listID`, `objectID`, `progress`, `type`, `streamingService`, `season`, `episode`) VALUES ($userID, '".$n."', 4, $obj, '', $type, '', 0, 0)";
    $conn->query($querywatch);
    $querydelete = "DELETE FROM listITEMS WHERE userID=$userID AND objectID=$obj AND listID=1";
    $conn->query($querydelete);
}
?>