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
<script type="text/javascript">
   function formfocus() {
      document.getElementById('ask').focus();
   }
   window.onload = formfocus;
</script>
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
<p>ask me
<form method=GET action=ask.php>
<input type=text id=ask name=c /> <input type=submit value="Ask" />
</form>
</p>
</body>
</html>
