<?php
ini_set('display_errors', 1);
session_start();
session_regenerate_id();
include("sources/php/config.php");
include("sources/php/functions/functions.php");
include("sources/php/classes/classes.php");
$session = (check_session()) ? null : header("Location: login_form.php");
$company = new Company($conn);
$invoice = new Invoice($conn);
$page_config = new PageConfig($conn);

if(isSet($_GET['id'])){
	$id = filter($conn, $_GET['id']);
	
	if(is_numeric($id)){
		$userCompanyBasicInfo = $company -> getUserCompanyBasicInfo();
		$userCompanyExtendedInfo = $company -> getUserCompanyDetails();
		$invoiceInfo = $invoice -> getInvoice($conn, $id);
		$invoiceItems = $invoice -> generatePDFTableItems($invoice -> getInvoiceItems($conn, $id));
		$payDays = $invoice -> generatePayDate($invoiceInfo['date_of_invoice'], $invoiceInfo['days_to_pay']);
		$html = '
		<html>
			<head>

			</head>
			<body>
				<table width="100%">
					<tr>
						<td width="50%" align="left"><img src="sources/img/logo.png" width="200" height="100"/></td> <td align="right"><small>Data wystawienia: '.$invoiceInfo['date_of_invoice'].'<br>Miejsce wystawienia: '.$userCompanyExtendedInfo['company_city'].'</small></td>
					</tr>
					<tr>
						<td align="left" width="50%"><br><br><br>'.$userCompanyBasicInfo['company_name'].'<br>
						'.$userCompanyExtendedInfo['company_postal_code'].' '.$userCompanyExtendedInfo['company_city'].', '.$userCompanyExtendedInfo['company_street'].' '.$userCompanyExtendedInfo['company_st_number'].'<br>
						'.$userCompanyExtendedInfo['email'].'<br>
						NIP: '.$userCompanyBasicInfo['nip'].'</td>
						<td align="right" width="54%"><br><br><br>'.nl2br($invoiceInfo['buyer_data']).'</td>
					</tr>
				</table>
		
				<center><h2>Faktura VAT '.$invoiceInfo['id'].'/'.date('Y/m/d', strtotime($invoiceInfo['date_of_invoice'])).'</h2></center>
		
				<table width="100%" class="invoiceItems">
					<tr>
						<th>LP</th> <th>Nazwa towaru/usługi</th> <th>J. M.</th> <th>Cena netto</th> <th>VAT</th> <th>Wartość VAT</th> <th>Cena brutto</th>
					</tr>
					'.$invoiceItems.'
				</table>
		
				<div class="space"></div>
		
				<div class="parent">
					<div class="note">
						<b>Słownie:</b> '.$invoiceInfo['amount_in_words'].'<br>
						<b>Sposób płatności:</b> '.$invoiceInfo['payment_method'].'<br>
						<b>Termin płatności:</b> '.$payDays.'
						<h3>Notatka do faktury:</h3>
						'.nl2br($invoiceInfo['notes']).'
					</div>
					<div class="summary">
						<h3>Podsumowanie:</h3>
						<table width="100%" class="invoiceItems">
							<tr>
								<th>Suma VAT:</th>
								<td>'.$invoiceInfo['vat_sum'].'</td>
							</tr>
							<tr>
								<th>Suma netto:</th>
								<td>'.$invoiceInfo['netto_sum'].'</td>
							</tr>
							<tr>
								<th>Do zapłaty:</th>
								<td>'.$invoiceInfo['gross_sum'].'</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="clearfix"></div>
		
				<div class="bigspace"></div>
		
				<table width="100%">
					<tr>
						<td><b>Wystawił/a:</b> '.$invoiceInfo['staged'].'</td> <td align="right"><b>Odebrał/a:</b> '.$invoiceInfo['pickedup'].'</td>
					</tr>
				</table>
			</body>
		</html>';

		require_once __DIR__ . '\sources\php\mpdf7\vendor\autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$stylesheet = file_get_contents('mpdfstyleA4.css');
		$mpdf->WriteHTML($stylesheet, 1);
		$mpdf->WriteHTML($html);
		if(isSet($_GET['type']) && !strcmp($_GET['type'], 'download')){
			$mpdf->Output('Faktura '.$invoiceInfo['id'].'_'.$invoiceInfo['date_of_invoice'].'.pdf', 'D');
		}else{
			$mpdf->Output();
		}
		exit;
	}
}else{
?>
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
					<h2>Błąd!</h2>
					<p>Nie udało się wygenerować faktury o danym ID.</p>
				</div>
			</div>
		</div>
		<?php
		include_once("sources/php/footer.php");
		?>
	</body>
</html>
<?php
}
?>