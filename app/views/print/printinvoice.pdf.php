<?php
use app\extensions\action\Functions;
$function = new Functions();

ini_set('memory_limit', '-1');
//print_r($billData['invoiceSr']);exit;
$pdf =& $this->Pdf;
//$pdf->SetProtection($permissions=array('modify','extract','assemble'), $user_pass=$printdata['email'], $owner_pass=null, $mode=1, $pubkeys=null);

$this->Pdf->setCustomLayout(array(
    'header'=>function() use($pdf){
        list($r, $g, $b) = array(200,200,200);
        $pdf->SetFillColor($r, $g, $b); 
        $pdf->SetTextColor(0 , 0, 0);
        $pdf->Cell(0,15, "MODICARE TEMPORARY BILL", 0,1,'C', 1);
        $pdf->Ln();
    },
    'footer'=>function() use($pdf){
        $footertext = sprintf('This bill is not a INVOICE. Please ask for the INVOICE from Modicare', date('Y')); 
        $pdf->SetY(-10); 
        $pdf->SetTextColor(0, 0, 0); 
        $pdf->SetFont(PDF_FONT_NAME_MAIN,'', 8); 
        $pdf->Cell(0,8, $footertext,'T',1,'C');
    }

));

$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
$pdf->SetAuthor('https://IndianEagles.Team');
$pdf->SetCreator('ruchi.doctor.modicare@gmail.com');
$pdf->SetSubject('Modicare - contact: +91 9879578244, +91 7597219319');
$pdf->SetKeywords('Modicare Temp Bill');
$pdf->SetTitle('Modicare - contact: +91 9879578244, +91 7597219319');


$pdf->SetAutoPageBreak(true);
$pdf->AddPage();
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(10,20,false);
$html = '
<table cellpadding=10 cellspacing=10 border=0 style="font-size:24px">
<tr>
<td style="font-size:30px;font-weight:bold;padding:5px">Bill: '.$billData['invoiceSr'].$billData['invoiceNo'].'</td>
<td style="text-align:right;font-size:30px;font-weight:bold;padding:5px">DP Name: '.$billData['DPName'].'</td>
</tr>
</table>
<br>
<table cellpadding=10 cellspacing=10 border=0 style="font-size:24px">
<tr>
 <td>MCA: <strong>'.$billData['mcaNumber'].'</strong></td>
 <td>Name: <strong>'.$billData['mcaName'].'</strong></td>
 <td>Mobile: <strong>'.$billData['mcaPhone'].'</strong></td>
 <td style="text-align:right">Date: <strong>'.date('Y M d',$billData['DateTime']->sec).'</strong></td>
</tr>
</table><br><br>
<table cellpadding=5 cellspacing=0 border=1 style="border:0.5pt solid black;font-size:24px">
 <tr>
  <th width="5%" style="text-align:center;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">Sr.</th>
  <th width="10%" style="text-align:center;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">Code</th>
  <th width="50%" style="text-align:left;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">Name</th>
  <th width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">Qty</th>
  <th width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">DP</th>
  <th width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">BV</th>
  <th width="10%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">Total DP</th>
  <th width="10%" style="text-align:right;border-bottom:0.5pt solid black;padding-top:5px">Total BV</th>
 </tr>';
 foreach($billDetails as $bd){
$html = $html .' 
 <tr>
  <td width="5%" style="text-align:center;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$bd['srno'].'</td>
  <td width="10%" style="text-align:center;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$bd['code'].'</td>
  <td width="50%" style="text-align:left;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$bd['name'].'</td>
  <td width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$bd['Quantity'].'</td>
  <td width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$bd['DP'].'</td>
  <td width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$bd['BV'].'</td>
  <td width="10%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$bd['TotalDP'].'</td>
  <td width="10%" style="text-align:right;border-bottom:0.5pt solid black">'.$bd['TotalBV'].'</td>
 </tr>';
 }
 $html = $html .' 
 <tr>
  <th width="5%" style="text-align:center;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px"></th>
  <th width="10%" style="text-align:center;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">Total</th>
  <th width="50%" style="text-align:left;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px"># '.$billData['totalItems'].'</th>
  <th width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$billData['totalProducts'].'</th>
  <th width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px"></th>
  <th width="5%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px"></th>
  <th width="10%" style="text-align:right;border-right:0.5pt solid black;border-bottom:0.5pt solid black;padding-top:5px">'.$billData['totalDP'].'</th>
  <th width="10%" style="text-align:right;border-bottom:0.5pt solid black;padding-top:5px">'.$billData['totalBV'].'</th>
 </tr>';

