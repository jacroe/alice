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
<p>bedroom lamp<br />
[<a href=?c=turn+bedroom+on>on</a>] [<a href=?c=turn+bedroom+off>off</a>] [<a href=?c=brighten+bedroom>brighten</a>] [<a href=?c=dim+bedroom>dim</a>]</p>
<p>living room light<br />
[<a href=?c=turn+livingroom+on>on</a>] [<a href=?c=turn+livingroom+off>off</a>] [<a href=?c=brighten+livingroom>brighten</a>] [<a href=?c=dim+livingroom>dim</a>]</p>
<p>turn bill<br />
[<a href=?c=turn+bill+on>on</a>] [<a href=?c=turn+bill+off>off</a>]</p>
</body>
</html>
