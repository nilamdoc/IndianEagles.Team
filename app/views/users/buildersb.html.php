<?php 
use lithium\storage\Session;
$session = Session::read('session');
setlocale(LC_MONETARY, 'hi_IN');
?>
<?php 
$thismonth = date('Y-m',time());
if($selfline['YYYYMM'][$months][$thismonth]['TGBV']===0){
	$thismonth = date('Y-m',strtotime("-1 month", strtotime(date("F") . "1")));
	$months = (int)$months - 1;
}
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Number');
        data.addColumn('string', 'Name');
        data.addColumn('string', 'ToolTip');
	data.addRows([
 
<?php 
$i = 1; $j = 0;
foreach($allusers as $user) {
//print_r($user);
 ?>
							[{v:'<?=$user['mcaNumber']?>', f:'<?=$i;?><br><b style="font-size:14px;<?php if($user['Percent']=='22'){?>color:red<?php }?>"><?=$user['mcaName']?> <?php if($user['Percent']=='22'){?><?=$user['PaidTitle']?><?php }?></b><br>PGBV: <?=$user['PGBV']?><br>Rollup: <?=$user['RollUp']?><br>TGBV: <?=$user['TGBV']?><br>Rs. <?=$user['Gross']?><br><a href="/users/builders/<?=$user['mcaNumber']?>"><?=$user['mcaNumber']?></a>'}, '<?=$user['refer']?>',''],
<?php
$i++;
} ?>
     ]);   
        
        
        // For each orgchart box, provide the name, manager, and tooltip to show.
/*
        data.addRows([
          [{v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'},
           '', 'The President'],
          [{v:'Jim', f:'Jim<div style="color:red; font-style:italic">Vice President</div>'},
           'Mike', 'VP'],
          ['Alice', 'Mike', ''],
          ['Bob', 'Jim', 'Bob Sponge'],
          ['Carol', 'Bob', '']
        ]);
*/
        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {allowHtml:true});
      }
   </script>
   
<div style="background-color:white;padding:10px;margin:auto;width:300%">
<h4>Sponsor: <a href="/users/display/<?=$selfline['refer']?>"><?=$selfline['referName']?>-<?=$selfline['refer']?></a><span class="pull-right">
<a href="/users/builders/<?=$selfline['mcaNumber']?>">Builders</a>  |  
<a href="/users/search/">Search</a></span>
</h4>
<h3><?=$selfline['mcaName']?>-<?=$selfline['mcaNumber']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month: <span class="text-right"><?=$thismonth?></span></h3>
<?php

?>
<div style="background-color:white;padding:10px;margin:auto">
  <div id="chart_div" style="font-size:12px"></div>
</div>
</div>
<?php
function moneyFormatIndia($num){
	
    $explrestunits = "" ;
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}
?>