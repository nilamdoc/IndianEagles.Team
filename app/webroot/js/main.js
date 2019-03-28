function checkForm(){
	sponsorName = $("#sponsorname").val();
	$("#sponsornameError").html("");
	if(sponsorName==""){
		$("#sponsornameError").html("Reference Name can be blank");
		$("#sponsorname").focus();
	}
	sponsormcano = $("#sponsormcano").val();
	$("#sponsormcanoError").html("");
	if(sponsormcano==""){
		$("#sponsormcanoError").html("Reference Number can be blank");
		$("#sponsormcano").focus();
	}
	name = $("#name").val();
	$("#nameError").html("");
	if(name==""){
		$("#nameError").html("Name cannot be blank");
		$("#name").focus();
		return false;
	}
	surname = $("#surname").val();
	$("#surnameError").html("");
	if(surname==""){
		$("#surnameError").html("Surname cannot be blank");
		$("#surname").focus();
		return false;
	}
	dateofbirth = $("#dateofbirth").val();
	$("#dobError").html("");
	if(dateofbirth==""){
		$("#dobError").html("Date of Birth cannot be blank");
		$("#dateofbirth").focus();
		return false;
	}
	email = $("#email").val();
	$("#emailError").html("");
	if(email==""){
		$("#emailError").html("Email required cannot be blank");
		$("#email").focus();
		return false;
	}
	var pattern = "^.+@[^\.].*\.[a-z,A-Z]{2,}$";
	$("#emailError").html("");
	if ( !email.match(pattern) ) {
		$("#emailError").html("Email not correct");
		$("#email").focus();
		return false;
	}
	address = $("#address").val();
	$("#addressError").html("");
	if(address==""){
		$("#addressError").html("Address required cannot be blank");
		$("#address").focus();
		return false;
	}
	pincode = $("#pincode").val();
	$("#pincodeError").html("");
	if(pincode==""){
		$("#pincodeError").html("Pincode required cannot be blank");
		$("#pincode").focus();
		return false;
	}
	mobile = $("#mobile").val();
	$("#mobileError").html("");
	if(mobile==""){
		$("#mobileError").html("Mobile required cannot be blank");
		$("#mobile").focus();
		return false;
	}
	doc1name = $("#doc1name").val();
	$("#doc1nameError").html("");
	if(doc1name==""){
		$("#doc1nameError").html("Document number required cannot be blank");
		$("#doc1name").focus();
		return false;
	}
	doc2name = $("#doc2name").val();
	$("#doc2nameError").html("");
	if(doc2name==""){
		$("#doc2nameError").html("Document number required cannot be blank");
		$("#doc2name").focus();
		return false;
	}
	doc1 = $("#doc1").val();
	$("#doc1Error").html("");
	if(doc1==""){
		$("#doc1Error").html("Document not selected cannot be blank");
		$("#doc1").focus();
		return false;
	}
	doc2 = $("#doc2").val();
	$("#doc2Error").html("");
	if(doc2==""){
		$("#doc2Error").html("Document not selected cannot be blank");
		$("#doc2").focus();
		return false;
	}
	file1 = $("#File1").val();
	$("#file1Error").html("");
	if(file1==""){
		$("#file1Error").html("Document not selected cannot be blank");
		$("#File1").focus();
		return false;
	}
	file2 = $("#File2").val();
	$("#file2Error").html("");
	if(file2==""){
		$("#file2Error").html("Document not selected cannot be blank");
		$("#File2").focus();
		return false;
	}
	$("#Register").submit();
}

