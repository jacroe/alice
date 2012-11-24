<?php
/*
NAME:         X10
ABOUT:        Turns off and on X10 devices. Must be preset as shown
DEPENDENCIES: None
*/
function alice_x10($device, $do)
{ 
	
	if($do == "on" || $do == "off")
	{
		exec("nohup flipit flip $device $do > /dev/null 2>&1 & echo $!");
	}
	else
	{
		exec("nohup flipit $do $device 1 > /dev/null 2>&1 & echo $!");
	}
	alice_x10_update($device, $do);
	return true;
	
}

function alice_x10_getSingle($code)
{
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	
	$result = mysql_query("SELECT * FROM a_x10 WHERE (code = '$code') LIMIT 1");
	while($row = mysql_fetch_array($result))
	{
		$name = explode("_", $row['name']);
		return array("name"=>$name[1], "code"=>$row['code'], "type"=>$row['type'], "curState"=>intval($row['curState']));

	}
	mysql_close();
}
function alice_x10_getGroup($group)
{
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	
	$result = mysql_query("SELECT * FROM a_x10 WHERE (name LIKE '%{$group}_%')");
	while($row = mysql_fetch_array($result))
	{
		$name = str_replace($group."_", "", $row['name']);
		$array[] = array("name"=>$name, "code"=>$row['code'], "type"=>$row['type'], "curState"=>intval($row['curState']));

	}
	mysql_close();
	return $array;
}
function alice_x10_update($code, $newState=-1)
{
	$device = alice_x10_getSingle($code);
	
	mysql_connect(MYSQL_SERVER,MYSQL_USER,MYSQL_PASS) or die('Could not connect to database');
	mysql_select_db(MYSQL_DB) or die('Could not select database');
	
	if ($newState == -1) mysql_query("UPDATE a_x10 SET curState='-1' WHERE (code = '$code')");
	elseif ($device['type'] == "appliance")
	{
		if ($newState == "on") mysql_query("UPDATE a_x10 SET curState='1' WHERE (code = '$code')");
		else mysql_query("UPDATE a_x10 SET curState='0' WHERE (code = '$code')");
	}
	else
	{
		if ($newState == "brighten") mysql_query("UPDATE a_x10 SET curState=curState+1 WHERE (code = '$code')");
		elseif ($newState == "dim") mysql_query("UPDATE a_x10 SET curState=curState-1 WHERE (code = '$code')");
		elseif ($newState == "on") mysql_query("UPDATE a_x10 SET curState='10' WHERE (code = '$code')");
		else mysql_query("UPDATE a_x10 SET curState='0' WHERE (code = '$code')");
	}
	mysql_close();
}
?>
