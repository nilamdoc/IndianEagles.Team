<div class="row">
<div class="col-md-6">
<?=$this->form->create('',array('url'=>'/users/monthly')); ?>
Year - Month:
<select class="form-control" name="YearMonth" id="YearMonth">
<?php 
$today = gmdate('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-0*60*60*24*30);
for ($i=5;$i>=0;$i--){
$StartDate = gmdate('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30);
?>
<option value="<?=$StartDate?>" <?php if($thismonth==$StartDate){echo " selected ";}?> ><?=$StartDate?></option>
<?php
}
?>
</select>

Sponsor:
<select class="form-control" name="mcaNumber" id="mcaNumber" onblur="changePV();">
<?php foreach($users as $user){?>
<option value="<?=$user['mcaNumber']?>"><?=$user['mcaName']?> - <?=$user['mcaNumber']?></option>
<?php }?>
</select>
PV: <span id="PVVal"></span>
<input type="text" name="PV" value="" id="PV" class="form-control">
BV: <span id="BVVal"></span>
<input type="text" name="BV" value="" id="BV" class="form-control">
Previous BV:
<input type="text" name="Previous" value="" id="Previous" class="form-control"><br>
<input type="submit" name="submit" value="Submit" id="Submit" class="btn btn-primary">
</form>
</div>

<div class="col-md-6">
	<table class="table table-striped table-border">
	<?php 
	$pv = 0;
	$xbv = 0;
	
	foreach ($bv as $b){
		$pv = $pv + $b[$thismonth]['PV'];
		$xbv = $xbv + $b[$thismonth]['BV'];
		?>
		<tr>
			<td><?=$b['mcaNumber']?></td>
			<td><?=$b['mcaName']?></td>
			<td><?=$b[$thismonth]['PV']?></td>
			<td><?=$b[$thismonth]['BV']?></td>
		</tr>
	<?php }?>
	<tr>
			<td>Total</td>
			<td></td>
			<td><?=$pv?></td>
			<td><?=$xbv?></td>
		</tr>
	
	</table>
</div>
</div>