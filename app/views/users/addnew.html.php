<?

?>
<div style="margin:auto">
<?=$this->form->create('',array('url'=>'/users/addnew')); ?>
MCA Number:
<input type="text" value="" id="mcaNumber" name="mcaNumber" class="form-control">
MCA Name:
<input type="text" value="" id="mcaName" name="mcaName" class="form-control">
DateJoin:
<input type="text" class="form-control" id="DateJoin" placeholder="1985-12-31" name="DateJoin" value="">
Sponsor:
<select class="form-control" name="refer" id="refer">
<?php foreach($users as $user){?>
<option value="<?=$user['mcaNumber']?>"><?=$user['mcaName']?> - <?=$user['mcaNumber']?></option>
<?php }?>
</select><br>
<input type="submit" value="submit" class="form-control btn btn-primary">
</form>