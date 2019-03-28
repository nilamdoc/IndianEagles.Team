<?php
use lithium\storage\Session;
$employee = Session::read('employee');  
//print_r($employee);
?><div class="navbar-wrapper">
	<div class="">
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">...</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><img src="/img/INDIANEAGLES.TEAM.png" alt="IndianEagles" width="200">&nbsp;<sup style="color:red;font-weight:bold"></sup></a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="/bill">Home</a></li>
						<li><a href="/bill/add">Add bill</a></li>
      <li><a href="/bill/addinvoice">Add invoice</a></li>
						<li><a href="/bill/listbill">List</a></li>						
      <li><a href="/bill/select">Select</a></li>						
					</ul>
     <ul  class="nav navbar-nav">
     <li><a href="/bill" style="color:red;font-size:14px;font-weight:bold;letter-spacing:3px"><?=$employee['DP']?> - <?=$employee['role']?> - bill: <?=$employee['bill']?>, invoice: <?=$employee['invoice']?></a></li>
     </ul>
					<ul class="nav navbar-nav pull-right">
      <?php if($employee['phone']!=""){?>
        <li><a href="/bill/logout">Logout <?=$employee['Name']?></a></li>					
      <?php }else{ ?>
     <li><a href="/bill/login">Login</a></li>					
      <?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
