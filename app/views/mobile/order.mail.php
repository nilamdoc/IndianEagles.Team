<?php 
use app\extensions\action\Functions;
?>
<link href="http://indianeagles.team/bootstrap/css/bootstrap.css" rel="stylesheet"> 
<link href="https://indianeagles.team/css/dashboard.css?v=80657959" rel="stylesheet">
<div width="90%">
<h3>IndianEagles.Team</h3>

<h4>Email: <strong><?=$compact['data']['email']?></strong></h4>
<table class="table table-bordered">
		<thead>
			<tr>
				<th width="40%">Order No</th>
				<th><strong><?=$compact['data']['orderNo']?></strong></th>
			</tr>
		</thead>
			<tr>
				<td width="40%">Name:</td>
				<td><?=$compact['data']['user']['mcaName']?></td>
			</tr>
			<tr>
				<td width="40%">MCA #:</td>
				<td><?=$compact['data']['user']['mcaNumber']?></td>
			</tr>
			<tr>
				<td width="40%">Email:</td>
				<td><?=$compact['data']['user']['email']?></td>
			</tr>
			<tr>
				<td width="40%">Mobile:</td>
				<td><?=$compact['data']['user']['mobile']?></td>
			</tr>
			<tr>
				<td width="40%">Address:</td>
				<td><?=$compact['data']['user']['address']?></td>
			</tr>			
			<tr>
				<td width="40%">City:</td>
				<td><?=$compact['data']['user']['city']?></td>
			</tr>			
			<tr>
				<td width="40%">State:</td>
				<td><?=$compact['data']['user']['state']?></td>
			</tr>
			
<?php		if($result['collect']=="dp"){?>
			<tr>
				<th width="40%">Collect:</th>
				<td>Collect from DP</td>
			</tr>
			<tr>
				<th width="40%">DP Name:</th>
				<td><?=$compact['data']['dpdetails']['Name']?></td>
			</tr>
			<tr>
				<th width="40%">DP email:</th>
				<td><?=$compact['data']['dpdetails']['Email']?></td>
			</tr>
			<tr>
				<th width="40%">DP Mobile:</th>
				<td><?=$compact['data']['dpdetails']['Mobile']?></td>
			</tr>			
			<tr>
				<th width="40%">DP PayTM:</th>
				<td><?=$compact['data']['dpdetails']['PayTM']?></td>
			</tr>			
			<tr>
				<th width="40%">DP Address:</th>
				<td><?=$compact['data']['dpdetails']['Address']?></td>
			</tr>			
			<tr>
				<th width="40%">DP City:</th>
				<td><?=$compact['data']['dpdetails']['City']?></td>
			</tr>			
			<tr>
				<th width="40%">DP State:</th>
				<td><?=$compact['data']['dpdetails']['State']?></td>
			</tr>			
			<tr>
				<td colspan="2">Please make the payment to PayTM: <?=$compact['data']['dpdetails']['PayTM']?>. 
				</td>
			</td>
			</tr>

<?php			}?>

<?php			if($compact['data']['collect']=='home'){?>
				
			<tr>
				<th width="40%">Collect:</th>
				<td>Deliver to Address:</td>
			</tr>
			<tr>
				<td colspan="2">Please make the payment to PayTM: 7597219319
				</td>
			</td>
			</tr>			
<?php			}?>

			<tr>
			<td colspan="2">
			<h2>Detail Order</h2>
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Product Name</th>
						<th>Size</th>
						<th style="text-align:right">MRP</th>
						<th style="text-align:right">DP</th>
						<th style="text-align:right">Quantity</th>
						<th style="text-align:right">Total MRP</th>
						<th style="text-align:right">Total DP</th>
					</tr>
<?php
					$i = 1;
					foreach($compact['data']['allorders'] as $o){?>
					<tr>
						<td><?=$i?></td>
						<td><?=$o['Code']?></td>
						<td><?=$o['Name']?></td>
						<td><?=$o['Size']?></td>
						<td style="text-align:right"><?=number_format($o['MRP'],2)?></td>
						<td style="text-align:right"><?=number_format($o['DP'],2)?></td>
						<td style="text-align:right"><?=$o['Quantity']?></td>
						<td style="text-align:right"><?=number_format($o['MRP']*$o['Quantity'],2)?></td>
						<td style="text-align:right"><?=number_format($o['DP']*$o['Quantity'],2)?></td>
					</tr>
					<?php
						$i++;
						$totalQ = $totalQ + $o['Quantity'];
						$totalMRP = $totalMRP + ($o['MRP']*$o['Quantity']);
						$totalDP = $totalDP + ($o['DP']*$o['Quantity']);
						
					}?>
					<tr>
						<th colspan="6">Total </th>
						<th style="text-align:right"><?=$totalQ?></th>
						<th style="text-align:right">Rs. <?=number_format($totalMRP,2)?></th>
						<th style="text-align:right">Rs. <?=number_format($totalDP,2)?></th>
					</tr>
					<?php
					$function = new Functions();
					if($result['user']['mcaNumber']>0){?>
				
					<tr>
						<th colspan="8"><strong>To pay Total</strong></th>
						<th style="text-align:right"><strong>Rs. <?=number_format($totalDP,2)?></strong></th>
					</tr>
					<tr>
						<th colspan="9">Rs. <?=strtoupper($function->number_to_words(round($totalDP,2)))?> ONLY</th>
					</tr>					
					<?php
					}
					if($result['user']['mcaNumber']=="" || $result['user']['mcaNumber']=="undefined" || $result['user']['mcaNumber']=='null'){?>
				
					<tr>
						<th colspan="8"><strong>To pay Total Rs.</strong></th>
						<th style="text-align:right"><strong>Rs. <?=number_format($totalMRP,2)?></strong></th>
					</tr>
					<tr>
						<th colspan="9">Rs. <?=strtoupper($function->number_to_words(round($totalMRP,2)))?> ONLY</th>
					</tr>					
					<?php }?>
					
			
				</table>
				
			</td>
			</tr>
			</table></div>
		
			


<p>Date and time: <?=gmdate('Y-m-d H:i:s',time())?></p>
<p>IP: <?=$_SERVER['REMOTE_ADDR'];?></p>
</div>