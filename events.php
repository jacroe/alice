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
<h1><a href=index.php>Alice</a></h1>
</header>
<?php
if ($message) {
echo('<article>
<p>'.$message.'</p>
</article>');
}
?>
<nav>
<p>events<br />
[<a href=?c=event+home>home</a>] [<a href=?c=event+away>away</a>]<br />
[<a href=?c=event+movie>movie</a>] [<a href=?c=event+sleep>sleep</a>]</p>
</nav>
</body>
</html>
