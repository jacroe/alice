<?php
/*
NAME:         Groceries Database
ABOUT:        Stores and retrieves grocery information. Generates a shopping list.
DEPENDENCIES: MySQL database (not the module);
*/
function alice_groceries_get($arraySection = array("Clothing", "Health", "Cleaning supplies", "Dairy", "Deli", "Grocery"))
{
	$db = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	$stmt = $db->prepare("SELECT name,aisle,price,needed,section FROM a_groceries WHERE (section LIKE :section) ORDER BY section,aisle DESC");
	foreach($arraySection as $section)
	{
		$stmt->execute(array(':section'=>$section));
		$return[$section] = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	$stmt = NULL;
	return $return;
}
function alice_groceries_mark($item, $needed = true)
{
	$db = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	if ($needed) $stmt = $db->prepare("UPDATE a_groceries SET needed = '1' WHERE name LIKE :name");
	else $stmt = $db->prepare("UPDATE a_groceries SET needed = '0' WHERE name LIKE :name");
	$stmt->execute(array(':name'=>"%$item%"));
	return $stmt->rowCount();
}
function alice_groceries_print($arraySection = array("Clothing", "Health", "Cleaning supplies", "Dairy", "Deli", "Grocery"))
{
	// This function only exists until the Events module is built. This shouldn't be done by this module
	// Perhaps it should? If events are going to be a set of Alice function calls, then this is definitely where this goes. 
	global $smarty;
	$data = alice_groceries_get($arraySection);
	$smarty->assign("data", $data);

	$body = $smarty->fetch("groceryList.tpl");
	file_put_contents("/tmp/grocery.html", $body);
	exec("xvfb-run -a wkhtmltopdf -s Letter /tmp/grocery.html ".DROPBOX."grocery.pdf");
	unlink("/tmp/grocery.html");
	exec("chmod 666 ".DROPBOX."grocery.pdf");
	if(file_exists(DROPBOX."grocery.pdf")) return 1;
	else
	{
		alice_error_add("Grocery Module", "Grocery printing error - File not moved to Dropbox");
		return 0;
	}
}
