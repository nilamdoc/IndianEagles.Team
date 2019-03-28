<?php
header("Content-type: application/pdf");
echo $this->Pdf->Output(OUTPUT_DIR.$billData['invoiceSr'].$billData['invoiceNo']."-Bill".".pdf","F");
?>