<?php
include_once("config.php");
include_once("functions/functions.php");
include_once("classes/classes.php");

$session = (check_session()) ? null : header("Location: login_form.php");
$page_config = new PageConfig($conn);
$user = new User($conn);
$company = new Company($conn);
$invoice = new Invoice($conn);
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $page_config -> getCharset(); ?>" />
		<link rel="stylesheet" href="sources/css/bootstrap.min.335.css">
		<link rel="stylesheet" href="sources/css/style.css">
		<script src="sources/js/jquery.min.js"></script>
		<script src="sources/js/bootstrap.min.335.js"></script>
		<title><?php echo $page_config -> getTitle(); ?></title>
