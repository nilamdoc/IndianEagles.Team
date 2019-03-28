<?php echo $this->_render('element', 'bill');?>	
<?php 
use lithium\storage\Session;
$employee = Session::read('employee');
?>
<div class="container ">
<br><br><h3>Add BILL (Temporary)</h3>
<br><?=$this->form->create('',array('url'=>'/bill/addnew', 'enctype'=>"multipart/form-data")); ?>
<table  id="" class="table table-bordered table-condensed ">
 <tr>
  <td>MCA#</td>
  <td><INPUT type="text" name="mcaNumber" id="mcaNumber" onblur="checkMCA(this.value)" size="10"/></td>
  <td>Name</td>
  <td><INPUT type="text" name="mcaName" id="mcaName" onblur="" size="60"/></td>
  <td>Phone</td>
  <td><INPUT type="text" name="mcaPhone" id="mcaPhone" onblur="" size="10"/></td>
  <td>Date</td>
  <td><INPUT type="text" name="DateTime" id="DateTime" onblur="" size="10" readonly=readonly value=""/></td>
  </tr>
</table>
<strong>Search Product Name: </strong>
<table id="SearchTable" class="table table-condensed">
 <tr>
 <td style="width:25%"><INPUT class="form-control" type="text" name="pname[]" id="PNAME" size="10"  onkeyup="checkname(this.value,  $(this).closest('tr').index(),'SearchTable')"/></td>
 <td><select id="selectName"  name="selectName" class="form-control"></select>
 </td>
 </tr>
</table>

		<table id="TotalTable" class="table table-condensed">
		<tr style="font-weight:bold;background-color:pink">
   <td width="5%" style="padding:3px">&nbsp;</td>
   <td width="5%" style="padding:3px">&nbsp;</td>
   <td width="10%" style="padding:3px">&nbsp;</td>
   <td width="5%">&nbsp;</td>
   <td width="40%">Grand Total</td>
   <td width="5%">&nbsp;</td>
   <td width="5%" class="text-right" id="Items"></td>
			<td width="5%" class="text-right" id="QuantityItems"></td>
			<td width="5%" class="text-right" id="GTotalDP"></td>
			<td width="5%" class="text-right" id="GTotalBV"></td>
   <td width="2%">&nbsp;</td>
   <td width="3%">&nbsp;</td>
		</tr>
		</table>
<table  id="dataTable" class="table table-bordered table-condensed">
 <tr>
  <th style="text-align:center;padding:3px" width="5%">#</th>
  <th style="text-align:center;padding:3px" width="5%">Sel</th>
  <th style="text-align:center;padding:3px" width="10%">EAN</th>
  <th style="text-align:center;padding:3px" width="5%">Code</th>
  <th style="padding:3px" width="40%">Name</th>
  <th style="text-align:center" width="5%">DP</th>
  <th style="text-align:center" width="5%">BV</th>
  <th style="text-align:center" width="5%">Quantity</th>
  <th style="text-align:center" width="5%">Total DP</th>
  <th style="text-align:center" width="5%">Total BV</th>
  <th style="text-align:center" width="2%"><i class="glyphicon glyphicon-ok" style="color:green" onclick="addRow('dataTable')"></i></th>
  <th style="text-align:center" width="3%"><i class="glyphicon glyphicon-remove" style="color:red" onclick="deleteRow('dataTable')" ></i></th>
  </tr>
  <tr>
		<td><INPUT type="number" name="srno[]" class="form-control input-sm" value="1" readonly=readonly/></td>
			<td><INPUT type="checkbox" name="chk[]"/></td>
   <td><INPUT type="text" name="ean[]" id="EAN" onblur="checkean(this.value,  $(this).closest('tr').index(),'dataTable')" size="13"/></td>
   <td><INPUT type="text" name="code[]" id="CODE" onkeyup="this.value=this.value.toUpperCase()" onblur="checkcode(this.value,  $(this).closest('tr').index(),'dataTable')" size="6"/></td>
			<td><INPUT type="text" name="name[]" id="NAME" readonly=readonly size="50" /></td>
			<td><INPUT type="text" name="DP[]" id='DP' class=" DP text-right " readonly=readonly size="6" /></td>
			<td><INPUT type="text" name="BV[]" id='BV' class=" BV text-right " readonly=readonly size="6" /></td>
			<td><INPUT type="text" name="Quantity[]" id="Quantity" size="6" class="Quantity text-right  " onblur="getDPBV($(this).closest('tr').index(),'dataTable');" value=""/></td>
			<td><INPUT type="text" name="TotalDP[]" id="TotalDP" class=" TotalDP text-right " size="6" readonly=readonly/></td>
			<td><INPUT type="text" name="TotalBV[]" id="TotalBV" class=" TotalBV text-right " size="6" readonly=readonly/></td>
   <td style="text-align:center"><i class="glyphicon glyphicon-ok" style="color:green" onclick="addRow('dataTable')"></i></td>
   <td style="text-align:center"><i class="glyphicon glyphicon-remove" style="color:red" onclick="deleteRow('dataTable')" ></i></td>
		</tr>
