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
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <script>
        function checkPass() {
            let a = document.getElementById('newPassword').value;
            let b = document.getElementById('confirmPassword').value;

            if (a === b) {
                document.getElementById('message').innerHTML = '';
                document.getElementById('newPass').innerHTML = "<button type\"submit\" class=\"buttons\" id=\"newPass\">Submit</button>";
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Password not matching';
                document.getElementById('newPass').innerHTML = "";
            }
        }
    </script>
</head>
<body>
<!-- following div loads the image-->
<a href="http://a24group.com/" title="a24 Group">
    <img src="https://static1.squarespace.com/static/5149c458e4b0199d103d7411/t/5b682fb10e2e72aae8b968c9/1533554610971/logo.PNG?format=500w"
         alt="A24 Group">
</a>
<br>
<br>
<!--Following load the for-->
<div class="container">
    <form action="../index.php" method="POST">
        <h4><b>New Password</b></h4>
        <input type="password" placeholder="New Password" id="newPassword" required>
        <br>
        <h4><b>Confirm Password</b></h4>
        <input type="password" placeholder="Confirm Password" id="confirmPassword" ; onkeyup='checkPass()' required>
        <input type="hidden" name="ref" value="<?php echo $_GET['ref']; ?>">
        <div id="newPass"></div>
    </form>
    <div><p id="message"></p></div>
    <form action="../index.php" method="POST" style="border:0px;">
        <input type="button" class="buttons" name="cancel" value="Cancel">
    </form>
</div>
</body>
</html>

