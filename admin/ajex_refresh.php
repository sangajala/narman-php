<?php
require __DIR__ . "/../config.php";
$keyword = '%'.$_POST['quality'].'%';
$sql = mysql_query("SELECT * FROM `quality` WHERE `quality` LIKE '$keyword%' ORDER BY id ASC LIMIT 0, 10");

while($rs=mysql_fetch_array($sql))
{
	// put in bold the written text
	
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['quality']).'\')">'.$rs['quality'].'</li>';
}
?>