</table>
<table  id="AddDataTable" class="table table-bordered table-condensed">
 <tr>
   <th style="text-align:center;padding:3px" width="5%">Extra</td>
  	<th style="padding:3px" width="60%">Description</td>
   <th  style="text-align:center" width="10%">Price</td>
   <th style="text-align:center" width="10%">Quantity</td>
   <th style="text-align:center" width="10%">Total</td>
   
  <th style="text-align:center" width="2%"><i class="glyphicon glyphicon-ok" style="color:green" onclick="addRow('AddDataTable')"></i></th>
  <th style="text-align:center" width="3%"><i class="glyphicon glyphicon-remove" style="color:red" onclick="deleteRow('AddDataTable')" ></i></th>
 </tr>
 <tr>
   <td><INPUT type="number" name="srex[]" class="form-control input-sm" value="1" readonly=readonly/></td>
  	<td style="padding:3px" width="60%"><INPUT type="text" name="Extra" id="Extra" size="100" /></td>
   <td  style="" width="10%"><INPUT type="text" name="ExtraPrice[]" id='ExtraPrice' class="ExtraPrice"  size="6" /></td>
   <td style="" width="10%"><INPUT type="text" name="ExtraQuantity[]" id="ExtraQuantity" size="6" class="ExtraQuantity text-right  " onblur="getExtra($(this).closest('tr').index(),'AddDataTable');" value=""/></td>
   <td style="" width="10%"><INPUT type="text" name="ExtraValue[]" id="ExtraValue" class="ExtraValue  text-right " size="6" readonly=readonly/></td>
   <td style=""><i class="glyphicon glyphicon-ok" style="color:green" onclick="addRow('AddDataTable')"></i></td>
   <td style=""><i class="glyphicon glyphicon-remove" style="color:red" onclick="deleteRow('AddDataTable')" ></i></td>
  </tr>
</table>
 <h4>Payment:</h4>
  <select name="payment" id="payment" class="form-control">
  <?php foreach($options as $o){ ?>
  <option value="<?=$o['Method']?>" <?php if($o['Method']=="Cash"){echo " selected ";}?>><?=$o['Method']?></option>
  <?php }?>
  </select><br>
 <h4>Remarks:</h4>
 <textarea name="Remarks" id="Remarks" class="form-control"></textarea><br>
  <input type="submit" name="submit" value="Save" id="Submit" class="btn btn-primary" onclick="return checkForm();">
  <input type="hidden" name="bill" id="bill" value="<?=$employee['bill']?>">
  <input type="hidden" name="invoice" id="invoice" value="<?=$employee['invoice']?>">
  <input type="hidden" name="prepared" id="prepared" value="<?=$employee['Name']?>">
  <input type="hidden" name="preparedMobile" id="preparedMobile" value="<?=$employee['phone']?>">
  <input type="hidden" name="DPName" id="DPName" value="<?=$employee['DP']?>">
</form>
</div>
<style>
th{
 background-color:black;
 color:white;
}
</style>
<script>
var formattedDate = new Date();
var d = formattedDate.getDate();
var m =  formattedDate.getMonth();
m += 1;  // JavaScript months are 0-11
var y = formattedDate.getFullYear();
$("#DateTime").val(y +"-"+ m +"-"+ d);

