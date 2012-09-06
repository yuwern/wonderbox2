<?php
App::import('Vendor','mpdf/mpdf');  
$mpdf=new mPDF('c','A4');
//$mpdf=new mPDF('win-1252','A4','','',20,15,48,25,10,10);
$mpdf->useOnlyCoreFonts = true;    // false is default
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Acme Trading Co. - Invoice");
$mpdf->SetAuthor("Acme Trading Co.");
$mpdf->SetWatermarkText("WonderBox");
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$html = '

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="8">
<thead>
<tr>
<td width="10%" align="center">S. NO.</td>
<td width="10%" align="center">Name</td>
<td width="20%">Email</td>
<td width="25%">Address</td>
<td width="20%">Mobile No</td>
<td width="20%">Phone No</td>
<td width="15%">Active</td>
</tr>
</thead>
<tbody>';
if($packageUsers):
$i= 1;
foreach($packageUsers as $packageUser):

$html .='<!-- ITEMS HERE -->
<tr>
<td align="center">'.$i.'</td>
<td align="center">'.$this->Html->cText($packageUser['User']['UserProfile']['first_name']).'</td>
<td align="left">'.$packageUser['User']['email'].'</td>
<td align="left">'.$packageUser['User']['UserShipping'][0]['address'].','.$packageUser['User']['UserShipping'][0]['State']['name'].','.$packageUser['User']['UserShipping'][0]['Country']['name'].','.$packageUser['User']['UserShipping'][0]['zip_code'].'</td>
<td align="left">'.$this->Html->cText($packageUser['User']['UserShipping'][0]['contact_no']).'</td>
<td align="left">'.$this->Html->cText($packageUser['User']['UserShipping'][0]['contact_no1']).'</td>
<td align="left">'. date("F Y",strtotime($packageUser['PackageUser']['start_date'])).'</td>
</tr>';
$i++;
endforeach;
else:
$html .= '<tr>
<td align="center">No users is avialable</td>
</tr>';
endif; 
$html .='
</tbody>
</table>
</body>
</html>
';

$mpdf->WriteHTML($html);

$mpdf->Output(); exit;


?> 