function checkFormRegister(){
		name = $("#name").val();
	$("#nameError").html("");
	if(name==""){
		$("#nameError").html("Name cannot be blank");
		$("#name").focus();
		return false;
	}
	surname = $("#surname").val();
	$("#surnameError").html("");
	if(surname==""){
		$("#surnameError").html("Surname cannot be blank");
		$("#surname").focus();
		return false;
	}
	dateofbirth = $("#dateofbirth").val();
	$("#dobError").html("");
	if(dateofbirth==""){
		$("#dobError").html("Date of Birth cannot be blank");
		$("#dateofbirth").focus();
		return false;
	}
	email = $("#email").val();
	$("#emailError").html("");
	if(email==""){
		$("#emailError").html("Email required cannot be blank");
		$("#email").focus();
		return false;
	}
	var pattern = "^.+@[^\.].*\.[a-z,A-Z]{2,}$";
	$("#emailError").html("");
	if ( !email.match(pattern) ) {
		$("#emailError").html("Email not correct");
		$("#email").focus();
		return false;
	}
	address = $("#address").val();
	$("#addressError").html("");
	if(address==""){
		$("#addressError").html("Address required cannot be blank");
		$("#address").focus();
		return false;
	}
	pincode = $("#pincode").val();
	$("#pincodeError").html("");
	if(pincode==""){
		$("#pincodeError").html("Pincode required cannot be blank");
		$("#pincode").focus();
		return false;
	}
	mobile = $("#mobile").val();
	$("#mobileError").html("");
	if(mobile==""){
		$("#mobileError").html("Mobile required cannot be blank");
		$("#mobile").focus();
		return false;
	}
	$("#Register").submit();
	
}
function changePV(){
	var mcaNumber = $("#mcaNumber").val();
	var YearMonth = $("#YearMonth").val();
	$.getJSON('/users/getPV/'+mcaNumber+'/'+YearMonth,
	function(Result){
		$('#PVVal').html(Result['PV']);
		$('#BVVal').html(Result['BV']);
		$('#PV').val(Result['PV']);
		$('#BV').val(Result['BV']);
		$('#Previous').val(Result['Previous']);
});
}
function searchName(){
	var mcaName = $("#mcaName").val();
	$.getJSON('/users/searchName/'+mcaName,
	function(Result){
		$('#result').html(Result['resultTable']);
});
}
function searchNumber(){
	var mcaNumber = $("#mcaNumber").val();
	$.getJSON('/users/searchNumber/'+mcaNumber,
	function(Result){
		$('#result').html(Result['resultTable']);
});
}
function getDPBV(next,tableID){
	var table = document.getElementById(tableID);
	var row = table.rows[next];
	var value = $(row).find("select[id=Code]").val();
	var Quantity = 0;
	var GTotalDP = 0;
	var GTotalBV = 0;

	$.getJSON('/mca/getDPBV/'+value,
	function(Result){
				var row = table.rows[next];
				$(row).find("input[id=DP]").val(Result['product']['DP']);
				$(row).find("input[id=BV]").val(Result['product']['BV']);
				$(row).find("input[id=TotalDP]").val(Result['product']['DP']*$(row).find("input[id=Quantity]").val());
				$(row).find("input[id=TotalBV]").val(Result['product']['BV']*$(row).find("input[id=Quantity]").val());
				
				
	table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	$("#Items").html(rowCount-1);
	table = document.getElementById(tableID);
	
	for(var i=1; i<rowCount; i++) {
		row = table.rows[i];
		
		console.log($(row).find(".Code").val());
		Quantity = Quantity + parseFloat($(row).find(".Quantity").val());
		GTotalDP = GTotalDP + parseFloat($(row).find(".TotalDP").val());
		GTotalBV = GTotalBV + parseFloat($(row).find(".TotalBV").val());
	}
	
	$("#QuantityItems").html(Quantity);
	$("#GTotalDP").html(GTotalDP);
	$("#GTotalBV").html(GTotalBV);
				
				
				
		}
	);
}

function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
   if(rowCount>=21){return false;}
			var row = table.insertRow(rowCount);

			var colCount = table.rows[1].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[1].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = "";
							break;
					case "number":
							newcell.childNodes[0].value = rowCount;
							break;							
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 1;
							break;
				}
			}
		}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;
	
			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[1].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 2) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}
function checkIFSC(code){
	$("#IFSCCode").val(code.toUpperCase());
	$.getJSON('/mca/getIFSC/'+code.toUpperCase(),
	function(Result){
		$('#IFSCoptions').html('');
		Result['IFSCcodes'].forEach(function(codes){
			$('#IFSCoptions').append($('<option>', { 
        value: codes,
        text : codes 
    }));
		});
});
}
function selectIFSC(code){
	$("#IFSCCode").val(code.toUpperCase());
	$.getJSON('/mca/selectIFSC/'+code.toUpperCase(),
	function(Result){
		$('#bank').html(Result['bank']['BANK']);
		$('#bankifsc').html(Result['bank']['IFSC']);
		$('#bankbranch').html(Result['bank']['BRANCH']);
		$('#bankaddress').html(Result['bank']['ADDRESS']);
		$('#bankcity').html(Result['bank']['CITY']);
		$('#bankstate').html(Result['bank']['STATE']);
	});
	
}