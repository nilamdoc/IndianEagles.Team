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

<div style="width:90%;background-color:white;padding:10px;margin:auto">
<h4>Sponsor: <a href="/users/display/<?=$selfline['refer']?>"><?=$selfline['referName']?>-<?=$selfline['refer']?></a><span class="pull-right">
<a href="/users/builders/<?=$selfline['mcaNumber']?>">Builders</a>  |  
<a href="/users/search/">Search</a></span>
</h4>
<h3><?=$selfline['mcaName']?>-<?=$selfline['mcaNumber']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month: <span class="text-right"><?=$thismonth?></span></h3>
<?php

?>
<div class="table-responsive">
<table class="table table-condensed table-bordered">
		<colgroup>
				<col >
				<col >
				<col >
				<col style="background-color:#ddd">
				<col style="background-color:#ccffff;text-align:right">
    <col style="background-color:pink">
    <col style="background-color:#ccffff;text-align:right">
    <col style="background-color:#ccffee">
				<col style="background-color:#ccffdd">
				<col style="background-color:#ccffcc">
				<col style="background-color:#ccffbb">
				<col style="background-color:#ccffaa">
				<col style="background-color:#ccff99">
				<col style="background-color:#ccff88">
				<col style="background-color:#ccff77">
  </colgroup>
<tr>
	<th>#<br>Level</th>
	<th>Name<br>MCA#</th>
	<th>Title<br>Mobile</th>
	<th style="text-align:center">Joining<br>Days</th>
	<th style="text-align:center">DL<br>Active</th>
	<th style="text-align:center">PBV</th>
	<th style="text-align:center">GBV</th>
	<th style="text-align:center">TGBC</th>
	<th style="text-align:center">TCGBV</th>
	<th style="text-align:center">Legs</th>
	<th style="text-align:center">QDLegs</th>
	<th style="text-align:center">PGBV</th>
	<th style="text-align:center">Rollup</th>

</tr>
<tr>
	<th>0<br><?=$selfline['YYYYMM'][$months][$thismonth]['Level']?></th>
	<th><?=$selfline['mcaName']?><br><?=$selfline['mcaNumber']?></th>

	<th><span ><?=$selfline['YYYYMM'][$months][$thismonth]['ValidTitle']?> <?=$selfline['YYYYMM'][$months][$thismonth]['Percent']?>%</span><br>
	<i class="glyphicon glyphicon-phone"></i><?=$selfline['Mobile']?>
	</th>
	<td style="text-align:center"><?=$selfline['DateJoin']?><br><?=$selfline['Days']?> days</td>
	<td style="text-align:right"><?=$selfline['countChild']?><br><?=$selfline['YYYYMM'][$months][$thismonth]['Active']?></td>
	<td style="text-align:right"><?=moneyFormatIndia($selfline['YYYYMM'][$months][$thismonth]['BV'])?></td>
	<td style="text-align:right"><?=moneyFormatIndia($selfline['YYYYMM'][$months][$thismonth]['GBV'])?></td>
	<td style="text-align:right"><?=moneyFormatIndia($selfline['YYYYMM'][$months][$thismonth]['TGBV'])?></td>
	<td style="text-align:right"><?=moneyFormatIndia($selfline['YYYYMM'][$months][$thismonth]['TCGBV'])?></td>
	<td style="text-align:center"><span class="badge"><?=$selfline['YYYYMM'][$months][$thismonth]['Legs']?></span></td>
	<td style="text-align:center"><span class="badge"><?=$selfline['YYYYMM'][$months][$thismonth]['QDLegs']?></span></td>
	<td style="text-align:right"><?=moneyFormatIndia($selfline['YYYYMM'][$months][$thismonth]['PGBV'])?></td>
	<td style="text-align:right"><?=moneyFormatIndia($selfline['YYYYMM'][$months][$thismonth]['Rollup'])?></td>
</tr>
<?php

$i = 1;
	foreach($downline as $d){
		?>
		<tr>
		<th><?=$i?><br><?=$d['YYYYMM'][$months][$thismonth]['Level']?></th>
		<th><a href="/users/display/<?=$d['mcaNumber']?>/<?=$d['refer']?>"><?=$d['mcaName']?><br><?=$d['mcaNumber']?></a></th>
	
	<th><span ><?=$d['YYYYMM'][$months][$thismonth]['ValidTitle']?> <?=$d['YYYYMM'][$months][$thismonth]['Percent']?>%</span><br>
	<i class="glyphicon glyphicon-phone"></i><?=$d['Mobile']?>
	</th>
	<td style="text-align:center"><?=$d['DateJoin']?><br><?=$d['Days']?> days</td>
	<td style="text-align:right"><?=$d['countChild']?><br><?=$d['YYYYMM'][$months][$thismonth]['Active']?></td>
	<td style="text-align:right"><?=moneyFormatIndia($d['YYYYMM'][$months][$thismonth]['BV'])?></td>
	<td style="text-align:right"><?=moneyFormatIndia($d['YYYYMM'][$months][$thismonth]['GBV'])?></td>
	<td style="text-align:right"><?=moneyFormatIndia($d['YYYYMM'][$months][$thismonth]['TGBV'])?></td>
	<td style="text-align:right"><?=moneyFormatIndia($d['YYYYMM'][$months][$thismonth]['TCGBV'])?></td>
	<td style="text-align:center"><span class="badge"><?=$d['YYYYMM'][$months][$thismonth]['Legs']?></span></td>
	<td style="text-align:center"><span class="badge"><?=$d['YYYYMM'][$months][$thismonth]['QDLegs']?></span></td>
	<td style="text-align:right"><?=moneyFormatIndia($d['YYYYMM'][$months][$thismonth]['PGBV'])?></td>
	<td style="text-align:right"><?=moneyFormatIndia($d['YYYYMM'][$months][$thismonth]['Rollup'])?></td>
		
		</tr>
		<?php
		$i++;
	}
?>
</table>
</div>

<?php
function levels($number,$levels){
	foreach($levels as $l){
		if($number>$l['Min'] && $number<$l['Max']){
			return $l['Level'];
		}
	}
	return 0;
}

		for ($i=12;$i>=0;$i--){
			$thismonth = gmdate('Y-m',mktime(0,0,0,gmdate('m',time()),gmdate('d',time()),gmdate('Y',time()))-$i*60*60*24*30);
		}

?><strong>
</strong>
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