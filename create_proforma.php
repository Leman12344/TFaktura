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
	</head>
	<body>
		<?php
		include_once("sources/php/menu.php");
		?>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php
					$companyDetails = $company -> getUserCompanyDetails();
					$currency_symbol = $page_config -> getCurrencySymbol();
					$newID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM ".DB_PREFIX."invoices ORDER BY id DESC LIMIT 1"));
					$f = new NumberFormatter("pl", NumberFormatter::SPELLOUT);
					$amountInWords = Array(explode("przecinek", $f -> format($_POST['grossSum']))[0], explode(".", $_POST['grossSum'])[1]);
					$amountInWords = $amountInWords[0].' '.$currency_symbol.' '.$amountInWords[1].'/100';
					
					$args = array(
						'buyer_id' => 0,
						'buyer_data' => $_POST['companyName']."\n".$_POST['address'],
						'date_of_invoice' => date("Y-m-d"),
						'payment_method' => $invoice -> generatePaymentMethod($conn, $_POST['payForm']),
						'vat_sum' => $_POST['VATtotal'],
						'netto_sum' => $_POST['netSum'],
						'gross_sum' => $_POST['grossSum'],
						'amount_in_words' => $amountInWords,
						'notes' => $_POST['notes'],
						'days_to_pay' => (!empty($_POST['payDays'])) ? $_POST['payDays'] : 0,
						'staged' => (!empty($_POST['staged'])) ? $_POST['staged'] : $companyDetails['representative'],
						'pickedup' => $_POST['pickedup'],
						'invoice_id' => (isSet($newID['id']) && is_numeric($newID['id'])) ? $newID['id'] + 1 : 1,
						'quantity' => $_POST['quantity'],
						'item_name' => $_POST['productName'],
						'measure_unit' => $_POST['unitMeasure'],
						'netto_amount' => $_POST['netAmount'],
						'vat' => $_POST['VAT'],
						'vat_amount' => $_POST['VATAmount'],
						'gross_amount' => $_POST['grossAmount']
					);
					
					if($invoice -> saveInvoice($conn, $args)){
					?>
					<h2>Dodano nową fakturę!</h2>
					<p>Faktura VAT <b><?php echo $invoice -> getNextID().'/'.date("Y/m/d"); ?></b> znajduje się <a href="generate_proforma.php?id=<?php echo $invoice -> getNextID(); ?>" target="_blank">tutaj</a>.</p>
					<?php
					}else{
					?>
					<h2>Błąd!</h2>
					<p>Nie udało się dodać faktury <b><?php echo $invoice -> getNextID().'/'.date("Y/m/d"); ?></b>.</p>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		include_once("sources/php/footer.php");
		?>
	</body>
</html>