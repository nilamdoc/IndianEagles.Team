<link href="http://indianeagles.team/bootstrap/css/bootstrap.css" rel="stylesheet"> 
<link href="https://indianeagles.team/css/dashboard.css?v=80657959" rel="stylesheet">
<h3>IndianEagles.Team</h3>
<h4>Email: <strong><?=$compact['data']['email']?></strong></h4>
<h4>Registered for: <strong><?=$compact['data']['registerfor']?></strong></h4>
<h3>Personal details</h3>
<table class="table table-condensed table-striped">
	<tr>
	<td>Name:</td>
	<td><?=$compact['data']['name']?> <?=$compact['data']['surname']?></td>
	</tr>
	<tr>
	<td>Email:</td>
	<td><?=$compact['data']['email']?></td>
	</tr>
	<tr>
	<td>Mobile:</td>
	<td><?=$compact['data']['mobile']?></td>
	</tr>
	<tr>
	<td>Address:</td>
	<td><?=$compact['data']['address']?>, <?=$compact['data']['pincode']?></td>
	</tr>
	<tr>
	<td>Date of Birth:</td>
	<td><?=$compact['data']['dateofbirth']?></td>
	</tr>
</table>
<hr>
<?php if($compact['data']['registerfor']=="Get Training" || $compact['data']['registerfor']=="Give Training"){?>
	<h4>No Documents uploaded: <?=$compact['data']['registerfor']; ?></h4>
<?php }else{?>
	<h4>Reference: <?=strtoupper($compact['data']['sponsorname']);?> - <?=strtoupper($compact['data']['sponsormcano']);?><h4>
	
	<h4>Documents uploaded</h4>
<table class="table table-condensed table-striped">
	<tr>
	<td><?=strtoupper($compact['data']['doc1']);?></td>
	<td><?=strtoupper($compact['data']['doc1name']);?></td>
	</tr>
	<tr>
	<td><?=strtoupper($compact['data']['doc2']);?></td>
	<td><?=strtoupper($compact['data']['doc2name']);?></td>
	</tr>
</table>

	<h4>Bank Details</h4>
<table class="table table-condensed table-striped">	
	<tr>
	<td>Account Name:</td>
	<td><?=$compact['data']['AccountName']?></td>
	</tr>
	<tr>
	<td>Account Number:</td>
	<td><?=$compact['data']['AccountNumber']?></td>
	</tr>
	<tr>
	<td>IFSC Code:</td>
	<td><?=$compact['data']['IFSCCode']?></td>
	</tr>
	<tr>
	<td>IFSC options:</td>
	<td><?=$compact['data']['IFSCoptions']?></td>
	</tr>
<tr>
	<td><?=strtoupper($compact['data']['bank']);?></td>
	<td><?=strtoupper($compact['data']['bankname']);?></td>
	</tr>		
</table>	
<?php }?>

<p>Date and time: <?=gmdate('Y-m-d H:i:s',time())?></p>
<p>IP: <?=$_SERVER['REMOTE_ADDR'];?></p>