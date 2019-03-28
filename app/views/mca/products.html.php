<?php
?>
<br>
<div class="" data-example-id=togglable-tabs> 
	<ul class="nav nav-tabs" id=myTabs role=tablist> 
		<li role=presentation class=dropdown> 
			<a href=# class=dropdown-toggle id=Color data-toggle=dropdown aria-controls=Color-contents>COLOR<span class=caret></span></a>
				<ul class=dropdown-menu aria-labelledby=Color id=Color-contents> 
					<li><a href=#dropdown1 role=tab id=dropdown1-tab data-toggle=tab aria-controls=dropdown1>URBAN COLOR CREME GLAM LIPSTICK</a></li> 
					<li><a href=#dropdown2 role=tab id=dropdown2-tab data-toggle=tab aria-controls=dropdown2>URBAN COLOR PERFECT MATTE LIPSTICK</a></li> 
					<li><a href=#dropdown3 role=tab id=dropdown3-tab data-toggle=tab aria-controls=dropdown3>URBAN COLOR  EXTREME STAY LIQUID LIPSTICK</a></li>
					<li><a href=#dropdown4 role=tab id=dropdown4-tab data-toggle=tab aria-controls=dropdown4>URBAN COLOR COLOR GLASS LIP GLOSS</a></li> 
					<li><a href=#dropdown5 role=tab id=dropdown5-tab data-toggle=tab aria-controls=dropdown5>URBAN COLOR GLASS SHINE LIP GLOSS </a></li> 
					<li><a href=#dropdown16 role=tab id=dropdown5-tab data-toggle=tab aria-controls=dropdown16>URBAN COLOR INTENSE STAY LIP DEFINER</a></li> 
					<li><a href=#dropdown6 role=tab id=dropdown6-tab data-toggle=tab aria-controls=dropdown6>URBAN COLOR NAIL LACQUER </a></li> 
     <li><a href=#dropdown66 role=tab id=dropdown66-tab data-toggle=tab aria-controls=dropdown66>URBAN COLOR MATT NAIL LACQUER </a></li> 
					<li><a href=#dropdown18 role=tab id=dropdown18-tab data-toggle=tab aria-controls=dropdown18>URBAN COLOR JEWEL NAIL LACQUER </a></li> 
					<li><a href=#dropdown7 role=tab id=dropdown7-tab data-toggle=tab aria-controls=dropdown7>URBAN COLOR NAIL ENAMEL REMOVER </a></li> 
					<li><a href=#dropdown8 role=tab id=dropdown8-tab data-toggle=tab aria-controls=dropdown8>URBAN COLOR QUICK DRY NAIL LACQUER </a></li> 
					<li><a href=#dropdown9 role=tab id=dropdown9-tab data-toggle=tab aria-controls=dropdown9>URBAN COLOR ULTIMATE RADIANCE PRIMER </a></li> 
					<li><a href=#dropdown10 role=tab id=dropdown10-tab data-toggle=tab aria-controls=dropdown10>URBAN COLOR ULTIMATE RADIANCE 3 IN 1 MAKEUP </a></li> 
					<li><a href=#dropdown11 role=tab id=dropdown11-tab data-toggle=tab aria-controls=dropdown11>URBAN COLOR ULTIMATE RADIANCE FOUNDATION </a></li> 
					<li><a href=#dropdown12 role=tab id=dropdown12-tab data-toggle=tab aria-controls=dropdown12>URBAN COLOR ULTIMATE RADIANCE COMPACT 
 </a></li> 
					<li><a href=#dropdown13 role=tab id=dropdown13-tab data-toggle=tab aria-controls=dropdown13>URBAN COLOR ULTIMATE RADIANCE BLUSH
 </a></li> 
					<li><a href=#dropdown14 role=tab id=dropdown14-tab data-toggle=tab aria-controls=dropdown14>URBAN COLOR INTENSE STAY 10HRS KAJAL
 </a></li> 
					<li><a href=#dropdown15 role=tab id=dropdown15-tab data-toggle=tab aria-controls=dropdown15>URBAN COLOR  ULTIMATE LASH MASCARA
 </a></li> 
				</ul> 
		</li> 
		<li role=presentation>
			<a href=#SkinCare role=tab id=SkinCare-tab data-toggle=tab aria-controls=SkinCare>SKIN</a></li> 
		<li role=presentation>
			<a href=#PersonalCare role=tab id=PersonalCare-tab data-toggle=tab aria-controls=PersonalCare>PERSONAL</a></li> 
		<li role=presentation>
			<a href=#Wellness role=tab id=Wellness-tab data-toggle=tab aria-controls=Wellness>WELLNESS</a></li> 
		<li role=presentation>
			<a href=#Food role=tab id=Food-tab data-toggle=tab aria-controls=Food>FOOD</a></li> 
		<li role=presentation>
			<a href=#Home role=active id=Home-tab data-toggle=tab aria-controls=Home>HOME</a></li> 
		<li role=presentation>
			<a href=#Auto role=active id=Auto-tab data-toggle=tab aria-controls=Auto>AUTO</a></li> 
		<li role=presentation>
			<a href=#Laundry role=active id=Laundry-tab data-toggle=tab aria-controls=Laundry>LAUNDRY</a></li> 
		<li role=presentation>
			<a href=#Agriculture role=active id=Agriculture-tab data-toggle=tab aria-controls=Agriculture>AGRICULTURE</a></li> 
		<li role=presentation>
			<a href=#Electronics role=active id=Electronics-tab data-toggle=tab aria-controls=Electronics>ELECTRONICS</a></li> 
		<li role=presentation>
			<a href=#AtootBandhan role=active id=AtootBandhan-tab data-toggle=tab aria-controls=AtootBandhan>ATOOT BANDHAN</a></li> 
			
			</ul> 
	<div class=tab-content id=myTabContent> 

		<div class="tab-pane fade" role=tabpanel id=SkinCare aria-labelledby=SkinCare-tab>
		<div style="text-align:left">
		<p>A paragraph about Skin care....</p>
		<div style="text-align:center">
		<img src="/img/Skin Care-banner.jpg" width="100%">
		</div>
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Skin Care</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>			
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Skin Care'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 
		

		<div class="tab-pane fade" role=tabpanel id=PersonalCare aria-labelledby=PersonalCare-tab>
		<div style="text-align:left">
		<p>A paragraph about Personal care....</p>
		<div style="text-align:center">
		<img src="/img/Personal Care-banner.jpg" width="100%">
		</div>
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Personal Care</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Personal Care'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 
		
		<div class="tab-pane fade" role=tabpanel id=Wellness aria-labelledby=Wellness-tab>
		<div style="text-align:left">
		<p>A paragraph about Wellness care....</p>
		<div style="text-align:center">
		<img src="/img/Wellness Care-banner.jpg" width="100%">
		</div>

		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Wellness Care</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Wellness Care'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 
		 
		<div class="tab-pane fade" role=tabpanel id=Food aria-labelledby=Food-tab>
		<div style="text-align:left">
		<p>A paragraph about Food & Beverages....</p>
		<div style="text-align:center">
		<img src="/img/Food & Beverages-banner.jpg" width="100%">
		</div>

		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Food & Beverages</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Food & Beverages'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 
		
		<div class="tab-pane fade in active" role=tabpanel id=Home aria-labelledby=Home-tab>
		<div style="text-align:left">
		<p>A paragraph about home care....</p>
		<div style="text-align:center">
		<img src="/img/Home Care-banner.jpg" width="100%">
		</div>

		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Home Care</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Home Care'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=Auto aria-labelledby=Auto-tab>
		<div style="text-align:left">
		<p>A paragraph about auto care....</p>
		<div style="text-align:center">
		<img src="/img/Auto Care-banner.jpg" width="100%">
		</div>

		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Auto Care</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
			<tr>
