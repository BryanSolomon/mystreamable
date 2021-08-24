<?php 
    $validInput = 1;
?>

<!DOCTYPE html>
<html>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include '../dbinfo.php';

    if($_SESSION['userID'] == NULL) {
        header("Location: ../sign-in");
    }

    $qquery = "SELECT streamingServices, email, securityQuestions, password, name FROM accounts WHERE userID = '" .$_SESSION['userID']. "' ";
    $result = mysqli_query($conn, $qquery);
    $resultarray = mysqli_fetch_array($result);

    $nameValidation = NULL;
    if(isset($_POST['namesubmit']) && $validInput){
        
        if (!$conn) {
            echo "<div class='row'>";
            echo "<div class='col mb-3'>";
            echo "<div class='alert alert-danger' role='alert'>";
            die("Connection failed: " . mysqli_connect_error());
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        $newname =  $_POST['floatingName'];

        $floatingName = $_POST['floatingName'];           
    
        $nameValidation = preg_match("/^[a-zA-Z'-]+$/", $floatingName);
        if(!$nameValidation || strlen($floatingName) < 2 || strlen($floatingName) > 25) {
        //   echo "<div class='error' style='color:red;font-size:0.8rem;'>";
        //   echo "  *Invalid Name Format: Only alphabets allowed, minimum of 2 characters, maximum of 25 characters.";
        //   echo "</div>";
            $validInput = 0;
        }

        if ($validInput == 0) {
            echo "<div class='alert alert-danger mb-0' role='alert'>";
            echo "Invalid name formatting.";
            echo "</div>";
        } elseif($newname != "") {

            $queryname = "UPDATE accounts SET name='".$newname."' WHERE userID='".$_SESSION['userID']."'";
            $resultt = mysqli_query($conn, $queryname);
            echo "<div class='alert alert-success mb-0' role='alert'>";
            echo "Your name has been updated.";
            echo "</div>";
        }
        else{
            echo "<div class='alert alert-danger mb-0' role='alert'>";
            echo "Name cannot be empty.";
            echo "</div>";
        }
    }
    
    $emailerror = 0;
    $floatingEmail = NULL;
    $emailConfirmation = NULL;
    if(isset($_POST['emailsubmit']) && $validInput){
        
        if (!$conn) {
            echo "<div class='row'>";
            echo "<div class='col mb-3'>";
            echo "<div class='alert alert-danger' role='alert'>";
            die("Connection failed: " . mysqli_connect_error());
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        $newemail = $_POST['floatingEmail'];
        $newemailconfirm = $_POST['emailConfirmation'];
        $querycheckemail = "SELECT * FROM accounts WHERE email='".$newemail."'";
        $resultcheckemail = mysqli_query($conn, $querycheckemail);

        $floatingEmail = $_POST['floatingEmail'];    

        if(!filter_var($floatingEmail, FILTER_VALIDATE_EMAIL)) {
        //   echo "<div class='error' style='color:red;font-size:0.8rem;'>";
        //   echo "  *Invalid Email Format: Email format must match user@website.com.";
        //   echo "</div>";
            $validInput = 0;
        }

        $emailConfirmation = $_POST['emailConfirmation'];

        if($floatingEmail != $emailConfirmation) {
        //   echo "<div class='error' style='color:red;font-size:0.8rem;'>";
        //   echo "  *The confirm email does not match.";
        //   echo "</div>";
            $validInput = 0;
        } // else {
        //     $_POST['emailsuccess'] = $floatingEmail;
        // }

        if ($validInput == 0) {
            echo "<div class='alert alert-danger mb-0' role='alert'>";
            echo "Invalid email formatting.";
            echo "</div>";
        } elseif($newemail != "") {
            if (mysqli_num_rows($resultcheckemail) > 0) {
                echo "<div class='alert alert-danger mb-0' role='alert'>";
                echo "Email already is associated with another account.";
                echo "</div>";
                $emailerror = 1;
            } elseif($newemailconfirm == $newemail) {
                $queryemailupdate = "UPDATE accounts SET email='".$newemail."' WHERE userID='".$_SESSION['userID']."'";
                $resultt = mysqli_query($conn, $queryemailupdate);
                echo "<div class='alert alert-success mb-0' role='alert'>";
                echo "Your email has been updated.";
                echo "</div>";
            } else {
                echo "<div class='alert alert-danger mb-0' role='alert'>";
                echo "Emails do not match.";
                echo "</div>";
                $emailerror = 1;
            }
        }
        else{
            echo "<div class='alert alert-danger mb-0' role='alert'>";
            echo "Email cannot be empty.";
            echo "</div>";
            $emailerror = 1;
        }
    }

    // if (isset($_POST['passwordsubmit']) && $validInput == 0) {
    //     echo "<div class='alert alert-danger mb-0' role='alert'>";
    //     echo "Incorrect password formatting.";
    //     echo "</div>";
    // }
    $number = NULL;
    $specialChars = NULL;
    $passwordNew = NULL;
    $passwordConfirmation = NULL;
    if(isset($_POST['passwordsubmit']) && $validInput){

        if (!$conn) {
            echo "<div class='row'>";
            echo "<div class='col mb-3'>";
            echo "<div class='alert alert-danger' role='alert'>";
            die("Connection failed: " . mysqli_connect_error());
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        $oldpassword = $_POST['passwordOld'];
        $newpassword = $_POST['passwordNew'];
        $newpasswordconfirm = $_POST['passwordConfirmation'];
        $passwordNew = $_POST['passwordNew'];

        // validate
        $number = preg_match('@[0-9]@', $passwordNew); // at least one number.
        $specialChars = preg_match('@[^\w]@', $passwordNew); // at least one special char.
        
        if(!$number) {
        //   echo "<div class='error' style='color:red;font-size:0.8rem;'>";
        //   echo "  *Must contain at least 1 number.";
        //   echo "</div>";
            $validInput = 0;
        } 
        if(!$specialChars) {
        //   echo "<div class='error' style='color:red;font-size:0.8rem;'>";
        //   echo "  *Must contain at least 1 special character.";
        //   echo "</div>";
            $validInput = 0;
        } 
        if(strlen($passwordNew) < 8 || strlen($passwordNew) > 255) {
        //   echo "<div class='error' style='color:red;font-size:0.8rem;'>";
        //   echo "  *Must be at least 8 but less than 255 characters.";
        //   echo "</div>";
            $validInput = 0;
        }

        $passwordConfirmation = $_POST['passwordConfirmation'];

        if($passwordConfirmation == "" || $passwordNew != $passwordConfirmation) {
        //   echo "<div class='error' style='color:red;font-size:0.8rem;'>";
        //   echo "  *The confirm password does not match.";
        //   echo "</div>";
            $validInput = 0;
        }
        
        if ($validInput == 0) {
            echo "<div class='alert alert-danger mb-0' role='alert'>";
            echo "Invalid password formatting.";
            echo "</div>";
        } elseif(!(password_verify($oldpassword, $resultarray['password']))) {
            echo "<div class='alert alert-danger mb-0' role='alert'>";
            echo "Incorrect old password.";
            echo "</div>";
        } else {
            if($newpassword == $newpasswordconfirm && $newpassword != ""){
                $userpassword = password_hash($newpassword, PASSWORD_DEFAULT);
                $querypasswordupdate = "UPDATE accounts SET password='".$userpassword."' WHERE userID='".$_SESSION['userID']."'";
                mysqli_query($conn, $querypasswordupdate);
                echo "<div class='alert alert-success mb-0' role='alert'>";
                echo "Your password has been updated.";
                echo "</div>";

            } else {
                echo "<div class='alert alert-danger mb-0' role='alert'>";
                echo "Password entries do not match.";
                echo "</div>";
            }
        }
    }

    if(isset($_POST['streamingservicessubmit'])){

        if (!$conn) {
            echo "<div class='row'>";
            echo "<div class='col mb-3'>";
            echo "<div class='alert alert-danger' role='alert'>";
            die("Connection failed: " . mysqli_connect_error());
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        $services = '';

        $serv = isset($_POST['service']) ? $_POST['service'] : [];
        if(!empty($serv)) {
            $N = count($serv);
            for ($i = 0; $i < $N; $i++) {
                $services = $services.'/'.$serv[$i]; 
        }
      }
        $queryservicesupdate = "UPDATE accounts SET streamingServices='".$services."' WHERE userID='".$_SESSION['userID']."'";
        mysqli_query($conn, $queryservicesupdate);
        echo "<div class='alert alert-success mb-0' role='alert'>";
        echo "Your streaming services have been updated.";
        echo "</div>";
    }

    if(isset($_POST['securityquestionsubmit'])){

        if (!$conn) {
            echo "<div class='row'>";
            echo "<div class='col mb-3'>";
            echo "<div class='alert alert-danger' role='alert'>";
            die("Connection failed: " . mysqli_connect_error());
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        $securityquestion = $_POST['securityQuestion'];
        $securityanswer = $_POST['securityAnswer'];

        if(!($securityanswer == "") && password_verify($_POST['userPassword'], $resultarray['password'])){
            $querysecurity = "UPDATE accounts SET securityQuestions='".$securityquestion."', 
            securityAnswer='".$securityanswer."' WHERE userID='".$_SESSION['userID']."'";
            mysqli_query($conn, $querysecurity);
            echo "<div class='alert alert-success mb-0' role='alert'>";
            echo "Your security question has been updated.";
            echo "</div>";
        } elseif ($securityanswer == "") {
            echo "<div class='alert alert-danger mb-0' role='alert'>";
            echo "Security answer cannot be empty.";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger mb-0' role='alert'>";
            echo "Incorrect password.";
            echo "</div>";
        }
    }
    ?>

    <head>
        <title>Settings | Streamable</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
            crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        <style>
        @media (max-width: 768px) {
            .hero-size {
                height: 100px;
            }
        }

        @media (min-width: 768px) {
            .hero-size {
                height: 200px;
            }
        }
        .hero-icon {
            width: 2rem;
            height: 2rem;
            margin-top: -0.5rem;
        }
        </style>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    </head>

    <body class="bg-light">
        <div id="top"></div>
        <?php include "../navbar.php"; ?>
        <div class="hero w-100 text-white bg-dark d-flex flex-column mb-3 hero-size"
            style="/*background: url('gear.png') repeat; background-size: 50px;*/">
            <div class="container mt-auto mb-auto">
                <h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gear hero-icon" viewBox="0 0 16 16">
                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                    </svg>
                    Account Settings
                </h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <form id="nameupdate" method="post" class="col-sm mb-5" novalidate>
                    <h3 id="ma-name">Change Name</h3>
                    <div class="form-floating mb-3">
                        <input type="name" class="form-control" name="floatingName" id="floatingName" placeholder="Name"
                            value="<?php echo isset($_POST['floatingName']) ? $_POST['floatingName'] : $resultarray['name']?>" required pattern="[A-Za-z\- ]{2,25}">
                        <label for="floatingName">Name</label>
                    </div>
                    <div class="mb-3">
                        <?php
                            if(!$validInput && isset($_POST['namesubmit'])) {
                                // $floatingName = $_POST['floatingName'];           
                        
                                // $nameValidation = preg_match("/^[a-zA-Z'-]+$/", $floatingName);
                                if(!$nameValidation || strlen($floatingName) < 2 || strlen($floatingName) > 25) {
                                echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                echo "  *Invalid Name Format: Only alphabets allowed, minimum of 2 characters, maximum of 25 characters.";
                                echo "</div>";
                                //   $validInput = 0;
                                }
                            }
                        ?>
                    </div>
                    <button type="submit" name="namesubmit" class="btn btn-dark">Change Name</button>
                </form>
                <?php
                if (!isset($services)) {
                    $services = $resultarray['streamingServices'];
                }
                ?>
                <form id="streamingservicesupdate" method="post" class="col-sm mb-5">
                    <h3 id="ma-streamingservices">Update Streaming Services</h3>
                    <small class="text-muted">Select the streaming services you're subscribed
                        to.</small>
                    <div class="row mt-1">
                        <div class="col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Netflix" name="service[]"
                                    id="ss-netflix" <?php
                                if(strpos($services, "Netflix")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-netflix">Netflix</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Hulu" name="service[]"
                                    id="ss-hulu" <?php
                                if(strpos($services, "Hulu")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-hulu">Hulu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Disney+" name="service[]"
                                    id="ss-disneyPlus" <?php
                                if(strpos($services, "Disney+")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-disneyPlus">Disney+</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="HBO Max" name="service[]"
                                    id="ss-hboMax" <?php
                                if(strpos($services, "HBO Max")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-hboMax">HBO Max</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Prime Video" name="service[]"
                                    id="ss-primeVideo" <?php
                                if(strpos($services, "Prime Video")) : ?> checked
                                    <?php endif; ?>>
                                <label class="form-check-label" for="ss-primeVideo">Prime Video</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Paramount+" name="service[]"
                                    id="ss-paramountPlus" <?php
                                if(strpos($services, "Paramount+")) : ?> checked
                                    <?php endif; ?>>
                                <label class="form-check-label" for="ss-paramountPlus">Paramount+</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Discovery+" name="service[]"
                                    id="ss-discoveryPlus" <?php
                                if(strpos($services, "Discovery+")) : ?> checked
                                    <?php endif; ?>>
                                <label class="form-check-label" for="ss-discoveryPlus">Discovery+</label>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Apple TV+" name="service[]"
                                    id="ss-appleTVPlus" <?php
                                if(strpos($services, "Apple TV+")) : ?> checked
                                    <?php endif; ?>>
                                <label class="form-check-label" for="ss-appleTVPlus">Apple TV+</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Peacock" name="service[]"
                                    id="ss-peacock" <?php
                                if(strpos($services, "Peacock")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-peacock">Peacock</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Showtime" name="service[]"
                                    id="ss-showtime" <?php
                                if(strpos($services, "Showtime")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-showtime">Showtime</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Starz" name="service[]"
                                    id="ss-starz" <?php
                                if(strpos($services, "Starz")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-starz">Starz</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="ESPN+" name="service[]"
                                    id="ss-espnPlus" <?php
                                if(strpos($services, "ESPN+")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-espnPlus">ESPN+</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="YouTube Premium" name="service[]"
                                    id="ss-youtubePremium" <?php
                                if(strpos($services, "YouTube Premium")) : ?> checked
                                    <?php endif; ?>>
                                <label class="form-check-label" for="ss-youtubePremium">YouTube Premium</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Other" name="service[]"
                                    id="ss-other" <?php
                                if(strpos($services, "Other")) : ?> checked <?php endif; ?>>
                                <label class="form-check-label" for="ss-other">Other</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="streamingservicessubmit" class="btn btn-dark mt-3">Update Streaming
                        Services</button>
                </form>
            </div>
            <div class="row">
                <form id="emailupdate" method="post" class="col-sm mb-5" novalidate>
                    <h3 id="ma-email">Change Email</h3>
                    <div class="form-floating mb-3" aria-describedby="emailHelpBlock">
                        <input type="email" class="form-control" name="floatingEmail" id="floatingEmail"
                            placeholder="New email" required pattern="([A-Za-z0-9_\-\.]+)@([A-Za-z0-9_\-\.]+)\.([A-Za-z]{2,5})">
                        <label for="floatingemail">New email</label>
                    </div>
                    <div class="mb-3">
                        <?php
                            //   if(isset($_POST['emailsubmit'])) {
                            //     $floatingEmail = $_POST['floatingEmail'];    
                            if (!$validInput && isset($_POST['emailsubmit'])) {
                                if(!filter_var($floatingEmail, FILTER_VALIDATE_EMAIL)) {
                                  echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                  echo "  *Invalid Email Format: Email format must match user@website.com.";
                                  echo "</div>";
                                }
                              }
                            // }
                         ?>
                    </div>
                    <div class="form-floating mb-3" aria-describedby="emailHelpBlock">
                        <input type="email" class="form-control" id="emailConfirmation" placeholder="Confirm new email"
                            name="emailConfirmation" required pattern="([A-Za-z0-9_\-\.]+)@([A-Za-z0-9_\-\.]+)\.([A-Za-z]{2,5})">
                        <label for="emailConfirmation" class="form-label">Confirm new email</label>
                    </div>
                    <div class="mb-3">
                        <?php
                            //   if(isset($_POST['emailsubmit'])) {
                            //     $floatingEmail = $_POST['floatingEmail'];    
                            //     $emailConfirmation = $_POST['emailConfirmation'];
                                if (!$validInput && isset($_POST['emailsubmit'])) {
                                    if($floatingEmail != $emailConfirmation) {
                                    echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                    echo "  *The confirm email does not match.";
                                    echo "</div>";
                                    } // else {
                                    //     $_POST['emailsuccess'] = $floatingEmail;
                                    // }
                                }
                            //   }
                         ?>
                    </div>
                    <div id="emailHelpblock" class="form-text mb-3">
                        Your current email is <b><?php if ($emailerror == 1 || !$validInput) { echo $resultarray['email']; } else { echo isset($_POST['emailsubmit']) ? $floatingEmail : $resultarray['email']; }?></b>. Once your email changes, you will need
                        to use your new email to sign in to your Streamable account.
                    </div>
                    <button type="submit" name="emailsubmit" class="btn btn-dark">Change Email</button>
                </form>
                <form id="passwordupdate" method="post" class="col-sm mb-5" novalidate>
                    <h3 id="ma-password">Change Password</h3>
                    <div class="form-floating mb-3" aria-describedby="passwordHelpBlock" required>
                        <input type="password" class="form-control" id="passwordOld" name="passwordOld"
                            placeholder="Old password">
                        <label for="passwordOld" class="form-label">Old password</label>

                    </div>
                    <div class="form-floating mb-3" aria-describedby="passwordHelpBlock" required>
                        <input type="password" class="form-control" id="password" name="passwordNew"
                            placeholder="New password" pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,255}">
                        <label for="password" class="form-label">New password</label>
                    </div>
                    <div class="mb-3">
                        <?php 
                            if (!$validInput && isset($_POST['passwordsubmit'])) {
                                if(!$number) {
                                    echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                    echo "  *Must contain at least 1 number.";
                                    echo "</div>";
                                } else {
                                    echo "<div style='color:green;font-size:0.8rem;'>";
                                    echo "  *Must contain at least 1 number.";
                                    echo "</div>";
                                }
                                if(!$specialChars) {
                                    echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                    echo "  *Must contain at least 1 special character.";
                                    echo "</div>";
                                } else {
                                    echo "<div style='color:green;font-size:0.8rem;'>";
                                    echo "  *Must contain at least 1 special character.";
                                    echo "</div>";
                                }
                                if(strlen($passwordNew) < 8 || strlen($passwordNew) > 255) {
                                    echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                    echo "  *Must be at least 8 but less than 255 characters.";
                                    echo "</div>";
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
                    <div class="form-floating mb-3" aria-describedby="passwordHelpBlock" required>
                        <input type="password" class="form-control" id="passwordConfirmation"
                            name="passwordConfirmation" placeholder="Confirm new password" pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,255}">
                        <label for="passwordConfirmation" class="form-label">Confirm new password</label>
                    </div>
                    <div class="mb-3">
                        <?php 
                            if (!$validInput && isset($_POST['passwordsubmit'])) {
                                if($passwordNew != $passwordConfirmation) {
                                    echo "<div class='error' style='color:red;font-size:0.8rem;'>";
                                    echo "  *The confirm password does not match.";
                                    echo "</div>";
                                }
                            }
                        ?>
                    </div>
                    <div id="passwordHelpBlock" class="form-text mb-3">
                        Once your password changes, you will need
                        to use your new password to sign in to your Streamable account.
                    </div>
                    <button type="submit" formmethod="post" name="passwordsubmit" class="btn btn-dark">Change
                        Password</button>
                </form>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form id="securityquestionupdate" method="post" class="mb-5" novalidate>
                        <h3 id="ma-securityquestion">Security Question</h3>
                        <div class="form-floating mb-3" aria-describedby="securityQuestionHelpBlock">
                            <select type="text" class="form-select" id="securityQuestion" name="securityQuestion"
                                required>
                                <?php
                                if (!isset($_POST['securityQuestion'])) {
                                    $_POST['securityQuestion'] = $resultarray['securityQuestions'];
                                }
                                ?>
                                <option selected disabled>Select</option>
                                <option value="pet" <?php echo $_POST['securityQuestion']=="pet" ? "selected" : ''?>>What was the name of your first pet?</option>
                                <option value="maiden" <?php echo $_POST['securityQuestion']=="maiden" ? "selected" : ''?>>What is your mother's maiden name?</option>
                                <option value="city" <?php echo $_POST['securityQuestion']=="city" ? "selected" : ''?>>In what city were you born?</option>
                                <option value="vacation" <?php echo $_POST['securityQuestion']=="vacation" ? "selected" : ''?>>What is your favorite place to vacation?</option>
                                <option value="job" <?php echo $_POST['securityQuestion']=="job" ? "selected" : ''?>>In what town or city was your first job?</option>
                            </select>
                            <label for="securityQuestion">Security Question</label>
                        </div>
                        <div class="form-floating mb-3" aria-describedby="securityQuestionHelpBlock">
                            <input type="text" class="form-control" id="securityAnswer" name="securityAnswer"
                                placeholder="Security Answer" required>
                            <label for="securityAnswer">Security Answer</label>
                        </div>
                        <div class="form-floating mb-3" aria-describedby="securityQuestionHelpBlock" required>
                            <input type="password" class="form-control" id="userPassword" name="userPassword"
                                placeholder="Password">
                            <label for="userPassword" class="form-label">Password</label>
                        </div>
                        <div id="securityQuestionHelpBlock" class="form-text mb-3">
                            If you cannot remember the answer to your security question, you can update it above.
                        </div>
                        <div class="col-12">
                            <button type="submit" formmethod="post" name="securityquestionsubmit"
                                class="btn btn-dark">Update Security Question</button>
                        </div>
                    </form>
                </div>
                
                <?php
                    $querysearch = "SELECT COUNT(*) as total FROM listItems WHERE userID='".$_SESSION['userID']."'AND listID=4 AND type=1";
                    $searchresult = mysqli_query($conn, $querysearch);
                    $movie  = mysqli_fetch_array($searchresult);
                    
                    $querysearch = "SELECT COUNT(*) as total FROM listItems WHERE userID='".$_SESSION['userID']."'AND listID=4 AND type=2";
                    $searchresult = mysqli_query($conn, $querysearch);
                    $tv = mysqli_fetch_array($searchresult);
                    
                    $querysearch = "SELECT COUNT(*) as total FROM listItems WHERE userID='".$_SESSION['userID']."'AND listID=3";
                    $searchresult = mysqli_query($conn, $querysearch);
                    $favorite = mysqli_fetch_array($searchresult);
                    
                    $querysearch = "SELECT COUNT(*) as total FROM listItems WHERE userID='".$_SESSION['userID']."'AND listID=4";
                    $searchresult = mysqli_query($conn, $querysearch);
                    $total = mysqli_fetch_array($searchresult);
                ?>
            <div class="col-md-6 mb-5">
                <h3 id="ma-statistics">Statistics</h3>
                <p>
                    <b>Number of shows watched:</b> <?php echo $tv['total'];?><br>
                    <b>Number of movies watched:</b> <?php echo $movie['total'];?><br>
                    <b>Total number of items watched:</b> <?php echo $total['total'];?><br>
                    <b>Number of favorited items:</b> <?php echo $favorite['total'];?><br>
                </p>
            </div>
            
            </div>
        </div>
        </div>
        <?php include "../footer.php" ?>
    </body>

</html>
