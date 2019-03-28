<div style="width:90%;margin:auto">
<?=$this->form->create('',array('url'=>'/users/dateofjoin')); ?>
Sponsor:
<select class="form-control" name="mcaNumber" id="mcaNumber">
<?php foreach($users as $user){?>
<option value="<?=$user['mcaNumber']?>"><?=$user['mcaName']?> - <?=$user['mcaNumber']?></option>
<?php }?>
</select>
<h4>Date of Join:</h4>
<input type="text" class="form-control" id="DateJoin" placeholder="1985-12-31" name="DateJoin" value="">
<br>
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">
</form>
</div>
</div>