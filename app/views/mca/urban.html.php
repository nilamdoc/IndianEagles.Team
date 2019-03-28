<?php
?>
<br>
<div>
<?=$this->form->create(null,array('class'=>'form-group','id'=>'Product',)); ?>
   Code:<input type="text" name="Code" id="Code" value=""><br>
   Start:<input type="text" name="Start" id="Start" value=""><br>
   End:<input type="text" name="End" id="End" value=""><br>
   
<table>
   <tr>
   <td>MRP</td>
   <td><input type="text" name="MRP" id="MRP" value=""></td>
   </tr>
   <tr>
   <td>DP</td>
   <td><input type="text" name="DP" id="DP" value=""></td>
   </tr>
   <tr>
   <td>BV %</td>
   <td><input type="text" name="BVPercent" id="BVPercent" value=""></td>
		</tr>

</table>   
<input type="submit" value="save" class="form-control btn btn-primary">
	</form>   
</div>