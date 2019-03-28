<?php echo $this->_render('element', 'bill');?>	
<?php
use lithium\storage\Session;
$employee = Session::read('employee');  
//print_r($employee);
?>

<div class="container ">
<br><br><h3>Select</h3>
<br><?=$this->form->create('',array('url'=>'/bill/select', 'enctype'=>"multipart/form-data")); ?>
<h5>Select DP:</h5>
<select name="DP" id="DP" class="form-control" >
 <?php foreach($employee['DPs'] as $DP ){?>
  <option value="<?=$DP['Name']?>"><?=$DP['Name']?></option>
 <?php }?>
</select><br>
<input type="submit" name="submit" value="Save" id="Submit" class="btn btn-primary">
</form>
</div>