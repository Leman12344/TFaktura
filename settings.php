<!DOCTYPE html>
<?php
session_start();
session_regenerate_id();
?>
<html>
	<head>
		<?php
		include_once("sources/php/head.php");
		?>
		<script src="sources/js/invoice.js"></script>
	</head>
	<body>
		<?php
		include_once("sources/php/menu.php");
		?>
		<div class="container content-invoice">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<h3>Zgłoś błąd</h3>
				</div>	
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#home">Ustawienia główne</a></li>
						<li><a data-toggle="tab" href="#menu1">Ustawienia konta</a></li>
						<li><a data-toggle="tab" href="#menu2">Ustawienia systemu</a></li>
					</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<h3>HOME</h3>
						<p>Some content.</p>
					</div>
					
					<div id="menu1" class="tab-pane fade">
						<h3>Menu 1</h3>
						<p>Some content in menu 1.</p>
					</div>
					
					<div id="menu2" class="tab-pane fade">
						<h3>Menu 2</h3>
						<p>Some content in menu 2.</p>
					</div>
				</div>
				</div>
			</div>
		</div>
		<?php
		include_once("sources/php/footer.php");
		?>
	</body>
</html>