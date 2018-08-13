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
			grid-template-areas:
				"header header header"
				"nav article article";
			grid-template-rows: 206px 1fr;
			grid-template-columns: 300px 1fr 15%;
			height: 100vh;
			margin: 0;
			font-family: Arial, Helvetica, sans-serif;
		}
		#pageHeader {
			grid-area: header;
		}
		#pageFooter {
			grid-area: footer;
		}
		#mainArticle {
			grid-area: article;
		}
		#mainNav {
			grid-area: nav;
			background:#0065A4;
			color:white;
		}
		article, nav {
			background: gold;
		}
	</style>
</head>
<body>
	<header id="pageHeader">
		<center>
			<div>
				<!-- following div loads the image-->
				<a href="http://a24group.com/" title="a24 Group">
					<img src="https://static1.squarespace.com/static/5149c458e4b0199d103d7411/t/5b682fb10e2e72aae8b968c9/1533554610971/logo.PNG?format=500w" alt="A24 Group">
				</a>
			</div>
		</center>
		<div style="text-align:right;background:#0065A4;color:white;width:100%;">
			<div>
				Welcome <?php echo $_SESSION['username']; ?>
			</div>
			<div>
				Logout
			</div>
		</div>
	</header>
	<article id="mainArticle">Article</article>
	<nav id="mainNav">
		<center>
		<p>Admin</p>
		<p>Joiner</p>
		<p>Leaver</p>
		<p>Mover</p>
		</center>
	</nav>
</body>
