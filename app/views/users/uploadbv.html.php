<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/users/uploadbv', 'enctype'=>"multipart/form-data")); ?>
<br>
<?=$this->form->field('file', array('type' => 'file','label'=>'BV.csv', 'class'=>'form-control-file')); ?>
Year - Month:
<select class="form-control" name="YearMonth" id="YearMonth">
<?php 

for ($i=5;$i>=0;$i--){
$StartDate = gmdate("Y-m", strtotime(-$i." month", strtotime(gmdate("F") . "1")) );
?>
<option value="<?=$StartDate?>" <?php if($thismonth==$StartDate){echo " selected ";}?> ><?=$StartDate?></option>
<?php
}
?>
</select>
<br>
<input type="checkbox" value="true" name="Previous" id="Previous"> Previous<br>
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">

</form>
</div>

<div class="col-md-6">
	<table class="table table-striped table-border">
	</table>
</div>
</div>