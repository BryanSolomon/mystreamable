<?php 
session_start();
$validInput = 1;
?>
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
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Create an Account | Streamable</title>
        <style>
        @media (max-width: 768px) {
            .floatingBox {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }

            .hero {
                height: 100px;
            }

            .streamableLogo {
                width: 200px;
            }
        }

        @media (min-width: 768px) {
            .floatingBox {
                border-radius: 2rem !important;
                padding: 5rem !important;
                margin-bottom: 5rem !important;
            }

            .hero {
                height: 200px;
            }

            .streamableLogo {
                width: 300px;
            }
        }

        .logoStyle {
            width: 70%;
            object-fit: cover;
        }

        .btnWrapper {}

        .btnStyle {
            width: 100%;
            min-height: 75px;
            line-height: 75px;
            background: rgba(0, 0, 0, .05);
        }

        .btnStyle>img {
            vertical-align: middle;
        }

        .btnStyle:hover {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 20px rgba(0, 0, 0, .03);
        }

        .btnStyle:focus,
        .btnStyle:active,
        :checked~label {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 20px rgba(0, 0, 0, .05);
        }

        .error {
            color: #FF0000
        }

        </style>
    </head>

    <body class="bg-dark">
        <div class="hero w-100 text-white text-center d-flex flex-column mb-3">
            <!-- <h1 class="mt-auto mb-auto">Streamable logo here</h1> -->
            <h1 class="mt-auto mb-auto"><a href="../"><img src="../images/streamable-color.png" class="streamableLogo"></a></h1>
        </div>
        <div class="container w-100 bg-light floatingBox">
            <form action="index.php" method="post" novalidate>
                <h1 class="mb-3">Create your Streamable account</h1>
                <h4 class="mb-3">Account information</h4>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" placeholder="First Name" name="name"
                                required pattern="[A-Za-z\- ]{2,25}" value="<?php if(isset($_POST['name']) && $_POST['name'] != "") { echo $_POST['name']; }?>">
                            <label for="name" class="form-label">First Name</label>
                            <?php
                              if(isset($_POST['submit'])) {
                                $name = $_POST['name'];           
                                $nameValidation = preg_match("/^[a-zA-Z'-]+$/", $name);
                                if(!$nameValidation || strlen($name) < 2 || strlen($name) > 25) {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *Invalid Name Format: Only alphabets allowed, minimum of 2 characters, maximum of 25 characters.";
                                  echo "</div>";
                                  $validInput = 0;
                                }
                              }
                            ?>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                                required pattern="([A-Za-z0-9_\-\.]+)@([A-Za-z0-9_\-\.]+)\.([A-Za-z]{2,5})" value="<?php if(isset($_POST['email']) && $_POST['email'] != "") { echo $_POST['email']; }?>">
                            <label for="email" class="form-label">Email</label>
                            <?php
                              if(isset($_POST['submit'])){
                                $email = $_POST['email'];
                                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *Invalid Email Format: Email format must match user@website.com.";
                                  echo "</div>";
                                  $validInput = 0;
                                }
                              }
                           ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="userpassword" placeholder="Password"
                                name="userpassword" required pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,255}">
                            <label for="userpassword" class="form-label">Password</label>
                            <?php
                              if(isset($_POST['submit'])){
                                $userpassword = $_POST['userpassword'];
                                // validate
                                $number = preg_match('@[0-9]@', $userpassword); // at least one number.
                                $specialChars = preg_match('@[^\w]@', $userpassword); // at least one special char.
                                
                                if(!$number) {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *Must contain at least 1 number.";
                                  echo "</div>";
                                  $validInput = 0;
                                } else {
                                  echo "<div style='color:green;font-size:0.8rem;'>";
                                  echo "  *Must contain at least 1 number.";
                                  echo "</div>";
                                }
                                if(!$specialChars) {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *Must contain at least 1 special character.";
                                  echo "</div>";
                                  $validInput = 0;
                                } else {
                                  echo "<div style='color:green;font-size:0.8rem;'>";
                                  echo "  *Must contain at least 1 special character.";
                                  echo "</div>";
                                }
                                if(strlen($userpassword) < 8 || strlen($userpassword) > 255) {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *Must be at least 8 but less than 255 characters.";
                                  echo "</div>";
                                  $validInput = 0;
                                } else {
                                  echo "<div style='color:green;font-size:0.8rem;'>";
                                  echo "  *Must be at least 8 but less than 255 characters.";
                                  echo "</div>";
                                }
                              } else {
                                echo "<div class='text-muted' style='font-size:0.8rem;'>";
                                echo "  *Must contain at least 1 number.<br>";
                                echo "  *Must contain at least 1 special character.<br>";
                                echo "  *Must be at least 8 but less than 255 characters.";
                                echo "</div>";
                              }
                            ?>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="confirmpassword"
                                placeholder="Confirm Password" name="confirmpassword" required pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,255}">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <?php
                              if(isset($_POST['submit'])) {
                                $confirmpassword = $_POST['confirmpassword'];
                                $userpassword = $_POST['userpassword'];
                                if($confirmpassword != $userpassword) {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *The Confirm Password does not match.";
                                  echo "</div>";
                                  $validInput = 0;
                                }
                              }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="securityquestion" name="securityquestion" required>
                                <option value="" selected disabled>Select</option>
                                <option value="pet" <?php if(isset($_POST['securityquestion']) && $_POST['securityquestion'] == "pet") { echo "selected"; }?>>What was the name of your first pet?</option>
                                <option value="maiden" <?php if(isset($_POST['securityquestion']) && $_POST['securityquestion'] == "maiden") { echo "selected"; }?>>What is your mother's maiden name?</option>
                                <option value="city" <?php if(isset($_POST['securityquestion']) && $_POST['securityquestion'] == "city") { echo "selected"; }?>>In what city were you born?</option>
                                <option value="vacation" <?php if(isset($_POST['securityquestion']) && $_POST['securityquestion'] == "vacation") { echo "selected"; }?>>What is your favorite place to vacation?</option>
                                <option value="job" <?php if(isset($_POST['securityquestion']) && $_POST['securityquestion'] == "job") { echo "selected"; }?>>In what town or city was your first job?</option>
                            </select>
                            <label for="securityquestion">Security Question</label>
                            <?php
                              if(isset($_POST['submit'])) {
                                $securityquestion = $_POST['securityquestion'];                                
                                if(strlen($securityquestion) < 0 || $securityquestion == "") {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *Select Security Question";
                                  echo "</div>";
                                  $validInput = 0;
                                }
                              }
                            ?>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="securityanswer" placeholder="Security Answer"
                                name="securityanswer" required value="<?php if(isset($_POST['securityanswer']) && $_POST['securityanswer'] != "") { echo $_POST['securityanswer']; }?>">
                            <label for="securityanswer" class="form-label">Security Question Answer</label>
                            <?php
                              if(isset($_POST['submit'])) {
                                $securityanswer = $_POST['securityanswer'];
                                $securityanswerChar = preg_match("/^[a-zA-Z'-]+$/", $securityanswer);
                                if(!$securityanswerChar || strlen($securityanswer) < 1) {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *The Security Answer field must be at least 1 character.";
                                  echo "</div>";
                                  $validInput = 0;
                                }
                              }
                            ?>
                        </div>
                    </div>
                </div>
                <h4 class="mb-3">Select streaming services</h4>
                <div class="row">
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Netflix" name="service[]" value="Netflix" <?php if(isset($_POST['service']) && in_array("Netflix", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Netflix"><img src="../images/logos/netflix.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Disney+" name="service[]" value="Disney+" <?php if(isset($_POST['service']) && in_array("Disney+", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Disney+"><img src="../images/logos/disneyplus.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="PrimeVideo" name="service[]" value="Prime Video" <?php if(isset($_POST['service']) && in_array("Prime Video", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="PrimeVideo"><img src="../images/logos/primevideo.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Hulu" name="service[]" value="Hulu" <?php if(isset($_POST['service']) && in_array("Hulu", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Hulu"><img src="../images/logos/hulu.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="HBOMax" name="service[]" value="HBO Max" <?php if(isset($_POST['service']) && in_array("HBO Max", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="HBOMax"><img src="../images/logos/hbomax.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Paramount+" name="service[]" value="Paramount+" <?php if(isset($_POST['service']) && in_array("Paramount+", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Paramount+"><img
                                src="../images/logos/paramountplus.png" class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Discovery+" name="service[]" value="Discovery+" <?php if(isset($_POST['service']) && in_array("Discovery+", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Discovery+"><img
                                src="../images/logos/discoveryplus.png" class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="AppleTV+" name="service[]" value="Apple TV+" <?php if(isset($_POST['service']) && in_array("Apple TV+", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="AppleTV+"><img src="../images/logos/appletvplus.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Peacock" name="service[]" value="Peacock" <?php if(isset($_POST['service']) && in_array("Peacock", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Peacock"><img src="../images/logos/peacock.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Showtime" name="service[]" value="Showtime" <?php if(isset($_POST['service']) && in_array("Showtime", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Showtime"><img src="../images/logos/showtime.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Starz" name="service[]" value="Starz" <?php if(isset($_POST['service']) && in_array("Starz", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Starz"><img src="../images/logos/starz.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="ESPN+" name="service[]" value="ESPN+" <?php if(isset($_POST['service']) && in_array("ESPN+", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="ESPN+"><img src="../images/logos/espnplus.png"
                                class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="YouTubePremium" name="service[]"
                            value="YouTube Premium" <?php if(isset($_POST['service']) && in_array("YouTube Premium", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="YouTubePremium"><img
                                src="../images/logos/youtubepremium.png" class="logoStyle"></label>
                    </div>
                    <div class="col-6 col-md-2 mb-3 btnWrapper">
                        <input type="checkbox" class="btn-check" id="Other" name="service[]" value="Other" <?php if(isset($_POST['service']) && in_array("Other", $_POST['service'], true)) { echo "checked"; } ?>>
                        <label class="btn rounded btnStyle" for="Other">Other</label>
                    </div>
                    <?php
                      if(isset($_POST['submit'])) {
                        $serv = $_POST['service'];
                        if(empty($serv)) {
                          echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                          echo "  *Select at least one streaming service.";
                          echo "</div>";
                          $validInput = 0;
                        }
                      }
                    ?>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <input type="submit" value="Create Account" name="submit" class="btn btn-dark btn-lg">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <small><a href="../sign-in" class="text-muted" style="text-decoration: none;">Already have an
                                account? Sign
                                In</a></small>
                    </div>
                </div>
            </form>


            <?php include '../dbinfo.php';
      if(isset($_POST['submit']) && $validInput){
      
      if ($conn->connect_error) {
        echo "<div class='alert alert-danger mt-3' role='alert'>";
        die("Connection failed: " . $conn->connect_error);
        echo "</div>";
      }
      

      $email = $_POST['email'];
      $userpassword = $_POST['userpassword'];
      $confirmpassword = $_POST['confirmpassword'];
      $name = $_POST['name'];
      $securityquestion = $_POST['securityquestion'];
      $securityanswer = $_POST['securityanswer'];
      $services = '';
      // Getting streaming services 
      $serv = $_POST['service'];
      if(!empty($serv)) {
        $N = count($serv);
        for ($i = 0; $i < $N; $i++) {
          $services = $services.'/'.$serv[$i]; 
        }
      }

      // Check if account already exists
      $tquery = "SELECT * FROM accounts where email ='" . $email ."'";
      $tresult = mysqli_query($conn, $tquery);
      if(mysqli_num_rows($tresult) > 0){
        echo "<div class='alert alert-danger mt-3' role='alert'>";
        echo "An account with this email already exists!";
        echo "</div>";
        exit();
      }
      
      //check if passwords match
      if ($userpassword != $confirmpassword) {
        echo('**Passwords do not match');
        throw new Exception('Passwords do not match');
      }
      $userpassword = password_hash($userpassword, PASSWORD_DEFAULT);

      $sql = "INSERT INTO accounts (email, name, streamingServices, securityQuestions, securityAnswer, password) VALUES ('$email', '$name', '$services', '$securityquestion', '$securityanswer', '$userpassword' )";

      if($conn->query($sql)) {        
        // Automatically sign user in
        $queryUserID = "SELECT userID, email FROM accounts WHERE email = '" . $email . "' ";
        $resultUserID = mysqli_query($conn, $queryUserID);
        $resultUserIDArray = mysqli_fetch_array($resultUserID);
        $_SESSION['userID'] = $resultUserIDArray['userID'];
    ?>
            <script type="text/javascript">
            window.location = "../dashboard";
            </script>
            <?php
      }
      $conn->close();
    }
  ?>

            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </body>

</html>