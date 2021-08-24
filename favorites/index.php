<!DOCTYPE html>
<html>

<?php 

session_start();

include "../dbinfo.php";
include "../list/ajax-functions.php";

if($_SESSION['userID'] == NULL) {
    header("Location: ../sign-in");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$querysearchfull = "SELECT name, objectID, season, episode, streamingService, type FROM listItems WHERE userID='".$_SESSION['userID']."' AND listID=3";
$searchfullresult = mysqli_query($conn, $querysearchfull);
$noResults = 0;
if (mysqli_num_rows($searchfullresult) == 0) {
    $noResults = 1;
}

while($row = mysqli_fetch_array($searchfullresult)){
    $rows[] = $row;
}
if (!$noResults) {
    $heroRow = $rows[0];
}

$noSearchFilterResults = 0;
if(isset($_POST['button-search'])){
    if (!$conn) {
        echo "<div class='row'>";
        echo "<div class='col mb-3'>";
        echo "<div class='alert alert-danger' role='alert'>";
        die("Connection failed: " . mysqli_connect_error());
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    $trigger = true;
    $title = str_replace("'", "''", $_POST['searchList']);

    $querysearch = "SELECT name, objectID, season, episode, streamingService, type FROM listItems WHERE name='".$title."' AND userID='".$_SESSION['userID']."' AND listID=3";
    $searchresult = mysqli_query($conn, $querysearch);
    $rows = array();
    $rows[] = mysqli_fetch_array($searchresult);
    if ($rows[0] == NULL) {
        $noSearchFilterResults = 1;
    }
}

if(isset($_POST['button-filter'])){
    if (!$conn) {
        echo "<div class='row'>";
        echo "<div class='col mb-3'>";
        echo "<div class='alert alert-danger' role='alert'>";
        die("Connection failed: " . mysqli_connect_error());
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    $trigger = true;

    if($_POST['filter-itemType'] == "Movie"){
        $queryfilter = "SELECT name, objectID, season, episode, streamingService, type FROM listItems WHERE userID='".$_SESSION['userID']."' AND listID=3 AND type=1";
    }
    else if($_POST['filter-itemType'] == "TV Show"){
        $queryfilter = "SELECT name, objectID, season, episode, streamingService, type FROM listItems WHERE userID='".$_SESSION['userID']."' AND listID=3 AND type=2";
    }
    else if($_POST['filter-itemType'] == "All"){
        $queryfilter = "SELECT name, objectID, season, episode, streamingService, type FROM listItems WHERE userID='".$_SESSION['userID']."' AND listID=3";
    }

    $filterresult = mysqli_query($conn, $queryfilter);
    $rows = array();

    while($row = mysqli_fetch_array($filterresult)){
        $rows[] = $row;
    }
    if (sizeof($rows) == 0) {
        $noSearchFilterResults = 1;
    }
    
}

$trigger = true;

?>

<head>
    <title>Favorites | Streamable</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="../list/liststyle.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div id="top"></div>
    <?php include "../navbar.php";
    require('../tmdb_v3-PHP-API--master/tmdb-api.php');
                      $tmdb = new TMDB();
                      $tmdb->setAPIKey('1ef601ddfcc2248eda53874c4027c1b5'); 
        if (!$noResults) {
            if($heroRow['type'] == 1) {
                $herobg = 'https://image.tmdb.org/t/p/original' . ($tmdb->getMovie($heroRow['objectID']))->getPoster();
            } else if ($heroRow['type'] == 2) {
                $herobg = 'https://image.tmdb.org/t/p/original' . ($tmdb->getTVShow($heroRow['objectID']))->getPoster();
            }
        }
    ?>
    <style>
        .hero {
            background: url('<?php echo $herobg ; ?>');
        }
    </style>
    <div class="w-100 text-white bg-dark hero d-flex flex-column mb-3 hero-size">
        <div class="w-100 h-100 darken bg-blur d-flex">
            <div class="container mt-auto mb-auto">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart hero-icon" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                    </svg>
                    Favorites
                </h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 rounded bg-white me-3 mb-3">
                <div class="row mt-3"> 
                    <form class="col" id="search" method="post" action="index.php">
                        <div class="row px-1">
                            <h4>Search</h4>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="form-floating" style="width: 85%;">
                                        <input type="text" class="form-control" id="searchList" name="searchList" aria-label="button-search" aria-describedby="button-search" placeholder="Search List" required novalidate value="<?php if (isset($_POST['searchList'])) { echo $_POST['searchList']; } ?>">
                                        <label for="searchList">Search List</label>
                                    </div>
                                    <button class="btn btn-dark" style="width: 15%;" name="button-search">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" class="bi bi-search btn-icons" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row p-1">
                    <form class="col" id="filter" method="post" action="index.php">
                        <h4>Filters</h4>
                        <div class="form-floating mb-3">
                            <select type="text" class="form-select" id="filter-itemType" name="filter-itemType">
                                <option value="All" selected>All</option>
                                <option value="Movie" <?php if (isset($_POST['filter-itemType']) && $_POST['filter-itemType'] == "Movie") { echo "selected"; } ?>>Movie</option>
                                <option value="TV Show" <?php if (isset($_POST['filter-itemType']) && $_POST['filter-itemType'] == "TV Show") { echo "selected"; } ?>>TV Show</option>
                            </select>
                            <label for="filter-itemType">Item Type</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select type="text" class="form-select" id="filter-streamingService"
                                name="filter-streamingService" disabled>
                                <option value="All" selected>All</option>
                                <option value="Netflix" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Netflix") { echo "selected"; } ?>>Netflix</option>
                                <option value="Hulu" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Hulu") { echo "selected"; } ?>>Hulu</option>
                                <option value="Disney+" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Disney+") { echo "selected"; } ?>>Disney+</option>
                                <option value="HBO Max" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "HBO Max") { echo "selected"; } ?>>HBO Max</option>
                                <option value="Prime Video" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Prime Video") { echo "selected"; } ?>>Prime Video</option>
                                <option value="Paramount+" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Paramount+") { echo "selected"; } ?>>Paramount+</option>
                                <option value="Discovery+" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Discovery+") { echo "selected"; } ?>>Discovery+</option>
                                <option value="Apple TV+" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Apple TV+") { echo "selected"; } ?>>Apple TV+</option>
                                <option value="Peacock" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Peacock") { echo "selected"; } ?>>Peacock</option>
                                <option value="Showtime" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Showtime") { echo "selected"; } ?>>Showtime</option>
                                <option value="Starz" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Starz") { echo "selected"; } ?>>Starz</option>
                                <option value="ESPN+" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "ESPN+") { echo "selected"; } ?>>ESPN+</optino>
                                <option value="YouTube Premium" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "YouTube Premium") { echo "selected"; } ?>>YouTube Premium</option>
                                <option value="Other" <?php if (isset($_POST['filter-streamingService']) && $_POST['filter-streamingService'] == "Other") { echo "selected"; } ?>>Other</option>
                            </select>
                            <label for="filter-streamingService">Streaming Service</label>
                        </div>
                        <!-- todo add more filters iteration 3 -->
                        <button class="btn btn-dark mb-3 w-100" name="button-filter">Apply Filters</button>
                    </form>
                </div>
            </div>
            <?php
                if(isset($_POST['button-search']) || isset($_POST['button-filter']) || $trigger){
            ?>
                <div class="col-xl-7 mb-3">
                        <?php
                        if ($noResults) {
                            echo '<div class="text-center mt-5">No items are currently in this list</div>';
                        } else if ($noSearchFilterResults) {
                            echo '<div class="text-center mt-5">No results found</div>';
                        } else {
                            if(!empty($rows)){
                            foreach($rows as $row){
                                if($row['type'] == 1){
                                    $search = $tmdb->getMovie($row['objectID']);
                                }
                                else if($row['type'] == 2){
                                    $search = $tmdb->getTVShow($row['objectID']);
                                }

                        ?>
                        <div class="row rounded bg-white p-3 mb-3 textCenterIfMobile">
                        <div class="col-md-3 mb-3 mb-md-0 text-center">
                            <?php
                                if ($search->getPoster() == "") {
                                    echo '<img src="../images/no-poster.png" class="poster-size rounded"/>';
                                } else {
                                    $poster = $search->getPoster();
                                    if($search->getMediaType() === 'tv') {
                                        $mediaType = 'TV Show';
                                        $itemName = $search->getName();
                                    }
                                    else if ($search->getMediaType() === 'movie') {
                                        $mediaType = 'Movie';
                                        $itemName = $search->getTitle();
                                    }
                                    echo '<a href="' . 
                                            '../item/index.php?objectID='. 
                                            $search->getID() . '&mediatype=' . $mediaType .
                                            '"><img src="' .
                                    'https://image.tmdb.org/t/p/original' .
                                    $poster .
                                    '" class="poster-size rounded"/></a>'; }
                            
                            ?>
                        </div>
                        <div class="col-md-9">
                            <?php 
                                $queryCurrentlyWatching = "SELECT name, objectID, season, episode, streamingService, type FROM listItems WHERE userID='".$_SESSION['userID']."' AND objectID='".$row['objectID']."' AND listID=1";
                                $currentlyWatchingFullResult = mysqli_query($conn, $queryCurrentlyWatching);
                                $fetchCurrentlyWatchingFullResult = mysqli_fetch_array($currentlyWatchingFullResult);
                            ?>
                            <h4><?php echo $row['name']; ?></h4>
                            <p>
                                <?php 
                                    if (mysqli_num_rows($currentlyWatchingFullResult) > 0) {
                                        echo "<p>";
                                        if ($fetchCurrentlyWatchingFullResult['streamingService'] != "" && $fetchCurrentlyWatchingFullResult['type'] == 2 && $fetchCurrentlyWatchingFullResult['season'] != 0 && $fetchCurrentlyWatchingFullResult['episode'] != 0) { 
                                            echo "Watching on " . $fetchCurrentlyWatchingFullResult['streamingService'] . " | " . "Season " . $fetchCurrentlyWatchingFullResult['season'] . ", Episode " . $fetchCurrentlyWatchingFullResult['episode']; 
                                        } else {
                                            if ($fetchCurrentlyWatchingFullResult['streamingService'] != "") echo "Watching on " . $fetchCurrentlyWatchingFullResult['streamingService'];
                                            if ($fetchCurrentlyWatchingFullResult['type'] == 2 && $fetchCurrentlyWatchingFullResult['season'] != 0 && $fetchCurrentlyWatchingFullResult['episode'] != 0){
                                                echo "Season " . $fetchCurrentlyWatchingFullResult['season'] . ", Episode " . $fetchCurrentlyWatchingFullResult['episode'];
                                            }
                                        }
                                        echo "</p>";
                                    }
                                    echo '<small>' . $search->getOverview() . "</small>";
                                ?>
                            </p>
                            <?php
                                echo '<form method="post">';
                                
                                // Favorite button
                                $userID = $_SESSION['userID'];
                                $obj = $search->getID();
                                $type = $row['type'];
                                $sql = "SELECT * FROM listItems WHERE userID = $userID AND objectID = '" . $obj . "' AND listID = 3";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result) == 0) {
                                    ?>
                                    <a id="<?php echo $obj?>-fav" class="btn btn-light mb-1 me-1" onclick="update(<?php echo $obj ?>,<?php echo $type?>,1,`<?php echo $obj?>-fav`,3);">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart btn-icons" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                        </svg>
                                        <span class="btn-text">Favorite</span>
                                    </a>
                                    <?php
                                }

                                // Unfavorite button
                                if(mysqli_num_rows($result) > 0) {
                                    ?>
                                    <a id="<?php echo $obj?>-unfav" class="btn btn-light mb-1 me-1" onclick="update(<?php echo $obj ?>,<?php echo $type?>,2,`<?php echo $obj?>-unfav`);">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart-fill btn-icons"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                        <span class="btn-text">Unfavorite</span>
                                    </a>
                                    <?php
                                }
                            ?>

                            <script>
                            function update(objectID,type,ft,id,lID) {
                                $.ajax({
                                    type:'POST',
                                    url: 'index.php',
                                    data: { objectID: objectID, type: type, ft: ft, lID: lID},
                                    error: function () {
                                        console.log(fail)
                                    }
                                });
                                if (ft == 1) {
                                    $(`#${id}`).replaceWith(`<a id="${objectID}-unfav" class="btn btn-light mb-1 me-1" onclick="update(${objectID},${type},2,'${objectID}-unfav');"> <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart-fill btn-icons" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" /></svg> <span class="btn-text">Unfavorite</span></a>`)
                                } else {
                                    $(`#${id}`).replaceWith(`<a id="${objectID}-fav" class="btn btn-light mb-1 me-1" onclick="update(${objectID},${type},1,'${objectID}-fav',3);"> <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart btn-icons" viewBox="0 0 16 16"><path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></svg> <span class="btn-text">Favorite</span></a>`)
                                }
                            }
                            </script>

                            <?php
                            if($search->getMediaType() === 'tv') {
                                $mediaType = 'TV Show';
                                $itemName = $search->getName();
                            }
                            else if ($search->getMediaType() === 'movie') {
                                $mediaType = 'Movie';
                                $itemName = $search->getTitle();
                            }
                            echo '<a href="' . 
                                            '../item/index.php?objectID='. 
                                            $obj . '&mediatype=' . $mediaType .
                                            '" class="btn btn-light mb-1 me-1 rounded text-center"/>';
                            echo "Go to " . $mediaType;
                            echo "</a>";
                            ?>
                        </div></div>
                        
                        <?php
                            }
                           }
                        }
                        ?>    
                        </div>
            <?php
                }
            ?>
        </div>
    </div>
    <?php include "../footer.php" ?>
</body>

</html>