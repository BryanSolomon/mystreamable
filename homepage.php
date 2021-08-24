<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>Streamable</title>
    <style>
        /* mobile */
        @media (max-width: 768px) {
            .streamableLogo {
                width: 200px;
            }

            .sign-in-btn {
                margin-top: -.5rem;
            }

            .home-section {
                padding: 2rem;
            }

            .home-section-content {
                text-align: center;
            }

            .home-section-list-icons {
                width: 2.5rem;
                height: 2.5rem;
            }
            
            .home-section-device-icons, .home-section-search-icon, .home-section-discover-icon {
                width: 4rem;
                height: 4rem;
            }

            .streamingLogoWrapper {
                /* background: #fff;
                border-radius: 2rem; */
                text-align: center;
            }

            .streamingLogoContainer {
                padding: 5px;
                margin: 0.5rem;
                width: 8rem;
            }
        }

        /* non-mobile */
        @media (min-width: 768px) {
            .sign-in-btn {
                margin-top: 1rem;
            }

            .home-section {
                padding: 6rem;
            }

            .home-section-list-icons {
                width: 5rem;
                height: 5rem;
            }

            .home-section-device-icons, .home-section-search-icon, .home-section-discover-icon {
                width: 5.5rem;
                height: 5.5rem;
            }

            .streamingLogoContainer {
                padding: 20px;
                margin: 1rem;
            }
        }

        .bg-blur {
            backdrop-filter: saturate(180%) blur(20px);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
        }

        .hero {
            background: linear-gradient(0deg, rgba(0, 0, 0, 1) 5%, rgba(0, 0, 0, 0) 100%), url('./images/movie-show-collage-darken-85.png') no-repeat top center;
            background-size: cover;
            min-height: 100vh;
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

        .hero-content {
            /* min-height: 100vh; */
            /* align-items: center; */
            /* background: rgba(255, 255, 255, .35); */
            /* border-radius: 5rem; */
            color: #fff;
            text-align: center;
        }

        .home-section {
            color: #fff;
            border-radius: 2rem;
            margin-bottom: 3rem;
        }

        #changingword {
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .home-section h1 {
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .streamingLogoContainer {
            background: rgba(255, 255, 255, 1);
            text-align: center;
            /* padding: 20px; */
            min-height: 75px;
            line-height: 75px;
            border-radius: 2rem;
            /* margin: 1rem; */
        }

        .streamingLogoContainer>img {
            vertical-align: middle;
        }

        .streamingLogoStyle {
            width: 70%;
            object-fit: cover;
        }

        .linear-gradient-45 {
            background: rgb(29, 173, 255);
            background: linear-gradient(45deg, rgba(29, 173, 255, 1) 0%, rgba(148, 29, 255, 1) 100%);
        }

        .linear-gradient-145 {
            background: rgb(29, 173, 255);
            background: linear-gradient(145deg, rgba(29, 173, 255, 1) 0%, rgba(148, 29, 255, 1) 100%);
        }

        .linear-gradient-245 {
            background: rgb(29, 173, 255);
            background: linear-gradient(245deg, rgba(29, 173, 255, 1) 0%, rgba(148, 29, 255, 1) 100%);
        }

        .linear-gradient-345 {
            background: rgb(29, 173, 255);
            background: linear-gradient(345deg, rgba(29, 173, 255, 1) 0%, rgba(148, 29, 255, 1) 100%);
        }

        @keyframes thump {
            0% {
                margin-top: -1.5rem;
            }

            5% {
                margin-top: 0;
            }

            10% {
                margin-top: -.5rem;
            }

            15% {
                margin-top: 0;
            }

            85% {
                margin-top: 0;
            }

            100% {
                margin-top: -1.5rem;
            }
        }

        .thump {
            animation: thump 10s infinite;
        }
        .thump a, .thump a:hover, .thump a:visited {
            color: rgba(255, 255, 255, 0.35);
        }
    </style>
</head>

<body style="background: #000;">
    <div id="top"></div>
    <div class="hero d-flex h-100">
        <div class="container">
            <div class="row h-auto">
                <div class="col mt-5">
                    <img src="./images/streamable-white.png" class="streamableLogo">
                </div>
                <div class="col mt-5">
                    <a href="./sign-in" class="btn btn-lg float-end blue-btn sign-in-btn">Sign In</a>
                </div>
            </div>
            <div class="row d-flex h-75 align-items-center hero-content">
                <h1>
                    Track all of your <span id="changingword" class="linear-gradient-145">shows</span> in one place.
                    <br>
                    <a href="./create-account" class="btn btn-lg blue-btn mt-4 fs-6">Sign Me Up
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                    </a>
                </h1>
            </div>
            <div class="row d-flex h-auto hero-content">
                <div class="col">
                    <div class="thump">
                        <a href="#content">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="content">
        <div class="bg-dark home-section">
            <div class="row mb-4">
                <h1 class="linear-gradient-245 text-center">
                    So. Many. Streaming. Services.
                </h1>
            </div>
            <div class="row mb-4 streamingLogoWrapper justify-content-center">
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/netflix.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/disneyplus.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/primevideo.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/hulu.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/hbomax.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/paramountplus.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/discoveryplus.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/appletvplus.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/peacock.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/showtime.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/starz.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/espnplus.png" class="streamingLogoStyle">
                </div>
                <div class="col-6 col-md-2 mb-3 streamingLogoContainer">
                    <img src="../images/logos/youtubepremium.png" class="streamingLogoStyle">
                </div>
            </div>
            <div class="row">
                <h4 class="text-center">and more.</h4>
            </div>
        </div>
        <div class="bg-dark home-section">
            <div class="row">
                <div class="col-md-5 d-flex justify-content-center align-items-center text-center order-md-last">
                    <div class="row">
                        <div class="col col-lg-6 col-xl-3">
                            <!-- play list -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-collection-play home-section-list-icons mb-4" viewBox="0 0 16 16">
                                <path
                                    d="M2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1zm2.765 5.576A.5.5 0 0 0 6 7v5a.5.5 0 0 0 .765.424l4-2.5a.5.5 0 0 0 0-.848l-4-2.5z" />
                                <path
                                    d="M1.5 14.5A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zm13-1a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-.5-.5h-13A.5.5 0 0 0 1 6v7a.5.5 0 0 0 .5.5h13z" />
                            </svg>
                        </div>
                        <div class="col col-lg-6 col-xl-3">
                            <!-- bookmark -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-bookmark home-section-list-icons mb-4" viewBox="0 0 16 16">
                                <path
                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                            </svg>
                        </div>
                        <div class="col col-lg-6 col-xl-3">
                            <!-- heart -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-heart home-section-list-icons mb-4" viewBox="0 0 16 16">
                                <path
                                    d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>
                        </div>
                        <div class="col col-lg-6 col-xl-3">
                            <!-- history -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-clock-history home-section-list-icons" viewBox="0 0 16 16">
                                <path
                                    d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                <path
                                    d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 home-section-content align-items-center">
                    <h1 class="linear-gradient-145">
                        Add it to your list.
                    </h1>
                    <h5>Currently Watching, Watchlist, Favorites, and History lists allow you to organize your
                        content and quickly find the next item to stream.</h5>
                </div>
            </div>
        </div>
        <div class="bg-dark home-section">
            <div class="row">
                <div class="col-md-5 d-flex justify-content-center align-items-center text-center">
                    <div class="row">
                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search home-section-search-icon" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 home-section-content align-items-center">
                    <h1 class="linear-gradient-345">
                        Just search it.
                    </h1>
                    <h5>Search for nearly any TV show or movie in existence. Streamable has it all. Don't believe us?
                        <a href="./search" style="color: #1dadff; text-decoration: none;">
                            Try it out
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                            </svg>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="bg-dark home-section">
            <div class="row">
                <div class="col-md-5 d-flex justify-content-center align-items-center text-center order-md-last">
                    <div class="row">
                        <div class="col">
                            <!-- trophy -->
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trophy home-section-discover-icon" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z"/>
                            </svg> -->
                            <!-- play btn -->
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-play-btn home-section-discover-icon" viewBox="0 0 16 16">
                                <path d="M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                            </svg> -->
                            <!-- star -->
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-star home-section-discover-icon" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                            </svg> -->
                            <!-- grid -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-grid home-section-discover-icon" viewBox="0 0 16 16">
                                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 home-section-content align-items-center">
                    <h1 class="linear-gradient-345">
                        Discover binge-worthy content.
                    </h1>
                    <h5>See trending movies and TV shows, movies now playing, TV shows currently on air, and more!
                        <a href="./discover" style="color: #1dadff; text-decoration: none;">
                            Try it out
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                            </svg>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
        <div class="bg-dark home-section">
            <div class="row">
                <div class="col-md-5 d-flex justify-content-center align-items-center text-center">
                    <div class="row">
                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-phone home-section-device-icons mb-4" viewBox="0 0 16 16">
                                <path
                                    d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z" />
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg>
                        </div>
                        <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-laptop home-section-device-icons" viewBox="0 0 16 16">
                                <path
                                    d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z" />
                            </svg>
                        </div>
                        <!-- <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-tablet" viewBox="0 0 16 16">
                                <path
                                    d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z" />
                                <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-tablet-landscape" viewBox="0 0 16 16">
                                <path
                                    d="M1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4zm-1 8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8z" />
                                <path d="M14 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0z" />
                            </svg>
                        </div> -->
                        <!-- <div class="col">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-globe" viewBox="0 0 16 16">
                                <path
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z" />
                            </svg>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-7 home-section-content align-items-center">
                    <h1 class="linear-gradient-45">
                        Manage content from any device.
                    </h1>
                    <h5>Update your streaming progress on your phone, tablet, and laptop.</h5>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>

<script>
    (function () {
        var words = [
            'shows',
            'movies',
            'series',
            'documentaries',
            'dramas',
            'comedies',
            'thrillers',
            'musicals',
            'episodes',
            'specials',
            'films',
            'content'
        ], i = 0;
        setInterval(function () {
            $('#changingword').fadeOut(function () {
                $(this).html(words[i = (i + 1) % words.length]).fadeIn();
            });
        }, 3000);

    })();
</script>

</html>