function checkForm(){
 if($("#mcaNumber").val()==""){return false;}
 if($("#mcaName").val()==""){return false;}
 if($("#mcaPhone").val()==""){return false;}
 if($("#GTotalDP").html()=="" || $("#GTotalDP").html()=="0"){return false;}
 if(!confirm("Save this bill?")){return false;}
}
function checkean(ean,row,tableID){
 console.log(row);
 var  myURL = "/bill/findean/"+ean;
 $.ajax({ 	  		crossOrigin: true,
		url: myURL,
   success: function(data){
   console.log(data['product']['Code']);
   //data['product']['Code']
   	var table = document.getElementById(tableID);
    var rowe = table.rows[row];
    $(rowe).find("input[id=CODE]").val(data['product']['Code']);
    $(rowe).find("input[id=NAME]").val(data['product']['Name']+" - "+data['product']['Size']);
    $(rowe).find("input[id=DP]").val(data['product']['DP']);
    $(rowe).find("input[id=BV]").val(data['product']['BV']);
    $(rowe).find("input[id=EAN]").val(data['product']['EAN']);
  }
 });
}
function checkname(name,row,tableID){
 if(name.lenght<3){return false;}
 var  myURL = "/bill/findname/"+name;
 $.ajax({ 	  		crossOrigin: true,
		url: myURL,
	 success: function(data){
   		$('#selectName').html('');
    data['products'].forEach(function(codes){
			$('#selectName').append($('<option>', { 
        value: codes,
        text : codes 
    }));
		});
 }});
}
function checkcode(code,row,tableID){
 
 var  myURL = "/bill/findcode/"+code;
 $.ajax({ 	  		crossOrigin: true,
		url: myURL,
	 success: function(data){
   //console.log(data['product']['Code']);
   //data['product']['Code']
   	var table = document.getElementById(tableID);
    var rowe = table.rows[row];
    $(rowe).find("input[id=CODE]").val(data['product']['Code']);
    $(rowe).find("input[id=NAME]").val(data['product']['Name']+" - "+data['product']['Size']);
    $(rowe).find("input[id=DP]").val(data['product']['DP']);
    $(rowe).find("input[id=BV]").val(data['product']['BV']);
    $(rowe).find("input[id=EAN]").val(data['product']['EAN']);
  }
 });
}
function getDPBV(row,tableID){
	var table = document.getElementById(tableID);
 
	var rowe = table.rows[row];
	var value = $(rowe).find("input[id=CODE]").val();
// console.log(value);
	var Quantity = 0;
	var GTotalDP = 0;
	var GTotalBV = 0;

	$.getJSON('/bill/findcode/'+value,
	function(Result){
				var rowe = table.rows[row];
				$(rowe).find("input[id=DP]").val(Result['product']['DP']);
				$(rowe).find("input[id=BV]").val(Result['product']['BV']);
    
				$(rowe).find("input[id=TotalDP]").val(Result['product']['DP']*$(rowe).find("input[id=Quantity]").val());
				$(rowe).find("input[id=TotalBV]").val(Result['product']['BV']*$(rowe).find("input[id=Quantity]").val());
				
				
	table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	$("#Items").html(rowCount-1);
	table = document.getElementById(tableID);
	Quantity = 0; GTotalDP = 0;GTotalBV = 0;
	for(var i=1; i<rowCount; i++) {
		var rowe = table.rows[i];
		
		Quantity = Quantity + parseFloat($(rowe).find(".Quantity").val());
		GTotalDP = GTotalDP + parseFloat($(rowe).find(".TotalDP").val());
		GTotalBV = GTotalBV + parseFloat($(rowe).find(".TotalBV").val());
	}
	
	$("#QuantityItems").html(Quantity);
	$("#GTotalDP").html(GTotalDP);
	$("#GTotalBV").html(GTotalBV);
		}
	);

 
 
 
 
 
 
 
 
 
 
}
function getExtra(row, tableID){
 getDPBV(0,'dataTable');
 var table = document.getElementById(tableID);
 
 var Items = $("#QuantityItems").html();
	var DP = $("#GTotalDP").html();
	var BV = $("#GTotalBV").html();
 var rowe = table.rows[row];
 
	var Price = $(rowe).find("input[id=ExtraPrice]").val();
	var Quantity = $(rowe).find("input[id=ExtraQuantity]").val();
 $(rowe).find("input[id=ExtraValue]").val(Price*Quantity);
 
 table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	Items = parseFloat(Items) ;
	
	Q = 0;GTotalDP =0;
	for(var i=1; i<rowCount; i++) {
		var rowe = table.rows[i];
		Q = parseFloat(Q) + parseFloat($(rowe).find(".ExtraQuantity").val());
		GTotalDP = parseFloat(GTotalDP) + parseFloat($(rowe).find(".ExtraValue").val());
		
	}

 $("#GTotalDP").html(parseFloat(DP) + parseFloat(GTotalDP));
 $("#QuantityItems").html(parseFloat(Quantity) + parseFloat(Items));
 
				
}
function checkMCA(mcaNumber){
 var  myURL = "/bill/findmca/"+mcaNumber;
 
 $.ajax({crossOrigin: true,
		url: myURL,
	 success: function(data){
    $("#mcaName").val(data['user']['mcaName']);
    $("#mcaPhone").val(data['user']['mcaPhone']);
 }});
 
	
}
</script>