<?php 
// todo: assign $selectedStreamingService to the streaming service in the database
$selectedStreamingServiceLogo = NULL;
$selectedStreamingService = "Disney+";
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
} else {
    $selectedStreamingServiceLogo = "../images/logos/select.png";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>WandaVision | Streamable</title> <!-- todo: put name of movie/show here -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
    <style>
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

            .item-poster-size {
                max-width: 150px;
                min-width: 150px;
                max-height: 225px;
                min-height: 225px;
            }

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

            .item-poster-size {
                max-width: 300px;
                min-width: 300px;
                max-height: 450px;
                min-height: 450px;
                /* max-width: 250px;
                min-width: 250px;
                max-height: 375px;
                min-height: 375px; */
            }
        }

        @media (max-width: 800px) {
            .hero-name {
                font-size: 3rem;
            }
        }

        .hero {
            background: #fff url('https://www.themoviedb.org/t/p/w1920_and_h800_multi_faces/57vVjteucIF3bGnZj6PmaoJRScw.jpg') center;
            /* todo: put item cover photo in the url tag */
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
            background: url('<?php echo $selectedStreamingServiceLogo; ?>') no-repeat center;
            background-size: 40%;
            color: transparent;
        }
        select#season > option, select#episode > option {
            font-size: 10rem;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <div id="top"></div>
    <div class="hero w-100 text-white bg-dark d-flex flex-column mb-3 hero-size">
        <div class="darken w-100 d-flex flex-column h-100">
            <div class="container mt-auto mb-auto pt-5 pb-5">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 col-xl-3 textCenterIfMobile">
                        <img src="https://www.themoviedb.org/t/p/w300_and_h450_bestv2/glKDfE6btIRcVB5zrjspRIs4r52.jpg"
                            class="item-poster-size rounded"> <!-- todo: put item poster image in here -->
                    </div>
                    <div class="col-sm-6 col-lg-8 col-xl-9 textCenterIfMobile">
                        <div class="row hero-info">
                            <div class="col mt-auto mb-auto">
                                <h1 class="hero-name">WandaVision</h1> <!-- todo: put movie/show name here -->
                                <p>Wanda Maximoff and Vision—two super-powered beings living idealized suburban
                                    lives—begin to
                                    suspect that everything is
                                    not as it seems.</p> <!-- todo: put item overview here -->
                            </div>
                        </div>
                        <div class="row hero-buttons">
                            <div class="col">
                                <button class="btn btn-light mb-1">
                                    <!-- todo: implement functionality (remove from favorites list) and show this button if the item is on the user's favorites list -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart-fill"
                                        viewBox="0 0 16 16" width="1rem" height="1rem">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                    <span class="btn-text">Unfavorite</span>
                                </button>
                                <button class="btn btn-light mb-1">
                                    <!-- todo: only show this button if the item is on the user's currently watching list and implement functionality (remove from currently watching list) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="bi bi-collection-play-fill" viewBox="0 0 16 16" width="1rem"
                                        height="1rem">
                                        <path
                                            d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm6.258-6.437a.5.5 0 0 1 .507.013l4 2.5a.5.5 0 0 1 0 .848l-4 2.5A.5.5 0 0 1 6 12V7a.5.5 0 0 1 .258-.437z" />
                                    </svg>
                                    <span class="btn-text">Remove from Currently Watching</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md rounded bg-white box-shadow text-center mb-3 me-3" style="padding: 20px;">
            <!-- ignore between these lines -->    
            <!-- Watching on:<br>
                <img src="<?php echo $selectedStreamingServiceLogo; ?>" class="streamingServiceLogo mt-3 mb-3"><br>
                <a href="#" class="text-muted" style="text-decoration: none; font-size: 0.75rem;">Change streaming
                    service</a> todo: clicking this link should make the form below appear -->
            <!-- end ignore between these lines -->
                <form>
                    <!-- todo: implement functionality for user to be able to select streaming service, should only allow the user to click on options that the item is available to be streamed on -->
                    <div class="form-floating mx-auto mb-2">
                        <select type="text" class="form-select" id="streamingService" name="streamingService"> <!-- todo: have option currently in database be selected so it displays correctly on page load/reload -->
                            <option selected disabled>Select</option>
                            <option value="Netflix" class="">Netflix</option>
                            <option value="Hulu">Hulu</option>
                            <option value="Disney+">Disney+</option>
                            <option value="HBO Max">HBO Max</option>
                            <option value="Prime Video">Prime Video</option>
                            <option value="Paramount+">Paramount+</option>
                            <option value="Discovery+">Discovery+</option>
                            <option value="Apple TV+">Apple TV+</option>
                            <option value="Peacock">Peacock</option>
                            <option value="Showtime">Showtime</option>
                            <option value="Starz">Starz</option>
                            <option value="ESPN+">ESPN+</optino>
                            <option value="YouTube Premium">YouTube Premium</option>
                            <option value="Other">Other</option>
                        </select>
                        <label for="streamingService">Watching on</label>
                    </div>
                    <button class="btn btn-dark w-100">Change Streaming Service</button>
                </form>
            </div>
            <!-- <div class="col-md rounded bg-white box-shadow text-center fs-2 mb-3 d-flex align-items-center" style="padding: 20px;"> i can't really get this to work out well
                <div class="row">
                    <div class="col">
                        Season 3, Episode 2
                         todo: put season and episode info here. if it's a movie, put the year here 
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-dark btn-sm me-1">Previous Episode</button><button
                            class="btn btn-dark btn-sm">Next
                            Episode</button>
                    </div>
                </div>
            </div> -->
            <div class="col-md rounded bg-white box-shadow text-center mb-3" style="padding: 20px;">
                <form class="row">
                    <h2 class="mb-3">Streaming Progress</h2>
                    <!-- todo: implement functionality for user to be able to select season and episode. only show options that are avilable to be streamed on -->
                    <div class="col-6">
                        <div class="form-floating mx-auto mb-3">
                            <select type="text" class="form-select" id="season" name="season"> <!-- todo: have option currently in database be selected -->
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                                <option value="66">66</option>
                                <option value="67">67</option>
                                <option value="68">68</option>
                                <option value="69">69</option>
                                <option value="70">70</option>
                                <option value="71">71</option>
                                <option value="72">72</option>
                                <option value="73">73</option>
                                <option value="74">74</option>
                                <option value="75">75</option>
                                <option value="76">76</option>
                                <option value="77">77</option>
                                <option value="78">78</option>
                                <option value="79">79</option>
                                <option value="80">80</option>
                                <option value="81">81</option>
                                <option value="82">82</option>
                                <option value="83">83</option>
                                <option value="84">84</option>
                                <option value="85">85</option>
                                <option value="86">86</option>
                                <option value="87">87</option>
                                <option value="88">88</option>
                                <option value="89">89</option>
                                <option value="90">90</option>
                                <option value="91">91</option>
                                <option value="92">92</option>
                                <option value="93">93</option>
                                <option value="94">94</option>
                                <option value="95">95</option>
                                <option value="96">96</option>
                                <option value="97">97</option>
                                <option value="98">98</option>
                                <option value="99">99</option>
                                <option value="100">100</option>
                            </select>
                            <label for="season">Season</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mx-auto mb-3">
                            <select type="text" class="form-select" id="episode" name="episode"> <!-- todo: have option currently in database be selected -->
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                                <option value="51">51</option>
                                <option value="52">52</option>
                                <option value="53">53</option>
                                <option value="54">54</option>
                                <option value="55">55</option>
                                <option value="56">56</option>
                                <option value="57">57</option>
                                <option value="58">58</option>
                                <option value="59">59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                                <option value="66">66</option>
                                <option value="67">67</option>
                                <option value="68">68</option>
                                <option value="69">69</option>
                                <option value="70">70</option>
                                <option value="71">71</option>
                                <option value="72">72</option>
                                <option value="73">73</option>
                                <option value="74">74</option>
                                <option value="75">75</option>
                                <option value="76">76</option>
                                <option value="77">77</option>
                                <option value="78">78</option>
                                <option value="79">79</option>
                                <option value="80">80</option>
                                <option value="81">81</option>
                                <option value="82">82</option>
                                <option value="83">83</option>
                                <option value="84">84</option>
                                <option value="85">85</option>
                                <option value="86">86</option>
                                <option value="87">87</option>
                                <option value="88">88</option>
                                <option value="89">89</option>
                                <option value="90">90</option>
                                <option value="91">91</option>
                                <option value="92">92</option>
                                <option value="93">93</option>
                                <option value="94">94</option>
                                <option value="95">95</option>
                                <option value="96">96</option>
                                <option value="97">97</option>
                                <option value="98">98</option>
                                <option value="99">99</option>
                                <option value="100">100</option>
                            </select>
                            <label for="episode">Episode</label>
                        </div>
                    </div>
                    <div class="col"><button class="btn btn-dark w-100">Update Progress</button></div>
                </form>
            </div>
        </div>
        <div class="row rounded bg-white box-shadow mb-3" style="padding: 20px;">
            <h3>Show Details</h3> <!-- todo: if type is movie put Movie here, if show put Show -->
            <p> <!-- todo: fill out this info from the api -->
                <b>Release Date: </b> $RELEASE_DATE
                <br><b>Duration: </b> $DURATION
                <br><b>Available On: </b> $LIST_STREAMING_SERVICE_PROVIDERS_HERE
                <br><b>Cast: </b> $CAST
                <!-- todo: add more info from API -->
            </p>
        </div>
    </div>
    <?php include "../footer.php"; ?>
</body>

</html>