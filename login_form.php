<!DOCTYPE html>
<?php
session_start();
session_regenerate_id();
include_once("sources/php/functions/functions.php");
include_once("sources/php/config.php");
$session = (check_session()) ? header("Location: dashboard.php") : null;
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="sources/js/jquery.min.js"></script>
		<script src="sources/js/bootstrap.min.335.js"></script>
		<title></title>
		<style>
			body {
			color: #000;
			overflow-x: hidden;
			height: 100%;
			background-color: #B0BEC5;
			background-color: #fff;
			background-repeat: no-repeat
			}
			.container-fluid{
			padding: 15px !important;
			}
			.card0 {
			box-shadow: 0px 4px 8px 0px #757575;
			border-radius: 0px
			}
			.card2 {
			margin: 0px 40px
			}
			.logo {
			width: 200px;
			height: 100px;
			margin-top: 20px;
			margin-left: 35px
			}
			.image {
			width: 360px;
			height: 280px
			}
			.border-line {
			border-right: 1px solid #EEEEEE
			}
			.line {
			height: 1px;
			width: 45%;
			background-color: #E0E0E0;
			margin-top: 10px
			}
			.or {
			width: 10%;
			font-weight: bold
			}
			.text-sm {
			font-size: 14px !important
			}
			::placeholder {
			color: #BDBDBD;
			opacity: 1;
			font-weight: 300
			}
			:-ms-input-placeholder {
			color: #BDBDBD;
			font-weight: 300
			}
			::-ms-input-placeholder {
			color: #BDBDBD;
			font-weight: 300
			}
			input,
			textarea {
			padding: 10px 12px 10px 12px;
			border: 1px solid lightgrey;
			border-radius: 2px;
			margin-bottom: 5px;
			margin-top: 2px;
			width: 100%;
			box-sizing: border-box;
			color: #2C3E50;
			font-size: 14px;
			letter-spacing: 1px
			}
			input:focus,
			textarea:focus {
			-moz-box-shadow: none !important;
			-webkit-box-shadow: none !important;
			box-shadow: none !important;
			border: 1px solid #304FFE;
			outline-width: 0
			}
			button:focus {
			-moz-box-shadow: none !important;
			-webkit-box-shadow: none !important;
			box-shadow: none !important;
			outline-width: 0
			}
			a {
			color: inherit;
			cursor: pointer
			}
			.btn-blue {
			background-color: #1A237E;
			width: 150px;
			color: #fff;
			border-radius: 2px
			}
			.btn-blue:hover {
			background-color: #000;
			cursor: pointer
			}
			.bg-blue {
			color: #fff;
			background-color: #1A237E
			}
			@media screen and (max-width: 991px) {
			.logo {
			margin-left: 0px
			}
			.image {
			width: 300px;
			height: 220px
			}
			.border-line {
			border-right: none
			}
			.card2 {
			border-top: 1px solid #EEEEEE !important;
			margin: 0px 15px
			}
			}
		</style>
		<script src="sources/js/invoice.js"></script>
	</head>
	<body>
		<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
			<div class="card card0 border-0">
				<div class="row d-flex">
					<div class="col-lg-6">
						<div class="card1 pb-5">
							<div class="row"> <img src="sources/img/FlovMediaLogo.png" class="logo"> </div>
							<div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card2 card border-0 px-4 py-5">
							<div class="row px-3 mb-4">
								<div class="line"></div>
								<small class="or text-center"> Zaloguj </small>
								<div class="line"></div>
							</div>
							<form action="check_password.php" method="POST">
								<div class="row px-3">
									<label class="mb-1">
										<h6 class="mb-0 text-sm">Login</h6>
									</label>
									<input class="mb-4" type="text" name="login" placeholder="Twój login"> 
								</div>
								<div class="row px-3">
									<label class="mb-1">
										<h6 class="mb-0 text-sm">Hasło</h6>
									</label>
									<input type="password" name="password" placeholder="Twoje hasło"> 
								</div>
								<div class="row px-3 mb-4">
									<div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Pamiętaj mnie</label> </div>
									<a href="recovery_password.php" class="ml-auto mb-0 text-sm">Nie pamiętam hasła</a>
								</div>
								<div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center">Zaloguj się</button> </div>
							</form>
						</div>
					</div>
				</div>
				<div class="bg-blue py-4">
					<div class="row px-3">
						<small class="ml-4 ml-sm-5 mb-2">
							Copyright &copy; by <a href="https://flovmedia.pl" target="_blank">FLOV Media</a> <script>document.write((new Date()).getFullYear());</script>.
						</small>
						<div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>