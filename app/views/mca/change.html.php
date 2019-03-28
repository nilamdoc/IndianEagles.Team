<?php
?>
<br>
<div>
	<table class="table table-border table-striped table-condensed">
	<?php foreach($products as $p){?>
		<tr>
			<td><?=$p['code'];?></td>
   <td><a href="/mca/changeedit/<?=$p['_id'];?>"><?=$p['name'];?></a></td>
   <td><?=$p['size'];?></td>
   <td><?=$p['mrp'];?></td>
   <td><?=$p['dp'];?></td>
   <td><?=$p['bv'];?></td>
		</tr>
	<?php }?>
	</table>
 <table class="table table-border table-striped table-condensed">
	<?php foreach($productschanged as $p){?>
		<tr>
			<td><?=$p['code'];?></td>
   <td><a href="/mca/changeedit/<?=$p['_id'];?>"><?=$p['name'];?></a></td>
   <td><?=$p['size'];?></td>
   <td><?=$p['mrp'];?></td>
   <td><?=$p['dp'];?></td>
   <td><?=$p['bv'];?></td>
		</tr>
	<?php }?>
	</table>
 
</div>