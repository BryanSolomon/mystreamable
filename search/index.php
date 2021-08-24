<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
            crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>

        <title>Search | Streamable</title>
        <style>
        @media (max-width: 768px) {
            .hero-size {
                height: 300px;
            }
            .poster-size {
                width: 150px;
            }
        }

        @media (min-width: 768px) {
            .hero-size {
                height: 400px;
            }
            .poster-size {
                width: 125px;
            }
        }
        
        @media (max-width: 12000px) {
            .title-text {
                font-size: 3rem;
            }
        }
        @media (min-width: 1200px) {
            .title-text {
                font-size: 5rem;
            }
        }

        .hero {
            background: #000 url('../images/movie-show-collage-darken-85.png') no-repeat top center;
            background-size: cover;
        }

        .blue-btn {
            /* background: rgba(255, 255, 255, .85); */
            background:
                /*#941dff*/
                #1dadff;
            color: #fff;
        }
        .blue-btn:hover {
            /* background: #fff; */
            color: #fff;
        }
        .search-result {
            padding: 1rem;
            color: #000;
            text-decoration: none;
        }
        .search-result:hover, .search-result:visited {
            color: #000;
        }
        </style>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    </head>

  <body class="bg-light <?php if (!isset($_POST['submit'])) { echo "overflow-hidden"; } ?>">
        <div id="top"></div>
        <?php include "../navbar.php"; ?>
        <div class="hero w-100 d-flex flex-column <?php if (isset($_POST['submit'])) { echo "hero-size"; } else { echo "vh-100"; } ?>">
            <div class="container mt-auto mb-auto text-center h-75">
                <h1 class="text-white title-text mb-5">
                    Search
                </h1>
                <form id="search" method="post" action="index.php">
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" placeholder="Search..." name="search" id="search" value="<?php if (isset($_POST['search'])) { echo $_POST['search']; } ?>" required>
                        <label for="search">Search...</label>
                    </div>
                    <button type="submit" name="submit" class="btn blue-btn">Search Streamable</button>
                </form>
            </div>
        </div>
        <?php if(isset($_POST['submit'])) { ?>
        <div class="container mt-3">
            <!-- <form id="search" method="post" action="index.php"> -->
                <div class="row mb-3 justify-content-center">
                    <?php if(isset($_POST['submit'])) { ?>
                        <h4 class="text-center mb-3">Showing results for: <span class="text-muted"><?php echo $_POST['search']; ?></span></h4>
                    <?php } ?>
                    <!-- <div class="col-12 mb-3"> -->
                        <!-- <div class="form-floating">
                            <input type="text" placeholder="Search.." name="search">
                            <button type="submit" name="submit">Search</button> -->
                            <?php
                            if(isset($_POST['submit'])){
                                require('../tmdb_v3-PHP-API--master/tmdb-api.php');
                    
                                // if you have no $conf it uses the default config
                                $tmdb = new TMDB(); 
                                
                                //Insert your API Key of TMDB
                                //Necessary if you use default conf
                                $tmdb->setAPIKey('1ef601ddfcc2248eda53874c4027c1b5');
                                $title = $_POST['search'];
                                $multiSearchResults = $tmdb->multiSearch($title);
                                foreach($multiSearchResults as $searchResults){
                                    foreach($searchResults as $searchResult){
                                        // echo "<a href='#'>"; // todo: update link to item
                                        if($searchResult->getMediaType() === 'tv') {
                                            $mediaType = 'TV Show';
                                            $itemName = $searchResult->getName();
                                        }
                                        else if ($searchResult->getMediaType() === 'movie') {
                                            $mediaType = 'Movie';
                                            $itemName = $searchResult->getTitle();
                                        }
                                        else if($searchResult->getMediaType() === 'person'){
                                            continue;
                                        }
                                        else {
                                            $mediaType = $searchResult->getMediaType();
                                        }
                                        echo '<a href="' . 
                                            '../item/index.php?objectID='. 
                                            $searchResult->getID() . '&mediatype=' . $mediaType .
                                            '" class="col-md-5 col-xl-2 mb-3 me-3 bg-white rounded text-center search-result"/>';
                                        if ($searchResult->getPoster() == "") {
                                            echo '<img src="../images/no-poster.png" class="mb-2 poster-size rounded"/>';
                                        } else {
                                        echo '<img src="' .
                                            'https://image.tmdb.org/t/p/original' .
                                            $searchResult->getPoster() .
                                            '" class="mb-2 poster-size rounded"/>'; }
                                        echo "<br>";
                                        echo $itemName;
                                        echo "<br><button class='btn btn-dark btn-sm mt-2'>Go to " . $mediaType .  "</button>"; // todo: put item type (show/movie)
                                        echo "</a>";
                                        // echo "</a>";
                                        }
                                }
                            }
                        ?>
                        <!-- </div> -->
                    <!-- </div> -->
                </div>

            <!-- </form> -->

        </div>
        <?php } ?>
        <?php if (isset($_POST['submit'])) { include "../footer.php"; } ?>
    </body>
</html> 
