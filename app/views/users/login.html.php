<div style="width:90%;margin:auto">
<?=$this->form->create('',array('url'=>'/users/login')); ?>
<h4>MCA Number:</h4>
<input type="text" class="form-control" id="mcaNumber" name="mcaNumber" value="">
<h4>Date of Join:</h4>
<input type="text" class="form-control" id="DateJoin" placeholder="1985-12-31" name="DateJoin" value="">
<br>
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">
</form>
</div>