<?php foreach ($products as $product){
	
		if($product['Category']==='Auto Care'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
	<?php }?>
<?php }?>
		</table>
		
		</div> 
		
		<div class="tab-pane fade" role=tabpanel id=Laundry aria-labelledby=Laundry-tab>
		<div style="text-align:left">
		<div style="text-align:center">
		<img src="/img/Laundry Care-banner.jpg" width="100%">
		</div>

		<p>A paragraph about Laundry care....</p>
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Laundry Care</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Laundry Care'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=Agriculture aria-labelledby=Agriculture-tab>
		<div style="text-align:left">
		<p>A paragraph about Agriculture....</p>
		<div style="text-align:center">
		<img src="/img/Agriculture-banner.jpg" width="100%">
		</div>

		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Agriculture</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Agriculture'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=Electronics aria-labelledby=Electronics-tab>
		<div style="text-align:left">
		<p>A paragraph about Electronics....</p>
		<div style="text-align:center">
		<img src="/img/Electronics-banner.jpg" width="100%">
		</div>

		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Electronics</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Electronics'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 
		
		
		<div class="tab-pane fade" role=tabpanel id=dropdown1 aria-labelledby=dropdown1-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR CREME GLAM LIPSTICK....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color CREME GLAM LIPSTICK-banner.jpg" width="100%">
		</div>

		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR CREME GLAM LIPSTICK</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR CREME GLAM LIPSTICK'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown2 aria-labelledby=dropdown2-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR PERFECT MATTE LIPSTICK....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color-PERFECT MATTE LIPSTICK.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR PERFECT MATTE LIPSTICK</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR PERFECT MATTE LIPSTICK'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown3 aria-labelledby=dropdown3-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR EXTREME STAY LIQUID LIPSTICK....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color EXTREME STAY LIQUID LIPSTICK-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR EXTREME STAY LIQUID LIPSTICK</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR EXTREME STAY LIQUID LIPSTICK'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		
		<div class="tab-pane fade" role=tabpanel id=dropdown18 aria-labelledby=dropdown3-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR JEWEL NAIL LACQUER....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color EXTREME STAY LIQUID LIPSTICK-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR JEWEL NAIL LACQUER</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR JEWEL NAIL LACQUER'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 
		
		
		<div class="tab-pane fade" role=tabpanel id=dropdown4 aria-labelledby=dropdown4-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR GLASS LIP GLOSS....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color GLASS LIP GLOSS-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR GLASS LIP GLOSS</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR COLOR GLASS LIP GLOSS'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown5 aria-labelledby=dropdown5-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR GLASS SHINE LIP GLOSS ....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color-GLASS SHINE LIP GLOSS.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR GLASS SHINE LIP GLOSS</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR GLASS SHINE LIP GLOSS'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		
		<div class="tab-pane fade" role=tabpanel id=dropdown16 aria-labelledby=dropdown16-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR INTENSE STAY LIP DEFINER....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color CREME GLAM LIPSTICK-banner.jpg" width="100%">
		</div>

		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR INTENSE STAY LIP DEFINER</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR INTENSE STAY LIP DEFINER'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown66 aria-labelledby=dropdown66-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR MATT NAIL LACQUER....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color NAIL LACQUER-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR NAIL MATT LACQUER</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR MATT NAIL LACQUER'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

	
		
		
		<div class="tab-pane fade" role=tabpanel id=dropdown6 aria-labelledby=dropdown6-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR NAIL LACQUER....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color NAIL LACQUER-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR NAIL LACQUER</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR NAIL LACQUER'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 


		<div class="tab-pane fade" role=tabpanel id=dropdown7 aria-labelledby=dropdown7-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR NAIL ENAMEL REMOVER ....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color NAIL ENAMEL REMOVER-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR NAIL ENAMEL REMOVER</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR NAIL ENAMEL REMOVER'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown8 aria-labelledby=dropdown8-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR QUICK DRY NAIL LACQUER....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color QUICK DRY NAIL LACQUER-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR QUICK DRY NAIL LACQUER</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR QUICK DRY NAIL LACQUER'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown9 aria-labelledby=dropdown9-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR ULTIMATE RADIANCE PRIMER....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color ULTIMATE RADIANCE PRIMER -banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR ULTIMATE RADIANCE PRIMER</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR ULTIMATE RADIANCE PRIMER'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown10 aria-labelledby=dropdown10-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR ULTIMATE RADIANCE 3 IN 1 MAKEUP....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color ULTIMATE RADIANCE 3 IN 1 MAKEUP-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR ULTIMATE RADIANCE 3 IN 1 MAKEUP</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR ULTIMATE RADIANCE 3 IN 1 MAKEUP'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown11 aria-labelledby=dropdown11-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR ULTIMATE RADIANCE FOUNDATION....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color ULTIMATE RADIANCE FOUNDATION-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR ULTIMATE RADIANCE FOUNDATION</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR ULTIMATE RADIANCE FOUNDATION'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown12 aria-labelledby=dropdown12-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR ULTIMATE RADIANCE COMPACT ....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color ULTIMATE RADIANCE COMPACT-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR ULTIMATE RADIANCE COMPACT </th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR ULTIMATE RADIANCE COMPACT'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 


		<div class="tab-pane fade" role=tabpanel id=dropdown13 aria-labelledby=dropdown13-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR ULTIMATE RADIANCE BLUSH....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color ULTIMATE RADIANCE BLUSH-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR ULTIMATE RADIANCE BLUSH</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR ULTIMATE RADIANCE BLUSH'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 

		<div class="tab-pane fade" role=tabpanel id=dropdown14 aria-labelledby=dropdown14-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR INTENSE STAY 10HRS KAJAL....</p>
		<div style="text-align:center">
		<img src="/img/Urban Color INTENSE STAY 10 HRS KAJAL-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR INTENSE STAY 10HRS KAJAL</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR INTENSE STAY 10HRS KAJAL'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 		


		<div class="tab-pane fade" role=tabpanel id=dropdown15 aria-labelledby=dropdown15-tab> 
		<div style="text-align:left">
		<p>A paragraph about URBAN COLOR ULTIMATE LASH MASCARA</p>
		<div style="text-align:center">
		<img src="/img/Urban Color ULTIMATE LASH MASCARA-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">URBAN COLOR ULTIMATE LASH MASCARA</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='URBAN COLOR ULTIMATE LASH MASCARA'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div>

		
		<div class="tab-pane fade" role=tabpanel id=AtootBandhan aria-labelledby=AtootBandhan-tab> 
		<div style="text-align:left">
		<p>A paragraph about Atoot Bandhan</p>
		<div style="text-align:center">
		<img src="/img/Urban Color AtootBandhan-banner.jpg" width="100%">
		</div>		
		</div>
		<table class="table table-condensed table-striped table-hover table-bordered table-responsive">
		<tr><th colspan="9">Atoot Bandhan Kits</th></tr>
		<colgroup>
				<col style="background-color:#ddd">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
  </colgroup>
			<tr>
			<th >Code</th>
			<th >Name</th>
			<th style="text-align:center">Size</th>
			<th style="text-align:center">MRP</th>
			<th style="text-align:center">PV</th>
			<th style="text-align:center">DP</th>
			<th style="text-align:center">BV</th>
			<th style="text-align:center">PR</th>
			<th style="text-align:center">BV/DP%</th>
			<th style="text-align:center">%</th>
			</tr>
