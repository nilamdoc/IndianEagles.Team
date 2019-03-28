<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/users/gender')); ?>
<select class="form-control" name="mcaNumber" id="mcaNumber">
<?php foreach($users as $user){?>
<option value="<?=$user['mcaNumber']?>"><?=$user['mcaName']?> - <?=$user['mcaNumber']?></option>
<?php }?>
</select>
Gender <span id="Gender"></span>
<select class="form-control" name="Gender" id="Gender">
	<option value="Male">Male</option>
	<option value="Female">Female</option>
</select>
<br>
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">
</form>
</div>

<div class="col-md-6">
	<table class="table table-striped table-border">
	</table>
</div>
</div>