<?php
session_start();

include "../dbinfo.php";
include '../tmdb_v3-PHP-API--master/tmdb-api.php';

if($_SESSION['userID'] == NULL) {
    header("Location: ../sign-in");
}

$tmdb = new TMDB(); 
$tmdb->setAPIKey('1ef601ddfcc2248eda53874c4027c1b5');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Streamable</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<style>
    .list {
        margin-top: 30px;
    }

    .list-titles {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        /* margin: 0 3rem; */
    }

    a {
        text-decoration: none;
        color: black;
    }
    
    @media (max-width: 1200px) {
        .title-text {
            font-size: 3rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .hero-size {
            min-height: 100px;
        }
        .list-design {
            padding: 20px;
        }
    }
    @media (min-width: 1200px) {
        .title-text {
            font-size: 5rem;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .hero-size {
            min-height: 200px;
        }
        .list-design {
            padding: 40px;
        }
    }
    .poster-size {
        width: 100%;
        height: auto;
    }
    .title-text {
        text-align: center;
    }
    .list-design {
        border-radius: 1rem;
        min-height: 7.5rem;
    }
    .hero {
        background: #000 url(../images/movie-show-collage-darken-85.png) top center;
        background-size: cover;
    }
    .poster {
        border: 1px black solid;
        border-radius: 12.5px;
    }
</style>

<body class="bg-light">
    <div id="top"></div>
    <?php include "../navbar.php"?>
    <div class="hero w-100 text-white bg-dark d-flex flex-column mb-3 hero-size">
        <h1 class="title-text">What are you watching today?</h1>
    </div>
    <div class="container">
        <div class="list bg-white list-design">
            <div class="list-titles">
                <h4>Currently Watching</h4>
                <a href="../currently-watching">See All</a>
            </div>

            <?php
            $sql = "SELECT objectID,type FROM listItems WHERE userID='".$_SESSION['userID']."' AND listID=1 ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                ?>
            <div style="text-align: center;">No items are currently in this list</div>
            <?php
            } else {
                ?>
            <div class="owl-carousel owl-theme">
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['type'] == 1) {
                        $movie = $tmdb->getMovie($row['objectID']);
                        ?>
                <div class="item">
                    <a href="../item/index.php?objectID=<?php echo $row['objectID']?>&mediatype=Movie"><img
                            src="<?php if($movie->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $movie->getPoster(); } ?>"
                            class="card-img-top poster poster-size" alt="..."></a>
                </div>
                <?php
                    } elseif ($row['type'] == 2) {
                        $tvshow = $tmdb->getTVShow($row['objectID']);
                        ?>
                <div class="item">
                    <a href="../item/index.php?objectID=<?php echo $row['objectID']?>&mediatype=TV%20Show"><img
                            src="<?php if($tvshow->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $tvshow->getPoster(); } ?>"
                            class="card-img-top poster poster-size" alt="..."></a>
                </div>
                <?php
                    }
                }     
                ?>
            </div>
            <?php      
            }
            ?>

        </div>

        <div class="list bg-white list-design">
            <div class="list-titles">
                <h4>Watchlist</h4>
                <a href="../watchlist">See All</a>
            </div>

            <?php
            $sql = "SELECT objectID,type FROM listItems WHERE userID='".$_SESSION['userID']."' AND listID=2 ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                ?>
            <div style="text-align: center;">No items are currently in this list</div>
            <?php
            } else {
                ?>
            <div class="owl-carousel owl-theme">
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['type'] == 1) {
                        $movie = $tmdb->getMovie($row['objectID']);
                        ?>
                <div class="item">
                    <a href="../item/index.php?objectID=<?php echo $row['objectID']?>&mediatype=Movie"><img
                            src="<?php if($movie->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $movie->getPoster(); } ?>"
                            class="card-img-top poster poster-size" alt="..."></a>
                </div>
                <?php
                    } elseif ($row['type'] == 2) {
                        $tvshow = $tmdb->getTVShow($row['objectID']);
                        ?>
                <div class="item">
                    <a href="../item/index.php?objectID=<?php echo $row['objectID']?>&mediatype=TV%20Show"><img
                            src="<?php if($tvshow->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $tvshow->getPoster(); } ?>"
                            class="card-img-top poster poster-size" alt="..."></a>
                </div>
                <?php
                    }
                }     
                ?>
            </div>
            <?php      
            }
            ?>

        </div>

        <div class="list bg-white list-design">
            <div class="list-titles">
                <h4>Favorites</h4>
                <a href="../favorites">See All</a>
            </div>

            <?php
            $sql = "SELECT objectID,type FROM listItems WHERE userID='".$_SESSION['userID']."' AND listID=3 ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                ?>
            <div style="text-align: center;">No items are currently in this list</div>
            <?php
            } else {
                ?>
            <div class="owl-carousel owl-theme">
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['type'] == 1) {
                        $movie = $tmdb->getMovie($row['objectID']);
                        ?>
                <div class="item">
                    <a href="../item/index.php?objectID=<?php echo $row['objectID']?>&mediatype=Movie"><img
                            src="<?php if($movie->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $movie->getPoster(); } ?>"
                            class="card-img-top poster poster-size" alt="..."></a>
                </div>
                <?php
                    } elseif ($row['type'] == 2) {
                        $tvshow = $tmdb->getTVShow($row['objectID']);
                        ?>
                <div class="item">
                    <a href="../item/index.php?objectID=<?php echo $row['objectID']?>&mediatype=TV%20Show"><img
                            src="<?php if($tvshow->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $tvshow->getPoster(); } ?>"
                            class="card-img-top poster poster-size" alt="..."></a>
                </div>
                <?php
                    }
                }     
                ?>
            </div>
            <?php      
            }
            ?>

        </div>

        <div class="list bg-white list-design" style="margin-bottom: 30px">
            <div class="list-titles">
                <h4>History</h4>
                <a href="../history">See All</a>
            </div>

            <?php
            $sql = "SELECT objectID,type FROM listItems WHERE userID='".$_SESSION['userID']."' AND listID=4 ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                ?>
            <div style="text-align: center;">No items are currently in this list</div>
            <?php
            } else {
                ?>
            <div class="owl-carousel owl-theme">
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['type'] == 1) {
                        $movie = $tmdb->getMovie($row['objectID']);
                        ?>
                <div class="item">
                    <a href="../item/index.php?objectID=<?php echo $row['objectID']?>&mediatype=Movie"><img
                            src="<?php if($movie->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $movie->getPoster(); } ?>"
                            class="card-img-top poster poster-size" alt="..."></a>
                </div>
                <?php
                    } elseif ($row['type'] == 2) {
                        $tvshow = $tmdb->getTVShow($row['objectID']);
                        ?>
                <div class="item">
                    <a href="../item/index.php?objectID=<?php echo $row['objectID']?>&mediatype=TV%20Show"><img
                            src="<?php if($tvshow->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $tvshow->getPoster(); } ?>"
                            class="card-img-top poster poster-size" alt="..."></a>
                </div>
                <?php
                    }
                }     
                ?>
            </div>
            <?php      
            }
            ?>

        </div>
    </div>

    <?php include "../footer.php"?>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel({
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    // stagePadding: 80,
                },
                600: {
                    items: 3,
                    margin: 10,
                    // stagePadding: 50,
                },
                1000: {
                    items: 5,
                    margin: 10,
                    // stagePadding: 50,
                    dots: true,
                }
            }
        });
    });
</script>

</html>