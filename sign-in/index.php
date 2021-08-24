<?php
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
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <title>Sign In | Streamable</title>
        <style>
        @media (max-width: 768px) {
            .floatingBox {
                padding-top: 2rem !important;
                height: 100vh;
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
                margin-bottom: 5rem;
            }

            .hero {
                height: 200px;
            }

            .streamableLogo {
                width: 300px;
            }
        }

        </style>
    </head>

    <body class="bg-dark">
        <div class="hero w-100 text-white text-center d-flex flex-column mb-3">
            <h1 class="mt-auto mb-auto"><a href="../"><img src="../images/streamable-color.png" class="streamableLogo"></a></h1>
        </div>
        <div class="container col-md-6 bg-light floatingBox">
            <form id="signin" method="post" action="index.php" novalidate>
                <h1 class="mb-3">Sign in to Streamable</h1>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                                required pattern="([A-Za-z0-9_\-\.]+)@([A-Za-z0-9_\-\.]+)\.([A-Za-z]{2,5})">
                            <label for="email" class="form-label">Email</label>
                        </div>
                        <?php
                          if(isset($_POST['submit'])){
                            $email = $_POST['email'];
                            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                              echo "<div class='error' style='color:red'>";
                              echo "  *Invalid Email Format: Email format must match user@website.com.";
                              echo "</div>";
                              $validInput = 0;
                            }
                        
                          }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="userpassword" placeholder="Password"
                                name="userpassword" required pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,255}">
                            <label for="userpassword" class="form-label">Password</label>
                        </div>
                        <?php
                          if(isset($_POST['submit'])){
                            $userpassword = $_POST['userpassword'];
                            // validate
                            $number = preg_match('@[0-9]@', $userpassword); // at least one number.
                            $specialChars = preg_match('@[^\w]@', $userpassword); // at least one special char.
                            
                            if(!$number || !$specialChars || strlen($userpassword) < 8 || strlen($userpassword) > 255) {
                              echo "<div class='error' style='color:red'>";
                              echo "  *Invalid Password Format: Password must be between 8 and 255 characters inclusive and contain at least one letter, one number, and one special character.";
                              echo "</div>";
                              $validInput = 0;
                            }
                          }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3 mx-2">
                          <small><a href="../forgot-password" class="text-muted" style="text-decoration: none;">Forgot Password?</a></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <a href="../create-account/" class="btn text-muted fs-6 mt-2 px-1"
                            style="text-decoration: none;">Create an
                            Account</a>
                    </div>
                    <div class="col-6 mb-3">
                        <input type="submit" value="Sign In" name="submit" class="btn btn-dark btn-lg float-end">
                    </div>
                </div>
                <?php include '../dbinfo.php';
        if(isset($_POST['submit'])){
          if (!$conn) {
            echo "<div class='row'>";
            echo "<div class='col mb-3'>";
            echo "<div class='alert alert-danger' role='alert'>";
            die("Connection failed: " . mysqli_connect_error());
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
      }
      ?>
            </form>
        </div>
        <?php include '../dbinfo.php';
          if(isset($_POST['submit']) && $validInput == 1){
          $email = $_POST['email'];
          $userpassword = $_POST['userpassword'];

          $qquery = "SELECT userID, email, name, streamingServices, securityQuestions, securityAnswer, password FROM accounts WHERE email = '" . $email . "' ";
          $result = mysqli_query($conn, $qquery);
          $resultarray = mysqli_fetch_array($result);

          if(strcasecmp($email, $resultarray['email']) || !(password_verify($userpassword ,$resultarray['password']))){
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<div class='col mb-3'>";
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Incorrect email or password.";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
          else if(password_verify($userpassword ,$resultarray['password'])) {;
            session_start();
            $_SESSION['userID'] = $resultarray['userID'];
            header("Location: ../dashboard");
          }
          }
  ?>


        </div>
    </body>

</html>
