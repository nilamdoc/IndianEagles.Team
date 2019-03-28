<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/users/mobile')); ?>

<?php print_r($users['mcaNumber']);?> - <?php print_r($users['mcaName']);?>
<input type="text" name="mcaNumber"  id="mcaNumber" class="form-control" value="<?=$users['mcaNumber']?>" placeholder="<?=$users['mcaNumber']?>"><br>
Mobile <?=$count?>:
<input type="text" name="Mobile" value="" id="Mobile" class="form-control" value=""><br>
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">
</form>
</div>

<div class="col-md-6">
	<table class="table table-striped table-border">
	</table>
</div>
</div>