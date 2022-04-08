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
		if(isSet($_GET['page'])){
			$page = filter($conn, $_GET['page']);
		}else{
			$page = 1;
		}
		$pages = $invoice -> invoicesPagination($conn);
		$invoices = $invoice -> getInvoices($conn, $page);
		$currency_symbol = $page_config -> getCurrencySymbol();
		?>
		<div class="container content-invoice">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
					<h3>Lista wszystkich faktur</h3>
					<a href="invoice_list.php" class="btn btn-success">&darr; Pobierz zaznaczone</a>
					<a href="invoice_list.php" class="btn btn-danger">Usuń zaznaczone</a>
				</div>	
			</div>
			
			<div class="row" style="margin-top: 20px;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<form id="invoicesTableSearchForm">
						<input type="text" class="form-control" id="searchInvoicesTableInput" placeholder="Szukaj po..."/>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-default active">
								<input type="radio" name="searchFilter" value="1" checked="checked"/> Wystawiona przez
							</label> 
							<label class="btn btn-default">
								<input type="radio" name="searchFilter" value="2" /> Sprzedawca
							</label> 
							<label class="btn btn-default">
								<input type="radio" name="searchFilter" value="3" /> Odbiorca
							</label> 
							<label class="btn btn-default">
								<input type="radio" name="searchFilter" value="4" /> Data wystawienia
							</label> 
							<label class="btn btn-default">
								<input type="radio" name="searchFilter" value="5" /> Termin płatności
							</label>
						</div>
					</form>
					<br>
					<table class="table table-bordered table-hover" id="invoiceItems">
						<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="15%">Wystawiona przez</th>
							<th width="19%">Sprzedawca</th>
							<th width="19%">Odbiorca</th>
							<th width="11%"><a href="invoice_list.php?sort_type=date&sort=<?php echo (isSet($_GET['sort_type']) && !strcmp($_GET['sort_type'], 'date') && isSet($_GET['sort']) && !strcmp($_GET['sort'], 'asc')) ? 'dsc' : 'asc'; ?>">Data wystawienia</a></th>
							<th width="11%"><a href="invoice_list.php?sort_type=pay_date&sort=<?php echo (isSet($_GET['sort_type']) && !strcmp($_GET['sort_type'], 'pay_date') && isSet($_GET['sort']) && !strcmp($_GET['sort'], 'asc')) ? 'dsc' : 'asc'; ?>">Termin płatności</a></th>
							<th width="10%">Sposób płatności</th>
							<th width="9%">Brutto</th>
							<th width="4%">Akcja</th>
						</tr>
						
						<?php
						for($i = 0; $i < count($invoices); $i++){
							$paydate = $invoice -> generatePayDate($invoices[$i]['date_of_invoice'], $invoices[$i]['days_to_pay']);
						?>
						<tr>
						<td><input class="itemRow" type="checkbox"></td> <td><?php echo $invoices[$i]['staged']; ?></td> <td><?php echo nl2br($invoices[$i]['buyer_data']); ?></td> <td><?php echo $invoices[$i]['pickedup']; ?></td> <td><?php echo $invoices[$i]['date_of_invoice']; ?></td> <td><?php echo $paydate; ?></td> <td><?php echo $invoices[$i]['payment_method']; ?></td> <td><?php echo $invoices[$i]['gross_sum'].' '.$currency_symbol; ?></td> <td><a href="generate_invoice.php?id=<?php echo $invoices[$i]['id']; ?>" target="_blank">Zobacz</a><br><a href="return: null;" id="downloadInvoice" invoice-id="<?php echo $invoices[$i]['id']; ?>">Pobierz</a></td>
						</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-6">
					<a href="invoice_list.php" class="btn btn-success">&darr; Pobierz zaznaczone</a>
					<a href="invoice_list.php" class="btn btn-danger">Usuń zaznaczone</a>
				</div>	
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-12 text-center">
					<div class="btn-group">
					<?php
					$active = 'active';
					for($i = 0; $i < $pages; $i++){
						if(isSet($_GET['page']) && $_GET['page'] == $i){
						?>
						<a href="?page=<?php echo $i + 1; ?>" class="btn btn-default active"><?php echo $i + 1; ?></a>
						<?php
						}else if(!isSet($_GET['page'])){
						?>
						<a href="?page=<?php echo $i + 1; ?>" class="btn btn-default <?php echo $active; ?>"><?php echo $i + 1; ?></a>
						<?php
						$active = '';
						}else{
						?>
						<a href="?page=<?php echo $i + 1; ?>" class="btn btn-default"><?php echo $i + 1; ?></a>
						<?php
						}
					}
					?>
					</div>
				</div>
			</div>
		</div>
		<?php
		include_once("sources/php/footer.php");
		?>
	</body>
</html>