$html = $html .'</table>';
$words = $function->number_to_words($billData['totalDP']);
$html = $html .'<h5>Rs. '.ucwords($words).' ONLY</h5>';
$html = $html .'Payment: <strong>'.$billData['payment'];
$html = $html .'</strong><br>';
$html = $html .'Remarks: '.$billData['Remarks'].'';
$html = $html .'<p>Prepared by: ';
$html = $html .$billData['prepared'];
$html = $html .',  Mobile: ';
$html = $html .$billData['preparedMobile'];
$html = $html .'</p>';
$html = $html .'<hr>';
$html = $html .'
<table cellpadding="2" cellspacing="0" border="0" style="border:0.25pt solid black;font-size:24px">
 <tr>
  <td colspan="3" style="text-align:center;background-color:#ddd">Modicare Azadi Plan - IndianEagles.Team - School of Financial Freedom</td>
 </tr>
 <tr>
  <td colspan="2" style="text-align:center;border:0.25pt solid black;" width="50%">MRP - DP Difference (15% to 20%)</td>
  <td style="text-align:center;border:0.25pt solid black;" width="50%">MRP - BV Difference (35% to 60%) Avg 50%</td>
 </tr>
 <tr>
  <td colspan="2" style="text-align:center">
   <table cellpadding="2" cellspacing="0" border="0" style="border:0.25pt solid black;font-size:24px"  width="100%">
    <tr>
     <td colspan="3" style="text-align:center;background-color:#ddd;border:0.25pt solid black;"><b>Loyalty Program</b></td>
    </tr>
    <tr>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">Month</td>
     <td colspan="3" style="text-align:center;border:0.25pt solid black;">Purchase (1-15 of month)</td>
    </tr>
    <tr>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">1</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2500-5000</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2500 NJP</td>
    </tr>
   <tr>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2500-5000</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">3000 RPP</td>
    </tr>
   <tr>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">3</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2500-5000</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2000+1000 RPP</td>
    </tr>
   <tr>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">4</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2500-5000</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">5000 RPP</td>
    </tr>
   <tr>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">5</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2500-5000</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">3000+2000 RPP</td>
    </tr>
   <tr>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">6</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2500-5000</td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;">2000+3000 RPP</td>
    </tr>
   <tr>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;"><b>Average</b></td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;"><b>FREE</b></td>
     <td colspan="1" style="text-align:center;border:0.25pt solid black;"><b>4333</b></td>
    </tr>
    <tr>
     <td colspan="3" style="text-align:center;background-color:#ddd">Available every 6 months in rotation 12 consecutive months 4333+5000=4700 average <b>FREE 3 times</b></td>
    </tr>
   </table>
  </td>
  <td style="text-align:center">
   <table cellpadding="2" cellspacing="0" border="0" style="border:0.25pt solid black;font-size:24px;text-align:center" width="100%">
   <tr>
    <td>
     <table cellpadding="2" cellspacing="0" border="0" style="border:0.25pt solid black;font-size:24px" width="100%">
      <tr>
       <td colspan="2" style="text-align:center;background-color:#ddd;border:0.25pt solid black;"><b>New Joining Program (NJP)</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;background-color:#ddd;border:0.25pt solid black;"><b>DP</b></td>
       <td width="50%" style="text-align:center;background-color:#ddd;border:0.25pt solid black;"><b>FREE</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;border:0.25pt solid black;">2000</td>
       <td width="50%" style="text-align:center;border:0.25pt solid black;"><b>200</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;border:0.25pt solid black;">3000</td>
       <td width="50%" style="text-align:center;border:0.25pt solid black;"><b>300</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;border:0.25pt solid black;">4000</td>
       <td width="50%" style="text-align:center;border:0.25pt solid black;"><b>400</b></td>
      </tr>
      <tr>
       <td colspan="2" style="text-align:center;background-color:#ddd;border:0.25pt solid black;">Only one slab available</td>
      </tr>
      <tr>
       <td colspan="2" style="text-align:center;background-color:#ddd;border:0.25pt solid black;">Special month end benefits</td>
      </tr>
     </table>
    </td>
    <td>
     <table cellpadding="2" cellspacing="0" border="0" style="border:0.25pt solid black;font-size:24px" width="100%">
      <tr>
       <td colspan="2" style="text-align:center;background-color:#ddd;border:0.25pt solid black;"><b>Re-Purchase Program</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;background-color:#ddd;border:0.25pt solid black;"><b>DP</b></td>
       <td width="50%" style="text-align:center;background-color:#ddd;border:0.25pt solid black;"><b>FREE</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;border:0.25pt solid black;">1000</td>
       <td width="50%" style="text-align:center;border:0.25pt solid black;"><b>100</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;border:0.25pt solid black;">2000</td>
       <td width="50%" style="text-align:center;border:0.25pt solid black;"><b>200</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;border:0.25pt solid black;">3000</td>
       <td width="50%" style="text-align:center;border:0.25pt solid black;"><b>300</b></td>
      </tr>
      <tr>
       <td width="50%" style="text-align:center;border:0.25pt solid black;">5000</td>
       <td width="50%" style="text-align:center;border:0.25pt solid black;"><b>500</b></td>
      </tr>
      <tr>
       <td colspan="2" style="text-align:center;background-color:#ddd;border:0.25pt solid black;">All slab available</td>
      </tr>
     </table>
    </td>
   </tr>
   <tr>
    <td colspan="2">10% benefit (FREE Gift) in NJP and RPP</td>
   </tr>
   <tr>
    <td colspan="2" style="text-align:center;background-color:#ddd"><b>Joining Requirements</b></td>
   </tr>
   <tr>
    <td colspan="1">Aadhar / PAN / Cheque Passbook</td>
    <td colspan="1">Mobile / Email / Date of Birth</td>
   </tr>
   </table>
  </td>
 </tr>
