<?php 
    session_start();
    unset($_SESSION['userID']);    
    // session_destory();
    // header("Location: ../sign-in");
?>
<html>

    <head>
        <title>Signing Out | Streamable</title>
    </head>

    <body>
        Signing out...
    </body>
    <script>
    setTimeout(function() {
        window.location = "./sign-in";
    }, 1);
    </script>

</html>
