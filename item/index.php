<?php session_start(); ?>
<?php
include "../dbinfo.php";
$objectID = $_GET['objectID'];
$getCurrentlyWatchingInfo = "SELECT * FROM listItems WHERE userID = '" . $_SESSION['userID'] . "' AND objectID = '" . $objectID . "' AND listID = 1";
$resultCurrentlyWatchingInfo = mysqli_query($conn, $getCurrentlyWatchingInfo);
if (mysqli_num_rows($resultCurrentlyWatchingInfo) > 0) {
    $resultCurrentlyWatchingInfoArray = mysqli_fetch_array($resultCurrentlyWatchingInfo);
    $selectedStreamingServiceLogo = NULL;
    $selectedStreamingService = $resultCurrentlyWatchingInfoArray['streamingService'];
    if ($selectedStreamingService == "Netflix") {
        $selectedStreamingServiceLogo = "../images/logos/netflix.png";
    } else if ($selectedStreamingService == "Hulu") {
        $selectedStreamingServiceLogo = "../images/logos/hulu.png";
    } else if ($selectedStreamingService == "Disney+") {
        $selectedStreamingServiceLogo = "../images/logos/disneyplus.png";
    } else if ($selectedStreamingService == "HBO Max") {
        $selectedStreamingServiceLogo = "../images/logos/hbomax.png";
    } else if ($selectedStreamingService == "Prime Video") {
        $selectedStreamingServiceLogo = "../images/logos/primevideo.png";
    } else if ($selectedStreamingService == "Paramount+") {
        $selectedStreamingServiceLogo = "../images/logos/paramountplus.png";
    } else if ($selectedStreamingService == "Discovery+") {
        $selectedStreamingServiceLogo = "../images/logos/discoveryplus.png";
    } else if ($selectedStreamingService == "Apple TV+") {
        $selectedStreamingServiceLogo = "../images/logos/appletvplus.png";
    } else if ($selectedStreamingService == "Peacock") {
        $selectedStreamingServiceLogo = "../images/logos/peacock.png";
    } else if ($selectedStreamingService == "Showtime") {
        $selectedStreamingServiceLogo = "../images/logos/showtime.png";
    } else if ($selectedStreamingService == "Starz") {
        $selectedStreamingServiceLogo = "../images/logos/starz.png";
    } else if ($selectedStreamingService == "ESPN+") {
        $selectedStreamingServiceLogo = "../images/logos/espnplus.png";
    } else if ($selectedStreamingService == "YouTube Premium") {
        $selectedStreamingServiceLogo = "../images/logos/youtubepremium.png";
    } else if ($selectedStreamingService == "Other") {
        $selectedStreamingServiceLogo = "../images/logos/other.png";
    } else {
        $selectedStreamingServiceLogo = "../images/logos/select.png";
    }
}

  $notSignedIn = 0;
  if ($_SESSION['userID'] == NULL) {
    $notSignedIn = 1;
  }
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    require('../tmdb_v3-PHP-API--master/tmdb-api.php');
    $tmdb = new TMDB();
    $tmdb->setAPIKey('1ef601ddfcc2248eda53874c4027c1b5');
    $objectID = $_GET['objectID'];
    $mediatype = $_GET['mediatype'];
    if (strcasecmp($mediatype, "movie") == 0) {
        $program = $tmdb->getMovie($objectID);
        $ITEM_NAME = $program->getTitle(); 
    } else if(strcasecmp($mediatype, "tv show") == 0) {
        $program = $tmdb->getTVShow($objectID);
        $ITEM_NAME = $program->getName();
    }
    if ($ITEM_NAME == "") {
        header("Location: ../page-not-found.html");
    }
    echo '<title>' . $ITEM_NAME .' | Streamable</title>';
    ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        @media (max-width: 576px) {
            .item-poster-size {
                max-width: 150px;
                height: auto;
            }
        }
        @media (max-width: 768px) {
            .hero-size {
                /* height: 500px; */
            }

            .hero-name {
                font-size: 3rem;
            }

            .textCenterIfMobile {
                text-align: center;
            }

            /* .item-poster-size {
                max-width: 150px;
                min-width: 150px;
                max-height: 225px;
                min-height: 225px;
            } */

            .btn-text {
                display: none;
            }
        }

        @media (min-width: 768px) {
            .hero-size {
                /* height: 500px; */
            }

            .hero-name {
                font-size: 5rem;
            }

            /* .item-poster-size {
                max-width: 300px;
                min-width: 300px;
                max-height: 450px;
                min-height: 450px;
                // max-width: 250px;
                // min-width: 250px;
                // max-height: 375px;
                // min-height: 375px; 
            } */
        }

        @media (max-width: 800px) {
            .hero-name {
                font-size: 3rem;
            }
        }

        @media (max-width: 1000px) {
            .btn-text {
                display: none;
            }
        }

        .item-poster-size {
            width: 100%;
            height: auto;
        }

        .hero {
            <?php
            $objectID = $_GET['objectID'];
            $mediatype = $_GET['mediatype'];
            if (strcasecmp($mediatype, "movie") == 0) {
                $program = $tmdb->getMovie($objectID);
                $ITEM_BG = $program->getPoster();
                $startlink = "https://image.tmdb.org/t/p/original" . $ITEM_BG ;
            } else if(strcasecmp($mediatype, "tv show") == 0) {
                $program = $tmdb->getTVShow($objectID);
                $ITEM_BG = $program->getBackdrop();
                $startlink = "https://image.tmdb.org/t/p/original" . $ITEM_BG ;
            }
            ?>
            background: #000 url('<?php echo $startlink; ?>') center; 
            background-size: cover;
        }
        
        .hero-info {
            height: 90%;
        }

        .hero-buttons {
            height: 10%;
        }

        .darken {
            background: rgba(0, 0, 0, .75);
        }

        .box-shadow {
            box-shadow: 0 0 20px rgba(0, 0, 0, .025);
        }

        .streamingServiceLogo {
            width: 10rem;
        }

        select#streamingService {
            /* width: 100%; */
            height: 10rem;
            background: url('<?php echo $selectedStreamingServiceLogo;?>') no-repeat center;
            background-size: 40%;
            color: transparent;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div id="top"></div>
    <?php include "../navbar.php"; ?>
    <div class="hero w-100 text-white bg-dark d-flex flex-column mb-3 hero-size">
        <div class="darken w-100 d-flex flex-column h-100">
            <div class="container mt-auto mb-auto pt-5 pb-5">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 col-xl-3 textCenterIfMobile">
                        <?php    
                            $objectID = $_GET['objectID'];
                            if (strcasecmp($mediatype, "movie") == 0) {
                                $program = $tmdb->getMovie($objectID);
                                $ITEM_POSTER = $program->getPoster();
                                if ($ITEM_POSTER == "") {
                                    echo '<img src="../images/no-poster.png" class="item-poster-size rounded">';
                                } else {
                                    echo '<img src="' . 'https://image.tmdb.org/t/p/original' . $ITEM_POSTER .  '" class="item-poster-size rounded">' ;
                                }
                            } else if(strcasecmp($mediatype, "tv show") == 0) {
                                $program = $tmdb->getTVShow($objectID);
                                $ITEM_POSTER = $program->getPoster();
                                if ($ITEM_POSTER == "") {
                                    echo '<img src="../images/no-poster.png" class="item-poster-size rounded">';
                                } else {
                                    echo '<img src="' . 'https://image.tmdb.org/t/p/original' . $ITEM_POSTER .  '" class="item-poster-size rounded">' ;
                                }
                            }
                        ?>
                    </div>
                    <div class="col-sm-6 col-lg-8 col-xl-9 textCenterIfMobile">
                        <div class="row hero-info">
                            <div class="col mt-auto mb-auto">
                                <?php
                                    $objectID = $_GET['objectID']; 
                                    if (strcasecmp($mediatype, "movie") == 0) {
                                        $program = $tmdb->getMovie($objectID);
                                        $ITEM_NAME = $program->getTitle();
                                        $ITEM_OVERVIEW = $program->getOverview();
                                        echo '<h1 class="hero-name">' . $ITEM_NAME . '</h1>';
                                        echo '<p class="pb-3">' . $ITEM_OVERVIEW .'</p>';
                                    } else if(strcasecmp($mediatype, "tv show") == 0) {
                                        $program = $tmdb->getTVShow($objectID);
                                        $ITEM_NAME = $program->getName();
                                        $ITEM_OVERVIEW = $program->getOverview();
                                        echo '<h1 class="hero-name">' . $ITEM_NAME . '</h1>';
                                        echo '<p class="pb-3">' . $ITEM_OVERVIEW .'</p>';
                                    }
                                ?>
                            </div>
                        </div>
                        <?php if (!$notSignedIn) {?>
                            <div class="row hero-buttons">
                                <div class="col">
                                    <?php include '../dbinfo.php';
                                    echo '<form method="post" onsubmit="setTimeout(function(){window.location.reload();}, 50);">';
                                    
                                    // Favorite button
                                    $userID = $_SESSION['userID'];
                                    $name = str_replace("'", "''", $ITEM_NAME);
                                    $sql = "SELECT * FROM listItems WHERE userID = $userID AND objectID = '" . $objectID . "' AND listID = 3";
                                    $result = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($result) == 0) {
                                        echo '<button class="btn btn-light mb-1 me-2" name= "favorite">';
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart"';
                                                echo 'viewBox="0 0 16 16" height="1rem" width="1rem">';
                                                echo '<path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />';
                                            echo '</svg>';
                                            echo '<span class="btn-text"> Favorite</span>';
                                        echo '</button>';
                                    }

                                    // Unfavorite button
                                    if(mysqli_num_rows($result) > 0) {
                                        echo '<button class="btn btn-light mb-1 me-2" name = "unfavorite">';
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart-fill"';
                                                echo 'viewBox="0 0 16 16" width="1rem" height="1rem">';
                                                echo '<path fill-rule="evenodd"';
                                                    echo 'd="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />';
                                            echo '</svg>';
                                            echo '<span class="btn-text"> Unfavorite</span>';
                                        echo '</button>';
                                    }

                                    // Currently Watching button
                                    $ssql = "SELECT * FROM listItems WHERE userID = $userID AND objectID = '" . $objectID . "' AND listID = 1";
                                    $rresult = mysqli_query($conn, $ssql);
                                    if(mysqli_num_rows($rresult) == 0) {
                                    echo '<button class="btn btn-light mb-1 me-2" name = "currentlywatching">';
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"';
                                            echo 'class="bi bi-collection-play" viewBox="0 0 16 16" width="1rem" height="1rem">';
                                            echo '<path d="M2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1zm2.765 5.576A.5.5 0 0 0 6 7v5a.5.5 0 0 0 .765.424l4-2.5a.5.5 0 0 0 0-.848l-4-2.5z" />';;
                                            echo '<path d="M1.5 14.5A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zm13-1a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-.5-.5h-13A.5.5 0 0 0 1 6v7a.5.5 0 0 0 .5.5h13z" />';
                                        echo '</svg>';
                                        echo '<span class="btn-text"> Mark Currently Watching</span>';
                                    echo '</button>';
                                    }
                                    
                                    // Remove from currently watching
                                    if(mysqli_num_rows($rresult) > 0) {
                                    echo '<button class="btn btn-light mb-1 me-2" name= "rmcw">';
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"';
                                            echo 'class="bi bi-collection-play-fill" viewBox="0 0 16 16" width="1rem"';
                                            echo 'height="1rem">';
                                            echo '<path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm6.258-6.437a.5.5 0 0 1 .507.013l4 2.5a.5.5 0 0 1 0 .848l-4 2.5A.5.5 0 0 1 6 12V7a.5.5 0 0 1 .258-.437z" />';
                                        echo '</svg>';
                                        echo '<span class="btn-text"> Remove from Currently Watching</span>';
                                    echo '</button>';
                                    }
                                    
                                    // Add to watchlist
                                    $sssql = "SELECT * FROM listItems WHERE userID = $userID AND objectID = '" . $objectID . "' AND listID = 2";
                                    $rrresult = mysqli_query($conn, $sssql);
                                    if(mysqli_num_rows($rrresult) == 0 && mysqli_num_rows($resultCurrentlyWatchingInfo) == 0) {
                                    echo '<button class="btn btn-light mb-1 me-2" name= "watchlist">';
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bookmark"';
                                            echo 'viewBox="0 0 16 16" width="1rem" height="1rem">';
                                            echo '<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />';
                                        echo '</svg>';
                                        echo '<span class="btn-text"> Add to Watchlist</span>';
                                    echo '</button>';
                                    }
                                    // Remove from watchlist
                                    if(mysqli_num_rows($rrresult) > 0) {
                                    echo '<button class="btn btn-light mb-1 me-2" name="rmwatchlist">';
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"';
                                            echo 'class="bi bi-bookmark-fill" viewBox="0 0 16 16" width="1rem" height="1rem">';
                                            echo '<path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z" />';  
                                        echo '</svg>';
                                        echo '<span class="btn-text"> Remove from Watchlist</span>';
                                    echo '</button>';
                                    }
                                    echo '</form>';

                                    if ($conn->connect_error) {
                                        echo "<div class='alert alert-danger mt-3' role='alert'>";
                                        die("Connection failed: " . $conn->connect_error);
                                        echo "</div>";
                                    }
                                    ////////////////////////////////
                                    // ADD TO FAVORITES
                                    if(isset($_POST['favorite'])) {
                                        $userID = $_SESSION['userID'];
                                        $type = $_GET['mediatype'];
                                        if (strcasecmp($type, "movie") == 0) {
                                            $type = 1;
                                        } else if(strcasecmp($type, "tv show") == 0) {
                                            $type = 2;
                                        }
                                        $name = str_replace("'", "''", $ITEM_NAME);
                                        $listID = 3;
                                        $objectID = $_GET['objectID'];
                                        $query = "INSERT INTO listItems (userID, name, listID, objectID, type, progress, streamingService, season, episode) VALUES ($userID, '$name', $listID, $objectID, $type, '', '', 0, 0)";
                                        $conn->query($query);                                   
                                    }
                                    // REMOVE FROM FAVORITES
                                    if(isset($_POST['unfavorite'])) {
                                        $userID = $_SESSION['userID'];
                                        $name = str_replace("'", "''", $ITEM_NAME);
                                        $listID = 3;
                                        $qquery = "DELETE FROM listItems where userID = $userID AND listID = $listID AND objectID = '" . $objectID ."' ";
                                        $conn->query($qquery);
                                                                        
                                    }
                                    // ADD TO CURRENTLY WATCHING
                                    if(isset($_POST['currentlywatching'])) {
                                        $userID = $_SESSION['userID'];
                                        $type = $_GET['mediatype'];
                                        if (strcasecmp($type, "movie") == 0) {
                                            $type = 1;
                                        } else if(strcasecmp($type, "tv show") == 0) {
                                            $type = 2;
                                        }
                                        $name = str_replace("'", "''", $ITEM_NAME);
                                        $listID = 1;
                                        $objectID = $_GET['objectID'];
                                        $wquery = "INSERT INTO listItems (userID, name, listID, objectID, type, progress, streamingService, season, episode) VALUES ($userID, '$name', $listID, $objectID, $type, '', '', 0, 0)";
                                        $wremovequery = "DELETE FROM listItems where userID = $userID AND listID = 2 AND objectID = '" . $objectID ."' ";
                                        $conn->query($wremovequery);
                                        $conn->query($wquery);                                   
                                    }
                                    // REMOVE FROM CURRENTLY WATCHING
                                    if(isset($_POST['rmcw'])) {
                                        $userID = $_SESSION['userID'];
                                        $name = str_replace("'", "''", $ITEM_NAME);
                                        $listID = 1;
                                        $wwquery = "DELETE FROM listItems where userID = $userID AND listID = $listID AND objectID = '" . $objectID ."' ";
                                        $conn->query($wwquery);
                                    }
                                    // ADD TO WATCHLIST
                                    if(isset($_POST['watchlist'])) {
                                        $userID = $_SESSION['userID'];
                                        $type = $_GET['mediatype'];
                                        if (strcasecmp($type, "movie") == 0) {
                                            $type = 1;
                                        } else if(strcasecmp($type, "tv show") == 0) {
                                            $type = 2;
                                        }
                                        $name = str_replace("'", "''", $ITEM_NAME);
                                        $listID = 2;
                                        $objectID = $_GET['objectID'];
                                        $lquery = "INSERT INTO listItems (userID, name, listID, objectID, type, progress, streamingService, season, episode) VALUES ($userID, '$name', $listID, $objectID, $type, '', '', 0, 0)";
                                        $conn->query($lquery);                                   
                                    }
                                    // REMOVE FROM WATCHLIST
                                    if(isset($_POST['rmwatchlist'])) {
                                        $userID = $_SESSION['userID'];
                                        $name = str_replace("'", "''", $ITEM_NAME);
                                        $listID = 2;
                                        $lquery = "DELETE FROM listItems where userID = $userID AND listID = $listID AND objectID = '" . $objectID ."' ";
                                        $conn->query($lquery);
                                    }
                                    //$conn->close();
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php if (mysqli_num_rows($resultCurrentlyWatchingInfo) > 0) { ?>
            <div class="row">
                <div class="col-md rounded bg-white box-shadow text-center mb-3 me-3" style="padding: 20px;">
                    <form method="post" onsubmit="setTimeout(function(){window.location.reload();},50);">
                        <div class="form-floating mx-auto mb-2">
                            <select type="text" class="form-select" id="streamingService" name="streamingService">
                                <?php
                                if (strcasecmp($mediatype, "movie") == 0) {
                                    $providerArray = $tmdb->getMovieProvider($objectID);
                                } else if(strcasecmp($mediatype, "tv show") == 0) {
                                    $providerArray = $tmdb->getTVShowProvider($objectID);
                                }
                                $provider = "/";
                                foreach ($providerArray as $prov) {
                                    $provider .= $prov . "/";
                                }
                                $provider = strtoupper($provider);

                                echo '<option selected disabled>Select</option>';
                                if (strpos($provider, 'NETFLIX') !== false) {
                                    echo '<option value="Netflix"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Netflix") { echo "selected"; };
                                    echo '>Netflix</option>';
                                }
                                if (strpos($provider, 'HULU') !== false) {
                                    echo '<option value="Hulu"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Hulu") { echo "selected"; };
                                    echo '>Hulu</option>';
                                }
                                if (strpos($provider, 'DISNEY PLUS') !== false) {
                                    echo '<option value="Disney+"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Disney+") { echo "selected"; };
                                    echo '>Disney+</option>';
                                }
                                if (strpos($provider, 'HBO MAX') !== false) {
                                    echo '<option value="HBO Max"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "HBO Max") { echo "selected"; };
                                    echo '>HBO Max</option>';
                                }
                                if (strpos($provider, 'AMAZON') !== false) {
                                    echo '<option value="Prime Video"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Prime Video") { echo "selected"; };
                                    echo '>Prime Video</option>';
                                }
                                if (strpos($provider, 'PARAMOUNT') !== false) {
                                    echo '<option value="Paramount+"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Paramount+") { echo "selected"; };
                                    echo '>Paramount+</option>';
                                }
                                if (strpos($provider, 'DISCOVERY') !== false) {
                                    echo '<option value="Discovery+"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Discovery+") { echo "selected"; };
                                    echo '>Discovery+</option>';
                                }
                                if (strpos($provider, 'APPLE') !== false) {
                                    echo '<option value="Apple TV+"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Apple TV+") { echo "selected"; };
                                    echo '>Apple TV+</option>';
                                }
                                if (strpos($provider, 'PEACOCK') !== false) {
                                    echo '<option value="Peacock"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Peacock") { echo "selected"; };
                                    echo '>Peacock</option>';
                                }
                                if (strpos($provider, 'SHOWTIME') !== false) {
                                    echo '<option value="Showtime"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Showtime") { echo "selected"; };
                                    echo '>Showtime</option>';
                                }
                                if (strpos($provider, 'STARZ') !== false) {
                                    echo '<option value="Starz"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Starz") { echo "selected"; };
                                    echo '>Starz</option>';
                                }
                                if (strpos($provider, 'ESPN') !== false) {
                                    echo '<option value="ESPN+"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "ESPN+") { echo "selected"; };
                                    echo '>ESPN+</option>';
                                }
                                if (strpos($provider, 'YOUTUBE') !== false) {
                                    echo '<option value="YouTube Premium"';
                                    if ($resultCurrentlyWatchingInfoArray['streamingService'] == "YouTube Premium") { echo "selected"; };
                                    echo '>YouTube Premium</option>';
                                }
                                echo '<option value="Other"';
                                if ($resultCurrentlyWatchingInfoArray['streamingService'] == "Other") { echo "selected"; };
                                echo '>Other</option>';
                                ?>
                            </select>
                            <label for="streamingService">Watching on</label>
                        </div>
                        <button class="btn btn-dark w-100" name= "changeStreamService">Change Streaming Service</button>
                        <?php include '../dbinfo.php';
                        if(isset($_POST['changeStreamService'])) {
                        $userID = $_SESSION['userID'];
                        $name = str_replace("'", "''", $ITEM_NAME);
                        $userID = $_SESSION['userID'];
                        $value = $_POST['streamingService'];
                        $chgquery = "UPDATE listItems SET streamingService = '" . $value . "' WHERE userID = $userID AND listID = 1 AND objectID = '" . $objectID . "' ";
                        $conn->query($chgquery);
                        }
                        ?> 
                    </form>
                </div>
                <div class="col-md rounded bg-white box-shadow text-center mb-3" style="padding: 20px;">
                    <form method="post" onsubmit="setTimeout(function(){window.location.reload();},150);">
                        <h2 class="mb-3">Streaming Progress</h2>
                        <?php
                        if(strcasecmp($mediatype, "tv show") == 0) {
                            $tvshow = $program;
                            $numSeasons = $tvshow->getNumSeasons();
                        ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mx-auto mb-3">
                                    <select type="text" class="form-select" id="season" name="season">
                                        <?php
                                        for ($i=1; $i <= $numSeasons; $i++) { 
                                            $season = $tmdb->getSeason($tvshow->getID(), $i);
                                            $numEpisodes = $season->getNumEpisodes();
                                            ?>
                                            <option numEps="<?php echo $numEpisodes?>" value="<?php echo $i?>" <?php if($resultCurrentlyWatchingInfoArray['season'] == $i ) { echo "selected"; } ?>><?php echo $i?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="season">Season</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mx-auto mb-3">
                                    <select type="text" class="form-select" id="episode" name="episode">
                                        <?php
                                        if ($resultCurrentlyWatchingInfoArray['season'] > 0 && $resultCurrentlyWatchingInfoArray['episode'] > 0) {
                                            $seasonNum = $resultCurrentlyWatchingInfoArray['season'];
                                            $season = $tmdb->getSeason($_GET['objectID'],$seasonNum);
                                            $numEpisodes = $season->getNumEpisodes();
                                            for ($i=1; $i <= $numEpisodes; $i++) { 
                                                ?>
                                                <option value="<?php echo $i?>" <?php if($resultCurrentlyWatchingInfoArray['episode'] == $i ) { echo "selected"; } ?>><?php echo $i?></option>
                                                <?php
                                            }
                                        } else {
                                            $season = $tmdb->getSeason($tvshow->getID(), 1);
                                            $numEpisodes = $season->getNumEpisodes();
                                            for ($i=1; $i <= $numEpisodes; $i++) { 
                                                ?>
                                                <option value="<?php echo $i?>" <?php if($resultCurrentlyWatchingInfoArray['episode'] == $i ) { echo "selected"; } ?>><?php echo $i?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="episode">Episode</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"><button class="btn btn-dark w-100 mb-3" name="updateprogress">Update Progress</button></div>
                            <div class="col-6"><button class="btn btn-dark w-100" name="markcomplete">Mark Complete</button></div>
                        </div>
                        <?php
                        } else if(strcasecmp($mediatype, "movie") == 0) { ?>
                            <div class="row">
                                <div class="col"><button class="btn btn-dark w-100" name="markcomplete">Mark Complete</button></div>
                            </div>
                        <?php }
                        // Updating season and episode
                        if(isset($_POST['updateprogress'])) {
                        $userID = $_SESSION['userID'];
                        $name = str_replace("'", "''", $ITEM_NAME);
                        $epivalue = $_POST['episode'];
                        $seavalue = $_POST['season'];

                        $upquery = "UPDATE listItems SET episode = '" . $epivalue . "' WHERE userID = $userID AND listID = 1 AND objectID = '" . $objectID . "' ";
                        $conn->query($upquery);
                        $upquery2 = "UPDATE listItems SET season = '" . $seavalue . "' WHERE userID = $userID AND listID = 1 AND objectID = '" . $objectID . "' ";
                        $conn->query($upquery2);

                        }
                        // Mark complete
                        if(isset($_POST['markcomplete'])) { // TODO: implement button functionality for marking complete (remove from currently watching and add to history list)
                            $userID = $_SESSION['userID'];
                            $name = str_replace("'", "''", $ITEM_NAME);
                            $type = $_GET['mediatype'];
                            if (strcasecmp($type, "movie") == 0) {
                                $type = 1;
                            } else if(strcasecmp($type, "tv show") == 0) {
                            $type = 2;
                            }
                            $listID = 4;
                            $addToHistoryQuery = "INSERT INTO listItems (userID, name, listID, objectID, type, progress, streamingService, season, episode) VALUES ($userID, '$name', $listID , $objectID, $type, '', '', 0, 0)";
                            // $query = "INSERT INTO listItems (userID, name, listID, objectID, type, progress, streamingService, season, episode) VALUES ($userID, '$name', $listID, $objectID, $type, '', '', 0, 0)";
                            $conn->query($addToHistoryQuery);
                            $removeFromCurrentlyWatchingQuery = "DELETE FROM listItems where userID = $userID AND listID = 1 AND objectID = $objectID";
                            $conn->query($removeFromCurrentlyWatchingQuery);
                        }
                        ?>
                        
                    </form>
                </div>
            </div>
        <?php } ?>
        <div class="row rounded bg-white box-shadow mb-3" style="padding: 20px;">
            <h3>Details</h3>
            <p>
                <?php
                if (strcasecmp($mediatype, "movie") == 0) {
                    $providerArray = $tmdb->getMovieProvider($objectID);
                    $program = $tmdb->getMovie($objectID);
                    $RELEASE_DATE = $program->getReleaseDate();
                    $DURATION = $program->getRuntime();
                    $Revenue = "$". $program->getRevenue();
                    $Score = $program->getVoteAverage();
                    if (strcmp($Revenue, "$0") == 0) {
                        $Revenue = "Not available";
                    } else {
                        $Revenue = "$" . number_format($program->getRevenue(), 0, ".", ",");
                    }
                    $BUDGET = "$" . $program->getBudget();
                    if (strcmp($BUDGET, "$0") == 0) {
                        $BUDGET = "Not available";
                    } else {
                        $BUDGET = "$" . number_format($program->getBudget(), 0, ".", ",");
                    }
                    // $provider = "";
                    // foreach ($providerArray as $prov) {
                    //     $provider .= $prov . "    ";
                    // }
                    // $provider = strtoupper($provider);
                    echo '<b>Overview: </b>'; if ($program->getOverview() == NULL) { echo "Not available"; } else { echo $program->getOverview(); };
                    echo '<br><b>Release Date: </b>'; if ($RELEASE_DATE == NULL) { echo "Not available"; } else { echo $RELEASE_DATE; };
                    echo '<br><b>Audience Score: </b>'; if ($Score == NULL) { echo "Not available"; } else { echo $Score . '/10'; };
                    echo '<br><b>Duration: </b>'; if ($DURATION == NULL) { echo "Not available"; } else { echo $DURATION . " minutes"; };
                    echo '<br><b>Genres: </b>';
                    $genres = $program->getGenres();
                    if ($genres == NULL) { echo "Not available"; } else {
                        $genresi = 0;
                        foreach ($genres as $genre) {
                            $genresi++;
                            if ($genresi == sizeof($genres)) {
                                echo $genre->getName();
                            } else {
                                echo $genre->getName() . ', ';
                            }
                        }
                    }
                    echo '<br><b>Available On: </b>';
                    if ($providerArray == NULL) {
                        echo 'Not available';
                    } else {
                        $provideri = 0;
                        foreach ($providerArray as $prov) {
                            $provideri++;
                            if ($provideri == sizeof($providerArray)) {
                                echo $prov;
                            } else {
                                echo $prov . ', ';
                            }
                            // $provider .= $prov . "    ";
                        }
                    }
                    echo '<br><b>Revenue: </b>'; echo $Revenue;
                    echo '<br><b>Budget: </b>'; echo $BUDGET;
                    echo '<br><b>Cast: </b>';
                    $cast = $program->getCast();
                    if ($cast == NULL) { echo "Not available"; } else {
                        $casti = 0;
                        foreach ($cast as $person) {
                            $casti++;
                            if ($casti == sizeof($cast)) {
                                echo $person->getName();
                            } else {
                                echo $person->getName() . ', ';
                            }
                        }
                    }
                } else if(strcasecmp($mediatype, "tv show") == 0) {
                    $providerArray = $tmdb->getTVShowProvider($objectID);
                    $program = $tmdb->getTVShow($objectID);
                    $NUMSEASONS = $program->getNumSeasons();
                    $NUMEPISODES = $program->getNumEpisodes();
                    $RELEASE = $program->getFirstAirDate();
                    $STATUS = $program->getStatus();
                    // $provider = "";
                    // $provider = strtoupper($provider);
                    // echo '<b>Number of Seasons: </b>'; echo $providerArray[0];
                    echo '<b>Overview: </b>'; if ($program->getOverview() == NULL) { echo "Not available"; } else { echo $program->getOverview(); };
                    echo '<br><b>Number of Seasons: </b>'; if ($NUMSEASONS == NULL) { echo "Not available"; } else { echo $NUMSEASONS; };
                    echo '<br><b>Number of Episodes: </b>'; if ($NUMEPISODES == NULL) { echo "Not available"; } else { echo $NUMEPISODES; };
                    echo '<br><b>Genres: </b>';
                    $genres = $program->getGenres();
                    if ($genres == NULL) { echo "Not available"; } else {
                        $genresi = 0;
                        foreach ($genres as $genre) {
                            $genresi++;
                            if ($genresi == sizeof($genres)) {
                                echo $genre->getName();
                            } else {
                                echo $genre->getName() . ', ';
                            }
                        }
                    }
                    echo '<br><b>Available On: </b>';
                    if ($providerArray == NULL) {
                        echo 'Not available';
                    } else {
                        $provideri = 0;
                        foreach ($providerArray as $prov) {
                            $provideri++;
                            if ($provideri == sizeof($providerArray)) {
                                echo $prov;
                            } else {
                                echo $prov . ', ';
                            }
                            // $provider .= $prov . "    ";
                        }
                    }
                    echo '<br><b>Release Date: </b>'; if ($RELEASE == NULL) { echo "Not available"; } else { echo $RELEASE; };
                    echo '<br><b>Production Status: </b>'; if ($STATUS == NULL) { echo "Not available"; } else { echo $STATUS; };
                    echo '<br><b>Cast: </b>';
                    $cast = $program->getCast();
                    if ($cast == NULL) { echo "Not available"; } else {
                        $casti = 0;
                        foreach ($cast as $person) {
                            $casti++;
                            if ($casti == sizeof($cast)) {
                                echo $person->getName();
                            } else {
                                echo $person->getName() . ', ';
                            }
                        }
                    }
                }
                ?>
            </p>
        </div>
    </div>
    <?php include "../footer.php"; ?>
</body>
<script>
$("#season").on('change', function() {
    let numEpisodes = parseInt($(this).find(":selected")[0].getAttribute("numEps"));
    $("#episode").empty();
    for (let i = 1; i <= numEpisodes; i++) {
        $("#episode").append(`<option value="${i}">${i}</option>`)
    }
});
</script>
</html>