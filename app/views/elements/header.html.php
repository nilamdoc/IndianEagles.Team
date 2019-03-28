<?php use lithium\core\Environment; 
if(substr(Environment::get('locale'),0,2)=="en"){$locale = "en";}else{$locale = Environment::get('locale');}
if(strlen($locale>2)){$locale='en';}
// print_r(Environment::get('locale'));
// print_r($locale);
?>

<div class="navbar-wrapper">
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
					<a class="navbar-brand" href="/<?=$locale?>/"><img src="/img/Logo.gif" alt="IndianEagles" width="200">&nbsp;<sup style="color:red;font-weight:bold"></sup></a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="/<?=$locale?>/">Home</a></li>
						<li><a href="/<?=$locale?>/company/about">About</a></li>
						<li><a href="/<?=$locale?>/users/training">Training</a></li>						
						<li><a href="/<?=$locale?>/mca/products">Products</a></li>
						<li><a href="/<?=$locale?>/users/businessplan">Business Plan</a></li>						
						<li><a href="/<?=$locale?>/mca/order">Order Online</a></li>						
						<li><a href="/<?=$locale?>/mca/events">Events</a></li>						
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="/<?=$locale?>/users/login">Login</a></li>					
						<li><a href="/<?=$locale?>/users/register">Register</a></li>					
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div style="margin-top:50px"  align="center">
<img src="/img/SiteFlyingIndianEagle.jpg" width="90%" class="img-responsive" >
</div>
