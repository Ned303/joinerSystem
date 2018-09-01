<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Joiner System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: grid;
            grid-template-areas: "header header header" "nav article article";
            grid-template-rows: 75px 1fr;
            grid-template-columns: 160px 1fr 15%;
            height: 100vh;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            overflow: hidden;
        }

        #pageHeader {
            grid-area: header;
            display: flex;
        }

        #mainArticle {
            grid-area: article;
        }

        #mainNav {
            grid-area: nav;
            background: #0065A4;
            color: white;
        }

        article, nav {
            background: white;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #0065A4;
        }

        li a {
            display: block;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
        }

        li a.active {
            background-color: white;
            color: black;
        }

        li a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        div a {
            background-color: transparent;
            color: white;
        }

        button {
            background-color: #0065A4;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
    <script>
        function join() {
            document.getElementById('change').innerHTML = '<iframe src="Joiners.php" width="100%" height="100%"></iframe>';
        }

        function leave() {
            document.getElementById('change').innerHTML = '<iframe src="Leavers.php" width="100%" height="100%"></iframe>';
        }

        function move() {
            document.getElementById('change').innerHTML = '<iframe src="Movers.php" width="100%" height="100%"></iframe>';
        }

        function admin() {
            document.getElementById('change').innerHTML = '<iframe src="Admin.php" width="100%" height="100%"></iframe>';
        }

    </script>
</head>
<body>
<header id="pageHeader">
    <div style="width:50%; background-color: #0065A4; float:left;">
        <!-- following div loads the image-->
        <a href="http://a24group.com/" title="a24 Group">
            <img style="width:160px;"
                 src="https://static1.squarespace.com/static/5149c458e4b0199d103d7411/t/5b682fb10e2e72aae8b968c9/1533554610971/logo.PNG?format=500w"
                 alt="A24 Group">
        </a>
    </div>
    <div style="text-align:right;background:#0065A4;color:white;width:100%;padding-right: 10px;">
        <div style="padding-top:10px;">
            Welcome <?php echo $_SESSION['name']; ?>
        </div>
        <div style="padding-top:10px;">
            <a href="/joinerSystem/index.php">Logout</a>
        </div>
    </div>
</header>
<article id="mainArticle">
    <div id="change">
        <iframe srcdoc="<p style='padding-top: 20px;text-align: center;'>Click on the left menu item to submit a new form</p>"
                width="100%" height="100%"></iframe>
    </div>
</article>
<nav id="mainNav">
	<?php if ($_SESSION['admin']) { ?>
        <button name="admin" onclick="admin()">Admin</button>
	<?php } ?>
    <button name="joiners" onclick="join()">Joiner</button>
    <button name="leavers" onclick="leave()">Leaver</button>
    <button name="movers" onclick="move()">Mover</button>
</nav>
</body>
</html>
