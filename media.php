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
<p>xbmc<br />
[<a href=?c=xbmc+pause>pause</a>] [<a href=?c=xbmc+rewind>rewind</a>] [<a href=?c=xbmc+forward>forward</a>]<br />
[<a href=?c=xbmc+volume+up>volume up</a>] [<a href=?c=xbmc+volume+down>down</a>] [<a href=?c=xbmc+volume+mute>mute</a>]</p>
<!--<p>spotify<br />
[<a href=?c=spotify+pause>pause</a>] [<a href=?c=spotify+prev>previous</a>] [<a href=?c=xbmc+next>next</a>]</p>
//-->
</nav>
</body>
</html>
