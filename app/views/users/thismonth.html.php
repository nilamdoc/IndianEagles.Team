<div style="width:70%;background-color:white;padding:10px">
<h2>This Month PV & BV</h2>
<table class="table table-condensed table-bordered table-striped table-responsive">
<tr>
	<th>#</th>
	<th>Name</th>
	<th>PV</th>
	<th>BV</th>
</tr>
<?php $i = 1;foreach($users as $t){?>
<tr>
<td><?=$i?></td>
<td><?=$t['mcaName']?>
<td><?=$t[$thismonth]['PV']?>
<td><?=$t[$thismonth]['BV']?>
</tr>
<?php $i++;}?>
</table>
</div>