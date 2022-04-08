<!DOCTYPE html>
<?php
session_start();
session_regenerate_id();
?>
<html>
	<head>
		<?php
		include_once("sources/php/head.php");
		$currency_side = $page_config -> getCurrencySide();
		$currency_symbol = $page_config -> getCurrencySymbol();
		$companyBasicInfo = $company -> getUserCompanyBasicInfo();
		$companyDetails = $company -> getUserCompanyDetails();
		?>
		<script src="sources/js/invoice.js"></script>
	</head>
	<body>
		<?php
		include_once("sources/php/menu.php");
		?>
		<div class="container content-invoice">
			<form action="create_proforma.php" id="invoice-form" method="POST" class="invoice-form" role="form" novalidate>
				<div class="load-animate animated fadeInUp">
					<div class="row">
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							Wystawiono dnia: <?php echo date("d-m-Y"); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<h3>Sprzedawca</h3>
							<?php echo $companyBasicInfo['company_name']; ?><br>
							<?php echo $companyDetails['company_postal_code'].' '.$companyDetails['company_city'].', '.$companyDetails['company_street'].' '.$companyDetails['company_st_number']; ?><br>
							<?php echo $companyDetails['email']; ?><br>
							<?php echo 'NIP: '.$companyBasicInfo['nip']; ?><br>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
							<h3>Nabywca</h3>
							<div class="form-group">
								<input type="text" class="form-control" name="companyName" id="companyName" placeholder="Nazwa nabywcy" autocomplete="off">
							</div>
							<div class="form-group">
								<textarea class="form-control" rows="3" name="address" id="address" placeholder="Dane nabywcy"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<table class="table table-bordered table-hover" id="invoiceItem">
								<tr>
									<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
									<th width="6%">Ilość</th>
									<th width="30%">Nazwa towaru/usługi</th>
									<th width="15%">Jednostka miary</th>
									<th width="15%">Kwota netto</th>
									<th width="9%">VAT</th>
									<th width="11%">Kwota VAT</th>
									<th width="11%">Kwota brutto</th>
								</tr>
								<tr>
									<td><input class="itemRow" type="checkbox"></td>
									<td><input type="text" name="quantity[]" id="productQuantity_1" class="form-control" autocomplete="off"></td>
									<td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
									<td><input type="text" name="unitMeasure[]" id="unit_1" class="form-control quantity" autocomplete="off"></td>
									<td><input type="number" name="netAmount[]" id="netAmount_1" class="form-control price" autocomplete="off"></td>
									<td><div class="input-group"><input type="number" name="VAT[]" id="VAT_1" class="form-control total" autocomplete="off"><div class="input-group-addon">%</div></div></td>
									<td><input type="number" name="VATAmount[]" id="VATAmount_1" class="form-control total" autocomplete="off"></td>
									<td><input type="number" name="grossAmount[]" id="grossAmount_1" class="form-control total" autocomplete="off"></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-3 col-md-3 col-lg-4">
							<button class="btn btn-danger delete" id="removeRows" type="button">Usuń zaznaczone</button>
							<button class="btn btn-success" id="addRows" type="button">Dodaj jeden wiersz</button>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
							<h3>Inne: </h3>
							<div class="form-group">
								<select class="form-control" name="payForm" id="payForm">
									<option value="0">Gotówka</option>
									<option value="1">Przelew</option>
									<option value="2">Karta płatnicza</option>
								</select>
							</div>
							<div class="form-group softhidden" id="payDaysForm">
								<div class="input-group">
									<input value="" type="number" class="form-control" name="payDays" id="payDays" min="1" max="60" placeholder="Ilość dni do zapłaty faktury.">
									<div class="input-group-addon currency">dni</div>
								</div>
							</div>
							<div class="form-group">
								<input value="" type="text" class="form-control" name="staged" id="staged" placeholder="Wystawił/a. (domyślnie: <?php echo $companyDetails['representative']; ?>)">
							</div>
							<div class="form-group">
								<input value="" type="text" class="form-control" name="pickedup" id="pickedup" placeholder="Odebrał/a.">
							</div>
							<div class="form-group">
								<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Twoja notka do faktury."></textarea>
							</div>
							<br>
							<div class="form-group">
								<input data-loading-text="Zapisuję..." type="submit" name="invoice_btn" value="Zapisz fakturę" class="btn btn-success submit_btn invoice-save-btm">
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<span class="form-inline">
								<div class="form-group">
									<label>Suma VAT: &nbsp;</label>
									<div class="input-group">
										<?php
										if(!strcmp($currency_side, "left")){
										?>
										<div class="input-group-addon currency"><?php echo $currency_symbol; ?></div>
										<input value="" type="number" class="form-control" name="VATtotal" id="VATtotal" placeholder="Suma podatku VAT">
										<?php
										}else if($currency_side == "right"){
										?>
										<input value="" type="number" class="form-control" name="VATtotal" id="VATtotal" placeholder="Suma podatku VAT">
										<div class="input-group-addon currency"><?php echo $currency_symbol; ?></div>
										<?php
										}
										?>
									</div>
								</div>
								<div class="form-group">
									<label>Netto: &nbsp;</label>
									<div class="input-group">
										<?php
										if($currency_side == "left"){
										?>
										<div class="input-group-addon currency"><?php echo $currency_symbol; ?></div>
										<input value="" type="number" class="form-control" name="netSum" id="netSum" placeholder="Suma netto">
										<?php
										}else if($currency_side == "right"){
										?>
										<input value="" type="number" class="form-control" name="netSum" id="netSum" placeholder="Suma netto">
										<div class="input-group-addon currency"><?php echo $currency_symbol; ?></div>
										<?php
										}
										?>
									</div>
								</div>
								<div class="form-group">
									<label>Brutto: &nbsp;</label>
									<div class="input-group">
										<?php
										if($currency_side == "left"){
										?>
										<div class="input-group-addon currency"><?php echo $currency_symbol; ?></div>
										<input value="" type="number" class="form-control" name="grossSum" id="grossSum" placeholder="Suma brutto">
										<?php
										}else if($currency_side == "right"){
										?>
										<input value="" type="number" class="form-control" name="grossSum" id="grossSum" placeholder="Suma brutto">
										<div class="input-group-addon currency"><?php echo $currency_symbol; ?></div>
										<?php
										}
										?>
									</div>
								</div>
								<div class="form-group">
									<label>Ilość: &nbsp;</label>
									<div class="input-group">
										<?php
										if($currency_side == "left"){
										?>
										<div class="input-group-addon currency">LP</div>
										<input value="" type="number" class="form-control" name="itemsQuantity" id="itemsQuantity" placeholder="Ilość usług/przedmiotów na fakturze">
										<?php
										}else if($currency_side == "right"){
										?>
										<input value="" type="number" class="form-control" name="itemsQuantity" id="itemsQuantity" placeholder="Ilość usług/przedmiotów na fakturze">
										<div class="input-group-addon currency">LP</div>
										<?php
										}
										?>
									</div>
								</div>
							</span>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</form>
		</div>
		<?php
		include_once("sources/php/footer.php");
		?>
	</body>
</html>