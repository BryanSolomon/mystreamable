<?php
    include "dbinfo.php";
    if (isset($_SESSION['userID'])) {
        $queryGetUsername = "SELECT name FROM accounts WHERE userID = " . $_SESSION['userID'];
        $resultGetUsername = mysqli_query($conn, $queryGetUsername);
        $resultGetUsernameArray = mysqli_fetch_array($resultGetUsername);
        $username = "User";
        if ($resultGetUsernameArray['name'] != "") {
            $username = ucwords(strtolower($resultGetUsernameArray['name']));
        }
    }
    $guest = 1;
    if (!isset($_SESSION['userID']) || $_SESSION['userID'] == NULL) {
        $guest = 1;
    } else {
        $guest = 0;
    }
?>

<style>
    .bg-blur {
        backdrop-filter: saturate(180%) blur(20px);
        -webkit-backdrop-filter: saturate(180%) blur(20px);
    }
    .nav-custom {
        background: rgba(0,0,0,0.85);
    }
    .nav-logo {
        height: 30px;
    }
</style>

<nav class="navbar sticky-top navbar-expand-xl navbar-dark bg-blur nav-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="../"><img class="navbar-logo nav-logo" src="../images/streamable-white.png" alt="Navbar"
                style="margin-right:1.2rem"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="text-align: center;">
                <?php if(!$guest) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard">Dashboard</a>
                    </li>
                <?php } ?>
                <?php if(!$guest) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../currently-watching">Currently Watching</a>
                    </li>
                <?php } ?>
                <?php if(!$guest) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../watchlist">Watchlist</a>
                    </li>
                <?php } ?>
                <?php if(!$guest) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../favorites">Favorites</a>
                    </li>
                <?php } ?>
                <?php if(!$guest) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../history">History</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="../discover">Discover</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../search">Search</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="text-align: center;">
                <?php if(!$guest) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../settings"><?php echo $username; ?></a>
                    </li>
                <?php } ?>
                <?php if(!$guest) { ?>
                    <li class="nav-item">
                        <a class="nav-link" name="sign-out" href="../sign-out.php">Sign Out</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>