</table>
<table style="text-align:center;font-size:20px">
<tr><td>PATTAYA</td></tr>
<tr><td>Base Title: March 2018</td></tr>
<tr><td>Offer Period: April - December 2018 (9 Months)</td></tr>
<tr><td>Couple ticket: Double your target</td></tr>
<tr><td>Any consultant joins during this period has to do a total PGBV of 3,00,000 after he / she becomes a Director. Roll up is not included in Pure PGBV.</td></tr>
</table>
<table cellpadding="2" cellspacing="0" border="0" style="border:0.25pt solid black;font-size:20px" width="100%">
 <tr>
  <td style="text-align:center;border:0.25pt solid black;"><b>Title</b></td>
  <td style="text-align:center;border:0.25pt solid black;"><b>Target PGBV</b></td>
  <td style="text-align:center;border:0.25pt solid black;"><b>Monthly Minimum PGBV</b></td>
 </tr>
 <tr>
  <td style="text-align:center;border:0.25pt solid black;">Director</td>
  <td style="text-align:center;border:0.25pt solid black;">3,00,000</td>
  <td style="text-align:center;border:0.25pt solid black;">31,250</td>
 </tr>
 <tr>
  <td style="text-align:center;border:0.25pt solid black;">Senior Director</td>
  <td style="text-align:center;border:0.25pt solid black;">2,75,000</td>
  <td style="text-align:center;border:0.25pt solid black;">27,500</td>
 </tr>
 <tr>
  <td style="text-align:center;border:0.25pt solid black;">Executive Director</td>
  <td style="text-align:center;border:0.25pt solid black;">2,50,000</td>
  <td style="text-align:center;border:0.25pt solid black;">22,500</td>
 </tr>
 <tr>
  <td style="text-align:center;border:0.25pt solid black;">Senior Executive Director</td>
  <td style="text-align:center;border:0.25pt solid black;">2,25,000</td>
  <td style="text-align:center;border:0.25pt solid black;">15,000</td>
 </tr>
 <tr>
  <td style="text-align:center;border:0.25pt solid black;">Platinum Director</td>
  <td style="text-align:center;border:0.25pt solid black;">2,00,000</td>
  <td style="text-align:center;border:0.25pt solid black;">15,000</td>
 </tr>
 <tr>
  <td style="text-align:center;border:0.25pt solid black;">Presidential Direct & Above</td>
  <td colspan="2" style="text-align:center;border:0.25pt solid black;">Travel ONLY from Travel Fund</td>
 </tr>
</table>
';
$pdf->writeHTML($html, true, 0, true, 0);
?>