<?php foreach ($products as $product){
		if($product['Category']=='Atoot Bandhan'){
	?>			
			<tr>
			<td><a href="/mca/product/<?=$product['Code'];?>"><?=$product['Code'];?></a></td>
			<td><?=$product['Name'];?></td>
			<td style="text-align:right"><?=$product['Size'];?></td>
			<td style="text-align:right"><?=number_format($product['MRP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['PV'],2)?></td>
			<td style="text-align:right"><?=number_format($product['DP'],0)?></td>
			<td style="text-align:right"><?=number_format($product['BV'],1)?></td>
			<td style="text-align:right"><?=round($product['MRP']-$product['DP'])?></td>
			<td style="text-align:right"><?=round($product['BV']/$product['DP']*100,0)?>%</td>
			<td style="text-align:right"><?=round(($product['MRP']-$product['DP'])/$product['DP']*100)?>%</td>
			</tr>
		<?php }?>
<?php }?>
			</table>
		</div> 
		
<div>
<h3>Download Product Catalogue</h3>
<ul>
	<li><a href="/catalogue/Modicare-Print-English.pdf" target="_blank">Product Catalogue English - 8" x 8" (Print)</a></li>
	<li><a href="/catalogue/Modicare-Print-Gujarati.pdf" target="_blank">Product Catalogue Gujarati - 8" x 8" (Print)</a></li>
	<li><a href="/catalogue/Modicare-Mobile-English.pdf" target="_blank">Product Catalogue English - Mobile view</a></li>
	<li><a href="/catalogue/Modicare-Mobile-Gujarati.pdf" target="_blank">Product Catalogue Gujarati - Mobile view</a></li>
	<li><a href="/catalogue/Modicare-Mobile-RangRiti-English.pdf" target="_blank">Rangriti English - Mobile view</a></li>
</ul>
</div>
	<h4>
MRP - Maximum Retail Price<br>
PV  - Point Value<br>
DP  - Dealer Price<br>
BV  - Business Volume<br>
PR  - Profit<br>
%   - Percent Profit
</h4>
		</div>