<?php
/*
NAME:         MySQL Database
ABOUT:        Stores and retrieves all information stored by Alice. 
DEPENDENCIES: None
*/
function alice_mysql_get($table, $prefix, $sort = null)
{
	$db = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	$stmt = $db->prepare("SELECT * FROM a_$table WHERE (name LIKE :name) ORDER BY name $sort");
	$stmt->execute(array(':name'=>"%{$prefix}_%"));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach($rows as $row)
	{
		$name = str_replace($prefix."_", "", $row['name']);
		$array[$name] = $row['value'];

	}
	$stmt = NULL;
	return $array;
}

function alice_mysql_put($table, $prefix, $array)
{
	$db = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	
	$stmtSelect = $db->prepare("SELECT * FROM a_$table WHERE (name = :name)");;
	$stmtUpdate = $db->prepare("UPDATE a_$table SET value=:value, lastchanged=:time WHERE (name=:name);");
	$stmtInsert = $db->prepare("INSERT INTO a_$table(name, value, lastchanged) VALUES (:name,:value,:time);");
	$time = date("Y-m-d H:i:s");
	
	foreach($array as $name => $value)
	{
		$stmtSelect->execute(array(':name'=>"{$prefix}_{$name}"));
		$count = $stmtSelect->rowCount();
		if($count)
			$stmtUpdate->execute(array(':name'=>"{$prefix}_{$name}", ':value'=>$value, ':time'=>$time));
		else
			$stmtInsert->execute(array(':name'=>"{$prefix}_{$name}", ':value'=>$value, ':time'=>$time));

	}
	return alice_mysql_get($table, $prefix);
}

function alice_mysql_remove($table, $prefix, $array)
{
	$db = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	$stmt = $db->prepare("DELETE FROM a_$table WHERE (name = :name) LIMIT 1");
	
	foreach($array as $name)
	{
		$stmt->execute(array(':name'=>"{$prefix}_{$name}"));

	}
	return 1;
}

function alice_mysql_getImage($name)
{
	$db = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	$stmt = $db->prepare("SELECT * FROM a_images WHERE (name = :name) LIMIT 1");
	$stmt->execute(array(':name'=>$name));
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $rows[0];
}

function alice_mysql_putImage($name, $img, $mime="image/jpg")
{
	$db = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	
	$stmtSelect = $db->prepare("SELECT * FROM a_images WHERE (name = :name)");;
	$stmtUpdate = $db->prepare("UPDATE a_images SET mime=:mime, image=:image, lastchanged=:time WHERE (name=:name);");
	$stmtInsert = $db->prepare("INSERT INTO a_images(name, mime, image, lastchanged) VALUES (:name,:mime,:image,:time);");
	$time = date("Y-m-d H:i:s");
	
	$stmtSelect->execute(array(':name'=>$name));
	$count = $stmtSelect->rowCount();
	if($count)
	{
		$stmtUpdate->bindParam(':image', $img, PDO::PARAM_LOB);
		$stmtUpdate->bindParam(':name', $name);
		$stmtUpdate->bindParam(':mime', $mime);
		$stmtUpdate->bindParam(':time', $time);
		$stmtUpdate->execute();
	}
	else
	{
		$stmtInsert->bindParam(':image', $img, PDO::PARAM_LOB);
		$stmtInsert->bindParam(':name', $name);
		$stmtInsert->bindParam(':mime', $mime);
		$stmtInsert->bindParam(':time', $time);
		$stmtInsert->execute();
	}
}

function alice_mysql_removeImage($name)
{
	$db = new PDO('mysql:host='.MYSQL_SERVER.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
	$stmt = $db->prepare("DELETE FROM a_images WHERE (name = :name) LIMIT 1");
	$stmt->execute(array(':name'=>$name));

	return 1;
}
?>
