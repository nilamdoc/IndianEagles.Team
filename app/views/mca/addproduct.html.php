<br>
<h3>Add Product</h3>
<?=$this->form->create(null,array('class'=>'form-group','id'=>'AddProduct')); ?>
<select name="Category" id="Category" class="form-control">
<?php
foreach($categories as $category){
?>
<option value="<?=$category['Category']?>"><?=$category['Category']?></option>
<?php }
?>
</select>
Code:
<input type="text" name="Code" id="Code" value="" class="form-control">
Name:
<input type="text" name="Name" id="Name" value="" class="form-control">
Size:
<input type="text" name="Size" id="Size" value="" class="form-control">
MRP:
<input type="number" name="MRP" id="MRP" value="" class="form-control" >
PV:
<input type="number" name="PV" id="PV" value="" class="form-control" step='0.01'>
DP:
<input type="number" name="DP" id="DP" value="" class="form-control">
BV:
<input type="number" name="BV" id="BV" value="" class="form-control" step='0.01'><br>
<input type="submit" value="Save" class="form-control btn btn-primary" >
</form>