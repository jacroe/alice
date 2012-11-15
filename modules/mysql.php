<?php
/*
NAME:         MySQL Database
ABOUT:        Stores and retrieves all information stored by Alice. 
DEPENDENCIES: None
*/
function alice_mysql_get($table, $prefix)
{
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	
	$result = mysql_query("SELECT * FROM a_$table WHERE (name LIKE '%{$prefix}_%')");
	while($row = mysql_fetch_array($result))
	{
		$name = str_replace($prefix."_", "", $row['name']);
		$array[$name] = $row['value'];

	}
	mysql_close();
	return $array;
}

function alice_mysql_put($table, $prefix, $array)
{
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	
	$time = date("Y-m-d H:i:s");
	foreach($array as $name => $value)
	{
		$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_$table WHERE (name = '{$prefix}_{$name}'))"));
		if($exists[0])
			mysql_query("UPDATE a_$table SET value='$value', lastchanged='$time' WHERE (name='{$prefix}_{$name}');");
		else
			mysql_query("INSERT INTO a_$table(name, value, lastchanged) VALUES ('{$prefix}_{$name}','$value','$time');");

	}
	mysql_close();
	return alice_mysql_get($table, $prefix);
}

function alice_mysql_getImage($name)
{
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	
	$result = mysql_query("SELECT * FROM a_images WHERE (name = '$name') LIMIT 1");
	while($row = mysql_fetch_array($result))
	{
		return array("mime" => $row['mime'], "image" => $row['image']);

	}
	mysql_close();
}

function alice_mysql_putImage($name, $img, $mime="image/jpg")
{
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	
	$time = date("Y-m-d H:i:s");
	$newImage = addslashes($img);
	
	$exists = mysql_fetch_array(mysql_query("SELECT EXISTS(SELECT * FROM a_images WHERE (name = '$name'))"));
	if($exists[0])
		mysql_query("UPDATE a_images SET mime='$mime', image='$newImage', lastchanged='$time' WHERE (name = '$name')");
	else
		mysql_query("INSERT INTO a_images(name, mime, image, lastchanged) VALUES ('$name', '$mime', '$newImage','$time');");
	mysql_close();
}
?>
