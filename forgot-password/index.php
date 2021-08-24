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

        <title>Forgot Password | Streamable</title>
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
            <?php
            include "../dbinfo.php";
            session_start();
            foreach ($_POST as $key => $value) {
                $_SESSION[$key] = $value;
            }

            if (isset($_POST['userpassword']) && isset($_POST['confirmpassword'])) {
                if ($_POST['userpassword'] === $_POST['confirmpassword']) {
                    $email = $_SESSION['email'];
                    $password = $_POST['userpassword'];
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE accounts SET password='".$password."' WHERE email='".$email."'";
                    if ($conn->query($sql) === TRUE) {
                        session_destroy();
                    } else {
                      echo "Error updating record: " . $conn->error;
                    }
                }
            }

            $userinfo = null;
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
                $question = $_POST['securityquestion'];
                $answer = $_POST['securityanswer'];
                $query = "SELECT * FROM accounts WHERE email = '" . $email . "' AND securityQuestions = '" . $question . "' AND securityAnswer = '" . $answer . "' ";
                $result = mysqli_query($conn, $query);
                $userinfo = mysqli_fetch_array($result);
            }
            if (!isset($userinfo)) {
                ?>
                <form id="verifyaccount" method="post" action="index.php">
                    <h1 class="mb-3">Forgot your Streamable password?</h1>
                    <h4 class="mb-3">Account information</h4>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                                    required>
                                <label for="email" class="form-label">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="securityquestion" name="securityquestion" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="pet">What was the name of your first pet?</option>
                                    <option value="maiden">What is your mother's maiden name?</option>
                                    <option value="city">In what city were you born?</option>
                                    <option value="vacation">What is your favorite place to vacation?</option>
                                    <option value="job">In what town or city was your first job?</option>
                                </select>
                                <label for="securityquestion">Security Question</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="securityanswer" placeholder="Security Answer" name="securityanswer" required>
                                <label for="securityanswer" class="form-label">Security Question Answer</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <a href="../sign-in" class="btn text-muted fs-6 px-1" style="text-decoration: none;">Sign In</a>
                        </div>
                        <div class="col-6 mb-3">
                            <input type="submit" value="Verify Account" name="verifyAccount" class="btn btn-dark float-end">
                        </div>
                    </div>
                </form>
                <?php
            }
            include "../dbinfo.php";
            if (isset($_POST['verifyAccount'])) {
                $email = $_POST['email'];
                $question = $_POST['securityquestion'];
                $answer = $_POST['securityanswer'];
                $qquery = "SELECT userID, email, name, streamingServices, securityQuestions, securityAnswer, password   FROM accounts WHERE email = '" . $email . "' ";
                $result = mysqli_query($conn, $qquery);
                $resultarray = mysqli_fetch_array($result);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "Invalid Email Format: Email format must match user@website.com.";
                    echo "</div>";
                } elseif (isset($resultarray)) {
                    if (strcasecmp($email, $resultarray['email']) == 0 && $question === $resultarray
                    ['securityQuestions'] && strcasecmp($answer, $resultarray['securityAnswer']) == 0) {
                        ?>
                        <form id="changepass" method="post" action="index.php">
                            <div class="row">
                                <h1 class="mb-3">Hello, <?php echo $resultarray['name']?></h1> <!-- todo put user's first name here from db -->
                                <h4>Let's change your Streamable password</h4>
                                <small class="text-muted mb-3">
                                    Change your password below for the Streamable account associated with the <?php echo $resultarray['email']?> email. Once your password changes, you will need to use your new password to sign in to your Streamable account. <!-- todo fill in user's email here from db -->
                                </small>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="userpassword" placeholder="Password" name="userpassword"
                                        required>
                                        <label for="userpassword" class="form-label">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" name="confirmpassword" required>
                                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 mb-3">
                                    <a href="../sign-in/" class="btn text-muted fs-6 px-1" style="text-decoration: none;">Sign In</a>
                                </div>
                                <div class="col-6 mb-3">
                                    <input id="passwordbtn" type="button" value="Change Password" name="changepassword" class="btn btn-dark float-end">
                                </div>
                            </div>
                        </form>
                        <div id="success" class="alert alert-success" role="alert" style="display: none; text-align: center;">
                            <h4 class="alert-heading">Password Updated</h4>
                            <span>redirecting to sign-in page...</span>       
                        </div>
                        <div id="fail" class="alert alert-danger" role="alert" style="display: none;">Password does not match with Confirm Password</div>
                        <div id="invalid" class="alert alert-danger" role="alert" style="display: none;">
                        *Invalid Password Format:
                            <ul>
                                <li>Minimum 8 characters</li>
                                <li>Maximum 255 characters</li>
                                <li>Must include at least one letter, number, and special character</li>
                            </ul> 
                        </div>
                        <?php
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Incorrect security question or answer.";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "Account not found.";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </body>
<script>
$("#passwordbtn").click(() => {
    let password = $("#userpassword").val();
    let confirm = $("#confirmpassword").val();
    let valid = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,255}$/;
    if (!password.match(valid)) {
        $("#invalid").css("display", "block")
        $("#fail").css("display", "none")
    } else if (password === confirm) {
        $.ajax({
            method: "POST",
            url: "index.php",
            data: {
                userpassword: password,
                confirmpassword: confirm
            },
            success: function() {
                $("#fail").css("display", "none")
                $("#invalid").css("display", "none")
                $("#success").css("display", "block")
                $("#changepass").css("display", "none")
                setTimeout(() => {  window.location.href = "../sign-in/index.php"; }, 3000);
            },
            error: function() {
                console.log("ERROR")
            }
        })
    } else {
        $("#invalid").css("display", "none")
        $("#fail").css("display", "block")
    }
})
</script>
</html>