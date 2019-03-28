<?php
use app\extensions\action\Functions;
$function = new Functions();
use lithium\g11n\Message;
extract(Message::aliases());

ini_set('memory_limit', '-1');


$pdf =& $this->Pdf;
//$pdf->SetProtection($permissions=array('modify','extract','assemble'), $user_pass=$printdata['email'], $owner_pass=null, $mode=1, $pubkeys=null);

$this->Pdf->setCustomLayout(array(
    'header'=>function() use($pdf){
        list($r, $g, $b) = array(200,200,200);
        $pdf->SetFillColor($r, $g, $b); 
        $pdf->SetTextColor(0 , 0, 0);
        $pdf->Cell(0,15, "IndianEagles.Team - Order ", 0,1,'C', 1);
        $pdf->Ln();
    },
    'footer'=>function() use($pdf){
        $footertext = sprintf('http://indianeagles.team Goolge Play App: search "IndianEagles"'. $result['orderNo']); 
        $pdf->SetY(-10); 
        $pdf->SetTextColor(0, 0, 0); 
        $pdf->SetFont(PDF_FONT_NAME_MAIN,'', 8); 
        $pdf->Cell(0,8, $footertext . ' - '. date('Y'),'T',1,'C');
    }
));

$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
$pdf->SetAuthor('http://IndianEagles.Team/');
$pdf->SetCreator('admin@indianeagles.team');
$pdf->SetSubject('Order No:'.$result['orderNo']);
$pdf->SetKeywords('Secure Order from Mobile App of Indian Eagles');
$pdf->SetTitle('IndianEagles.Team Order: '.$result['orderNo']);


$pdf->SetAutoPageBreak(true);
$pdf->AddPage();
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(10,20,false);
$html = '
<div style="padding:5px">
	<table width="100%">
		<thead>
			<tr>
				<th width="40%">Order No</th>
				<th><strong>'.$result['orderNo'].'</strong></th>
			</tr>
		</thead>
			<tr>
				<td width="40%">Name:</td>
				<td>'.$result['user']['mcaName'].'</td>
			</tr>
			<tr>
				<td width="40%">MCA #:</td>
				<td>'.$result['user']['mcaNumber'].'</td>
			</tr>
			<tr>
				<td width="40%">Email:</td>
				<td>'.$result['user']['email'].'</td>
			</tr>
			<tr>
				<td width="40%">Mobile:</td>
				<td>'.$result['user']['mobile'].'</td>
			</tr>
			<tr>
				<td width="40%">Address:</td>
				<td>'.$result['user']['address'].'</td>
			</tr>			
			<tr>
				<td width="40%">City:</td>
				<td>'.$result['user']['city'].'</td>
			</tr>			
			<tr>
				<td width="40%">State:</td>
				<td>'.$result['user']['state'].'</td>
			</tr>';
			
			if($result['collect']=="dp"){
				
				$html = $html.'<tr>
				<th width="40%">Collect:</th>
				<td>Collect from DP</td>
			</tr>
			<tr>
				<th width="40%">DP Name:</th>
				<td>'.$result['dpdetails']['Name'].'</td>
			</tr>
			<tr>
				<th width="40%">DP email:</th>
				<td>'.$result['dpdetails']['Email'].'</td>
			</tr>
			<tr>
				<th width="40%">DP Mobile:</th>
				<td>'.$result['dpdetails']['Mobile'].'</td>
			</tr>			
			<tr>
				<th width="40%">DP PayTM:</th>
				<td>'.$result['dpdetails']['PayTM'].'</td>
			</tr>			
			<tr>
				<th width="40%">DP Address:</th>
				<td>'.$result['dpdetails']['Address'].'</td>
			</tr>			
			<tr>
				<th width="40%">DP City:</th>
				<td>'.$result['dpdetails']['City'].'</td>
			</tr>			
			<tr>
				<th width="40%">DP State:</th>
				<td>'.$result['dpdetails']['State'].'</td>
			</tr>			
			<tr>
				<td colspan="2">Please make the payment to PayTM: '.$result['dpdetails']['PayTM'].'. 
				</td>
			</td>
			</tr>
			';			
			}
			if($result['collect']=='home'){
				$html = $html.'
			<tr>
				<th width="40%">Collect:</th>
				<td>Deliver to Address:</td>
			</tr>
			<tr>
				<td colspan="2">Please make the payment to PayTM: 7597219319
				</td>
			</td>
			</tr>			
			';
			}
				$html = $html.'
			<tr>
			<td colspan="2">
			<h2>Detail Order</h2>
				<table style="width=100%;font-size:20px" border="1" cellpadding="3">
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
					';
					$i = 1;
					foreach($result['allorders'] as $o){
				$html = $html.'
					<tr>
						<th>'.$i.'</th>
						<th>'.$o['Code'].'</th>
						<th>'.$o['Name'].'</th>
						<th>'.$o['Size'].'</th>
						<th style="text-align:right">'.number_format($o['MRP'],2).'</th>
						<th style="text-align:right">'.number_format($o['DP'],2).'</th>
						<th style="text-align:right">'.$o['Quantity'].'</th>
						<th style="text-align:right">'.number_format($o['MRP']*$o['Quantity'],2).'</th>
						<th style="text-align:right">'.number_format($o['DP']*$o['Quantity'],2).'</th>
					</tr>
					';	
						$i++;
						$totalQ = $totalQ + $o['Quantity'];
						$totalMRP = $totalMRP + ($o['MRP']*$o['Quantity']);
						$totalDP = $totalDP + ($o['DP']*$o['Quantity']);
						
					}
				$html = $html.'
					<tr>
						<th colspan="6">Total </th>
						<th style="text-align:right">'.$totalQ.'</th>
						<th style="text-align:right">Rs. '.number_format($totalMRP,2).'</th>
						<th style="text-align:right">Rs. '.number_format($totalDP,2).'</th>
					</tr>
					';
					$function = new Functions();
					if($result['user']['mcaNumber']>0){
				$html = $html.'
					<tr>
						<th colspan="8"><strong>To pay Total</strong></th>
						<th style="text-align:right"><strong>Rs. '.number_format($totalDP,2).'</strong></th>
					</tr>
					<tr>
						<th colspan="9">Rs. '.strtoupper($function->number_to_words(round($totalDP,2))).' ONLY</th>
					</tr>					
					';
					}
					if($result['user']['mcaNumber']=="" || $result['user']['mcaNumber']=="undefined" || $result['user']['mcaNumber']=='null'){
				$html = $html.'
					<tr>
						<th colspan="8"><strong>To pay Total Rs.</strong></th>
						<th style="text-align:right"><strong>Rs. '.number_format($totalMRP,2).'</strong></th>
					</tr>
					<tr>
						<th colspan="9">Rs. '.strtoupper($function->number_to_words(round($totalMRP,2))).' ONLY</th>
					</tr>					
					';						
					}
					
			$html = $html.'					
				</table>
				
			</td>
			</tr>
				';
			$html = $html.'</table></div>';
				
$pdf->writeHTML($html, true, 0, true, 0);
?>