<?php echo $this->_render('element', 'bill');?>	
<?php 
use lithium\storage\Session;
$employee = Session::read('employee');
?>
<div class="container ">
<br><br><h3>Add INVOICE</h3>
<br><?=$this->form->create('',array('url'=>'/bill/addnewinvoice', 'enctype'=>"multipart/form-data")); ?>
<table  id="" class="table table-bordered table-condensed ">
 <tr>
  <td>MCA#</td>
  <td><INPUT type="text" name="mcaNumber" id="mcaNumber" onblur="checkMCA(this.value);checkInvoices(this.value,'ListBills')" size="10"/></td>
  <td>Name</td>
  <td><INPUT type="text" name="mcaName" id="mcaName" onblur="" size="60"/></td>
  <td>Phone</td>
  <td><INPUT type="text" name="mcaPhone" id="mcaPhone" onblur="" size="10"/></td>
  <td>Date</td>
  <td><INPUT type="text" name="DateTime" id="DateTime" onblur="" size="10" readonly=readonly value=""/></td>
  </tr>
</table>
<table  id="ListBills" class="table table-bordered table-condensed" style="display:none">
 <tr>
  <th style="text-align:center;padding:3px" width="5%">#</th>
  <th style="text-align:center;padding:3px" width="5%">Sel</th>
  <th style="text-align:center;padding:3px" width="5%">Bill #</th>

  <th style="text-align:center" width="5%">Total DP</th>
  <th style="text-align:center" width="5%">Total BV</th>
  <th style="text-align:center" width="5%">Products</th>
  <th style="text-align:center" width="5%">Quantity</th>
  <th style="text-align:center;padding:3px" width="5%">-</th>
  
  </tr>
  <tr>
   <td><INPUT type="number" name="srno[]" class="form-control input-sm" value="1" readonly=readonly/></td>
			<td><INPUT type="checkbox" name="chk[]"/></td>
   
   <td><INPUT type="text" name="bill[]" id="billNO" value="" readonly=readonly/></td>
			
			<td><INPUT type="text" name="TotalDP[]" id="TotalDP" class="  text-right " size="6" readonly=readonly/></td>
   <td><INPUT type="text" name="TotalBV[]" id="TotalBV" class="  text-right " size="6" readonly=readonly/></td>
   <td><INPUT type="text" name="Products[]" id="Products" class="  text-right " size="6" readonly=readonly/></td>
   <td><INPUT type="text" name="Quantity[]" id="Quantity" class="  text-right " size="6" readonly=readonly/></td>
   <td>Details</td>
		</tr>

</table>

  <input type="submit" name="submit" value="Save" id="Submit" class="btn btn-primary" onclick="return checkForm();">
</form>
</div>


<!-- Modal -->
<div class="modal fade" id="billModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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
function checkInvoices(mcaNumber,tableID){
 var  myURL = "/bill/findinvoices/"+mcaNumber;
 $.ajax({crossOrigin: true,
		url: myURL,
	 success: function(data){
   if(data['invoices'].length>0){
    $("#ListBills").show();
    for(i=1;i<=data['invoices'].length-1;i++){
     addRow(tableID);
    }
    
   
 ////// Nestle          / Any Soda  / Pepsi           // 
/////// 444 555 444 55 / 4321 123 11 / 421 132 14321 // 4321132123

    
    var Table = document.getElementById(tableID);
    var rowLength = Table.rows.length;
    for (i = 1; i < rowLength; i++) {
     var Cells = Table.rows.item(i).cells;
     Cells[2].childNodes[0].value=data['invoices'][i-1]['invoiceSr']+data['invoices'][i-1]['invoiceNo'];
     Cells[3].childNodes[0].value=data['invoices'][i-1]['totalDP'];     
     Cells[4].childNodes[0].value=data['invoices'][i-1]['totalBV'];     
     Cells[5].childNodes[0].value=data['invoices'][i-1]['totalItems'];     
     Cells[6].childNodes[0].value=data['invoices'][i-1]['totalProducts'];     
     Cells[7].innerHTML="<button type='button' href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#billModal' onclick=billdetails('"+data['invoices'][i-1]['invoiceSr']+data['invoices'][i-1]['invoiceNo']+"')>"+data['invoices'][i-1]['invoiceSr']+data['invoices'][i-1]['invoiceNo']+"</a>";
    }



   
   }else{
    $("#ListBills").hide();
   }
 }});
}

function billdetails(billNo){
 $('#billModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
}
</script>