<?php echo $this->_render('element', 'bill');?>	
<?php 
use lithium\storage\Session;
$employee = Session::read('employee');
?>
<div class="container ">
<br><br><h3>List Bills</h3>
<table>
<tr>
<?php
foreach($bills as $b){
 print_r($b['invoiceNo']);
 
}
?>