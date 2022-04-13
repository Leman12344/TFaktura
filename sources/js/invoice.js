 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';  
		htmlRows += '<td><input type="text" name="quantity[]" id="productQuantity_' + count + '" class="form-control" autocomplete="off"></td>';  
		htmlRows += '<td><input type="text" name="productName[]" id="productName_' + count + '" class="form-control" autocomplete="off"></td>';  
		htmlRows += '<td><input type="text" name="unitMeasure[]" id="unit_' + count + '" class="form-control quantity" autocomplete="off"></td>';  
		htmlRows += '<td><input type="number" name="netAmount[]" id="netAmount_' + count + '" class="form-control price" autocomplete="off"></td>';  
		htmlRows += '<td><div class="input-group"><input type="number" name="VAT[]" id="VAT_' + count + '" class="form-control total" autocomplete="off"><div class="input-group-addon">%</div></div></td>';  
		htmlRows += '<td><input type="number" name="VATAmount[]" id="VATAmount_' + count + '" class="form-control total" autocomplete="off"></td>';  
		htmlRows += '<td><input type="number" name="grossAmount[]" id="grossAmount_' + count + '" class="form-control total" autocomplete="off"></td>';
		$('#invoiceItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
	});	
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
	$("#payDays").change(function(){
		var max = parseInt($(this).attr('max'));
		var min = parseInt($(this).attr('min'));
		
		if($(this).val() != ''){
			if($(this).val() > max){
				$(this).val(max);
			}else if ($(this).val() < min){
				$(this).val(min);
			}
		}
	});
	$('#payForm').change(function(){
		var type = $('#payForm option:selected').attr('value');
		
		switch(type){
			case '1':
				$('#payDaysForm').show('slow');
				break;
			default:
				$('#payDaysForm').hide('slow');
		}
	});
	$('#downloadInvoice').click(function(e){
		e.preventDefault();
		var invoiceId = $(this).attr("invoice-id");
		window.location.href = 'generate_invoice.php?id=' + invoiceId + '&type=download';
	});
	$("#searchInvoicesTableInput").on("keyup", function(){
		var value = $(this).val().toLowerCase();
		var checkedValue = $('input[name=searchFilter]:checked', '#invoicesTableSearchForm').val();
		
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("searchInvoicesTableInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("invoiceItems");
		tr = table.getElementsByTagName("tr");
		for(i = 0; i < tr.length; i++){
			td = tr[i].getElementsByTagName("td")[checkedValue];
			if (td) {
				txtValue = td.textContent || td.innerText;
				if(txtValue.toUpperCase().indexOf(filter) > -1){
					tr[i].style.display = "";
				}else{
					tr[i].style.display = "none";
				}
			}       
		}
	});
	
});	

function calculateTotal(){
	/*var totalAmount = 0; 
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var quantity  = $('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;			
	});
	$('#subTotal').val(parseFloat(totalAmount));	
	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();	
	if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(subTotal);		
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {		
			$('#amountDue').val(subTotal);
		}
	}*/
}

function roundToTwo(num){    
    return num.toFixed(2);
}

function calculateSum(){
	/* initialize variables */
	var id, totalVAT = 0, totalNet = 0, totalGross = 0, countAllItems = 0;
	
	/* calculate a sum of VAT */
	$("[id^='VATAmount_']").each(function(){
		id = $(this).attr('id');
		id = id.replace("VATAmount_", "");
		totalVAT += Number($('#VATAmount_' + id).val());
	});
	
	/* calculate a sum of net value */
	$("[id^='netAmount_']").each(function(){
		id = $(this).attr('id');
		id = id.replace("netAmount_", "");
		totalNet += Number($('#netAmount_' + id).val());			
	});
	
	/* calculate a sum of gross value */
	$("[id^='grossAmount_']").each(function(){
		id = $(this).attr('id');
		id = id.replace("grossAmount_", "");
		totalGross += Number($('#grossAmount_' + id).val());			
	});
	
	$("[id^='productQuantity_']").each(function(){
		id = $(this).attr('id');
		id = id.replace("productQuantity_", "");
		countAllItems += Number($('#productQuantity_' + id).val());	
	});
	
	/* show results */
	$('#VATtotal').val(totalVAT.toFixed(2));
	$('#netSum').val(totalNet.toFixed(2));
	$('#grossSum').val(totalGross.toFixed(2));
	$('#itemsQuantity').val(countAllItems);
}

function calculateVAT(id){
	/* initialize variables */
	var id, VATRate, productVAT, totalNet, totalGross = 0;
	
	if(id.substring(0, 3).toLowerCase() == "vat"){
		/* get ID of whole row */
		id = id.replace("VAT_", "");
	}else if(id.substring(0, 3).toLowerCase() == "net"){
		/* get ID of whole row */
		id = id.replace("netAmount_", "");
	}
	
	/* some math */
	if($('#VAT_' + id).val() < 0 || isNaN(Number($('#VAT_' + id).val()))){
		VATRate = Number(0);
	}else{
		VATRate = Number($('#VAT_' + id).val()).toFixed(2);
	}
	totalNet = Number($('#netAmount_' + id).val());
	productVAT = Number(totalNet * VATRate / 100);
	totalGross += productVAT + totalNet;
	
	/* change elements value */
	$('#VATAmount_' + id).val(productVAT.toFixed(2));
	if($('#VATAmount_' + id).val() > 0){
		$('#grossAmount_' + id).val(totalGross.toFixed(2));
		calculateSum(); //call function to calculate sum of net, gross, vat etc.
	}
}

$(document).ready(function(){
	$(document).on('keyup', '[id^=\'VAT_\']', function(){
		/* call function to calculate VAT rate */
		calculateVAT($(this).attr('id'));
	});

	$(document).on('keyup', '[id^=\'netAmount_\']', function(){
		/* call function to calculate VAT rate */
		calculateVAT($(this).attr('id'));
	});
});
