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
<td width="35%" align="center">S. NO.</td>
<td width="10%" align="center">Name</td>
<td width="45%">Email</td>
<td width="45%">Active</td>
</tr>
</thead>
<tbody>';
if($users):
$i= 1;
foreach($users as $user):
$username = $user['UserProfile']['first_name'];
$email = $user['User']['email'];
$is_verified_user = $user['User']['is_verified_user'];
$html .='<!-- ITEMS HERE -->
<tr>
<td align="center">'.$i.'</td>
<td align="center">'.$this->Html->cText($user['UserProfile']['first_name']).'</td>
<td align="left">'.$user['User']['email'].'</td>
<td align="left">'.$this->Html->cBool($user['User']['is_verified_user']).'</td>
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