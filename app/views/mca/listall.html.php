<?php
?>
<br>
<div>
	<table class="table table-border table-striped table-condensed">
	<?php foreach($products as $p){?>
		<tr>
			<td><?=$p['code'];?></td>
			<td><?=$p['g_category'];?></td>
			<td><?=$p['g_name'];?></td>
		</tr>
	<?php }?>
	</table>
</div>