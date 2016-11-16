<?php
$dbname = 'database_erg2';
$link = mysql_connect("localhost","root") or die("Couldn't make connection.");
mysql_query('SET NAMES utf8');
$db = mysql_select_db($dbname, $link) or die("Couldn't select database");
?>