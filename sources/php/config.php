<?php
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_HOST", "localhost");
define("DB_NAME", "tfaktura");
define("DB_PREFIX", "tfaktura_");
define("IV_KEY", "7u0VOIJGJfzw");
define("S_KEY", "WZ31e3xFa6Eq");
define("MD5_SALT", "XqWPiN3H3cPX");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if($conn -> connect_error){
	die("Can't connect to database. Error: " . $conn -> connect_error);
}
?>