<br>
<div style="margin:auto;width:90%;background-color:white" class="table-responsive">
<div class="row" style="width:90%;margin:auto"><br>
	<div class="col-md-2">
	</div>
	<div class="col-md-4">
		<INPUT type="button" value="Add Row" onclick="addRow('dataTable')" class="form-control btn btn-primary"/>
	</div>
	<div class="col-md-4">
		<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')"  class="form-control btn btn-warning"/>
	</div>
	<div class="col-md-2">
	</div>
</div><hr>
<?=$this->form->create(null,array('class'=>'form-group','id'=>'Order')); ?>
<h3 style="background: rgb(238, 238, 238) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 5px 10px;">Select Products</h3>
	<TABLE id="dataTable" class="table table-condensed table-bordered">
		<tr>
			<th>#</th>
			<th>Select</th>
			<th>Product</th>
			<th>Quantity</th>
			<th>DP</th>
			<th>BV</th>
			<th>Total DP</th>
			<th>Total BV</th>
		</tr>
		<tr>
		<TD><INPUT type="number" name="srno[]" class="form-control  input-sm" value="1" readonly=readonly/></TD>
			<TD><INPUT type="checkbox" name="chk[]" class="form-control"/></TD>
			<TD>
				<select class="form-control Code  input-sm" name="Code[]" onblur="getDPBV($(this).closest('tr').index(),'dataTable');"  id="Code">
					<?php foreach($products as $p){ 
						$Category = $p['Category'];
						if($Category != $OldCategory){
					?>
					<optgroup label="<?=$Category?>">
						<?php }?>
					<option value="<?=$p['Code']?>"><?=$p['Code']?> - <?=$p['Name']?></option>
					<?php 
					$OldCategory = $Category;
					}	?>
				</select>
			</TD>
			<TD><INPUT type="text" name="Quantity[]" id="Quantity" class="form-control Quantity text-right  input-sm" onblur="getDPBV($(this).closest('tr').index(),'dataTable');"/></TD>
			<td><INPUT type="text" name="DP[]" id='DP' class="form-control DP text-right input-sm" readonly=readonly /></td>
			<td><INPUT type="text" name="BV[]" id='BV' class="form-control BV text-right input-sm" readonly=readonly/></td>
			<td><INPUT type="text" name="TotalDP[]" id="TotalDP" class="form-control TotalDP text-right input-sm" readonly=readonly/></td>
			<td><INPUT type="text" name="TotalBV[]" id="TotalBV" class="form-control TotalBV text-right input-sm" readonly=readonly/></td>
		</tr>
	</TABLE>
		<TABLE id="TotalTable" class="table table-condensed table-bordered">
			<tr>
			<th>Items</th>
			<th>Quantity</th>
			<th>Grand Total DP</th>
			<th>Grand Total BV</th>
		</tr>

		<tr>
			<th id="Items"></th>
			<th id="QuantityItems"></th>
			<th id="GTotalDP"></th>
			<th id="GTotalBV"></th>
		</tr>
		</table>
<h3 style="background: rgb(238, 238, 238) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 5px 10px;">Personal Details</h3>

		<TABLE id="DetailsTable" class="table table-condensed ">
			<tr>
				<th>Your Name</th>
				<td><INPUT type="text" name="mcaName" id='mcaName' class="form-control input-sm"/></td>
				<th>Your MCA Number</th>
				<td><INPUT type="text" name="mcaNumber" id='mcaNumber' class="form-control input-sm"/></td>
			</tr>
			<tr>
				<th>Your Email</th>
				<td><INPUT type="text" name="email" id='email' class="form-control input-sm"/></td>
				<th>Your Mobile</th>
				<td><INPUT type="text" name="mobile" id='mobile' class="form-control input-sm"/></td>
			</tr>
		</table>

<h3 style="background: rgb(238, 238, 238) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 5px 10px;">Delivery Options</h3>
		<TABLE id="DetailsTable" class="table table-condensed ">
		<tr>
			<td>
				<select class="form-control Code  input-sm" name="Delivery"  id="Delivery" onblur="ShowDiv(this.value)">
				<option>-- Select --</option>
		<?php foreach($addresses as $address){?>
					<option value="<?=$address['DPName']?>"><?=$address['DPName']?></option>
		<?php }?>
				</select>
			</td>
		</tr>
		<?php foreach($addresses as $address){?>
		<?php }?> 
		</table>
		<div class="row" style="width:90%;margin:auto"><br>
	<div class="col-md-4">
	</div>
	<div class="col-md-4">
	<input type="submit" value="Submit Order" class="form-control btn btn-primary" >
	</div>
	<div class="col-md-4">
	</div>
	</div>
</form>


</div>
