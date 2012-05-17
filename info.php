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
<p>weather<br />
[<a href=?c=weather+here>here</a>] [<a href=?c=weather+39406>hattiesburg</a>] [<a href=?c=weather+39339>louisville</a>]</p>
<p>email<br />
[<a href=?c=email>check it</a>]</p>
<p>other<br />
[<a href=?c=ip>ip address</a>] [<a href=?c=clothes>clothes</a>] [<a href=?c=where+am+i>where am i</a>]</p>
</nav>
</body>
</html>
