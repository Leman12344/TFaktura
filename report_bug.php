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
					<form class="form-horizontal" action="report_bug.php">
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Adres email:</label>
							<div class="col-sm-10">
								<input type="email" value="<?php echo $user -> getUserBasicInfo()['email']; ?>" class="form-control" id="email" placeholder="Kontaktowy adres e-mail" name="email">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="bug-subject">Temat wiadomości:</label>
							<div class="col-sm-10">
								<select class="form-control" id="bug-subject" name="bugSubject">
									<optgroup label="Błąd aplikacji">
										<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Błąd frontend">
											<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faktura">
												<option value="">Nowa faktura</option>
											</optgroup>
										</optgroup>
										<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Błąd backend">
											<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faktura">
											<option value="">Nowa faktura</option>
										</optgroup>
										</optgroup>
									</optgroup>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label><input type="checkbox" name="remember"> Akceptuję <a href="terms_of_report.php">warunki zgłaszania błędów</a>.</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" class="btn btn-info" value="Wyślij">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
		include_once("sources/php/footer.php");
		?>
	</body>
</html>