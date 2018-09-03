<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Joiner System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {

        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .buttons {
            background-color: #0065A4;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .buttons:hover {
            opacity: 0.8;
        }

        .buttons:disabled {
            opacity: 0;
        }

        .container {
            padding: 16px;
            border-radius: 25px;
            border: 3px solid #f1f1f1;
            width: 30%;
            margin: auto;
            border-radius: 25px;
            border-collapse: separate;
            border-spacing: 1.5em;
            position:relative;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #loader-section {
            background: grey;
            position: absolute;
            top: 0;
            z-index: 1;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.5;
            display: none;
            align-items: center;
            border-radius: 25px;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #0065A4;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
            margin-left: auto;
            margin-right: auto;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>

    <script>
        function checkPass() {
            let a = document.getElementById('newPassword').value;
            let b = document.getElementById('confirmPassword').value;

            if (a === b) {
                document.getElementById('message').innerHTML = '';
                document.getElementById('newPass').innerHTML = "<button type=\"submit\" class=\"buttons\"name=\"newPass\">Submit</button>";
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Password not matching';
                document.getElementById('newPass').innerHTML = "";
            }
        }

        function showLoader() {
            document.getElementById('loader-section').style.display = "flex";
        }
    </script>
</head>
<body>
<!-- following div loads the image-->
<img src="../images/JoinerSystem.png" style="width: 349px;"alt="JoinerSystem">
<br>
<br>
<!--Following load the for-->
<div class="container">
    <form action="../index.php" method="POST" onsubmit="showLoader();">
        <h4><b>New Password</b></h4>
        <input type="password" placeholder="New Password" id="newPassword" required>
        <br>
        <h4><b>Confirm Password</b></h4>
        <input type="password" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" onkeyup='checkPass()' required>
        <div id="newPass"></div>
        <input type="hidden" name="ref" value="<?php echo $_GET['ref']; ?>">
    </form>
    <div><p id="message"></p></div>
    <form action="../index.php" method="POST" style="border:0px;">
        <input type="submit" class="buttons" name="cancel" value="Cancel">
    </form>
    <div id="loader-section">
        <div class="loader"></div>
    </div>
</div>
</body>
</html>

