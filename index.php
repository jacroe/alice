<?php
require "alice.php";
if ($_GET['c']) $message = alice_check_command($_GET['c']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Alice</title>
<link rel="stylesheet" href="styles.css" />
<meta charset="utf-8" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<header>
<h1><a href=?>Alice</a></h1>
</header>
<?php
if ($message) {
echo('<article>
<p>'.$message.'</p>
</article>');
}
?>
<nav>
<p class=main>[<a href=home.php>home</a>] [<a href=events.php>events</a>] [<a href=media.php>media</a>] [<a href=info.php>information</a>] [<a href=ask.php>ask me</a>]</p>
</nav>
</body>
</html>
