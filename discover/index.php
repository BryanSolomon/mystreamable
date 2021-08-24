<?php
session_start();

// include "../dbinfo.php";
include '../tmdb_v3-PHP-API--master/tmdb-api.php';

$tmdb = new TMDB(); 
$tmdb->setAPIKey('1ef601ddfcc2248eda53874c4027c1b5');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover | Streamable</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
</head>
<style>
    /* .list {
        margin-top: 30px;
    } */

    /* .list-titles {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    } */

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
        /* .list-design {
            padding: 20px;
        } */
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
        /* .list-design {
            padding: 40px;
        } */
    }
    
    .poster-size {
        width: 100%;
        height: auto;
    }
    /* set max poster height in case there are different poster sizes **/
    @media (min-width: 1400px) {
        .poster-size {
            max-height: 227px;
        }
    }
    @media (max-width: 1400px) {
        .poster-size {
            max-height: 193px;
        }
    }
    @media (max-width: 1200px) {
        .poster-size {
            max-height: 159px;
        }
    }
    @media (max-width: 1000px) {
        .poster-size {
            max-height: 247px;
        }
    }
    @media (max-width: 765px) {
        .poster-size {
            max-height: 179px;
        }
    }
    @media (max-width: 600px) {
        .poster-size {
            max-height: 257px;
        }
    }
    
    .title-text {
        text-align: center;
    }
    .list-design {
        border-radius: 1rem;
        /* min-height: 7.5rem; */
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
    <?php include "../navbar.php"; ?>
    <div class="hero w-100 text-white bg-dark d-flex flex-column mb-3 hero-size">
        <h1 class="title-text">Discover</h1>
    </div>
    <div class="container">
        <div class="list list-design mb-3">
            <h4>Trending Movies</h4>
            <div class="owl-carousel owl-theme">
                <?php
                for ($i=1; $i < 6; $i++) { 
                    $movies = $tmdb->getDiscoverMovies($i);
                    foreach ($movies as $m) {
                        ?>
                        <a href="../item/index.php?objectID=<?php echo $m->getID()?>&mediatype=Movie"><img src="<?php if ($m->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $m->getPoster(); }?>" class="card-img-top poster poster-size" alt=""></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="list list-design mb-3">
            <h4>Trending TV Shows</h4>
            <div class="owl-carousel owl-theme">
                <?php
                for ($i=1; $i < 6; $i++) {
                    $shows = $tmdb->getDiscoverTVShows($i);
                    foreach ($shows as $t) {
                        ?>
                        <a href="../item/index.php?objectID=<?php echo $t->getID()?>&mediatype=TV%20Show"><img src="<?php if ($t->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $t->getPoster(); }?>" class="card-img-top poster poster-size" alt=""></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
            
        <div class="list list-design mb-3">
            <h4>Now Playing Movies</h4>
            <div class="owl-carousel owl-theme">
                <?php
                for ($i=1; $i < 6; $i++) { 
                    $movies = $tmdb->getNowPlayingMovies($i);
                    foreach ($movies as $m) {
                        ?>
                        <a href="../item/index.php?objectID=<?php echo $m->getID()?>&mediatype=Movie"><img src="<?php if ($m->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $m->getPoster(); }?>" class="card-img-top poster poster-size" alt=""></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="list list-design mb-3">
            <h4>On the Air TV Shows</h4>
            <div class="owl-carousel owl-theme">
                <?php
                for ($i=1; $i < 6; $i++) { 
                    $shows = $tmdb->getOnTheAirTVShows($i);
                    foreach ($shows as $t) {
                        ?>
                        <a href="../item/index.php?objectID=<?php echo $t->getID()?>&mediatype=TV%20Show"><img src="<?php if ($t->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $t->getPoster(); }?>" class="card-img-top poster poster-size" alt=""></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
            
        <div class="list list-design mb-3">
            <h4>Popular Movies</h4>
            <div class="owl-carousel owl-theme">
                <?php
                for ($i=1; $i < 6; $i++) { 
                    $movies = $tmdb->getPopularMovies($i);
                    foreach ($movies as $m) {
                        ?>
                        <a href="../item/index.php?objectID=<?php echo $m->getID()?>&mediatype=Movie"><img src="<?php if ($m->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $m->getPoster(); }?>" class="card-img-top poster poster-size" alt=""></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="list list-design mb-3">
            <h4>Popular TV Shows</h4>
            <div class="owl-carousel owl-theme">
                <?php
                for ($i=1; $i < 6; $i++) { 
                    $shows = $tmdb->getPopularTVShows($i);
                    foreach ($shows as $t) {
                        ?>
                        <a href="../item/index.php?objectID=<?php echo $t->getID()?>&mediatype=TV%20Show"><img src="<?php if ($t->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $t->getPoster(); }?>" class="card-img-top poster poster-size" alt=""></a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- <div class="list list-design">
            <h4>Top Rated Movies</h4>
            <div class="owl-carousel owl-theme"> -->
                <!--?php
                for ($i=1; $i < 6; $i++) { 
                    $movies = $tmdb->getTopRatedMovies($i);
                    foreach ($movies as $m) {
                        ?-->
                        <!-- <a href="../item/index.php?objectID=<?php echo $m->getID()?>&mediatype=Movie"><img src="<?php if ($m->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $m->getPoster(); }?>" class="card-img-top poster poster-size" alt=""></a> -->
                        <!--?php
                    }
                }
                ?-->
            <!-- </div>
        </div> -->

        <!-- <div class="list list-design">
            <h4>Top Rated TV Shows</h4>
            <div class="owl-carousel owl-theme"> -->
                <!--?php
                for ($i=1; $i < 6; $i++) {
                    $shows = $tmdb->getTopRatedTVShows($i);
                    foreach ($shows as $t) {
                        ?-->
                        <!-- <a href="../item/index.php?objectID=<?php echo $t->getID()?>&mediatype=TV%20Show"><img src="<?php if ($t->getPoster() == "") { echo '../images/no-poster.png'; } else { echo 'https://image.tmdb.org/t/p/original' . $t->getPoster(); }?>" class="card-img-top poster poster-size" alt=""></a> -->
                        <!--?php
                    }
                }
                ?-->
            <!-- </div>
        </div> -->
    </div>
<?php
include("../footer.php")
?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                margin: 5,
            },
            600: {
                items: 4,
                margin: 10,
            },
            1000: {
                items: 8,
                margin: 10,
                dots: true,
            }
        }
    });
});
</script>
</html>