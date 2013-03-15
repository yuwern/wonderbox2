<?php
App::import('Vendor','mpdf/mpdf');  
$mpdf=new mPDF('c','A4');
//$mpdf=new mPDF('win-1252','A4','','',20,15,48,25,10,10);
$mpdf->useOnlyCoreFonts = true;    // false is default
$mpdf->SetProtection(array('copy','print','modify','annot-forms','fill-forms','extract','assemble','print-highres'));
$mpdf->SetTitle("Wonderbox - Report");
$mpdf->SetAuthor("Wonder Box");
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$html = '
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="8">
<thead>
<tr>
<td width="10%" align="center">S. NO.</td>
<td width="10%" align="center">User Name</td>
<td width="20%">User Email</td>
<td width="10%" align="center">Friend Name</td>
<td width="10%" align="center">Friend Email</td>
<td width="25%">ADD1</td>
<td width="25%">ADD2</td>
<td width="25%">ADD3</td>
<td width="20%">RECEIVER TEL (MOBILE)</td>
<td width="20%">RECEIVER TEL (HOME)</td>
</tr>
</thead>
<tbody>';
if($giftUsers):
$i= 1;
foreach($giftUsers as $giftUser):
$user_name = $giftUser['User']['UserProfile']['first_name'] .' '. $giftUser['User']['UserProfile']['last_name'];
$address1 = !empty($giftUser['GiftUser']['address'])?$giftUser['GiftUser']['address']:$giftUser['User']['UserShipping'][0]['address'];
$address2 = !empty($giftUser['GiftUser']['address1'])?$giftUser['GiftUser']['address1']:$giftUser['User']['UserShipping'][0]['address1'];
$address3 = !empty($giftUser['GiftUser']['address2'])?$giftUser['GiftUser']['address2']:$giftUser['User']['UserShipping'][0]['address2'];
$contact1 =  !empty($giftUser['GiftUser']['contact_no'])?$giftUser['GiftUser']['contact_no']:$giftUser['User']['UserShipping'][0]['contact_no'];
$contact2 =  !empty($giftUser['GiftUser']['contact_no1'])?$giftUser['GiftUser']['contact_no1']:$giftUser['User']['UserShipping'][0]['contact_no1'];

$html .='<!-- ITEMS HERE -->
<tr>
<td align="center">'.$i.'</td>
<td align="center">'.$this->Html->cText($user_name).'</td>
<td align="left">'.$giftUser['User']['email'].'</td>
<td align="center">'.$this->Html->cText($giftUser['GiftUser']['friend_name']).'</td>
<td align="center">'.$this->Html->cText($giftUser['GiftUser']['friend_mail']).'</td>
<td align="left">'.$address1.'</td>
<td align="left">'.$address2.'</td>
<td align="left">'.$address3.'</td>
<td align="left">'.$this->Html->cText($contact1).'</td>
<td align="left">'.$this->Html->cText($contact2).'</td>
</tr>';
$i++;
endforeach;
else:
$html .= '<tr>
<td align="center">No Gift Users is avialable</td>
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