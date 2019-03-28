<?php

?>
<br>
<div>
<?=$this->form->create(null,array('class'=>'form-group','id'=>'Product',)); ?>
	<table class="table table-border table-striped table-condensed">
			<tr>
   <td>Code</td>
			<td><?=$product['code']?></td>
   <td><input type="text" name="Code" id="Code" value="<?=$product['code']?>"></td>
   </tr>
   <tr>
   <td>Category</td>
			<td><?=$product['category']?></td>
   <td><input type="text" name="Category" id="Category" value="<?=$product['category']?>"></td>
   </tr>
   <tr>
   <td>Name</td>
   <td><?=$product['name']?></td>
   <td><input type="text" name="Name" id="Name" value="<?=$product['name']?>"></td>
   </tr>
   <tr>
   <td>Size</td>
   <td><?=$product['size']?></td>
   <td><input type="text" name="Size" id="Size" value="<?=$product['size']?>"></td>
   </tr>
   <tr>
   <td>MRP</td>
   <td><?=$product['mrp']?></td>
   <td><input type="text" name="MRP" id="MRP" value="<?=$product['mrp']?>"></td>
   </tr>
   <tr>
   <td>DP</td>
   <td><?=$product['dp']?></td>
   <td><input type="text" name="DP" id="DP" value="<?=$product['dp']?>"></td>
   </tr>
   <tr>
   <td>BV</td>
   <td><?=$product['bv']?></td>
   <td><input type="text" name="BV" id="BV" value="<?=$product['bv']?>"></td>
   </tr>
   <tr>
   <td>Percent</td>
   <td><?=$product['bv']/$product['dp']*100?></td>
   <td><input type="text" name="BVPercent" id="BVPercent" value=""></td>
		</tr>
			<tr>
   <td colspan="3">
    <textarea style="width:100%;height:200px" name="description" id="description"><?=$product['description']?></textarea>
   </td>
   <input type="text" name="_id" id="_id" value="<?=$product['_id']?>">
   <input type="text" name="Old_Code" id="Old_Code" value="<?=$product['code']?>">
   <input type="text" name="Old_MRP" id="Old_MRP" value="<?=$product['mrp']?>">
   <input type="text" name="Old_DP" id="Old_DP" value="<?=$product['dp']?>">
   <input type="text" name="Old_BV" id="Old_BV" value="<?=$product['bv']?>">
		</tr>	
	</table>
 	<input type="submit" value="save" class="form-control btn btn-primary">
	</form>
</div>