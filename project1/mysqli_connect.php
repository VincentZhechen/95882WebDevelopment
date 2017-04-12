<?php
/**
 * Created by PhpStorm.
 * User: 于哲晨
 * Date: 2017/4/2
 * Time: 22:03
 */

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'project1');

// Make the connection
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not 
connect to MySQL: ' .mysqli_connect_error());

mysqli_set_charset($dbc, 'utf8');

?>
